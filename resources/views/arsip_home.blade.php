<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>E-Arsip SDN Cintanagara</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        
        <style>
            /* #69B7FF warna biru muda
            #0d6efd warna biru tua */
            body {
                background: linear-gradient(72.56deg, #0d6efd 33.88%, #FFFFFF 99.83%);
            }

            .container {
                width: 100%;
                height: 100vh;
            }

            .text-1 {
                margin-top: 40%;
            }

            .login {
                box-shadow: 4px 6px 12px rgba(0, 0, 0, 0.25);
                width: 200px;
                transition: all .5s ease-out;
            }

            .login:hover {
                width: 250px;
                translate: all .5s ease-in;
            }

            .home {
                box-shadow: 4px 6px 12px rgba(0, 0, 0, 0.25);
                width: 200px;
                transition: all .5s ease-out;
            }

            .home:hover {
                width: 250px;
                translate: all .5s ease-in;
            }

            .img-home {
                margin-top: 20%;
                transition: all .5s ease-in;
            }

            .img-home:hover {
                scale: .96;
                transition: all .5s ease-out;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <nav class="navbar">
                <div class="container-fluid">
                    <span class="navbar-brand mb-0 h1 text-white">E-Arsip</span>
                </div>
            </nav>

            <div class="row">
                <div class="col-6">
                    <div class="text-1 text-white">
                        <h1 class="fw-bold">Aplikasi Elektronik Arsip</h1>
                        <p>Aplikasi ini dibuat untuk mempermudah dalam pengelolaan pengarsipan dan mempersingkat waktu pengerjaan</p>
                    </div>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/home') }}"><button type="button" class="home btn btn-success">Home</button></a>
                        @else
                            {{-- <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a> --}}
                            <a href="{{ route('login') }}"><button type="button" class="login btn btn-success">Sign In</button></a>
                        @endauth
                @endif
                </div>
                <div class="col-6">
                    <div class="img-home">
                        <img src="{{ URL('image/ilustrasi-arsip.png') }}" alt="" class="gambar mx-auto d-block w-100">
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    </body>
</html>