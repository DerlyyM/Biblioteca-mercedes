<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    // Campos que se pueden registrar masivamente
    protected $fillable = [
        'title',
        'author',
        'publisher',
        'published_year',
        'category',
        'stock',
        'is_active'
    ];
}