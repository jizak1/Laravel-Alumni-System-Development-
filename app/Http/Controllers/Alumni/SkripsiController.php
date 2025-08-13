<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\Skripsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SkripsiController extends Controller
{
    public function index()
    {
        $skripsi = auth()->user()->skripsi()->paginate(10);
        return view('alumni.skripsi.index', compact('skripsi'));
    }

    public function create()
    {
        return view('alumni.skripsi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'abstrak' => ['required', 'string'],
            'tahun' => ['required', 'integer', 'min:1900', 'max:' . (date('Y') + 10)],
            'pembimbing1' => ['nullable', 'string', 'max:255'],
            'pembimbing2' => ['nullable', 'string', 'max:255'],
            'file' => ['nullable', 'file', 'mimes:pdf', 'max:10240'], // 10MB max
            'akses' => ['required', 'in:public,private'],
        ]);

        $data = $request->only(['judul', 'abstrak', 'tahun', 'pembimbing1', 'pembimbing2', 'akses']);
        $data['user_id'] = auth()->id();
        $data['status'] = 'pending';

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('skripsi', 'public');
        }

        Skripsi::create($data);

        return redirect()->route('alumni.skripsi.index')->with('success', 'Skripsi berhasil ditambahkan dan menunggu persetujuan admin.');
    }

    public function show(Skripsi $skripsi)
    {
        // Ensure user can only view their own skripsi
        if ($skripsi->user_id !== auth()->id()) {
            abort(403);
        }

        return view('alumni.skripsi.show', compact('skripsi'));
    }

    public function edit(Skripsi $skripsi)
    {
        // Ensure user can only edit their own skripsi
        if ($skripsi->user_id !== auth()->id()) {
            abort(403);
        }

        // Only allow editing if status is pending or rejected
        if (!in_array($skripsi->status, ['pending', 'rejected'])) {
            return redirect()->route('alumni.skripsi.index')->with('error', 'Skripsi yang sudah disetujui tidak dapat diedit.');
        }

        return view('alumni.skripsi.edit', compact('skripsi'));
    }

    public function update(Request $request, Skripsi $skripsi)
    {
        // Ensure user can only update their own skripsi
        if ($skripsi->user_id !== auth()->id()) {
            abort(403);
        }

        // Only allow editing if status is pending or rejected
        if (!in_array($skripsi->status, ['pending', 'rejected'])) {
            return redirect()->route('alumni.skripsi.index')->with('error', 'Skripsi yang sudah disetujui tidak dapat diedit.');
        }

        $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'abstrak' => ['required', 'string'],
            'tahun' => ['required', 'integer', 'min:1900', 'max:' . (date('Y') + 10)],
            'pembimbing1' => ['nullable', 'string', 'max:255'],
            'pembimbing2' => ['nullable', 'string', 'max:255'],
            'file' => ['nullable', 'file', 'mimes:pdf', 'max:10240'], // 10MB max
            'akses' => ['required', 'in:public,private'],
        ]);

        $data = $request->only(['judul', 'abstrak', 'tahun', 'pembimbing1', 'pembimbing2', 'akses']);
        $data['status'] = 'pending'; // Reset status to pending after edit

        if ($request->hasFile('file')) {
            // Delete old file
            if ($skripsi->file) {
                Storage::disk('public')->delete($skripsi->file);
            }
            $data['file'] = $request->file('file')->store('skripsi', 'public');
        }

        $skripsi->update($data);

        return redirect()->route('alumni.skripsi.index')->with('success', 'Skripsi berhasil diperbarui dan menunggu persetujuan admin.');
    }

    public function destroy(Skripsi $skripsi)
    {
        // Ensure user can only delete their own skripsi
        if ($skripsi->user_id !== auth()->id()) {
            abort(403);
        }

        // Delete file if exists
        if ($skripsi->file) {
            Storage::disk('public')->delete($skripsi->file);
        }

        $skripsi->delete();
        return redirect()->route('alumni.skripsi.index')->with('success', 'Skripsi berhasil dihapus.');
    }
}
