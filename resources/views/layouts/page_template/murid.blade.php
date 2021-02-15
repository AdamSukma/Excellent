<form id="logout-form" action="{{ route('murid.logout') }}" method="POST" style="display: none;">
    @csrf
</form>
 <!-- End Navbar -->
 <div class="wrapper-sidebar d-flex align-items-stretch">
    <div class="" style="">
     <nav id="sidebar2" class="sidebar2" data-color="orange">

        <div class="logo" style="text-align:left;padding-left:1.5rem;padding-right:1.5rem">
            <a class="simple-text logo-normal">
                <i class="now-ui-icons users_single-02" style="margin-right:12px"></i>
                <b>{{ \Auth::user()->nama }}</b>
                <small>Siswa</small>
            </a>
        </div>
          <div class="sidebar-wrapper" id="sidebar-wrapper" >
              <ul class="nav">
              <li class="@if ($activePage == 'jadwalMurid') active @endif">
                  <a href="{{route('murid.jadwal')}}">
                  <i class="now-ui-icons ui-1_calendar-60"></i>
                  <p>{{ __('Jadwal Bimbel') }}</p>
                  </a>
              </li>
              <li class="@if ($activePage == 'soalMurid') active @endif">
                  <a href="{{route('murid.soal')}}">
                  <i class="now-ui-icons education_paper"></i>
                  <p>{{ __('Database Soal') }}</p>
                  </a>
              </li>
              <li class="@if ($activePage == 'profileMurid') active @endif">
                  <a href="{{route('murid.profile')}}">
                  <i class="now-ui-icons users_single-02"></i>
                  <p>{{ __('Profile') }}</p>
                  </a>
              </li>
              
              </ul>
          </div>
     </nav>
    </div>
     <!-- Page Content  -->
     <div id="content" >
         <nav class="navbar">
            <div class="container-fluid">
             <div class="custom-menu-sidebar">
                 <button type="button" id="sidebarCollapse" class="btn btn-primary">
                     <i class="fa fa-bars"></i>
                     <span class="sr-only">Toggle Menu</span>
                 </button>
             </div>
             {{-- <div class="navbar-wrapper">
                 <a class="navbar-brand" href="#pablo"><p>Selamat Datang {{ \Auth::user()->nama }}</p> </a>
             </div> --}}
             <a href="{{ route('murid.logout') }}" onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                    <p>Logout</p>
                </a>
         </nav>
         @yield('content')
     </div>
 </div>
 </div>
