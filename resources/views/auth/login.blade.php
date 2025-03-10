<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="robots" content="noindex, nofollow">
    <title>LITPERS - LOGIN</title>

    <!-- Favicons -->
    <link href="{{ asset('logo.png') }}" rel="icon">
    <link href="{{ asset('logo.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <!-- PWA  -->
    <meta name="theme-color" content="#ffffff" />
    <link rel="apple-touch-icon" href="{{ asset('mstile-150x150.png') }}">
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    <style>
        .form-control,
        .input-group-text {
            border: 1px solid rgba(116, 115, 115, 0.378) !important;
            /* Example of a bold border */
        }

        .card {
            border: 1px solid #ddd;
            /* Menambahkan border abu-abu */
            border-radius: 0.25rem;
            /* Sudut sedikit melengkung seperti Bootstrap */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            /* Menambahkan shadow yang lembut */
            background-color: #fff;
            /* Menetapkan latar belakang putih */
            margin-bottom: 1.5rem;
            /* Memberikan jarak antar card */
            padding: 1rem;
            /* Memberikan padding di dalam card */
        }

        .card-header {
            font-weight: bold;
            background-color: #f8f9fa;
            /* Warna latar belakang header sedikit lebih terang */
            border-bottom: 1px solid #ddd;
            /* Membuat border bawah di header */
            padding: 0.75rem 1rem;
        }

        .card-body {
            padding: 1rem;
            /* Padding lebih besar untuk isi card */
        }

        .card-footer {
            padding: 0.75rem 1rem;
            background-color: #f8f9fa;
            border-top: 1px solid #ddd;
        }

        /* Gambar pada halaman login */
        /* .col-lg-6 img {
            max-width: 100%;
            height: 100vh;
            object-fit: cover;
        } */
        .logo-img {
            width: 150px;
            height: 150px;
            object-fit: contain;
            /* Gambar akan pas tanpa terpotong atau gepeng */
        }
    </style>
</head>

<body>

    <main>
        <div class="container">
            <section class="section register min-vh-100 d-flex align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">

                        <!-- Kolom untuk gambar -->
                        <div class="col-lg-6 d-none d-lg-flex align-items-center justify-content-center">
                            <img src="{{ asset('icon_login.png') }}" class="img-fluid" alt="Login Image">
                        </div>

                        <!-- Kolom untuk form login -->
                        <div class="col-lg-6 col-md-8 d-flex flex-column align-items-center justify-content-center">
                            <div class="d-flex justify-content-center py-4">
                                <a href="/" class=" d-flex align-items-center w-auto">
                                    <img src="{{ asset('assets/img/LP.png') }}" alt="" class="pt-3 logo-img">
                                    <img src="{{ asset('logo.png') }}" alt="" class="logo-img">
                                </a>
                            </div>

                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">CATPERS PAMINAL BIDPROPAM</h5>
                                        {{-- <p class="text-center small">Enter your email & password to login</p> --}}
                                    </div>

                                    <form class="row g-3 needs-validation" method="POST"
                                        action="{{ route('login') }}">
                                        @csrf
                                        <div class="col-12">
                                            <label for="yourEmail" class="form-label">Email</label>
                                            <div class="input-group has-validation">
                                                <input type="email" name="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    id="yourEmail" required autocomplete="off"
                                                    value="{{ old('email') }}">
                                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                <div class="invalid-feedback">
                                                    @error('email')
                                                        {{ $message }}
                                                    @else
                                                        Please enter your email.
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <div class="input-group has-validation">
                                                <input type="password" name="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    id="yourPassword" required autocomplete="off">
                                                <span class="input-group-text" id="inputGroupPrepend"><i
                                                        class="bi bi-lock"></i></span>
                                                <div class="invalid-feedback">
                                                    @error('password')
                                                        {{ $message }}
                                                    @else
                                                        Please enter your password!
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                    value="true" id="rememberMe">
                                                <label class="form-check-label" for="rememberMe">Remember me</label>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Login</button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0"><a href="{{ route('password.request') }}">Lupa
                                                    Password?</a></p>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="credits">
                                &copy; Copyright <strong><span>Propam Malut</span></strong> {{ date('Y') }}. All
                                Rights Reserved
                            </div>
                        </div>

                    </div>
                </div>
            </section>
        </div>
    </main>


    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/quill/quill.js') }}"></script>
    <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    {{-- pwa --}}
    <script src="{{ asset('sw.js') }}"></script>
    <script>
        if ("serviceWorker" in navigator) {
            // Register a service worker hosted at the root of the
            // site using the default scope.
            navigator.serviceWorker.register("sw.js").then(
                (registration) => {
                    console.log("Service worker registration succeeded:", registration);
                },
                (error) => {
                    console.error(`Service worker registration failed: ${error}`);
                },
            );
        } else {
            console.error("Service workers are not supported.");
        }
    </script>
</body>

</html>
