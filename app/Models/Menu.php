<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    // Define fillable fields to protect against mass-assignment vulnerabilities
    protected $fillable = [
        'name',
        'description',
        'price',
        'photo',
        'category',
    ];
}
