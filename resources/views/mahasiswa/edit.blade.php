<!DOCTYPE html>
<html>

<head>
    <title>Edit Mahasiswa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
        }

        img {
            border-radius: 8px;
        }
    </style>
</head>

<body class="bg-dark">
    @include('components.navbar')

    <div class="container mt-4">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <div class="card shadow-sm">

            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center my-3s">
                    <h2 class="fw-bold">Edit Mahasiswa</h2>
                    <a href="/mahasiswa" class="btn btn-secondary btn-sm">← Kembali</a>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="/mahasiswa/{{ $mahasiswa->id }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- NPM --}}
                    <div class="mb-3">
                        <label class="form-label">NPM</label>
                        <input type="text" name="npm" class="form-control" value="{{ $mahasiswa->npm }}" required>
                    </div>

                    {{-- Nama --}}
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control" value="{{ $mahasiswa->nama }}" required>
                    </div>

                    {{-- Prodi --}}
                    {{-- <div class="mb-3">
                        <label class="form-label">Prodi</label>
                        <input type="text" name="prodi" class="form-control" value="{{ $mahasiswa->prodi }}" required>
                    </div> --}}
                    <div class="mb-3">
                        <label class="form-label">Prodi</label>
                        <select class="form-select" name="prodi" aria-label="Default select example">
                            <option value="{{ null }}">Pilih</option>
                            <option {{ $mahasiswa->prodi == "informatika" ? "selected" : null}} value="informatika">
                                informatika</option>
                            <option {{ $mahasiswa->prodi == "Sistem Informasi" ? "selected" : null}}
                                value="Sistem Informasi">
                                Sistem Informasi</option>
                            <option {{ $mahasiswa->prodi == "Kimia" ? "selected" : null}} value="Kimia">Kimia</option>
                        </select>
                    </div>
                    {{-- <div class="mb-3">
                        <label class="form-label">Prodi</label>
                        <input type="text" name="prodi" class="form-control" value="{{ $mahasiswa->prodi }}" required>
                    </div> --}}

                    {{-- IPK --}}
                    <div class="mb-3">
                        <label class="form-label">IPK</label>
                        <input type="number" step="0.01" name="ipk" class="form-control" value="{{ $mahasiswa->ipk }}"
                            required>
                    </div>

                    {{-- FOTO LAMA --}}
                    <div class="mb-3">
                        <label class="form-label">Foto Saat Ini</label><br>

                        @if ($mahasiswa->foto)
                            <img src="{{ asset('uploads/' . $mahasiswa->foto) }}" width="120" height="120"
                                style="object-fit: cover;">
                        @else
                            <span class="text-muted">Tidak ada foto</span>
                        @endif
                    </div>

                    {{-- FOTO BARU --}}
                    <div class="mb-3">
                        <label class="form-label">Ganti Foto</label>
                        <input type="file" name="foto" class="form-control">
                    </div>

                    {{-- BUTTON --}}
                    <button type="submit" class="btn btn-primary w-100">
                        Update Data
                    </button>

                </form>
            </div>

        </div>

    </div>

</body>

</html>
