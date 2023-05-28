<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="demo menu-text fw-bolder fs-4">Dashboard Walas</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>
    <p class="text-muted ms-2">Welcome back, {{ Auth::guard('guru')->user()->nama }}</p>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Laporan Kegiatan Literasi</span>
        </li>


        <!-- Esktensif -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons fa-solid fa-children"></i>
                <div data-i18n="Layouts">Ekstensif</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="/walas-ekstensif" class="menu-link">
                        <div data-i18n="Without menu">Laporan</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/ketercapaian-ekstensif" class="menu-link">
                        <div data-i18n="Without navbar">Laporan Ketercapaian</div>
                    </a>
                </li>
            </ul>
        </li>


        {{-- Kerohanian --}}
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icon fa-solid fa-door-closed"></i>
                <div data-i18n="Layouts">Kerohanian</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="/walas-kerohanian" class="menu-link">
                        <div data-i18n="Without menu">Laporan</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/ketercapaian-kerohanian" class="menu-link">
                        <div data-i18n="Without navbar">Laporan Ketercapaian</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icon fa-solid fa-door-closed"></i>
                <div data-i18n="Layouts">Kunjungan</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="/walas-kunjungan" class="menu-link">
                        <div data-i18n="Without menu">Laporan</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/ketercapaian-kunjungan" class="menu-link">
                        <div data-i18n="Without navbar">Laporan Ketercapaian</div>
                    </a>
                </li>
            </ul>
        </li>
        {{-- Kunjungan
        <li class="menu-item">
            <a href="/walas-kunjungan" class="menu-link">
                <i class="menu-icon tf-icon fa-solid fa-book"></i>
                <div data-i18n="Boxicons">Laporan Kunjungan</div>
            </a>
        </li> --}}

        {{-- Karya --}}
        <li class="menu-item">
            <a href="/walas-karya" class="menu-link">
                <i class="menu-icon tf-icon fa-solid fa-book"></i>
                <div data-i18n="Boxicons">Laporan Unggah Karya</div>
            </a>
        </li>

        {{-- UKBI --}}

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icon fa-solid fa-book"></i>
                <div data-i18n="Layouts">UKBI</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="/walas-ukbi" class="menu-link">
                        <div data-i18n="Without menu">Laporan</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/ketercapaian-ukbi" class="menu-link">
                        <div data-i18n="Without navbar">Laporan Ketercapaian</div>
                    </a>
                </li>
            </ul>
        </li>
        {{-- Kegiatan --}}
        <li class="menu-item">
            <a href="/walas-kegiatan" class="menu-link">
                <i class="menu-icon tf-icon fa-solid fa-book"></i>
                <div data-i18n="Boxicons">Laporan Kegiatan Perpustakaan</div>
            </a>
        </li>



        {{-- Kunjungan
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icon fa-solid fa-person-chalkboard"></i>
                <div data-i18n="Layouts">Kunjungan</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="/admin-guru/create" class="menu-link">
                        <div data-i18n="Without menu">Laporan</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/admin-guru" class="menu-link">
                        <div data-i18n="Without navbar">Grafik</div>
                    </a>
                </li>
            </ul>
        </li> --}}




        <li class="menu-item">
            <a href="/walas-review" class="menu-link">
                <i class="menu-icon tf-icon fa-solid fa-magnifying-glass"></i>
                <div data-i18n="Boxicons">Review Tim Literasi</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="/walas-gantipass" class="menu-link">
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
