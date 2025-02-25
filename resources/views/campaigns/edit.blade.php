@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Donasi</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('campaigns.update', $campaign->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Judul</label>
                <input type="text" name="title" id="title" class="form-control"
                    value="{{ old('title', $campaign->title) }}" required>
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Kategori</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    <option value="">Pilih Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $campaign->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Gambar Donasi</label>
                <input type="file" name="image" id="image" class="form-control">
                @if ($campaign->image)
                    <small class="text-muted">Gambar Saat Ini:</small>
                    <div>
                        <img src="{{ asset('storage/' . $campaign->image) }}" alt="{{ $campaign->title }}"
                            style="max-width: 200px;">
                    </div>
                @endif
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="file_qr" class="form-label">File QR</label>
                <input type="file" name="file_qr" id="file_qr" class="form-control">
                @if ($campaign->file_qr)
                    <small class="text-muted">Gambar Saat Ini:</small>
                    <div>
                        <img src="{{ asset('storage/' . $campaign->file_qr) }}" alt="{{ $campaign->title }}"
                            style="max-width: 200px;">
                    </div>
                @endif
                @error('file_qr')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="goal_amount" class="form-label">Target Donasi</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp.</span>
                        <input type="text" name="goal_amount" id="goal_amount" class="form-control"
                            value="{{ number_format(old('goal_amount', $campaign->goal_amount), 0, ',', '.') }}" required>
                    </div>
                    @error('goal_amount')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
            </div>

            <div class="mb-3">
                <label for="bank_info" class="form-label">Informasi Bank</label>
                <input type="text" name="bank_info" class="form-control" id="bank_info"
                    value="{{ old('bank_info', $campaign->bank_info ?? '') }}">
                @error('bank_info')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description', $campaign->description) }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="expired" class="form-label">Batas Waktu</label>
                <input type="date" name="expired" id="expired" class="form-control"
                    value="{{ old('expired', $campaign->expired) }}" required>
                @error('expired')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary" style="background-color: #6777ef; color: white;">Update
                Donasi</button>
            <a href="{{ route('campaigns.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
    <script>
        document.getElementById('goal_amount').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, ""); // Hapus semua non-digit
            value = new Intl.NumberFormat('id-ID').format(value); // Format angka
            e.target.value = value;
        });
    </script>

@endsection
