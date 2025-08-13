<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilProdi extends Model
{
    use HasFactory;

    protected $table = 'profil_prodi';

    protected $fillable = [
        'nama_prodi',
        'deskripsi',
        'visi',
        'misi',
        'kontak',
        'email',
        'website'
    ];
}
