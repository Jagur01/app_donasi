@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Kategori Donasi</h1>
    <a href="{{ route('categoriesCampaigns.create') }}" class="btn btn-primary mb-3">Tambah Kategori</a>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th class="text-center">Nama Kategori</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead> 
            <tbody>
                @foreach ($categoriesCampaigns as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td class="text-center">
                            <a href="{{ route('categoriesCampaigns.edit', $category->id) }}" class="btn btn-warning btn-sm mx-1">Edit</a>

                            <form action="{{ route('categoriesCampaigns.destroy', $category->id) }}" method="POST" class="d-inline mx-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
