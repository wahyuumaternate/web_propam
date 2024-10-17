<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-heading">Pages</li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('dashboard') ? '' : 'collapsed' }} " href="/">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->is('dashboard/daftar-kasus*') ? '' : 'collapsed' }}"
                href="{{ route('daftarKasus') }}">
                <i class="bi bi-card-list"></i>
                <span>Daftar Kasus</span>
            </a>
        </li><!-- End Kasus Page Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->is('dashboard/kategori') ? '' : 'collapsed' }}"
                href="{{ route('kategori') }}">
                <i class="bi bi-file-earmark-ruled"></i>
                <span>Kategori</span>
            </a>
        </li><!-- End Profile Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="">
                <i class="bi bi-star"></i>
                <span>Pangkat</span>
            </a>
        </li><!-- End F.A.Q Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="">
                <i class="bi bi-pin-map"></i>
                <span>Satker</span>
            </a>
        </li><!-- End Contact Page Nav -->



        {{-- <li class="nav-item">
            <a class="nav-link collapsed" href="">
                <i class="bi bi-box-arrow-in-right"></i>
                <span>Jabatan</span>
            </a>
        </li><!-- End Login Page Nav --> --}}

        {{-- <li class="nav-item">
            <a class="nav-link collapsed" href="">
                <i class="bi bi-dash-circle"></i>
                <span>Belum Ada</span>
            </a>
        </li><!-- End Error 404 Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="">
                <i class="bi bi-file-earmark"></i>
                <span>Belum Ada</span>
            </a>
        </li><!-- End Blank Page Nav --> --}}

    </ul>

</aside><!-- End Sidebar-->
