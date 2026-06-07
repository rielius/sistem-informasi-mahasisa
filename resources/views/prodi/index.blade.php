<!DOCTYPE html>
<html>

<head>
    <title>Data Prodi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
        }

        .toast-fixed {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
        }

        img {
            border-radius: 8px;
            object-fit: cover;
        }

        .table td,
        .table th {
            vertical-align: middle;
        }
    </style>
</head>

<body class="bg-dark">

    @include('components.navbar')
    <div class="container mt-4">

        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="fw-bold">Data Prodi</h2>

                    <div class="d-flex gap-2">
                        <a href="/prodi/create" class="btn btn-primary btn-sm">+ Tambah</a>
                        <a href="/prodi/export/csv" class="btn btn-success btn-sm">Export CSV</a>
                        {{-- <a href="/logout" class="btn btn-danger btn-sm">Logout</a> --}}
                    </div>
                </div>

            </div>

            <div class="card-body">
                {{-- SEARCH --}}
                <form method="GET" action="/prodi" class="row g-2 mb-3">

                    <div class="col-md-6">
                        <input type="text" name="search" class="form-control" placeholder="Cari nama prodi"
                            value="{{ $search ?? '' }}">
                    </div>

                    <div class="col-md-2">
                        <button class="btn btn-secondary w-100">Cari</button>
                    </div>

                </form>

                {{-- TABLE --}}
                <div class="table-responsive bg-white p-3 rounded shadow-sm">

                    <table class="table table-hover table-bordered mb-0">

                        <thead class="table-primary text-center">
                            <tr>
                                <th>No</th>

                                <th>Nama Prodi</th>
                                <th style="width: 160px;">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($prodis as $prodi)
                                <tr>
                                    <td class="text-center">
                                        {{ ($prodis->firstItem() + $loop->index) }}
                                    </td>

                                    <td>{{ $prodi->nama_prodi }}</td>

                                    <td class="text-center">
                                        <a href="/prodi/{{ $prodi->id }}/edit" class="btn btn-warning btn-sm">
                                            Edit
                                        </a>

                                        <form action="/prodi/{{ $prodi->id }}" method="POST" class="d-inline">

                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin hapus data ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">
                                        Data tidak ditemukan
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>

                </div>

                {{-- PAGINATION --}}
                <div class="mt-3 d-flex justify-content-center">
                    {{ $prodis->links() }}
                </div>
            </div>
        </div>

        {{-- TOAST --}}
        @if (session('success'))
            {{-- <div class="alert alert-danger" role="alert">
                A simple primary alert—check it out!
            </div> --}}
            <div id="toast" class="toast-fixed alert alert-success shadow">
                {{ session('success') }}
            </div>
        @endif

        {{-- HEADER --}}



    </div>

    {{-- TOAST SCRIPT --}}
    <script>
        setTimeout(() => {
            let toast = document.getElementById('toast');
            if (toast) {
                toast.style.opacity = '0';
                toast.style.transition = '0.5s';
                setTimeout(() => toast.remove(), 500);
            }
        }, 3000);
    </script>

</body>

</html>
