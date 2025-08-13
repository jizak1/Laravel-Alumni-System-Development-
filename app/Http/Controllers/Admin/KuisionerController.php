<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kuisioner;
use App\Models\Pertanyaan;
use App\Models\User;
use Illuminate\Http\Request;
use App\Exports\KuisionerExport;

class KuisionerController extends Controller
{
    public function index()
    {
        $pertanyaan = Pertanyaan::ordered()->get();
        $total_alumni = User::where('role', 'alumni')->count();
        $total_responden = Kuisioner::distinct('user_id')->count('user_id');
        
        $responses = [];
        foreach ($pertanyaan as $p) {
            $responses[$p->id] = Kuisioner::where('pertanyaan_id', $p->id)
                ->with('user')
                ->get();
        }

        return view('admin.kuisioner.index', compact('pertanyaan', 'responses', 'total_alumni', 'total_responden'));
    }

    public function export(Request $request)
    {
        $format = $request->get('format', 'excel');
        
        $pertanyaan = Pertanyaan::ordered()->get();
        $users = User::where('role', 'alumni')
            ->whereHas('kuisioner')
            ->with(['kuisioner.pertanyaan', 'profile'])
            ->get();

        $data = [];
        foreach ($users as $user) {
            $row = [
                'Nama' => $user->name,
                'Email' => $user->email,
                'NIM' => $user->profile->nim ?? '',
                'Tahun Lulus' => $user->profile->tahun_lulus ?? '',
                'Pekerjaan' => $user->profile->pekerjaan ?? '',
            ];

            foreach ($pertanyaan as $p) {
                $jawaban = $user->kuisioner->where('pertanyaan_id', $p->id)->first();
                $row[$p->teks] = $jawaban ? $jawaban->jawaban : '';
            }

            $data[] = $row;
        }

        if ($format === 'pdf') {
            // Simple PDF generation without external library for now
            return response()->view('admin.kuisioner.export-pdf', compact('data', 'pertanyaan'))
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'attachment; filename="kuisioner-alumni.pdf"');
        } else {
            // Simple Excel export - for now return CSV
            $filename = 'kuisioner-alumni-' . date('Y-m-d') . '.csv';
            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ];

            $callback = function() use ($data) {
                $file = fopen('php://output', 'w');
                if (!empty($data)) {
                    fputcsv($file, array_keys($data[0]));
                    foreach ($data as $row) {
                        fputcsv($file, $row);
                    }
                }
                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        }
    }

    public function questions()
    {
        $pertanyaan = Pertanyaan::ordered()->paginate(10);
        return view('admin.kuisioner.questions', compact('pertanyaan'));
    }

    public function createQuestion()
    {
        return view('admin.kuisioner.create-question');
    }

    public function storeQuestion(Request $request)
    {
        $request->validate([
            'teks' => ['required', 'string'],
            'tipe' => ['required', 'in:text,radio,checkbox,select'],
            'opsi' => ['required_if:tipe,radio,checkbox,select', 'array'],
            'wajib' => ['boolean'],
            'urutan' => ['required', 'integer', 'min:0'],
        ]);

        $data = $request->only(['teks', 'tipe', 'wajib', 'urutan']);
        
        if (in_array($request->tipe, ['radio', 'checkbox', 'select'])) {
            $data['opsi'] = array_filter($request->opsi);
        }

        Pertanyaan::create($data);

        return redirect()->route('admin.kuisioner.questions')->with('success', 'Pertanyaan berhasil ditambahkan.');
    }

    public function editQuestion(Pertanyaan $pertanyaan)
    {
        return view('admin.kuisioner.edit-question', compact('pertanyaan'));
    }

    public function updateQuestion(Request $request, Pertanyaan $pertanyaan)
    {
        $request->validate([
            'teks' => ['required', 'string'],
            'tipe' => ['required', 'in:text,radio,checkbox,select'],
            'opsi' => ['required_if:tipe,radio,checkbox,select', 'array'],
            'wajib' => ['boolean'],
            'urutan' => ['required', 'integer', 'min:0'],
        ]);

        $data = $request->only(['teks', 'tipe', 'wajib', 'urutan']);
        
        if (in_array($request->tipe, ['radio', 'checkbox', 'select'])) {
            $data['opsi'] = array_filter($request->opsi);
        } else {
            $data['opsi'] = null;
        }

        $pertanyaan->update($data);

        return redirect()->route('admin.kuisioner.questions')->with('success', 'Pertanyaan berhasil diperbarui.');
    }

    public function destroyQuestion(Pertanyaan $pertanyaan)
    {
        $pertanyaan->delete();
        return redirect()->route('admin.kuisioner.questions')->with('success', 'Pertanyaan berhasil dihapus.');
    }
}
