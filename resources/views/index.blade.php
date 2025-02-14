<!DOCTYPE html>
<html lang="zxx">

<head>
    @include('layouts-index.head')
    <meta charset="utf-8" />
    <title>Swiper demo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS (harus ada untuk modal berfungsi) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <style>
        html,
        body {
            position: relative;
            height: 100%;
        }

        body {
            background-image: url('index/assets/img/orang2.jpg');
            background-position: 1px 3px;
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: cover;
            font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
            font-size: 14px;
            color: #000;
            margin: 0;
            padding: 0;
        }

        .swiper {
            width: 100%;
            height: 100%;
        }

        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>

<body>

    @include('layouts-index.navbar-area')

    {{-- Display success or error messages --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <section class="donations-area three pt-100 pb-70" id="donasi">
        <div class="container">
            <div class="scroll">
                <div class="scroll-text">
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide"><img src="index/assets/img/g1.jpg" alt=""
                                    style="height: 700px;"></div>
                            <div class="swiper-slide"><img src="index/assets/img/g2.jpg" alt=""
                                    style="height: 700px;"></div>
                            <div class="swiper-slide"><img src="index/assets/img/g3.jpeg" alt=""
                                    style="height: 700px;"></div>
                            <div class="swiper-slide"><img src="index/assets/img/Korban Bencana.jpg" alt=""
                                    style="height: 700px;"></div>
                            <div class="swiper-slide"><img src="index/assets/img/konflik-Israel-Palestina-4.jpeg"
                                    alt="" style="height: 700px;"></div>
                            <div class="swiper-slide"><img src="index/assets/img/kaum-dhuafa-.jpg" alt=""
                                    style="height: 700px;"></div>

                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
                <div class="section-title">
                    <h2 style="margin-top:50px;">Penggalangan terbaru</h2>
                </div>
                <div class="row">
                    @foreach ($campaigns as $campaign)
                        <div class="col-sm-6 col-lg-4">
                            <div class="donation-item">
                                <div class="img">
                                    <img src="{{ asset('storage/' . ($campaign->image ?? 'default.jpg')) }}"
                                        class="card-img-top" alt="{{ $campaign->title }}">
                                </div>
                                <div class="top pt-3">
                                    <h3>
                                        <a href="#" class="text-decoration-none fw-bold" data-bs-toggle="modal" data-bs-target="#campaignModal{{ $campaign->id }}">
                                            {{ $campaign->title }}
                                        </a>
                                    </h3>                                                                       
                                    <p>Target: {{ number_format($campaign->goal_amount) }}</p>
                                </div>
                                <div class="inner">
                                    <div class="bottom">
                                        <div class="skill">
                                            <div class="skill-bar wow fadeInLeftBig"
                                                style="width: {{ ($campaign->total_collected / $campaign->goal_amount) * 100 }}%">
                                                <p></p>
                                                <span class="skill-count4"></span>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="text-dark">Terkumpul: Rp.
                                                {{ number_format($campaign->total_collected) }}</div>

                                            <div class="text-dark" style="overflow: auto; margin-top:25px;">
                                                {{ $campaign->description }}
                                            </div>

                                            <!-- Tambahkan tombol Baca Selengkapnya di sini -->
                                            <div class="text-dark">
                                                <button class="btn btn-link text-decoration-none p-0" data-bs-toggle="modal" data-bs-target="#campaignModal{{ $campaign->id }}">
                                                    Baca Selengkapnya
                                                </button>
                                            </div>
                                            
                                            @php
                                                // Calculate days left until expiration
                                                $expirationDate = \Carbon\Carbon::parse($campaign->expired);
                                                $currentDate = \Carbon\Carbon::now();
                                                $daysLeft = $expirationDate->diffInDays($currentDate, false);
                                            @endphp

                                            <p style="color:black; margin-top: 15px; font-weight: bold;">
                                                @if ($currentDate->lessThanOrEqualTo($expirationDate))
                                                    {{ $daysLeft }} hari lagi
                                                @else
                                                    Donasi Telah Berakhir
                                                @endif
                                            </p>

                                        </div>
                                        <h4 style="color:black; margin-top: 15px; margin-bottom: 15px;">
                                            {{ $campaign->donors()->count() }} donatur
                                        </h4>
                                        @if ($campaign->total_collected >= $campaign->goal_amount)
                                            <button class="btn btn-secondary" disabled>Campaign Complete</button>
                                        @else
                                            @php
                                                $currentDate = \Carbon\Carbon::now();
                                                $expiryDate = \Carbon\Carbon::parse($campaign->expired); // Asumsikan 'expiry_date' adalah nama kolom di database
                                            @endphp
                                            @if ($currentDate->lessThanOrEqualTo($expiryDate))
                                                @if (session('auth'))
                                                    <a href="{{ route('donationuser.create', $campaign) }}"
                                                        class="btn btn-success">Donasi</a>
                                                @else
                                                    <a href ="/login" class="btn btn-primary">Donasi</a>
                                                @endif
                                            @else
                                                <span class="btn btn-secondary disabled">Campaign Expired</span>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
    </section>

    @include('layouts-index.footer')

    <div class="go-top">
        <i class="icofont-arrow-up"></i>
        <i class="icofont-arrow-up"></i>
    </div>

    <script src="{{ asset(' index/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('index/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('index/assets/js/form-validator.min.js') }}"></script>
    <script src="{{ asset('index/assets/js/contact-form-script.js') }}"></script>
    <script src="{{ asset('index/assets/js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('index/assets/js/jquery.meanmenu.js') }}"></script>
    <script src="{{ asset('index/assets/js/jquery-modal-video.min.js') }}"></script>
    <script src="{{ asset('index/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('index/assets/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('index/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('index/assets/js/odometer.min.js') }}"></script>
    <script src="{{ asset('index/assets/js/jquery.appear.min.js') }}"></script>
    <script src="{{ asset('index/assets/js/jquery.nice-select.min.js') }}"></script>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".mySwiper", {
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },

            autoplay: {
                delay: 2500,
            },
        });
    </script>
    @foreach ($campaigns as $campaign)
        <div class="modal fade" id="campaignModal{{ $campaign->id }}" tabindex="-1"
            aria-labelledby="campaignModalLabel{{ $campaign->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="campaignModalLabel{{ $campaign->id }}">{{ $campaign->title }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img src="{{ asset('storage/' . ($campaign->image ?? 'default.jpg')) }}" class="img-fluid mb-3"
                            alt="{{ $campaign->title }}">
                        <p><strong>Target:</strong> Rp. {{ number_format($campaign->goal_amount) }}</p>
                        <p><strong>Terkumpul:</strong> Rp. {{ number_format($campaign->total_collected) }}</p>
                        <p><strong>Deskripsi:</strong></p>
                        <p>{{ $campaign->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</body>

</html>
