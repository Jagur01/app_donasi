<!doctype html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Donasi</title>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
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
                        <a href="{{ route('home') }}" class="sidebar-link">
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
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#pages" data-bs-toggle="collapse" aria-expanded="false">
                            Agenda
                        </a>
                        <ul id="pages" class="sidebar-dropdown list-unstyled collpase" data-bs-target="#sidebar">
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
                                <a href="{{ route('campaigns.index') }}" class="sidebar-link">
                                    <i class="fa-solid fa-clipboard"></i> &nbsp;
                                    Donasi
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('categoriesCampaigns.index') }}" class="sidebar-link">
                                    <i class="fa-solid fa-window-restore"></i> &nbsp;
                                    Kategori Donasi
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('donations.index') }}" class="sidebar-link">
                                    <i class="fa-solid fa-users"></i> &nbsp;
                                    Daftar Donatur
                                </a>

                            </li>
                         

                        </ul>
                    </li>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('user.index') }}" class="sidebar-link">
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
                            <a href="#" data-bs-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <img src="{{ asset('assets/img/user.png') }}" alt="user" class="avatar border-bottom-0">
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
                                    CopyRight &copy; 2024
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
    <script>
        $(function() {
            $("#date").datepicker({
                dateFormat: 'yy-mm-dd'
            });
        });
    </script>
</body>

</html>