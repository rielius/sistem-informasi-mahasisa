<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMahasiswa = Mahasiswa::count();

        $rataRataIpk = Mahasiswa::avg('ipk');

        $mahasiswaPerProdi = Mahasiswa::selectRaw('prodi, COUNT(*) as jumlah')
            ->groupBy('prodi')
            ->get();
            
        return redirect('/mahasiswa');
        return view('dashboard', compact(
            'totalMahasiswa',
            'rataRataIpk',
            'mahasiswaPerProdi'
        ));
    }
}
