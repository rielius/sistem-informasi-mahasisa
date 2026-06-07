<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function create()
    {
        return view('mahasiswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'npm' => 'required|unique:mahasiswas|numeric',
            'nama' => 'required',
            'prodi' => 'required',
            'ipk' => 'required|numeric|min:0.001|max:4',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $namaFoto = null;

        if ($request->hasFile('foto')) {
            $namaFoto = time() . '.' . $request->foto->extension();

            $request->foto->move(
                public_path('uploads'),
                $namaFoto
            );
        }

        Mahasiswa::create([
            'npm' => $request->npm,
            'nama' => $request->nama,
            'prodi' => $request->prodi,
            'ipk' => $request->ipk,
            'foto' => $namaFoto
        ]);

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil ditambahkan');
    }

    public function index(Request $request)
    {
        $search = $request->search;
        $prodi = $request->prodi;

        $query = Mahasiswa::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('npm', 'like', "%{$search}%")
                    ->orWhere('nama', 'like', "%{$search}%")
                    ->orWhere('prodi', 'like', "%{$search}%");
            });
        }

        if ($prodi) {
            $query->where('prodi', $prodi);
        }

        $mahasiswas = $query->paginate(5);

        $daftarProdi = Mahasiswa::select('prodi')
            ->distinct()
            ->pluck('prodi');

        return view('mahasiswa.index', compact(
            'mahasiswas',
            'search',
            'prodi',
            'daftarProdi'
        ));
    }

    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        $request->validate([
            'npm' => 'required|unique:mahasiswas,id,' . $mahasiswa->id . '|numeric',
            'nama' => 'required',
            'prodi' => 'required',
            'ipk' => 'required|numeric|min:0.001|max:4',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $namaFoto = $mahasiswa->foto;

        if ($request->hasFile('foto')) {

            if (
                $mahasiswa->foto &&
                file_exists(public_path('uploads/' . $mahasiswa->foto))
            ) {
                unlink(public_path('uploads/' . $mahasiswa->foto));
            }

            $namaFoto = time() . '.' . $request->foto->extension();

            $request->foto->move(
                public_path('uploads'),
                $namaFoto
            );
        }

        $mahasiswa->update([
            'npm' => $request->npm,
            'nama' => $request->nama,
            'prodi' => $request->prodi,
            'ipk' => $request->ipk,
            'foto' => $namaFoto
        ]);

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil diupdate');
    }

    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil dihapus');
    }

    public function exportCsv()
    {
        $fileName = 'mahasiswa.csv';

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

            foreach (Mahasiswa::all() as $mahasiswa) {

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
