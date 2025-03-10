<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>{{ ($title ?? 'Dashboard') . ' - Litpers' }}</title>

    <meta name="robots" content="noindex, nofollow">
    
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
    @notifyCss
    <style>
        .notify {
            z-index: 999999;
        }

        /* CSS Laravel Notify */
        #toast-container {
            position: fixed;
            z-index: 9999;
            /* Bisa mempengaruhi tampilan elemen lain */
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


        .form-control,
        .form-check-input,
        .search-input {
            border: 1px solid rgba(116, 115, 115, 0.504) !important;
            /* Example of a bold border */
        }
    </style>

    <!-- PWA  -->
    <meta name="theme-color" content="#ffffff" />
    <link rel="apple-touch-icon" href="{{ asset('mstile-150x150.png') }}">
    <link rel="manifest" href="{{ asset('manifest.json') }}">

</head>

<body>
    @include('layouts.header')
    @include('layouts.sidebar')

    @yield('main')

    @include('layouts.footer')
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

    <x-notify::notify />
    @notifyJs

    @yield('js')
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form to delete the data
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }
    </script>

    {{-- pwa --}}
    <script src="{{ asset('/sw.js') }}"></script>
    <script>
        if ("serviceWorker" in navigator) {
            // Register a service worker hosted at the root of the
            // site using the default scope.
            navigator.serviceWorker.register("/sw.js").then(
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
