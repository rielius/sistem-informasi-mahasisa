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
                    <a href="/prodi" class="btn btn-secondary btn-sm">← Kembali</a>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="/prodi" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="nama_prodi" class="form-control" required>
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
