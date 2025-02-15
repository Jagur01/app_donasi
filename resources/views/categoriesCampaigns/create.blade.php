@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Kategori Donasi</h1>

    <form action="{{ route('categoriesCampaigns.store') }}" method="POST" id="createCategoryForm">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama Kategori</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary mb-2">Simpan</button>
    </form>
</div>

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('createCategoryForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Mencegah form langsung terkirim

        Swal.fire({
            title: "Sukses!",
            text: "Kategori berhasil ditambahkan!",
            icon: "success",
            confirmButtonText: "OK"
        }).then((result) => {
            if (result.isConfirmed) {
                event.target.submit(); // Kirim form setelah konfirmasi
            }
        });
    });
</script>

@endsection
