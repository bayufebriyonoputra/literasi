<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class=" demo menu-text fw-bolder fs-5 text-center">Literasi dan Inovasi</span>
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


        {{-- Tim Literasi --}}
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icon fa-solid fa-bars-progress"></i>
                <div data-i18n="Layouts">Tugas Literasi</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="/tugas-literasi/create" class="menu-link">
                        <div data-i18n="Without menu">Tambah Data</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/tugas-literasi" class="menu-link">
                        <div data-i18n="Without navbar">Laporan Tugas Literasi</div>
                    </a>
                </li>
            </ul>
        </li>




        {{-- Ekstensif --}}

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icon fa-solid fa-book"></i>
                <div data-i18n="Layouts">Laporan Ekstensif</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="/inovasi-ekstensif" class="menu-link">
                        <div data-i18n="Without menu">Laporan</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/inovasi-ketercapaian-ekstensif" class="menu-link">
                        <div data-i18n="Without navbar">Laporan Ketercapaian</div>
                    </a>
                </li>
            </ul>
        </li>

        {{-- Kerohanian --}}
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icon fa-solid fa-book"></i>
                <div data-i18n="Layouts">Laporan Kerohanian</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="/inovasi-kerohanian" class="menu-link">
                        <div data-i18n="Without menu">Laporan</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/inovasi-ketercapaian-kerohanian" class="menu-link">
                        <div data-i18n="Without navbar">Laporan Ketercapaian</div>
                    </a>
                </li>
            </ul>
        </li>
        {{-- Kunjungan --}}
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icon fa-solid fa-book"></i>
                <div data-i18n="Layouts">Laporan Kunjungan</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="/inovasi-kunjungan" class="menu-link">
                        <div data-i18n="Without menu">Laporan</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/inovasi-ketercapaian-kunjungan" class="menu-link">
                        <div data-i18n="Without navbar">Laporan Ketercapaian</div>
                    </a>
                </li>
            </ul>
        </li>
        {{-- Karya --}}
        <li class="menu-item">
            <a href="/inovasi-karya" class="menu-link">
                <i class="menu-icon tf-icon fa-solid fa-book"></i>
                <div data-i18n="Boxicons">Laporan Unggah Karya</div>
            </a>
        </li>
        {{-- ukbi --}}

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icon fa-solid fa-book"></i>
                <div data-i18n="Layouts">UKBI</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="/inovasi-ukbi" class="menu-link">
                        <div data-i18n="Without menu">Laporan</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/inovasi-ketercapaian-ukbi" class="menu-link">
                        <div data-i18n="Without navbar">Laporan Ketercapaian</div>
                    </a>
                </li>
            </ul>
        </li>
        {{-- Kegiatan --}}
        <li class="menu-item">
            <a href="/inovasi-kegiatan" class="menu-link">
                <i class="menu-icon tf-icon fa-solid fa-book"></i>
                <div data-i18n="Boxicons">Laporan Kegiatan Perpustakaan</div>
            </a>
        </li>


        {{-- Pengaduan --}}
        <li class="menu-item">
            <a href="/inovasi-pengaduan" class="menu-link">
                <i class="menu-icon tf-icon fa-solid fa-book"></i>
                <div data-i18n="Boxicons">Pengaduan</div>
            </a>
        </li>


        {{-- Review --}}
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icon fa-solid fa-magnifying-glass"></i>
                <div data-i18n="Layouts">Review</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="/review-literasi/create" class="menu-link">
                        <div data-i18n="Without menu">Input</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/review-literasi" class="menu-link">
                        <div data-i18n="Without navbar">Laporan</div>
                    </a>
                </li>
            </ul>
        </li>



        <li class="menu-item">
            <a href="/literasi-gantipass" class="menu-link">
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
