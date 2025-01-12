@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Donasi</h1>
    <a href="{{ route('campaigns.create') }}" class="btn btn-primary mb-3">Tambah Donasi</a>
    <div class="row">
        @foreach ($campaigns as $campaign)
        <div class="col-md-4">
            <div class="card mb-3">
                <!-- Tambahkan link untuk memicu modal ketika gambar diklik -->
                <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal{{ $campaign->id }}">
                    <img src="{{ asset('storage/' . ($campaign->image ?? 'default.jpg')) }}" class="card-img-top campaign-image" alt="{{ $campaign->title }}">
                </a>

                <div class="card-body">
                    <h5 class="card-title" style="font-weight: bold;">{{ $campaign->title }}</h5>
                    <p class="card-text" style="min-height: 120px; overflow: auto; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;">{{ $campaign->description }}</p>
                    <p><strong>Waktu Dibuat :</strong> {{ $campaign->created_at }}</p>
                    <p><strong>Batas Waktu :</strong> {{ $campaign->expired }}</p>
                    <p><strong>Target Donasi : </strong> {{ number_format($campaign->goal_amount, 2) }}</p>
                    <p><strong>Total Terkumpul :</strong> {{ number_format($campaign->total_collected , 2) }}</p>
                    
                    <!-- Tombol dalam satu baris -->
                    <div class="d-flex gap-2">
                        @if ($campaign->total_collected >= $campaign->goal_amount)
                            <button class="btn btn-secondary" disabled>Donasi Selesai</button>
                        @else
                            <a href="{{ route('donations.create', $campaign) }}" class="btn btn-success">Donasi</a>
                        @endif

                        <a href="{{ route('campaigns.edit', $campaign->id) }}" class="btn btn-warning">Edit</a>
                        
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $campaign->id }}">
                            Hapus
                        </button>
                    </div>

                    <!-- Modal Konfirmasi -->
                    <div class="modal fade" id="deleteModal{{ $campaign->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $campaign->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel{{ $campaign->id }}">Konfirmasi Penghapusan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                    <div class="modal-body">
                                        Apakah anda yakin ingin menghapus donasi "{{ $campaign->title }}"?
                                    </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <form action="{{ route('campaigns.destroy', $campaign->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Modal untuk menampilkan gambar lebih besar -->
        <div class="modal fade" id="imageModal{{ $campaign->id }}" tabindex="-1" aria-labelledby="imageModalLabel{{ $campaign->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="imageModalLabel{{ $campaign->id }}">Gambar Donasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img src="{{ asset('storage/' . ($campaign->image ?? 'default.jpg')) }}" class="img-fluid" alt="{{ $campaign->title }}">
                    </div>
                </div>
            </div>
        </div>

        @endforeach
    </div>
</div>

<!-- Tambahkan gaya CSS untuk gambar -->
<style>
    .campaign-image {
        width: 100%; /* Mengatur lebar gambar agar penuh dalam container */
        height: 200px; /* Menetapkan tinggi gambar agar konsisten */
        object-fit: cover; /* Menjaga agar gambar tidak terdistorsi */
    }

    .card-title {
        font-weight: bold; /* Menetapkan font tebal */
    }

    .d-flex.gap-2 > * {
        margin-right: 0.5rem; /* Tambahkan sedikit jarak antar tombol */
    }
</style>
@endsection