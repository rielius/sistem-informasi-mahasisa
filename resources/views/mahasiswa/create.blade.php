<!DOCTYPE html>
<html>

<head>
    <title>Tambah Mahasiswa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
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
                <div class="d-flex justify-content-between align-items-center my=2">
                    <h2 class="fw-bold">Tambah Mahasiswa</h2>
                    <a href="/mahasiswa" class="btn btn-secondary btn-sm">← Kembali</a>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="/mahasiswa" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">NPM</label>
                        <input type="text" name="npm" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>

                    {{-- <div class="mb-3">
                        <label class="form-label">Prodi</label>
                        <input type="text" name="prodi" class="form-control" required>
                    </div> --}}


                    <div class="mb-3">
                        <label class="form-label">Prodi</label>
                        <select class="form-select" name="prodi" aria-label="Default select example">
                            <option value="{{ null }}">Pilih</option>
                            <option value="informatika">
                                informatika</option>
                            <option value="Sistem Informasi">Sistem Informasi</option>
                            <option value="Kimia">Kimia</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">IPK</label>
                        <input type="number" step="0.01" name="ipk" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Foto</label>
                        <input type="file" name="foto" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        Simpan
                    </button>

                </form>
            </div>

        </div>

    </div>

</body>

</html>
