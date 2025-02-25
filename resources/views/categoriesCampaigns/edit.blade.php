@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Kategori Donasi</h1>

    <form action="{{ route('categoriesCampaigns.update', $categoriesCampaign->id) }}" method="POST" id="editCategoryForm">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="name" class="form-label">Nama Kategori</label>
            <input type="text" name="name" id="name" value="{{ $categoriesCampaign->name }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary" style="background-color: #6777ef; color: white;">Update</button>
    </form>
</div>

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('editCategoryForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Mencegah form langsung terkirim

        Swal.fire({
            title: "Sukses!",
            text: "Kategori berhasil diperbarui!",
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
