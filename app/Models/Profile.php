<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'alamat',
        'telepon',
        'pekerjaan',
        'foto',
        'tahun_lulus',
        'nim'
    ];

    protected $casts = [
        'tahun_lulus' => 'integer'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
