<!DOCTYPE html>
<html lang="zxx">
<head>
    @include('layouts-index.head')
</head>
<body>

   {{-- <div class="loader">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="pre-box-one">
                    <div class="pre-box-two"></div>
                </div>
            </div>
        </div>
    </div>  --}}

    @include('layouts-index.navbar-area')

    <div class="banner-area-two three">
        <div class="banner-slider owl-theme owl-carousel">
            <div class="banner-slider-item banner-img-four">
                <div class="d-table">
                    <div class="d-table-cell">
                        <div class="container">
                            <div class="banner-content">
                                <h1>Berikan bantuan kepada semua yang membutuhkan</h1>
                                <div class="banner-btn-area">
                                    <a class="common-btn" href="#">Mulai Berdonasi</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="banner-slider-item banner-img-six">
                <div class="d-table">
                    <div class="d-table-cell">
                        <div class="container">
                            <div class="banner-content">
                                <h1>Uluran tanganmu sangat berarti bagi mereka</h1>
                                <div class="banner-btn-area">
                                    <a class="common-btn" href="#donasi">Mulai Berdonasi</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Display success or error messages --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <section class="donations-area three pt-100 pb-70" id="donasi">
        <div class="container">
            <div class="section-title">
                <h2>Penggalangan terbaru</h2>
            </div>
            <div class="row">
                @foreach ($campaigns as $campaign)
                <div class="col-sm-6 col-lg-4">
                    <div class="donation-item">
                        <div class="img">
                            <img src="{{ asset('storage/' . ($campaign->image ?? 'default.jpg')) }}" class="card-img-top" alt="{{ $campaign->title }}">
                        </div>
                        <div class="top pt-3">
                            <h3>
                                <a href="">
                                    {{ $campaign->title }}
                                </a>
                            </h3>
                            <p>Target: {{ number_format($campaign->goal_amount) }}</p>
                        </div>
                        <div class="inner">
                            <div class="bottom">
                                <div class="skill">
                                    <div class="skill-bar wow fadeInLeftBig" style="width: {{ ($campaign->total_collected / $campaign->goal_amount) * 100 }}%">
                                        <p></p>
                                        <span class="skill-count4" ></span>
                                    </div>
                                </div>
                                <ul>
                                    <li class="text-dark" style="margin-bottom: 30px;">{{ $campaign->description }}</li>
                                    
                                    <li class="text-dark">Terkumpul: Rp. {{ number_format($campaign->total_collected) }}</li>
                                    @php
                                        // Calculate days left until expiration
                                        $expirationDate = \Carbon\Carbon::parse($campaign->expired);
                                        $currentDate = \Carbon\Carbon::now();
                                        $daysLeft = $expirationDate->diffInDays($currentDate);
                                    @endphp
                                   
                                        <b style="color:black;">
                                            @if ($daysLeft > 0)
                                                {{ $daysLeft }} hari lagi
                                            @else
                                               Donasi Telah Berakhir
                                            @endif
                                        </b>
                                 
                                </ul>
                                <h4><span>
                                    {{ $campaign->donors()->count() }} donatur
                                </span></h4>
                                @if ($campaign->total_collected >= $campaign->goal_amount)
                                <button class="btn btn-secondary" disabled>Campaign Complete</button>
                            @else
                                <a href="{{ route('donationuser.create', $campaign) }}" class="btn btn-success">Donate</a>
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
</body>
</html>