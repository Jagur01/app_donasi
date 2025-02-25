@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Daftar Donasi</h1>
        <a href="{{ route('campaigns.create') }}" class="btn mb-3" style="background-color: #6777ef; color: white;">
            Tambah Donasi
        </a>
        <div class="row">
            @foreach ($campaigns as $campaign)
                <div class="col-md-4">
                    <div class="card mb-3 campaign-card">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal{{ $campaign->id }}">
                            <img src="{{ asset('storage/' . ($campaign->image ?? 'default.jpg')) }}"
                                class="card-img-top campaign-image" alt="{{ $campaign->title }}">
                        </a>

                        <div class="card-body">
                            <h5 class="card-title">{{ $campaign->title }}</h5>
                            <p class="card-text description" id="desc-{{ $campaign->id }}">
                                {{ $campaign->description }}
                            </p>
                            <span class="show-more" onclick="toggleDescription({{ $campaign->id }})">
                                Lihat Selengkapnya
                            </span>
                            <p><strong>Informasi Bank</strong><br>{{ $campaign->bank_info }}</p>
                            <p><strong>Waktu Dibuat</strong><br> {{ $campaign->created_at }}</p>
                            <p><strong>Batas Waktu</strong><br> {{ $campaign->expired }}</p>
                            <p><strong>Target Donasi</strong><br> {{ number_format($campaign->goal_amount, 2) }}</p>
                            <p><strong>Total Terkumpul</strong><br> {{ number_format($campaign->total_collected, 2) }}</p>

                            <div class="d-flex gap-2">
                                <a href="{{ route('campaigns.edit', $campaign->id) }}" class="btn btn-warning">Edit</a>
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

                <!-- Modal Gambar -->
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

    <!-- CSS -->
    <style>
        .description {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            position: relative;
            max-height: 3.6em;
        }

        .description::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 1.5em;
            background: linear-gradient(to bottom, rgba(255, 255, 255, 0), white);
        }

        .description.expanded {
            -webkit-line-clamp: unset;
            max-height: none;
        }

        .description.expanded::after {
            display: none;
        }

        .show-more {
            color: #007bff;
            cursor: pointer;
            display: block;
            margin-top: 5px;
            font-weight: bold;
            padding-bottom: 10px;
        }
    </style>

    <!-- JavaScript -->
    <script>
        function toggleDescription(id) {
            let desc = document.getElementById(`desc-${id}`);
            let btn = desc.nextElementSibling;

            if (desc.classList.contains("expanded")) {
                desc.classList.remove("expanded");
                btn.innerText = "Lihat Selengkapnya";
            } else {
                desc.classList.add("expanded");
                btn.innerText = "Lebih Sedikit";
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            @if (session('success'))
                Swal.fire({
                    title: "Sukses!",
                    text: "{{ session('success') }}",
                    icon: "success",
                    confirmButtonText: "OK"
                });
            @endif

            document.querySelectorAll(".delete-form").forEach(form => {
                form.addEventListener("submit", function(event) {
                    event.preventDefault();
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
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
