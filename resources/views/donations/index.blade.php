@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Daftar Donatur</h1>

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
                        @foreach ($donations as $index => $donation)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $donation->user->name }}</td>
                                <td>{{ $donation->campaign->title }}</td>
                                <td>{{ number_format($donation->amount, 2) }}</td>
                                <td><span
                                        class="badge bg-{{ $donation->status->name == 'Pending' ? 'warning' : 'success' }}">{{ $donation->status->name }}</span>
                                </td>

                                <td>
                                    <img src="{{ asset('storage/' . $donation->proof_image) }}" class="img-thumbnail"
                                        style="width: 60px; cursor: pointer;"
                                        data-bs-image="{{ asset('storage/' . $donation->proof_image) }}">

                                </td>

                                <td>
                                    @if ($donation->status_id == 1)
                                        <!-- Pending -->
                                        <form action="{{ route('donations.approve', $donation->id) }}" method="POST"
                                            style="display: inline-block;">
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
                    <h5 class="modal-title" id="imageModalLabel">Bukti Donasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <div id="zoom-container" style="overflow: hidden; cursor: grab;">
                        <img id="modalImage" src="" alt="Proof Image" class="img-fluid rounded"
                            style="max-width: 100%;">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/panzoom/9.4.0/panzoom.min.js"></script>

    <script>
        function showImage(imageUrl) {
            const modalImage = document.getElementById('modalImage');
            modalImage.src = imageUrl;

            const modal = new bootstrap.Modal(document.getElementById('imageModal'));
            modal.show();

            // Aktifkan Panzoom setelah gambar muncul
            setTimeout(() => {
                const zoomContainer = document.getElementById('zoom-container');
                const panzoomInstance = Panzoom(zoomContainer, {
                    maxScale: 3, // Maksimum zoom 3x
                    minScale: 1, // Minimum zoom default
                    contain: 'outside'
                });

                zoomContainer.addEventListener('wheel', panzoomInstance.zoomWithWheel);
            }, 500);
        }
    </script>


    {{-- <script>
        function showImage(imageUrl) {
            Swal.fire({
                title: 'Bukti Donasi',
                imageUrl: imageUrl,
                imageAlt: 'Proof Image',
                showCloseButton: true,
                showConfirmButton: false
            });
        }
    </script> --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const imageModal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');

            document.querySelectorAll('.img-thumbnail').forEach(img => {
                img.addEventListener('click', function() {
                    console.log("Gambar diklik!"); // Debugging

                    const imageUrl = this.getAttribute('data-bs-image');
                    console.log("URL Gambar:", imageUrl); // Cek apakah URL benar diambil

                    if (imageUrl) {
                        document.getElementById('modalImage').src = imageUrl;
                        new bootstrap.Modal(document.getElementById('imageModal')).show();
                    } else {
                        console.error("Gambar tidak ditemukan!");
                    }
                });
            });

            // imageModal.addEventListener('hidden.bs.modal', function() {
            //     modalImage.src = ''; // Reset gambar saat modal ditutup
            // });
        });
    </script>
@endsection
