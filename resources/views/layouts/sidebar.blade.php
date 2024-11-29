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

        @if (auth()->user()->can('lihat_kasus') || auth()->user()->can('lihat_semua_kasus'))
            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard/daftar-kasus*') ? '' : 'collapsed' }}"
                    href="{{ route('daftarKasus') }}">
                    <i class="bi bi-card-list"></i>
                    <span>Daftar Kasus</span>
                </a>
            </li><!-- End Kasus Page Nav -->
        @endif

        @can('lihat_pelanggaran')
            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard/kategori') ? '' : 'collapsed' }}"
                    href="{{ route('kategori') }}">
                    <i class="bi bi-file-earmark-excel"></i>
                    <span>Pelanggaran</span>
                </a>
            </li><!-- End Profile Page Nav -->
        @endcan

        @can('lihat_pangkat')
            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard/pangkat') ? '' : 'collapsed' }}"
                    href="{{ route('pangkat') }}">
                    <i class="bi bi-star"></i>
                    <span>Pangkat</span>
                </a>
            </li><!-- End F.A.Q Page Nav -->
        @endcan

        @can('lihat_satker')
            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard/satker-satwil') ? '' : 'collapsed' }}"
                    href="{{ route('satker') }}">
                    <i class="bi bi-pin-map"></i>
                    <span>Satker</span>
                </a>
            </li><!-- End Contact Page Nav -->
        @endcan

        @can('lihat_status')
            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard/status') ? '' : 'collapsed' }}"
                    href="{{ route('status') }}">
                    <i class="bi bi-collection"></i>
                    <span>Status</span>
                </a>
            </li><!-- End Login Page Nav -->
        @endcan

        @can('lihat_pelanggaran')
            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard/pelanggaran') ? '' : 'collapsed' }}"
                    href="{{ route('pelanggaran') }}">
                    <i class="bi bi-diagram-2"></i>
                    <span>Jenis Pelanggaran</span>
                </a>
            </li><!-- End Contact Page Nav -->
        @endcan

        @can('lihat_hukuman')
            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard/hukuman') ? '' : 'collapsed' }}"
                    href="{{ route('hukuman') }}">
                    <i class="bi bi-bank2"></i>
                    <span>Hukuman</span>
                </a>
            </li><!-- End Contact Page Nav -->
        @endcan

        @if (auth()->user()->can('lihat_skhp') || auth()->user()->can('lihat_semua_skhp'))
            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard/skhp*') ? '' : 'collapsed' }}" data-bs-target="#skhp"
                    data-bs-toggle="collapse" href="#">
                    <i class="bi bi-file-earmark-pdf"></i><span>SKHP</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="skhp" class="nav-content collapse {{ request()->is('dashboard/skhp*') ? 'show' : '' }}"
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('skhp.index') }}"
                            class="{{ request()->is('dashboard/skhp') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Semua SKHP</span>
                        </a>
                    </li>
                    @can('lihat_skhp_tamplate')
                        <li>
                            <a href="{{ route('skhp.tamplate') }}"
                                class="{{ request()->is('dashboard/skhp-tamplate') ? 'active' : '' }}">
                                <i class="bi bi-circle"></i><span>Edit Tamplate SKHP</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li><!-- End Forms Nav -->
        @endif

        @can('lihat_pengaturan')
            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard/pengaturan*') ? '' : 'collapsed' }}"
                    data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-gear"></i><span>Pengaturan</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-nav" class="nav-content collapse {{ request()->is('dashboard/pengaturan*') ? 'show' : '' }}"
                    data-bs-parent="#sidebar-nav">
                    @can('lihat_role')
                        <li>
                            <a href="{{ route('users.index') }}"
                                class="{{ request()->is('dashboard/pengaturan/users') ? 'active' : '' }}">
                                <i class="bi bi-circle"></i><span>Pengguna</span>
                            </a>
                        </li>
                    @endcan
                    @can('lihat_role')
                        <li>
                            <a href="{{ route('roles.index') }}"
                                class="{{ request()->is('dashboard/pengaturan/role') ? 'active' : '' }}">
                                <i class="bi bi-circle"></i><span>Role</span>
                            </a>
                        </li>
                    @endcan
                    <li>
                        <a href="{{ route('activityLogs.index') }}"
                            class="{{ request()->is('dashboard/pengaturan/activity-logs') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Aktivitas Pengguna</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Forms Nav -->
        @endcan

    </ul>


</aside><!-- End Sidebar-->
