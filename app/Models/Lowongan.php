<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    use HasFactory;

    protected $table = 'lowongan';

    protected $fillable = [
        'user_id',
        'judul',
        'deskripsi',
        'perusahaan',
        'lokasi',
        'link',
        'tanggal_posting',
        'tanggal_berakhir',
        'status'
    ];

    protected $casts = [
        'tanggal_posting' => 'date',
        'tanggal_berakhir' => 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active')
                    ->where(function($q) {
                        $q->whereNull('tanggal_berakhir')
                          ->orWhere('tanggal_berakhir', '>=', now());
                    });
    }
}
