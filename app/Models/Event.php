<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'event';

    protected $fillable = [
        'judul',
        'deskripsi',
        'tanggal',
        'lokasi',
        'gambar',
        'status'
    ];

    protected $casts = [
        'tanggal' => 'datetime'
    ];

    public function scopeUpcoming($query)
    {
        return $query->where('tanggal', '>=', now());
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('tanggal', 'desc');
    }
}
