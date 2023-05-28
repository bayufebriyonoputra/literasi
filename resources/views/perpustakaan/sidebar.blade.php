<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="demo menu-text fw-bolder fs-4 text-center">Dashboard Perpustakaan</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>
    <p class="text-muted ms-2">Selamat Datang Kembali, {{ Auth::guard('guru')->user()->nama }}</p>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Menu Utama</span>
        </li>




        {{-- Perpustakaan --}}
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icon fa-solid fa-book"></i>
                <div data-i18n="Layouts"> Kegiatan Perpustakaan</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="/tim-perpustakaan/add" class="menu-link">
                        <div data-i18n="Without menu">Tambah Data</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/tim-perpustakaan/list" class="menu-link">
                        <div data-i18n="Without navbar">Daftar Kegiatan</div>
                    </a>
                </li>
            </ul>
        </li>

        {{-- Perpustakaan --}}
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icon fa-solid fa-book"></i>
                <div data-i18n="Layouts">Resensi Buku</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="/perpustakaan/create" class="menu-link">
                        <div data-i18n="Without menu">Tambah Data</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/perpustakaan" class="menu-link">
                        <div data-i18n="Without navbar">Daftar Resensi Buku</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item">
            <a href="/perpus-gantipass" class="menu-link">
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
