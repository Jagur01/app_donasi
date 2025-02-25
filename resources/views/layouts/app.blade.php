<!doctype html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Donasi</title>
    <link rel="icon" type="image/png" href="{{ asset('index/assets/img/masjid_uika.png') }}">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <style>
        #sidebar {
            background-color: #ffffff !important;
            /* Sidebar putih */
            box-shadow: 2px 0px 10px rgba(0, 0, 0, 0.1) !important;
            /* Bayangan biar nggak nge-blend */
        }

        /* Biar teks "Masjid Ibn Khaldun" tetap hitam */
        .sidebar-logo a {
            color: #000000 !important;
            /* Hitam */
            font-weight: bold;
            /* Biar lebih tegas */
            padding-left: 16px;
            display: block;
        }

        /* Warna default sidebar link */
        .sidebar-link {
            color: #707070 !important;
            /* Abu-abu terang */
            transition: color 0.3s ease-in-out;
        }

        /* Warna tetap abu-abu saat hover */
        .sidebar-link:hover {
            color: #707070 !important;
            /* Tetap abu-abu */
        }

        /* Warna berubah setelah pindah halaman (saat link aktif) */
        .sidebar-item .active,
        .sidebar-item .sidebar-link[aria-current="page"] {
            color: #6777ef !important;
            /* Ungu kebiruan */
            font-weight: bold;
        }

        .sidebar-title {
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
            color: #707070;
            padding-left: 16px;
            /* Sesuaikan dengan sidebar-logo */
            margin-top: 20px;
            /* Tambahin jarak atas */
            margin-bottom: 10px;
            /* Tambahin jarak bawah */
            cursor: default;
            user-select: none;
            display: block;
            letter-spacing: 4px;
            /* Ngasih jarak antar huruf */
        }

        .sidebar-item span {
            letter-spacing: 5px;
            /* Sesuaikan jarak sesuai selera */
        }

        .navbar {
            background-color: #6777ef !important;
            /* Sesuaikan dengan warna yang diinginkan */
        }
    </style>

</head>

<body>
    <div class="wrapper">
        <aside id="sidebar">
            <div class="h-100">
                <div class="sidebar-logo">
                    <a href="#">Masjid Ibn Khaldun</a>
                </div>
                <ul class="sidebar-nav">
                    <li class="sidebar-item">
                        <a href="{{ route('admin.home') }}"
                            class="sidebar-link {{ request()->routeIs('admin.home') ? 'active' : '' }}">
                            <i class="fa-solid fa-home"></i> &nbsp;
                            Dashboard
                        </a>
                    </li>

                    {{-- <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#pages" data-bs-toggle="collapse" aria-expanded="false">
                            Uang Kas</a>
                        <ul id="pages" class="sidebar-dropdown list-unstyled collpase" data-bs-target="#sidebar">
                            <li class="sidebar-item">
                                <a href="{{ route('enter.index') }}" class="sidebar-link">
                                    <i class="fa-solid fa-money-bill-trend-up"></i> &nbsp;
                                    Uang Masuk
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('out.index') }}" class="sidebar-link">
                                    <i class="fa-solid fa-money-bill"></i> &nbsp;
                                    Uang Keluar
                                </a>
                            </li>
                        </ul>
                    </li> --}}

                    <li class="sidebar-item">
                        <div class="sidebar-title">Agenda</div>
                    </li>

                    @can('accessAdmin')
                        <li class="sidebar-item">
                            <a href="{{ route('categoryEvent.index') }}" class="sidebar-link">
                                <i class="fa-solid fa-calendar"></i> &nbsp;
                                Kategori Event
                            </a>
                        </li>
                    @endcan
                    {{-- <li class="sidebar-item">
                                <a href="{{ route('event.index') }}" class="sidebar-link">
                                    <i class="fa-solid fa-calendar-day"></i> &nbsp;
                                    Event
                                </a>
                            </li> --}}
                    <li class="sidebar-item">
                        <a href="{{ route('campaigns.index') }}"
                            class="sidebar-link {{ request()->routeIs('campaigns.index') ? 'active' : '' }}">
                            <i class="fa-solid fa-clipboard"></i> &nbsp;
                            Donasi
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a href="{{ route('categoriesCampaigns.index') }}"
                            class="sidebar-link {{ request()->routeIs('categoriesCampaigns.index') ? 'active' : '' }}">
                            <i class="fa-solid fa-window-restore"></i> &nbsp;
                            Kategori Donasi
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a href="{{ route('donations.index') }}"
                            class="sidebar-link {{ request()->routeIs('donations.index') ? 'active' : '' }}">
                            <i class="fa-solid fa-users"></i> &nbsp;
                            Daftar Donasi
                        </a>
                    </li>

                    </li>
                    </li>

                    <li class="sidebar-item">
                        <a href="{{ route('user.index') }}"
                            class="sidebar-link {{ request()->routeIs('user.index') ? 'active' : '' }}">
                            <i class="fa-solid fa-user"></i> &nbsp;
                            Pengguna
                        </a>
                    </li>

                </ul>
            </div>
        </aside>
        <div class="main">
            <nav class="navbar navbar-expand px-3 border-bottom">
                <button class="btn" id="sidebar-toggle" type="button">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse">
                    <ul class="navbar-nav navbar-right">

                        <li class="dropdown">
                            <a href="#" data-bs-toggle="dropdown"
                                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <img src="{{ asset('assets/img/avatar-1.png') }}" alt="user"
                                    class="avatar rounded-circle mr-1">
                                <div class="d-sm-none d-lg-inline-block">Hi, {{ auth()->user()->name }}</div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{ route('logout') }}" style="cursor: pointer"
                                    onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="content px-3 py-2">
                @yield('content')
            </main>
            <a href="#" class="theme-toggle">
                <i class="fa-solid fa-moon"></i>
                <i class="fa-regular fa-sun"></i>
            </a>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <a href="#" class="text-muted">
                                    {{-- copyright --}}
                                    CopyRight &copy; 2025
                                </a>
                            </p>
                        </div>
                        {{-- <div class="col-6 text-end">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="#" class="text-muted">Github</a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" class="text-muted">Email</a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" class="text-muted">LinkedIn</a>
                                </li>
                            </ul>
                        </div> --}}
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="{{ asset('assets/js/bootstrap.bundle.js') }}"></script>
    <script src="https://kit.fontawesome.com/5f34f5e1d5.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let dropdown = document.querySelector(".dropdown");

            dropdown.addEventListener("mouseenter", function() {
                let menu = this.querySelector(".dropdown-menu");
                menu.classList.add("show");
            });

            dropdown.addEventListener("mouseleave", function() {
                let menu = this.querySelector(".dropdown-menu");
                menu.classList.remove("show");
            });
        });

        $(function() {
            $("#date").datepicker({
                dateFormat: 'yy-mm-dd'
            });
        });
    </script>
</body>

</html>
