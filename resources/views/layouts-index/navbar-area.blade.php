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
                  <img src="{{ asset('index/assets/img/masjid_uika.png') }}" class="logo-one" alt="Logo" width="135px">
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
                        <a href="/login" class="nav-link" style="color: black;" onmouseover="this.style.color='green'" onmouseout="this.style.color='black'">Login</a>
                        <a href="/register" class="nav-link" style="color: black;" onmouseover="this.style.color='green'" onmouseout="this.style.color='black'">Register</a>
                     {{-- </li>
                  </ul> --}}
               </div>
            </nav>
         </div>
      </div>
   </div>