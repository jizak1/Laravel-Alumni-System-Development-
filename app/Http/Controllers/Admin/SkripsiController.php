<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skripsi;
use Illuminate\Http\Request;

class SkripsiController extends Controller
{
    public function index()
    {
        $skripsi = Skripsi::with('user')->paginate(10);
        return view('admin.skripsi.index', compact('skripsi'));
    }

    public function show(Skripsi $skripsi)
    {
        $skripsi->load('user');
        return view('admin.skripsi.show', compact('skripsi'));
    }

    public function edit(Skripsi $skripsi)
    {
        return view('admin.skripsi.edit', compact('skripsi'));
    }

    public function update(Request $request, Skripsi $skripsi)
    {
        $request->validate([
            'status' => ['required', 'in:pending,approved,rejected'],
            'akses' => ['required', 'in:public,private'],
        ]);

        $skripsi->update([
            'status' => $request->status,
            'akses' => $request->akses,
        ]);

        return redirect()->route('admin.skripsi.index')->with('success', 'Status skripsi berhasil diperbarui.');
    }

    public function destroy(Skripsi $skripsi)
    {
        // Delete file if exists
        if ($skripsi->file && file_exists(storage_path('app/public/' . $skripsi->file))) {
            unlink(storage_path('app/public/' . $skripsi->file));
        }

        $skripsi->delete();
        return redirect()->route('admin.skripsi.index')->with('success', 'Skripsi berhasil dihapus.');
    }
}
