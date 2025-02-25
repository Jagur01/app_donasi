@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Daftar Donasi</h1>
        @if (session('success'))
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: "{{ session('success') }}",
                        confirmButtonText: 'OK'
                    });
                });
            </script>
        @endif
        <a href="{{ route('campaigns.create') }}" class="btn btn-primary mb-3"
            style="background-color: #6777ef; color: white;">Tambah Donasi</a>
        <div class="row">
            @foreach ($campaigns as $campaign)
                <div class="col-md-4">
                    <div class="card mb-3">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal{{ $campaign->id }}">
                            <img src="{{ asset('storage/' . ($campaign->image ?? 'default.jpg')) }}"
                                class="card-img-top campaign-image" alt="{{ $campaign->title }}">
                        </a>

                        <div class="card-body">
                            <h5 class="card-title" style="font-weight: bold;">{{ $campaign->title }}</h5>
                            <p class="card-text"
                                style="min-height: 120px; overflow: auto; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;">
                                {{ $campaign->description }}</p>
                            <p><strong>Waktu Dibuat :</strong> {{ $campaign->created_at }}</p>
                            <p><strong>Batas Waktu :</strong> {{ $campaign->expired }}</p>
                            <p><strong>Target Donasi : </strong> Rp.
                                {{ number_format($campaign->goal_amount, 0, ',', '.') }}</p>
                            <p><strong>Total Terkumpul :</strong> Rp.
                                {{ number_format($campaign->total_collected, 0, ',', '.') }}</p>


                            <!-- Tombol dalam satu baris -->
                            <div class="d-flex gap-2">
                                @if ($campaign->total_collected >= $campaign->goal_amount)
                                    <button class="btn btn-secondary" disabled>Donasi Selesai</button>
                                @else
                                    <a href="{{ route('donations.create', $campaign) }}" class="btn btn-success">Donasi</a>
                                @endif

                                <a href="{{ route('campaigns.edit', $campaign->id) }}" class="btn btn-warning">Edit</a>

                                <!-- Tombol Hapus (Tanpa Modal) -->
                                <form action="{{ route('campaigns.destroy', $campaign->id) }}" method="POST"
                                    class="delete-form" data-title="{{ $campaign->title }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal untuk menampilkan gambar lebih besar -->
                <div class="modal fade" id="imageModal{{ $campaign->id }}" tabindex="-1"
                    aria-labelledby="imageModalLabel{{ $campaign->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="imageModalLabel{{ $campaign->id }}">Gambar Donasi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <img src="{{ asset('storage/' . ($campaign->image ?? 'default.jpg')) }}" class="img-fluid"
                                    alt="{{ $campaign->title }}">
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
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .card-title {
            font-weight: bold;
        }

        .d-flex.gap-2>* {
            margin-right: 0.5rem;
        }
    </style>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Konfirmasi hapus tanpa modal
            document.querySelectorAll(".delete-form").forEach(form => {
                form.addEventListener("submit", function(event) {
                    event.preventDefault(); // Mencegah form langsung terkirim

                    let campaignTitle = form.getAttribute("data-title");

                    Swal.fire({
                        title: "Yakin ingin menghapus?",
                        text: `Donasi "${campaignTitle}" akan dihapus!`,
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Ya, Hapus!",
                        cancelButtonText: "Batal"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit(); // Kirim form jika dikonfirmasi
                        }
                    });
                });
            });
        });
    </script>
@endsection
