@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Daftar Donatur</h1>
    
    <!-- Success and Error Messages -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    
    <!-- Donations Table -->
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Donasi</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>Bukti Donasi</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($donations as $donation)
                        <tr>
                            <td>{{ $donation->id }}</td>
                            <td>{{ $donation->user->name }}</td>
                            <td>{{ $donation->campaign->title }}</td>
                            <td>{{ number_format($donation->amount, 2) }}</td>
                            <td><span class="badge bg-{{ $donation->status->name == 'Pending' ? 'warning' : 'success' }}">{{ $donation->status->name }}</span></td>
                            <td>
                                <!-- Image Thumbnail -->
                                <img src="{{ asset('storage/' . $donation->proof_image) }}" alt="Proof" 
                                     class="img-thumbnail" 
                                     style="width: 60px; cursor: pointer;" 
                                     data-bs-toggle="modal" 
                                     data-bs-target="#imageModal" 
                                     data-bs-image="{{ asset('storage/' . $donation->proof_image) }}">
                            </td>
                            <td>
                                @if($donation->status_id == 1) <!-- Pending -->
                                    <form action="{{ route('donations.approve', $donation->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">ACC</button>
                                    </form>
                                @else
                                    <button class="btn btn-secondary btn-sm" disabled>ACC</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal for Image -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Bukti</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" alt="Proof Image" class="img-fluid rounded">
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Pastikan modal dapat menerima data gambar
        const imageModal = document.getElementById('imageModal');
        const modalImage = document.getElementById('modalImage');

        imageModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget; // Tombol atau elemen yang memicu modal
            const imageUrl = button.getAttribute('data-bs-image'); // Ambil URL gambar dari atribut data-bs-image
            modalImage.src = imageUrl; // Setel src gambar modal ke URL gambar
        });

        // Bersihkan src gambar setelah modal ditutup untuk menghindari "flash"
        imageModal.addEventListener('hidden.bs.modal', function () {
            modalImage.src = '';
        });
    });
</script>
@endsection