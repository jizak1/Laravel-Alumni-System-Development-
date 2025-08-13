<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\Kuisioner;
use App\Models\Pertanyaan;
use Illuminate\Http\Request;

class KuisionerController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $pertanyaan = Pertanyaan::ordered()->get();
        $jawaban = Kuisioner::where('user_id', $user->id)->pluck('jawaban', 'pertanyaan_id');
        $sudah_mengisi = $jawaban->count() > 0;

        return view('alumni.kuisioner.index', compact('pertanyaan', 'jawaban', 'sudah_mengisi'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $pertanyaan = Pertanyaan::all();

        // Validate required questions
        $rules = [];
        foreach ($pertanyaan as $p) {
            if ($p->wajib) {
                $rules["jawaban.{$p->id}"] = 'required';
            }
        }

        $request->validate($rules, [
            'jawaban.*.required' => 'Pertanyaan ini wajib diisi.',
        ]);

        // Delete existing answers
        Kuisioner::where('user_id', $user->id)->delete();

        // Save new answers
        foreach ($request->jawaban as $pertanyaan_id => $jawaban) {
            if (!empty($jawaban)) {
                Kuisioner::create([
                    'user_id' => $user->id,
                    'pertanyaan_id' => $pertanyaan_id,
                    'jawaban' => is_array($jawaban) ? implode(', ', $jawaban) : $jawaban,
                ]);
            }
        }

        return redirect()->route('alumni.kuisioner.index')->with('success', 'Kuisioner berhasil disimpan. Terima kasih atas partisipasi Anda!');
    }
}
