@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Kategori Donasi</h1>

    <form action="{{ route('categoriesCampaigns.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama Kategori</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary mb-2">Simpan</button>
    </form>
</div>
@endsection
