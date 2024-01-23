<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'short_name',
        'long_name',
        'alamat',
        'email',
        'wa',
        'logo',
        'token',
        'zip_code',
        'country',
        'phone_number',
        'website',
        'description',
    ];
}