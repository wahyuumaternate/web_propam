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
                <form action="{{ route('daftarKasus.store') }}" method="POST">
                    @csrf
                    <div class="col-lg-12">

                        <div class="card">
                            <div class="card-body p-5">
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Kategori <span
                                            class="text-danger"></span></label>
                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="Default select example" name="kategori_id">
                                            <option selected="">Pilih Kategori</option>
                                            @foreach ($kategori as $k)
                                                <option value="{{ $k->id }}"
                                                    {{ old('kategori_id') == $k->id ? 'selected' : '' }}>
                                                    {{ $k->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="tanggal_lapor" class="col-sm-2 col-form-label">Tanggal Lapor <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="date" name="tanggal_lapor" class="form-control"
                                            value="{{ old('tanggal_lapor') }}">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body p-5">
                                <h5 class="card-title">Profil</h5>

                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label">NRP <span
                                            class="text-danger"></span></label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="nrp"
                                            value="{{ old('nrp') }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Nama <span
                                            class="text-danger"></span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="nama"
                                            value="{{ old('nama') }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Pangkat <span class="text-danger"></span></label>
                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="Default select example" name="pangkat">
                                            <option selected="">Pilih Pangkat</option>
                                            @foreach ($pangkat as $p)
                                                <option value="{{ $p->id }}"
                                                    {{ old('pangkat_id') == $p->id ? 'selected' : '' }}>
                                                    {{ $p->nama_pangkat }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Jabatan <span
                                            class="text-danger"></span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="jabatan"
                                            value="{{ old('jabatan') }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Satker/Satwil <span
                                            class="text-danger"></span></label>
                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="Default select example"
                                            name="satker_satwil_id">
                                            <option selected="">Pilih Satker</option>
                                            @foreach ($satker_satwil as $satker)
                                                <option value="{{ $satker->id }}"
                                                    {{ old('satker_satwil_id') == $satker->id ? 'selected' : '' }}>
                                                    {{ $satker->nama_satker_satwil }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body p-5">
                                <h5 class="card-title">Pelanggaran</h5>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Pangkat <span class="text-danger"></span></label>
                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="Default select example"
                                            name="pangkat_saat_terkena_kasus">
                                            <option selected="">Pilih Pangkat</option>
                                            @foreach ($pangkat as $p)
                                                <option value="{{ $p->nama_pangkat }}"
                                                    {{ old('pangkat_saat_terkena_kasus') == $p->nama_pangkat ? 'selected' : '' }}>
                                                    {{ $p->nama_pangkat }}</option>
                                            @endforeach
                                        </select>
                                        <small class="text-muted">Pangkat Saat Buat Pelanggaran</small>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Jabatan <span
                                            class="text-danger"></span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="jabatan_saat_terkena_kasus"
                                            value="{{ old('jabatan_saat_terkena_kasus') }}">
                                        <small class="text-muted">Jabatan Saat Buat Pelanggaran</small>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Wilayah Kasus <span
                                            class="text-danger"></span></label>
                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="Default select example"
                                            name="wilayah_kasus_id">
                                            <option selected="">Pilih Wilayah</option>
                                            @foreach ($wilayah as $w)
                                                <option value="{{ $w->id }}"
                                                    {{ old('wilayah_kasus_id') == $w->id ? 'selected' : '' }}>
                                                    {{ $w->nama_wilayah }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Referensi</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" style="height: 100px" name="referensi"> {{ old('referensi') }}</textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Uraian</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" style="height: 100px" name="uraian">{{ old('uraian') }}</textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Bentuk Pelanggaran </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="bantuk_pelanggaran"
                                            value="{{ old('bentuk_pelanggaran') }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Pasal <span
                                            class="text-danger"></span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="pasal"
                                            value="{{ old('pasal') }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Hukuman <span
                                            class="text-danger"></span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="hukuman"
                                            value="{{ old('hukuman') }}">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body p-5">
                                <h5 class="card-title">Putusan</h5>

                                <div class="row mb-3">
                                    <label for="inputDate" class="col-sm-2 col-form-label">Tanggal Pelanggaran <span
                                            class="text-danger"></span></label></label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" name="tanggal_putusan"
                                            value="{{ old('tanggal_putusan') }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">No Putusan</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" style="height: 100px" name="nomor_putusan">{{ old('nomor_putusan') }}</textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body p-5">
                                <h5 class="card-title">Putusan Banding/Keberatan</h5>

                                <div class="row mb-3">
                                    <label for="inputDate" class="col-sm-2 col-form-label">Tanggal Putusan
                                        Banding/Keberatan
                                        <span class="text-danger"></span></label></label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" name="tanggal_putusan_keberatan"
                                            value="{{ old('tanggal_putusan_keberatan') }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">No Putusan
                                        Banding/Keberatan</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" style="height: 100px" name="nomor_putusan_keberatan">{{ old('nomor_putusan_keberatan') }}</textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputDate" class="col-sm-2 col-form-label">Tanggal Mulai Hitung Hukuman
                                        <span class="text-danger"></span></label></label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" name="tanggal_dimulai_hukuman"
                                            value="{{ old('tanggal_dimulai_hukuman') }}">
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body p-5">
                                <h5 class="card-title">RPS</h5>

                                <div class="row mb-3">
                                    <label for="inputDate" class="col-sm-2 col-form-label">Tanggal RPS
                                        <span class="text-danger"></span></label></label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" name="tanggal_rps"
                                            value="{{ old('tanggal_rps') }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">RPS</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" style="height: 100px" name="no_rps">{{ old('no_rps') }}</textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Status <span
                                            class="text-danger"></span></label>
                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="Default select example" name="status_id">
                                            <option selected="">Pilih Status</option>
                                            @foreach ($status as $s)
                                                <option value="{{ $s->id }}"
                                                    {{ old('status_id') == $s->id ? 'selected' : '' }}>
                                                    {{ $s->nama_status }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label">Putusan Sidang</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" id="formFile"
                                            name="file_putusan_sidang">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label">Banding/Keberatan</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" id="formFile" name="file_banding">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label">Upload File RPS</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" id="formFile" name="file_rps">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
