<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class=" demo menu-text fw-bolder fs-5 text-center">Dashboard Siswa</span>
        </a>


        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>
    <p class="ms-4">Selamat Datang, {{ auth()->guard('siswa')->user()->nama }}</p>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Forms & Tables -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Menu Pembiasaan</span>
        </li>
        <!-- Forms -->


        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Form Elements">Pembiasaan Ekstensif</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="/ekstensif/create" class="menu-link">
                        <div data-i18n="Basic Inputs">Input</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/ekstensif" class="menu-link">
                        <div data-i18n="Input groups">
                            Laporan
                        </div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/tugas-ekstensif" class="menu-link">
                        <div data-i18n="Input groups">
                            Tugas
                        </div>
                    </a>
                </li>
            </ul>
        </li>



        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Form Elements">Pembiasaan Kerohanian</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="/kerohanian/create" class="menu-link">
                        <div data-i18n="Input groups">Input</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/kerohanian" class="menu-link">
                        <div data-i18n="Input groups">
                            Laporan
                        </div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/tugas-kerohanian" class="menu-link">
                        <div data-i18n="Input groups">
                            Tugas
                        </div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Menu Pengembangan</span>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Form Elements">Kunjungan</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="/kunjungan/create" class="menu-link">
                        <div data-i18n="Input groups">Input</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/kunjungan" class="menu-link">
                        <div data-i18n="Input groups">
                            Laporan
                        </div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/tugas-kunjungan" class="menu-link">
                        <div data-i18n="Input groups">
                            Tugas
                        </div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Form Elements">Unggah Karya</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="/unggah_karya/create" class="menu-link">
                        <div data-i18n="Input groups">Input</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/unggah_karya" class="menu-link">
                        <div data-i18n="Input groups">
                            Laporan
                        </div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/tugas-karya" class="menu-link">
                        <div data-i18n="Input groups">
                            Tugas
                        </div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Form Elements">UKBI</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="/ukbi/create" class="menu-link">
                        <div data-i18n="Input groups">Input</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/ukbi" class="menu-link">
                        <div data-i18n="Input groups">
                            Laporan
                        </div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/tugas-ukbi" class="menu-link">
                        <div data-i18n="Input groups">
                            Tugas
                        </div>
                    </a>
                </li>
            </ul>
        </li>

        {{-- Kegiatan --}}
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Layouts">Kegiatan Perpustakaan</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="/siswa-kegiatan/add" class="menu-link">
                        <div data-i18n="Without menu">Tambah Data</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/siswa-kegiatan/list" class="menu-link">
                        <div data-i18n="Without navbar">Laporan</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item">
            <a href="/siswa-gantipass" class="menu-link">
                <i class="menu-icon tf-icon bx bxs-key"></i>
                <div data-i18n="Boxicons">Ganti Password</div>
            </a>
        </li>
        {{-- <!-- Tables -->
        <li class="menu-item active open">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Form Layouts">Perpustakaan</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item active">
                    <a href="index.html" class="menu-link">
                        <div data-i18n="Vertical Form">Daftar Buku</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="input-data.html" class="menu-link">
                        <div data-i18n="Vertical Form">Input Buku</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="laporan-buku.html" class="menu-link">
                        <div data-i18n="Vertical Form">Laporan Buku</div>
                    </a>
                </li>
            </ul>
        </li> --}}
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
