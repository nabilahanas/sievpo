<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="{{ url('/home') }}" class="nav-link {{ $key == 'dashboard' ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/data" class="nav-link {{ $key == 'evdata' ? 'active' : '' }}">
                <i class="nav-icon far fa-edit"></i>
                <p>
                    Data Eviden Poin
                </p>
            </a>
        </li>

        @if(auth()->user() && auth()->user()->role->nama_role == "Admin" || (auth()->user()->role->nama_role == "Pimpinan") || (auth()->user()->role->nama_role == "Mahasiswa") )
        <li
            class="nav-item {{ $key == 'harian' || $key == 'bulanan' || $key == 'total' ? 'menu-is-opening menu-open' : '' }}">
            <a href="{{ url('#') }}"
                class="nav-link {{ $key == 'harian' || $key == 'bulanan' || $key == 'total' ? 'active' : '' }}">
                <i class="nav-icon fas fa-table"></i>
                <p>
                    Rekap Data
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/harian" class="nav-link {{ $key == 'harian' ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Harian</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/bulanan" class="nav-link {{ $key == 'bulanan' ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Bulanan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/total" class="nav-link {{ $key == 'total' ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Total</p>
                    </a>
                </li>
            </ul>
        </li>
        @endif

        @if(auth()->user() && auth()->user()->role->nama_role == "Admin" || (auth()->user()->role->nama_role == "Mahasiswa") )
        <li class="nav-item">
            <a href="/confirm" class="nav-link {{ $key == 'konfirmasi' ? 'active' : '' }}">
                <i class="nav-icon fas fa-check-circle"></i>
                <p>
                    Konfirmasi Data
                </p>
            </a>
        </li>
        @endif

        @if(auth()->user() && auth()->user()->role->nama_role == "Admin" || (auth()->user()->role->nama_role == "Mahasiswa") )
        <li
            class="nav-item {{ $key == 'jabatan' || $key == 'bidang' || $key == 'wilayah' || $key == 'lokasi' || $key == 'shift' ? 'menu-is-opening menu-open' : '' }}">
            <a href="{{ url('#') }}"
                class="nav-link {{ $key == 'jabatan' || $key == 'bidang' || $key == 'wilayah' || $key == 'lokasi' || $key == 'shift' ? 'active' : '' }}">
                <i class="nav-icon fas fa-database"></i>
                <p>
                    Data Master
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/karyawan" class="nav-link {{ $key == 'karyawan' ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Database Karyawan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/jabatan" class="nav-link {{ $key == 'jabatan' ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Jabatan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/bidang" class="nav-link {{ $key == 'bidang' ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Bidang</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/wilayah" class="nav-link {{ $key == 'wilayah' ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Wilayah</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/lokasi" class="nav-link {{ $key == 'lokasi' ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Lokasi</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/shift" class="nav-link {{ $key == 'shift' ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Shift</p>
                    </a>
                </li>
            </ul>
        </li>
        @endif

        @if(auth()->user() && auth()->user()->role->nama_role == "Admin" || (auth()->user()->role->nama_role == "Mahasiswa") )
        <li class="nav-item {{ $key == 'berita' || $key == 'pengumuman' ? 'menu-is-opening menu-open' : '' }}">
            <a href="{{ url('#') }}"
                class="nav-link {{ $key == 'berita' || $key == 'pengumuman' ? 'active' : '' }}">
                <i class="nav-icon fas fa-newspaper"></i>
                <p>
                    Manajemen Publikasi
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/berita" class="nav-link {{ $key == 'berita' ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Berita</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/pengumuman" class="nav-link {{ $key == 'pengumuman' ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Pengumuman</p>
                    </a>
                </li>
            </ul>
        </li>
        @endif

        @if(auth()->user() && auth()->user()->role->nama_role == "Admin" || (auth()->user()->role->nama_role == "Mahasiswa") )
        <li class="nav-item">
            <a href="/users" class="nav-link {{ $key == 'users' ? 'active' : '' }}">
                <i class="nav-icon fas fa-users"></i>
                <p>
                    User
                </p>
            </a>
        </li>
        @endif

    </ul>
    
</nav>