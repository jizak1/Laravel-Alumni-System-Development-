<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Event;
use App\Models\Lowongan;
use App\Models\ProfilProdi;
use App\Models\Skripsi;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $profil_prodi = ProfilProdi::first();
        $recent_berita = Berita::published()->latest()->take(3)->get();
        $upcoming_events = Event::upcoming()->latest()->take(3)->get();
        $recent_lowongan = Lowongan::active()->latest()->take(6)->get();
        $public_skripsi = Skripsi::public()->latest()->take(6)->get();

        return view('landing', compact(
            'profil_prodi',
            'recent_berita',
            'upcoming_events',
            'recent_lowongan',
            'public_skripsi'
        ));
    }
}
