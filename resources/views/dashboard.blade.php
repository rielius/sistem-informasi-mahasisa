<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
</head>
<body>

<h1>Dashboard Admin</h1>

<hr>

<h3>Total Mahasiswa</h3>
<p>{{ $totalMahasiswa }}</p>

<h3>Rata-rata IPK</h3>
<p>{{ number_format($rataRataIpk, 2) }}</p>

<h3>Jumlah Mahasiswa per Prodi</h3>

<ul>
@foreach($mahasiswaPerProdi as $prodi)
    <li>
        {{ $prodi->prodi }} : {{ $prodi->jumlah }}
    </li>
@endforeach
</ul>

<form method="POST" action="/logout">
    @csrf
    <button type="submit">
        Logout
    </button>
</form>

</body>
</html>