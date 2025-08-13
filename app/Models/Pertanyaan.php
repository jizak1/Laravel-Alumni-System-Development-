<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    use HasFactory;

    protected $table = 'pertanyaan';

    protected $fillable = [
        'teks',
        'tipe',
        'opsi',
        'wajib',
        'urutan'
    ];

    protected $casts = [
        'opsi' => 'array',
        'wajib' => 'boolean',
        'urutan' => 'integer'
    ];

    public function kuisioner()
    {
        return $this->hasMany(Kuisioner::class);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan');
    }
}
