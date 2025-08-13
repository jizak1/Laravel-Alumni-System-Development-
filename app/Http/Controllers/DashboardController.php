<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Event;
use App\Models\Lowongan;
use App\Models\Skripsi;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        if ($user->isAdmin()) {
            return $this->adminDashboard();
        } else {
            return $this->alumniDashboard();
        }
    }

    private function adminDashboard()
    {
        $stats = [
            'total_alumni' => User::where('role', 'alumni')->count(),
            'total_skripsi' => Skripsi::count(),
            'pending_skripsi' => Skripsi::where('status', 'pending')->count(),
            'total_lowongan' => Lowongan::count(),
            'total_berita' => Berita::count(),
            'total_event' => Event::count(),
        ];

        $recent_skripsi = Skripsi::with('user')
            ->where('status', 'pending')
            ->latest()
            ->take(5)
            ->get();

        $recent_alumni = User::where('role', 'alumni')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_skripsi', 'recent_alumni'));
    }

    private function alumniDashboard()
    {
        $user = auth()->user();
        
        $stats = [
            'my_skripsi' => $user->skripsi()->count(),
            'my_lowongan' => $user->lowongan()->count(),
            'profile_complete' => $user->profile && $user->profile->alamat ? true : false,
        ];

        $recent_berita = Berita::published()->latest()->take(3)->get();
        $upcoming_events = Event::upcoming()->latest()->take(3)->get();
        $recent_lowongan = Lowongan::active()->latest()->take(5)->get();

        return view('alumni.dashboard', compact('stats', 'recent_berita', 'upcoming_events', 'recent_lowongan'));
    }
}
