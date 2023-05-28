<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Pengaduan</title>

    <!-- Font Icon -->
    <link rel="stylesheet"
        href="{{ asset('pengaduan_assets/fonts/material-icon/css/material-design-iconic-font.min.css') }}">

    <!-- Main css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('Login/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('pengaduan_assets/css/style.css') }}">
</head>

<body>

    <div class="main">

        <section class="signup">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="container">
                <div class="signup-content">
                    <form method="POST" id="signup-form" class="signup-form" action="{{ url('/pengaduan') }}">
                        @csrf
                        <h2 class="form-title">Form Pengaduan</h2>
                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @elseif (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="form-group">
                            <input type="email" class="form-input" name="email" id="email"
                                placeholder="Alamat Email" />
                        </div>
                        <div class="form-group">
                            <textarea name="pengaduan" rows="3" class="form-input" placeholder="Tuliskan Pengaduan Anda...."></textarea>
                        </div>

                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Kirim" />
                        </div>
                    </form>
                    <p class="loginhere">
                        Batal Membuat Pengaduan ? <a href="{{ url('/') }}" class="loginhere-link">Kembali</a>
                    </p>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="{{ asset('pengaduan_assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('pengaduan_assets/js/main.js') }}"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
