<div class="navbar-area sticky-top">
      <div class="mobile-nav">
         <a href="http://127.0.0.1:8000" class="logo">
            <img src="assets/img/masjid_uika.png" alt="Logo" width="120">
         </a>
      </div>
      <div class="main-nav">
         <div class="container">

            <nav class="navbar navbar-expand-md navbar-light">
               <a class="navbar-brand" href="http://127.0.0.1:8000/indexs">
                  <img src="{{ asset('index/assets/img/masjid_uika.png') }}" class="logo-one" alt="Logo" width="70px">
                  <img src="{{ asset('index/assets/img/masjid_uika.png') }}" class="logo-two" alt="Logo">
               </a>
               <div style="display: flex; justify-content: flex-end; width:100%" id="navbarSupportedContent">
                  {{-- <ul class="navbar-nav"> --}}
                     {{-- <li class="nav-item">
                        <a href="/indexs" class="nav-link">Home</a>
                     </li> --}}
                     {{-- <li class="nav-item">
                        <a href="" class="nav-link">Donasi</a>
                     </li> --}}
                     
                     {{-- <li class="nav-item"> --}}
                      @auth
                         
                        <div style="display: flex; align-items: center;">
                           <a class="nav-link" style="color: green; margin-right: 15px;" onmouseover="this.style.color='black'" onmouseout="this.style.color='green'">Hi, {{ auth()->user()->name }}</a>
                           <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link" style="color: black;" onmouseover="this.style.color='red'" onmouseout="this.style.color='black'">Logout</a>
                       </div>
                       
                       <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                           @csrf
                       </form>
                       @endauth
                       
                       @guest
                         <div style="display: flex; align-items: center;">
                            <a href="{{ route('login') }}" class="nav-link" style="color: green; margin-right: 15px;" onmouseover="this.style.color='black'" onmouseout="this.style.color='green'">Login</a>
                            <a href="{{ route('register') }}" class="nav-link" style="color: green;" onmouseover="this.style.color='black'" onmouseout="this.style.color='green'">Register</a>
                        </div>
                       @endguest
                       

                        
                       
                     {{-- </li>
                  </ul> --}}
               </div>
            </nav>
         </div>
      </div>
   </div>