<!DOCTYPE html>
<html lang="zxx">
<head>
    @include('layouts-index.head')
    <style>
        /* Custom styles for centering and sizing */
        .donations-area {
            display: flex;
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
            min-height: 100vh; /* Full viewport height */
        }

        .donation-item {
            width: 100%; /* Full width */
            max-width: 400px; /* Maximum width */
            margin: 20px; /* Margin around each item */
            padding: 20px; /* Padding inside the item */
            border: 1px solid #ccc; /* Border for the item */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Shadow effect */
            text-align: center; /* Center text */
        }

        .section-title h2 {
            text-align: center; /* Center the section title */
            margin-bottom: 30px; /* Space below the title */
        }
    </style>
</head>
<body>

    @include('layouts-index.navbar-area')

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
                <h2>Mulai Berdonasi</h2>
            </div>
            <div class="row justify-content-center"> <!-- Center the row content -->
                <div class="col-sm-6 col-lg-4">
                    <div class="donation-item">
                        <h1>Donate to: {{ $campaign->title }}</h1>
                        <p>---------------------------------</p>
                        <h4>Qris</h4>
                        @if ($campaign->file_qr)
                        <img src="{{ asset('storage/' . $campaign->file_qr) }}" class="card-img-top" alt="{{ $campaign->title }}">
                    @else
                        <img src="{{ asset('storage/campaign_qr\default_qr.png') }}" class="card-img-top" alt="{{ $campaign->title }}">
                    @endif
                    

                        <form action="{{ route('donationuser.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id">
                    
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="campaign_id" value="{{ $campaign->id }}">
                          
                            <input type="hidden" name="status_id" value="1">
                            <div class="mb-3">
                                <label for="amount" class="form-label">Donation Amount</label>
                                <input type="number" name="amount" class="form-control" id="amount" required>
                            </div>
                            <div class="mb-3">
                                <label for="proof_image" class="form-label">Proof of Donation</label>
                                <input type="file" name="proof_image" class="form-control" id="proof_image" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit Donation</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('layouts-index.footer')

    <div class="go-top">
        <i class="icofont-arrow-up"></i>
        <i class="icofont-arrow-up"></i>
    </div>

    <script src="{{ asset('index/assets/js/jquery.min.js') }}"></script>
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


