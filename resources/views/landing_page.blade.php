<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <title>Literasi Bangsa</title>

    <!-- mobile responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- ** Plugins Needed for the Project ** -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('landing/plugins/bootstrap/bootstrap.min.css') }}">
    <!-- themefy-icon -->
    <link rel="stylesheet" href="{{ asset('landing/plugins/themify-icons/themify-icons.css') }}">
    <!-- slick slider -->
    <link rel="stylesheet" href="{{ asset('landing/plugins/slick/slick.css') }}">
    <!-- venobox popup -->
    <link rel="stylesheet" href="{{ asset('landing/plugins/Venobox/venobox.css') }}">
    <!-- aos -->
    <link rel="stylesheet" href="{{ asset('landing/plugins/aos/aos.css') }}">

    <!-- Main Stylesheet -->
    <link href="{{ asset('landing/css/style.css') }}" rel="stylesheet">

    <!--Favicon-->

</head>

<body>


    <!-- navigation -->
    <section class="fixed-top navigation">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('img/logo smp 4.png') }}" style="width:85px;">
                    <!--<h4 class="text-light">Literasi</h4>-->
                </a>
                <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbar"
                    aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- navbar -->
                <div class="collapse navbar-collapse text-center" id="navbar">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://ukbi.kemdikbud.go.id">UKBI</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://perpustakaan.kemdikbud.go.id/">Perpustakaan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/pengaduan') }}">Pengaduan</a>
                        </li>

                    </ul>
                    @if (auth()->guard('siswa')->guest() &&
                            auth()->guard('guru')->guest())
                        <a href="/login-siswa" class="btn btn-primary ml-lg-3 primary-shadow">Log In </a>
                    @elseif (auth()->guard('siswa')->check() ||
                            auth()->guard('guru')->check())
                        <a href="/logout" class="btn btn-danger ml-lg-3 primary-shadow">Log Out </a>
                    @endif
                </div>
            </nav>
        </div>
    </section>
    <!-- /navigation -->



    <!-- hero area -->
    <section class="hero-section hero" data-background=""
        style="background-image: url(landing/images/hero-area/wayang.png);">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center zindex-1">

                    <h3 class="mb-3 text-light">Giat Literasi</h3>
                    <h3 class="mb-3 text-light">SMP Negeri 4 Mojokerto</h3>
                    <p class="mb-4 text-light">Kendalikan dan Pantau Tingkat Literasi Peserta Didik di Sekolah</p>
                    <a href="/login-guru" class="btn btn-secondary btn-lg">Mulai</a>
                    <!-- banner image -->

                </div>
            </div>
        </div>
        <!-- background shapes -->
        <div id="scene">
            <img class="img-fluid hero-bg-1 up-down-animation"
                src="{{ asset('landing/images/background-shape/feature-bg-2.png') }}" alt="">
            <img class="img-fluid hero-bg-2 left-right-animation"
                src="{{ asset('landing/images/background-shape/seo-ball-1.png') }}" alt="">
            <img class="img-fluid hero-bg-3 left-right-animation"
                src="{{ asset('landing/images/background-shape/seo-half-cycle.png') }}" alt="">
            <img class="img-fluid hero-bg-4 up-down-animation"
                src="{{ asset('landing/images/background-shape/green-dot.png') }}" alt="">
            <img class="img-fluid hero-bg-5 left-right-animation"
                src="{{ asset('landing/images/background-shape/blue-half-cycle.png') }}" alt="">
            <img class="img-fluid hero-bg-6 up-down-animation"
                src="{{ asset('landing/images/background-shape/seo-ball-1.png') }}" alt="">
            <img class="img-fluid hero-bg-7 left-right-animation"
                src="{{ asset('landing/images/background-shape/yellow-triangle.png') }}" alt="">
            <img class="img-fluid hero-bg-8 up-down-animation"
                src="{{ asset('landing/images/background-shape/service-half-cycle.png') }}" alt="">
            <img class="img-fluid hero-bg-9 up-down-animation"
                src="{{ asset('landing/images/background-shape/team-bg-triangle.png') }}" alt="">
        </div>
    </section>
    <!-- /hero-area -->

    <!-- feature -->

    @if ($buku->count())
        <h2 class="text-center mt-5">Daftar Buku</h2>
        <div class="row">

            @foreach ($buku as $b)
                <div class=" col-6 col-sm-6 col-md-3 my-3">

                    <div class="card h-100">
                        <img src="{{ asset('uploads/' . $b->cover_buku) }}" class="card-img-top" alt="..."
                            style="max-width: 100%; height:400px;">
                        <div class="card-body d-flex flex-column">
                            <p class="card-text fs-2 text-muted">ISBN : {{ $b->isbn }}</p>
                            <p class="card-text fs-2 text-muted">Judul Buku : {{ $b->judul }}</p>
                            <p class="card-text fs-2 text-muted">Pengarang : {{ $b->pengarang }}</p>
                            <p class="card-text fs-2 text-muted">Penerbit : {{ $b->penerbit }}</p>
                            <p class="card-text fs-2 text-muted">Tahun Terbit : {{ $b->tahun_terbit }}</p>
                            <p class="card-text fs-2 text-muted">Sinopsis : {{ $b->sinopsis }}</p>

                        </div>
                        <div class="card-footer">
                            <div class="text-center">
                                <a href="{{ url('/uploads/' . $b->file_buku) }}"
                                    class="align-self-end bg-info py-2 px-2 text-light">Lihat Buku</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center container col-12">
            {{ $buku->onEachSide(1)->links() }}
        </div>
    @endif


    @if ($kegiatan->count())
        <h2 class="text-center mt-5">Daftar Kegiatan</h2>
        <div class="row d-flex justify-content-center">

            @foreach ($kegiatan as $k)
                <div class=" col-6 col-sm-6 col-md-3 my-3">
                    <div class="card h-100">
                        <img src="{{ asset('uploads/' . $k->foto) }}" class="card-img-top img-fluid" alt="...">
                        <div class="card-body">
                            <p class="card-text fs-2 text-muted">
                                {{ Carbon\Carbon::parse($k->tanggal)->locale('id_ID')->isoFormat('DD MMMM YYYY') }}</p>
                            <p class="card-text fs-2 text-center"><b>{{ $k->nama_kegiatan }}</b></p>
                            <p class="card-text fs-2 text-muted">{{ $k->deskripsi }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center container">
            {{ $kegiatan->links() }}
        </div>
    @endif




    <!-- /feature -->



    <!-- jQuery -->
    <script src="{{ asset('landing/plugins/jQuery/jquery.min.js') }}"></script>

    <!-- Bootstrap JS -->
    <script src="{{ asset('landing/plugins/bootstrap/bootstrap.min.js') }}"></script>
    <!-- slick slider -->
    <script src="{{ asset('landing/plugins/slick/slick.min.js') }}"></script>
    <!-- venobox -->
    <script src="{{ asset('landing/plugins/Venobox/venobox.min.js') }}"></script>
    <!-- aos -->
    <script src="{{ asset('landing/plugins/aos/aos.js') }}"></script>
    <!-- Main Script -->
    <script src="{{ asset('landing/js/script.js') }}"></script>

</body>

</html>
