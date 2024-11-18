@extends('layouts.main', ['title' => 'Daftar SKHP'])

@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Daftar SKHP (Surat Keterangan Hasil Pemeriksaan)</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item active">Daftar SKHP</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Template SKHP</h5>
                            </div>

                            <!-- Form for editing existing data -->
                            <form action="{{ route('skhp.tamplate.update', 1) }}" method="POST">
                                @csrf
                                @method('PUT') <!-- Specify that this is an update form -->

                                <div class="mb-3">
                                    <label for="di_keluar_di" class="form-label">Di Keluarkan Di</label>
                                    <input type="text" class="form-control" id="di_keluar_di" name="di_keluar_di"
                                        value="{{ old('di_keluar_di', $tamplateSkhp->di_keluar_di) }}" required>
                                </div>

                                <!-- Tabs -->
                                <ul class="nav nav-tabs mb-4" id="skhpTabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="kabid-tab" data-bs-toggle="tab" href="#kabid"
                                            role="tab" aria-controls="kabid" aria-selected="true">Kabid Propam</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="kasubid-tab" data-bs-toggle="tab" href="#kasubid"
                                            role="tab" aria-controls="kasubid" aria-selected="false">Kasubid Propam</a>
                                    </li>
                                </ul>

                                <div class="tab-content" id="skhpTabsContent">
                                    <!-- Kabid Tab -->
                                    <div class="tab-pane fade show active" id="kabid" role="tabpanel"
                                        aria-labelledby="kabid-tab">
                                        <div class="mb-3">
                                            <label for="kabid_nama" class="form-label">Nama Kabid Propam</label>
                                            <input type="text" class="form-control" id="kabid_nama" name="kabid_nama"
                                                value="{{ old('kabid_nama', $tamplateSkhp->kabid_nama) }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="kabid_pangkat" class="form-label">Pangkat Kabid Propam</label>
                                            <input type="text" class="form-control" id="kabid_pangkat"
                                                name="kabid_pangkat"
                                                value="{{ old('kabid_pangkat', $tamplateSkhp->kabid_pangkat) }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="kabid_nrp" class="form-label">NRP Kabid Propam</label>
                                            <input type="text" class="form-control" id="kabid_nrp" name="kabid_nrp"
                                                value="{{ old('kabid_nrp', $tamplateSkhp->kabid_nrp) }}" required>
                                        </div>
                                    </div>

                                    <!-- Kasubid Tab -->
                                    <div class="tab-pane fade" id="kasubid" role="tabpanel" aria-labelledby="kasubid-tab">
                                        <div class="mb-3">
                                            <label for="kasubid_nama" class="form-label">Nama Kasubid Propam</label>
                                            <input type="text" class="form-control" id="kasubid_nama" name="kasubid_nama"
                                                value="{{ old('kasubid_nama', $tamplateSkhp->kasubid_nama) }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="kasubid_pangkat" class="form-label">Pangkat Kasubid Propam</label>
                                            <input type="text" class="form-control" id="kasubid_pangkat"
                                                name="kasubid_pangkat"
                                                value="{{ old('kasubid_pangkat', $tamplateSkhp->kasubid_pangkat) }}"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="kasubid_nrp" class="form-label">NRP Kasubid Propam</label>
                                            <input type="text" class="form-control" id="kasubid_nrp" name="kasubid_nrp"
                                                value="{{ old('kasubid_nrp', $tamplateSkhp->kasubid_nrp) }}" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-outline-primary mt-3">Update</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
