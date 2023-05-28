<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-bolder">Literasi</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>
    <p class="text-muted ms-2">Welcome back, {{ Auth::guard('guru')->user()->nama }}</p>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Master Data</span>
        </li>


        <!-- Siswa -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons fa-solid fa-children"></i>
                <div data-i18n="Layouts">Data Siswa</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="/admin-siswa/create" class="menu-link">
                        <div data-i18n="Without menu">Tambah Data</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/admin-siswa" class="menu-link">
                        <div data-i18n="Without navbar">List Data Siswa</div>
                    </a>
                </li>
            </ul>
        </li>


        {{-- Kelas --}}
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icon fa-solid fa-door-closed"></i>
                <div data-i18n="Layouts">Data Kelas</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="/admin-kelas/create" class="menu-link">
                        <div data-i18n="Without menu">Tambah Data</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/admin-kelas" class="menu-link">
                        <div data-i18n="Without navbar">List Data Kelas</div>
                    </a>
                </li>
            </ul>
        </li>

        {{-- Guru --}}
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icon fa-solid fa-person-chalkboard"></i>
                <div data-i18n="Layouts">Guru</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="/admin-guru/create" class="menu-link">
                        <div data-i18n="Without menu">Tambah Data</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/admin-guru" class="menu-link">
                        <div data-i18n="Without navbar">List Data Guru</div>
                    </a>
                </li>
            </ul>
        </li>

        {{-- Tim Literasi --}}
        <li class="menu-item">
            <a href="/tim-literasi" class="menu-link">
                <i class="menu-icon tf-icon fa-solid fa-person-chalkboard"></i>
                <div data-i18n="Boxicons">Tim Literasi</div>
            </a>
        </li>

        {{-- Perpustakaan --}}
        <li class="menu-item">
            <a href="/admin-perpustakaan" class="menu-link">
                <i class="menu-icon tf-icon fa-solid fa-person-chalkboard"></i>
                <div data-i18n="Boxicons">perpustakaan</div>
            </a>
        </li>

        {{-- Wali Kelas --}}
        <li class="menu-item">
            <a href="/admin-walas" class="menu-link">
                <i class="menu-icon tf-icon fa-solid fa-person-chalkboard"></i>
                <div data-i18n="Boxicons">Wali Kelas</div>
            </a>
        </li>

        {{-- Warga Kelas --}}
        <li class="menu-item">
            <a href="/admin-warga" class="menu-link">
                <i class="menu-icon tf-icons fa-solid fa-children"></i>
                <div data-i18n="Boxicons">Warga Kelas</div>
            </a>
        </li>

        {{-- Kerohanian --}}
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icon fa-solid fa-book-quran"></i>
                <div data-i18n="Layouts">Data Kerohanian</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="/data_kerohanian/create" class="menu-link">
                        <div data-i18n="Without menu">Tambah Data</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/data_kerohanian" class="menu-link">
                        <div data-i18n="Without navbar">List Data Kerohanian</div>
                    </a>
                </li>
            </ul>
        </li>

        {{-- Tempat --}}
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icon fa-solid fa-building"></i>
                <div data-i18n="Layouts">Data Tempat</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="/tempat/create" class="menu-link">
                        <div data-i18n="Without menu">Tambah Data</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/tempat" class="menu-link">
                        <div data-i18n="Without navbar">List Data Tempat</div>
                    </a>
                </li>
            </ul>
        </li>
        {{-- Karya --}}
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icon fa-solid fa-democrat"></i>
                <div data-i18n="Layouts">Data Karya</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="/karya/create" class="menu-link">
                        <div data-i18n="Without menu">Tambah Data</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/karya" class="menu-link">
                        <div data-i18n="Without navbar">List Data Karya</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item">
            <a href="/admin-gantipass" class="menu-link">
                <i class="menu-icon tf-icon fa-solid fa-key"></i>
                <div data-i18n="Boxicons">Ganti Password</div>
            </a>
        </li>


        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Lain Lain</span>
        </li>

        <li class="menu-item">
            <a href="/logout" class="menu-link">
                <i class="menu-icon tf-icon fa-solid fa-arrow-right-from-bracket"></i>
                <div data-i18n="Boxicons">Keluar</div>
            </a>
        </li>
    </ul>
</aside>
<!-- / Menu -->
