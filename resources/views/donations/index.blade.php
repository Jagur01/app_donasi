@extends('layouts.app')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/custom.js') }}"></script>

    <div class="container mt-5">
        <h1 class="mb-4">Transaksi Donatur</h1>

        <!-- Success and Error Messages -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Donations Table -->
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered">
                        <thead class="table-light text-center">
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th style="width: 20%;">Nama</th>
                                <th style="width: 20%;">Judul</th>
                                <th style="width: 15%;">Jumlah</th>
                                <th style="width: 10%;">Status</th>
                                <th style="width: 15%;">Bukti Donasi</th>
                                <th style="width: 15%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($donations as $index => $donation)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>{{ $donation->user->name }}</td>
                                    <td>{{ $donation->campaign->title }}</td>
                                    <td class="text-end">{{ number_format($donation->amount, 2) }}</td>
                                    <td class="text-center">
                                        @if ($donation->status_id == 3)
                                            <span class="badge bg-danger">Ditolak</span>
                                        @elseif ($donation->status_id == 2)
                                            <span class="badge bg-success">Disetujui</span>
                                        @else
                                            <span class="badge bg-warning">Menunggu Persetujuan</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <img src="{{ asset('storage/' . $donation->proof_image) }}" 
                                            class="img-thumbnail bukti-donasi" 
                                            style="width: 60px; cursor: pointer;" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#imageModal" 
                                            data-bs-image="{{ asset('storage/' . $donation->proof_image) }}">
                                    </td>
                                    <td class="text-center">
                                        @if ($donation->status_id == 1)
                                            <!-- Tombol ACC -->
                                            <button class="btn btn-success btn-sm acc-btn"
                                                data-id="{{ $donation->id }}">ACC</button>
                                            <form id="approve-form-{{ $donation->id }}"
                                                action="{{ route('donations.approve', $donation->id) }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                            </form>

                                            <!-- Tombol Tolak -->
                                            <button class="btn btn-danger btn-sm reject-btn"
                                                data-id="{{ $donation->id }}">Tolak</button>
                                            <form id="reject-form-{{ $donation->id }}"
                                                action="{{ route('donations.reject', $donation->id) }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                                @method('PUT')
                                            </form>
                                        @else
                                            <span
                                                class="badge {{ $donation->status_id == 2 ? 'bg-success' : 'bg-danger' }}">
                                                {{ $donation->status_id == 2 ? 'Disetujui' : 'Ditolak' }}
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk Menampilkan Bukti Donasi -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Bukti Donasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" class="img-fluid rounded">
                </div>
            </div>
        </div>
    </div>

    <!-- Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log("Script Loaded - Event Listener Harus Berjalan");

            // Event listener untuk gambar bukti donasi
            document.querySelectorAll('.bukti-donasi').forEach(img => {
                img.addEventListener('click', function() {
                    let imageUrl = this.getAttribute('data-bs-image');
                    document.getElementById('modalImage').setAttribute('src', imageUrl);
                });
            });

            // Tombol ACC
            document.querySelectorAll('.acc-btn').forEach(button => {
                button.addEventListener('click', function() {
                    let donationId = this.getAttribute('data-id');
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Ingin menyetujui donasi ini?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Setujui!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById(`approve-form-${donationId}`).submit();
                        }
                    });
                });
            });

            // Tombol Tolak
            document.querySelectorAll('.reject-btn').forEach(button => {
                button.addEventListener('click', function() {
                    let donationId = this.getAttribute('data-id');
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Ingin menolak donasi ini?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, Tolak!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById(`reject-form-${donationId}`).submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
