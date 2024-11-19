@extends('layouts.main')
@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Daftar Kasus</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('daftarKasus') }}">Daftar Kasus</a></li>
                    <li class="breadcrumb-item active">Tambah Kasus</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                
            </div>
        </section>

    </main><!-- End #main -->
@endsection
