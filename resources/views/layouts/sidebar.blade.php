<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="true">
        <!-- DASHBOARD -->
        <li class="nav-item">
            <a href="/home" class="nav-link @if ($key == 'dashboard' && !request()->is('register')) active @endif">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>

        <!-- DATA EVIDEN POIN -->
        @if (auth()->user()->role->nama_role == 'Karyawan')
            <li class="nav-item">
                <a href="/data" class="nav-link {{ $key == 'data' ? 'active' : '' }}">
                    <i class="nav-icon far fa-edit"></i>
                    <p>
                        Data Eviden Poin
                    </p>
                </a>
            </li>
        @endif

        <!-- REKAP DATA ADMIN -->
        @if ((auth()->user() && auth()->user()->role->nama_role == 'Admin') || auth()->user()->role->nama_role == 'Mahasiswa')
            <li
                class="nav-item {{ $key == 'harian' || $key == 'mingguan' || $key == 'bkaryawan' || $key == 'bbidang' || $key == 'bbkph' || $key == 'bkrph' || $key == 'basper' || $key == 'tkaryawan' || $key == 'tbidang' || $key == 'tbkph' || $key == 'tkrph' || $key == 'tasper' ? 'menu-is-opening menu-open' : '' }}">
                <a href="{{ url('#') }}"
                    class="nav-link {{ $key == 'harian' || $key == 'mingguan' || $key == 'bkaryawan' || $key == 'bbidang' || $key == 'bbkph' || $key == 'bkrph' || $key == 'basper' || $key == 'tkaryawan' || $key == 'tbidang' || $key == 'tbkph' || $key == 'tkrph' || $key == 'tasper' ? 'active' : '' }}">
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
                        <a href="/mingguan" class="nav-link {{ $key == 'mingguan' ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Mingguan</p>
                        </a>
                    </li>
                    <li
                        class="nav-item {{ $key == 'bkaryawan' || $key == 'bbidang' || $key == 'bbkph' || $key == 'bkrph' || $key == 'basper' ? 'menu-is-opening menu-open' : '' }}">
                        <a href="#"
                            class="nav-link {{ $key == 'bkaryawan' || $key == 'bbidang' || $key == 'bbkph' || $key == 'tkrph' || $key == 'basper' ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Bulanan
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/bulanan/karyawan" class="nav-link {{ $key == 'bkaryawan' ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Karyawan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/bulanan/bidang" class="nav-link {{ $key == 'bbidang' ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Bidang</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/bulanan/bkph" class="nav-link {{ $key == 'bbkph' ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>BKPH</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/bulanan/krph" class="nav-link {{ $key == 'bkrph' ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>KRPH</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/bulanan/asper" class="nav-link {{ $key == 'basper' ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Asper/KBKPH</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li
                        class="nav-item {{ $key == 'tkaryawan' || $key == 'tbidang' || $key == 'tbkph' || $key == 'tkrph' || $key == 'tasper' ? 'menu-is-opening menu-open' : '' }}">
                        <a href="#"
                            class="nav-link {{ $key == 'tkaryawan' || $key == 'tbidang' || $key == 'tbkph' || $key == 'tkrph' || $key == 'tasper' ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Total
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/total/karyawan" class="nav-link {{ $key == 'tkaryawan' ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Karyawan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/total/bidang" class="nav-link {{ $key == 'tbidang' ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Bidang</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/total/bkph" class="nav-link {{ $key == 'tbkph' ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>BKPH</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/total/krph" class="nav-link {{ $key == 'tkrph' ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>KRPH</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/total/asper" class="nav-link {{ $key == 'tasper' ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Asper/KBKPH</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        @endif

        <!-- REKAP DATA PIMPINAN -->
        @if (auth()->user() && auth()->user()->role->nama_role == 'Pimpinan')
            <li
                class="nav-item {{ $key == 'harian' || $key == 'mingguan' || $key == 'bkaryawan' || $key == 'bbidang' || $key == 'bbkph' || $key == 'bkrph' || $key == 'basper' || $key == 'tkaryawan' || $key == 'tbidang' || $key == 'tbkph' || $key == 'tkrph' || $key == 'tasper' ? 'menu-is-opening menu-open' : '' }}">
                <a href="{{ url('#') }}"
                    class="nav-link {{ $key == 'harian' || $key == 'mingguan' || $key == 'bkaryawan' || $key == 'bbidang' || $key == 'bbkph' || $key == 'bkrph' || $key == 'basper' || $key == 'tkaryawan' || $key == 'tbidang' || $key == 'tbkph' || $key == 'tkrph' || $key == 'tasper' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-table"></i>
                    <p>
                        Rekap Data
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li
                        class="nav-item {{ $key == 'bkaryawan' || $key == 'bbidang' || $key == 'bbkph' || $key == 'bkrph' || $key == 'basper' ? 'menu-is-opening menu-open' : '' }}">
                        <a href="#"
                            class="nav-link {{ $key == 'bkaryawan' || $key == 'bbidang' || $key == 'bbkph' || $key == 'tkrph' || $key == 'basper' ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Bulanan
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/bulanan/karyawan" class="nav-link {{ $key == 'bkaryawan' ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Karyawan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/bulanan/bidang" class="nav-link {{ $key == 'bbidang' ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Bidang</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/bulanan/bkph" class="nav-link {{ $key == 'bbkph' ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>BKPH</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/bulanan/krph" class="nav-link {{ $key == 'bkrph' ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>KRPH</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/bulanan/asper" class="nav-link {{ $key == 'basper' ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Asper/KBKPH</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li
                        class="nav-item {{ $key == 'tkaryawan' || $key == 'tbidang' || $key == 'tbkph' || $key == 'tkrph' || $key == 'tasper' ? 'menu-is-opening menu-open' : '' }}">
                        <a href="#"
                            class="nav-link {{ $key == 'tkaryawan' || $key == 'tbidang' || $key == 'tbkph' || $key == 'tkrph' || $key == 'tasper' ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Total
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/total/karyawan" class="nav-link {{ $key == 'tkaryawan' ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Karyawan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/total/bidang" class="nav-link {{ $key == 'tbidang' ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Bidang</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/total/bkph" class="nav-link {{ $key == 'tbkph' ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>BKPH</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/total/krph" class="nav-link {{ $key == 'tkrph' ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>KRPH</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/total/asper" class="nav-link {{ $key == 'tasper' ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Asper/KBKPH</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        @endif

        <!-- KONFIRMASI DATA -->
        @if ((auth()->user() && auth()->user()->role->nama_role == 'Admin') || auth()->user()->role->nama_role == 'Mahasiswa')
            <li class="nav-item">
                <a href="/confirm" class="nav-link {{ $key == 'confirm' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-check-circle"></i>
                    <p>
                        Konfirmasi Data
                    </p>
                </a>
            </li>
        @endif

        <!-- DATA MASTER -->
        @if ((auth()->user() && auth()->user()->role->nama_role == 'Admin') || auth()->user()->role->nama_role == 'Mahasiswa')
            <li
                class="nav-item {{ $key == 'karyawan' || $key == 'jabatan' || $key == 'bidang' || $key == 'wilayah' || $key == 'lokasi' || $key == 'shift' ? 'menu-is-opening menu-open' : '' }}">
                <a href="{{ url('#') }}"
                    class="nav-link {{ $key == 'karyawan' || $key == 'jabatan' || $key == 'bidang' || $key == 'wilayah' || $key == 'lokasi' || $key == 'shift' ? 'active' : '' }}">
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
                            <p>Karyawan</p>
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
                        <a href="/shift" class="nav-link {{ $key == 'shift' ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Shift</p>
                        </a>
                    </li>
                </ul>
            </li>
        @endif

        <!-- MANAJEMEN PUBLIKASI -->
        @if ((auth()->user() && auth()->user()->role->nama_role == 'Admin') || auth()->user()->role->nama_role == 'Mahasiswa')
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

        <!-- USER -->
        @if ((auth()->user() && auth()->user()->role->nama_role == 'Admin') || auth()->user()->role->nama_role == 'Mahasiswa')
            <li class="nav-item">
                <a href="/users" class="nav-link @if (request()->is('users', 'register')) active @endif">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        User
                    </p>
                </a>
            </li>
        @endif

    </ul>

</nav>
