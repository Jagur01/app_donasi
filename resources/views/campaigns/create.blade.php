@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Buat Donasi</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form id="donationForm" action="{{ route('campaigns.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Judul</label>
                <input type="text" name="title" class="form-control" id="title" value="{{ old('title') }}"
                    required>
                @error('title')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
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
                <input type="file" name="image" class="form-control" id="image" value="{{ old('image') }}"
                    required>
                @error('image')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="file_qr">File QR</label>
                <input type="file" name="file_qr" id="file_qr" class="form-control" value="{{ old('file_qr') }}"
                    required>
                @error('file_qr')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="goal_amount" class="form-label">Target Donasi</label>
                <div class="input-group">
                    <span class="input-group-text">Rp.</span>
                    <input type="text" name="goal_amount" class="form-control" id="goal_amount"
                        value="{{ old('goal_amount') }}" required>
                    @error('goal_amount')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="bank_info" class="form-label">Informasi Bank</label>
                <input type="text" name="bank_info" class="form-control" id="bank_info" value="{{ old('bank_info') }}"
                    required>
                @error('bank_info')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control" id="description" rows="3" required>{{ old('description') }}</textarea>
                @error('description')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="expired" class="form-label">Batas Waktu</label>
                <input type="date" name="expired" class="form-control" id="expired" value="{{ old('expired') }}"
                    required>
                @error('expired')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <button type="button" id="btnSubmit"
                class="btn btn-primary"style="background-color: #6777ef; color: white;">Tambah Donasi</button>
        </form>
    </div>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const goalAmountInput = document.getElementById("goal_amount");

            goalAmountInput.addEventListener("input", function(event) {
                let value = event.target.value.replace(/\D/g, ""); // Hanya angka
                value = new Intl.NumberFormat("id-ID").format(value); // Format angka dengan titik
                event.target.value = value;
            });

            document.getElementById("btnSubmit").addEventListener("click", function(event) {
                // Sebelum submit, ubah format menjadi angka tanpa titik
                let rawValue = goalAmountInput.value.replace(/\./g, "");
                goalAmountInput.value = rawValue;

                Swal.fire({
                    title: "Konfirmasi",
                    text: "Apakah Anda yakin ingin menambahkan donasi ini?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Ya, Tambahkan!",
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('donationForm').submit();
                    }
                });
            });
        });
    </script>
@endsection
