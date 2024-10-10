@extends('layouts.main')
@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Daftar Kasus</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item active">Daftar Kasus</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body table-responsive">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">List Anggota Yang Melakukan Pelanggaran</h5>
                                <div>
                                    <a href="{{ route('daftarKasus.create') }}" class="btn btn-success">
                                        <i class="bi bi-file-earmark-excel"></i>
                                    </a>
                                    <a href="{{ route('daftarKasus.create') }}" class="btn btn-primary">
                                        <i class="bi bi-plus-lg"></i>
                                    </a>
                                </div>
                            </div>


                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>
                                            Nama
                                        </th>
                                        <th>NRP</th>
                                        <th>Kategori</th>
                                        <th data-type="date" data-format="YYYY/DD/MM">Tanggal Lapor</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($daftarKasus as $kasus)
                                        <tr>
                                            <td>{{ $kasus->nama }}</td>
                                            <td>{{ $kasus->nrp }}</td>
                                            <td>{{ $kasus->kategori->nama_kategori }}</td>
                                            <td>{{ $kasus->tanggal_lapor }}</td>
                                            <td>{{ $kasus->status->nama_status }}</td>
                                            <td>
                                                <a href="" class="btn btn-warning"><i class="bi bi-pencil"></i></a>
                                                <a href="" class="btn btn-danger"><i class="bi bi-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
