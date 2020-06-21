<div class="col-md-3 left_col">
  <div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
      <a href="?content.php" class="site_title" style="font-family: 'Patua One', cursive;"><i class="fa fa-car"></i><span>PSend</span></a>
    </div>

    <div class="clearfix"></div>



    <br />

    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">
        <h3>{{\App\User::where('id', \Auth::user()->id)->with('roles')->first()->roles[0]->display_name}}</h3>
        <ul class="nav side-menu">
          @if (\Auth::user()->can('read-user-menu'))
          <li><a><i class="fa fa-address-card-o"></i> Kelola Data User <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="{{url('/user/create')}}">Tambah User</a></li>
              <li><a href="{{url('/user')}}">Lihat Data User</a></li>
            </ul>
          </li>
          @endif
          @if (\Auth::user()->can('read-pegawai-menu'))
          <li><a><i class="fa fa-address-book-o"></i>Kelola Data Pegawai <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="{{url('/pegawai/create')}}">Tambah Data Pegawai</a></li>
              <li><a href="{{url('/pegawai')}}">Lihat Data Pegawai</a></li>
            </ul>
          </li>
          @endif
          @if (\Auth::user()->can('read-region-menu'))
          <li><a href="{{url('/region')}}"><i class="fa fa-globe"></i>Kelola Data Region</a></li>
          @endif
          @if (\Auth::user()->can('read-tarif-menu'))
          <li><a href="{{url('/tarif')}}"><i class="fa fa-money"></i>Kelola Tarif</a></li>
          @endif
          @if (\Auth::user()->can('read-laporan-menu'))
          <li><a><i class="fa fa-book"></i>Cetak Laporan <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="{{url('/laporan-barang')}}">Data Barang </a></li>
              <li><a href="{{url('/laporan-barang/user')}}">Data User</a></li>
              <li><a href="{{url('/laporan-barang/pegawai')}}">Data Pegawai</a></li>
              <li><a href="{{url('/laporan-barang/kurir')}}">Data Kurir</a></li>
            </ul>
          </li>
         @endif
         @if (\Auth::user()->can('read-barang-menu'))
         <li><a><i class="fa fa-cubes"></i> Kelola Data Barang <span class="fa fa-chevron-down"></a>
          <ul class="nav child_menu">
            <li><a href="{{url('/barang/create')}}">Tambah Barang</a></li>
            <li><a href="{{url('/barang')}}">Lihat Data Barang</a></li>
          <li><a href="{{url('/barang/index-transit')}}">Data Barang Transit</a></li>
            <li><a href="{{url('/barang/index-terkirim')}}">Data Barang Terkirim</a></li>
          </ul>
        </li>
        @endif
        @if (\Auth::user()->can('read-kurir-menu'))
        <li><a><i class="fa fa-user"></i> Kelola Data Kurir <span class="fa fa-chevron-down"></a>
          <ul class="nav child_menu">
            <li><a href="{{url('/kurir/create')}}">Tambah Kurir</a></li>
            <li><a href="{{url('/kurir')}}">Lihat Data Kurir</a></li>
          </ul>
        </li>
        @endif

        @if (\Auth::user()->can('read-pengiriman-barang-menu'))
        <li><a><i class="fa fa-cubes"></i> Pengiriman Barang <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="{{url('/pengiriman-barang')}}">Lihat Barang WTT</a></li>
            <li><a href="{{url('/pengiriman-barang/index-otw')}}">Lihat Barang OTW</a></li>
            <li><a href="{{url('/pengiriman-barang/index-delayed')}}">Lihat Barang Delay</a></li>
            <li><a href="{{url('/pengiriman-barang/index-terkirim')}}">Lihat Barang Terkirim</a></li>
          </ul>
        </li>
        @endif

        @if (\Auth::user()->can('read-cek-lokasi-barang-menu'))
        <li>
          <a href="{{url('/cek-lokasi-barang')}}"><i class="fa fa-user"></i> Check Lokasi Barang</a>   
        </li>
        @endif

        </div>

      </div>
      <div class="sidebar-footer hidden-small">
      </div>
      <!-- /menu footer buttons -->
    </div>
  </div>

  <!-- top navigation -->
  <div class="top_nav">
    <div class="nav_menu">
      <nav>
        <div class="nav toggle">
          <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>

        <ul class="nav navbar-nav navbar-right">
          <li class="">
            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              <img src="images/img.jpg" alt="">{{ Auth::user()->name }}
              <span class=" fa fa-angle-down"></span>
            </a>
            <ul class="dropdown-menu dropdown-usermenu pull-right">
              <li><a href="javascript:;"> Profile</a></li>
              <li>
                <a href="javascript:;">
                  <span class="badge bg-red pull-right">50%</span>
                  <span>Settings</span>
                </a>
              </li>
              <li><a href="javascript:;">Help</a></li>
              <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
              document.getElementById('logout-form').submit();"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</div>