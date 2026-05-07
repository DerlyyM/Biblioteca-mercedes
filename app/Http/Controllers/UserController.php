<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (! Auth::check()) {
                return redirect()->route('login');
            }

            if (Auth::user()->role !== 'coordinator') {
                abort(403, 'Acceso no autorizado.');
            }

            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $search = $request->input('search');

        $students = User::where('role', '=', 'student', 'and');

        if ($search) {
            $students->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%");

                if (is_numeric($search)) {
                    $query->orWhere('id', $search);
                }
            });
        }

        $students = $students->orderBy('id')->paginate(5)->appends(['search' => $search]);

        return view('users.index', compact('students', 'search'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('password123'), // Contraseña por defecto
            'role' => 'student',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        return redirect()->route('students.index')->with('success', 'Estudiante creado correctamente. La contraseña por defecto es "password123".');
    }

    public function toggle(Request $request, string $id)
    {
        $student = User::where('role', '=', 'student', 'and')->findOrFail($id);

        $student->update(['is_active' => ! $student->is_active]);

        return back()->with('success', 'El estado del estudiante se actualizó correctamente.');
    }
}
