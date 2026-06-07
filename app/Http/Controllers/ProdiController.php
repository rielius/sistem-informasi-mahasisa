<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    public function create()
    {
        return view('prodi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_prodi' => 'required|unique:prodis',
        ]);

        Prodi::create([
            'nama_prodi' => $request->nama_prodi,
        ]);

        return redirect()->route('prodi.index')
            ->with('success', 'Data mahasiswa berhasil ditambahkan');
    }

    public function index(Request $request)
    {
        $search = $request->search;
        $query = Prodi::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('npm', 'like', "%{$search}%")
                    ->orWhere('nama', 'like', "%{$search}%")
                    ->orWhere('prodi', 'like', "%{$search}%");
            });
        }

        $prodis = $query->paginate(5);

        return view('prodi.index', compact(
            'search',
            'prodis',
        ));
    }

    public function edit($id)
    {
        $prodi = Prodi::findOrFail($id);

        return view('prodi.edit', compact('prodi'));
    }

    public function update(Request $request, $id)
    {
        $prodi = Prodi::findOrFail($id);

        $request->validate([
            'nama_prodi' => 'required|unique:prodis,id,' . $prodi->id,
        ]);

        $prodi->update([
            'nama_prodi' => $request->nama_prodi,
        ]);

        return redirect()->route('prodi.index')
            ->with('success', 'Data mahasiswa berhasil diupdate');
    }

    public function destroy($id)
    {
        $Prodi = Prodi::findOrFail($id);

        $Prodi->delete();

        return redirect()->route('prodi.index')
            ->with('success', 'Data mahasiswa berhasil dihapus');
    }

    public function exportCsv()
    {
        $fileName = 'prodi.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=' . $fileName,
        ];

        $callback = function () {

            $file = fopen('php://output', 'w');

            fputcsv($file, [
                'NPM',
                'Nama',
                'Prodi',
                'IPK'
            ]);

            foreach (Prodi::all() as $mahasiswa) {

                fputcsv($file, [
                    $mahasiswa->npm,
                    $mahasiswa->nama,
                    $mahasiswa->prodi,
                    $mahasiswa->ipk
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
