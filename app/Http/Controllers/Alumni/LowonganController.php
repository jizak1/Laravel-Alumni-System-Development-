<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\Lowongan;
use Illuminate\Http\Request;

class LowonganController extends Controller
{
    public function index()
    {
        $lowongan = auth()->user()->lowongan()->paginate(10);
        return view('alumni.lowongan.index', compact('lowongan'));
    }

    public function create()
    {
        return view('alumni.lowongan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'string'],
            'perusahaan' => ['required', 'string', 'max:255'],
            'lokasi' => ['required', 'string', 'max:255'],
            'link' => ['nullable', 'url'],
            'tanggal_posting' => ['required', 'date'],
            'tanggal_berakhir' => ['nullable', 'date', 'after:tanggal_posting'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->id();

        Lowongan::create($data);

        return redirect()->route('alumni.lowongan.index')->with('success', 'Lowongan kerja berhasil ditambahkan.');
    }

    public function show(Lowongan $lowongan)
    {
        // Ensure user can only view their own lowongan
        if ($lowongan->user_id !== auth()->id()) {
            abort(403);
        }

        return view('alumni.lowongan.show', compact('lowongan'));
    }

    public function edit(Lowongan $lowongan)
    {
        // Ensure user can only edit their own lowongan
        if ($lowongan->user_id !== auth()->id()) {
            abort(403);
        }

        return view('alumni.lowongan.edit', compact('lowongan'));
    }

    public function update(Request $request, Lowongan $lowongan)
    {
        // Ensure user can only update their own lowongan
        if ($lowongan->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'string'],
            'perusahaan' => ['required', 'string', 'max:255'],
            'lokasi' => ['required', 'string', 'max:255'],
            'link' => ['nullable', 'url'],
            'tanggal_posting' => ['required', 'date'],
            'tanggal_berakhir' => ['nullable', 'date', 'after:tanggal_posting'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        $lowongan->update($request->all());

        return redirect()->route('alumni.lowongan.index')->with('success', 'Lowongan kerja berhasil diperbarui.');
    }

    public function destroy(Lowongan $lowongan)
    {
        // Ensure user can only delete their own lowongan
        if ($lowongan->user_id !== auth()->id()) {
            abort(403);
        }

        $lowongan->delete();
        return redirect()->route('alumni.lowongan.index')->with('success', 'Lowongan kerja berhasil dihapus.');
    }
}
