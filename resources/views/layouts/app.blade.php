<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Biblioteca Mercedes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/custom-pagination.css') }}">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('books.index') }}">
                <i class="bi bi-book"></i> Biblioteca Nuestra señora de las Mercedes
            </a>

            <div class="d-flex gap-2 align-items-center">
                @auth
                    @if(auth()->user()->role === 'coordinator')
                        <div class="dropdown">
                            <button class="btn btn-outline-light btn-sm dropdown-toggle" type="button" id="notificationsMenu" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-bell"></i>
                                @if(auth()->user()->unreadNotifications->count())
                                    <span class="badge bg-danger">{{ auth()->user()->unreadNotifications->count() }}</span>
                                @endif
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationsMenu" style="min-width: 400px;">
                                @forelse(auth()->user()->unreadNotifications->take(5) as $notification)
                                    <li>
                                        <a href="{{ $notification->data['url'] ?? route('books.index') }}" class="dropdown-item" onclick="markAsRead('{{ $notification->id }}')"
                                           style="white-space: normal; padding: 10px 15px;">
                                            <small class="text-muted">{{ $notification->data['creator_name'] ?? 'Estudiante' }}</small><br>
                                            <strong>{{ $notification->data['title'] ?? 'Nuevo libro' }}</strong><br>
                                            <small class="text-muted">{{ $notification->data['message'] ?? 'Se registró un nuevo libro' }}</small>
                                        </a>
                                    </li>
                                @empty
                                    <li>
                                        <span class="dropdown-item-text">No hay notificaciones nuevas.</span>
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                        <a href="{{ route('students.index') }}" class="btn btn-outline-light btn-sm">
                            <i class="bi bi-people-fill"></i> Estudiantes
                        </a>
                    @endif

                    <span class="text-white me-2">Hola, {{ auth()->user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-outline-light btn-sm">Cerrar sesión</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">Iniciar sesión</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function markAsRead(notificationId) {
            fetch(`/notifications/${notificationId}/read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                    'Content-Type': 'application/json',
                },
            }).catch(error => console.log('Notification marked'));
        }
    </script>
</body>
</html>