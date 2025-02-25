@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Buat Donasi</h1>
    <form id="donationForm" action="{{ route('campaigns.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" name="title" class="form-control" id="title" required>
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Kategori</label>
            <select name="category_id" id="category_id" class="form-control" required>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Gambar</label>
            <input type="file" name="image" class="form-control" id="image" required>
        </div>

        <div class="mb-3">
            <label for="file_qr">File QR</label>
             <input type="file" name="file_qr" id="file_qr" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="goal_amount" class="form-label">Target Donasi</label>
            <input type="number" name="goal_amount" class="form-control" id="goal_amount" required>
        </div>
        
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control" id="description" rows="3" required></textarea>
        </div>

        
        <div class="mb-3">
            <label for="expired" class="form-label">Batas Waktu</label>
            <input type="date" name="expired" class="form-control" id="expired" required>
        </div>
        <button type="button" id="btnSubmit" class="btn btn-primary"style="background-color: #6777ef; color: white;">Tambah Donasi</button>
    </form>
</div>

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.getElementById('btnSubmit').addEventListener('click', function (event) {
        Swal.fire({
            title: "Konfirmasi",
            text: "Apakah Anda yakin ingin menambahkan donasi ini?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Tambahkan!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('donationForm').submit(); // Submit form jika user mengonfirmasi
            }
        });
    });
</script>

@endsection
