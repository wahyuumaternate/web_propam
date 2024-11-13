@extends('layouts.main', ['title' => 'Tambah Kasus'])
@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Tambah Kasus</h1>
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

                        {{-- kategori --}}
                        <div class="card">
                            <div class="card-body p-5">
                                <h5 class="card-title">Laporan Pelanggaran</h5>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Kategori <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <select class="form-select @error('kategori_id') is-invalid @enderror"
                                            aria-label="Default select example" name="kategori_id">
                                            <option selected value="">Pilih Kategori</option>
                                            @foreach ($kategori as $k)
                                                <option value="{{ $k->id }}"
                                                    {{ old('kategori_id') == $k->id ? 'selected' : '' }}>
                                                    {{ $k->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                        @error('kategori_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="tanggal_lapor" class="col-sm-2 col-form-label">Tanggal Lapor <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="date" name="tanggal_lapor"
                                            class="form-control @error('tanggal_lapor') is-invalid @enderror"
                                            value="{{ old('tanggal_lapor') }}">
                                        @error('tanggal_lapor')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>

                        {{-- profil --}}
                        <div class="card">
                            <div class="card-body p-5">
                                <h5 class="card-title">Profil</h5>

                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label">NRP <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control @error('nrp') is-invalid @enderror"
                                            name="nrp" value="{{ old('nrp') }}">
                                        @error('nrp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Nama <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                            name="nama" value="{{ old('nama') }}">
                                        @error('nama')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Pangkat <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <select class="form-select @error('pangkat_id') is-invalid @enderror"
                                            aria-label="Default select example" name="pangkat_id">
                                            <option selected="" value="">Pilih Pangkat</option>
                                            @foreach ($pangkat as $p)
                                                <option value="{{ $p->id }}"
                                                    {{ old('pangkat_id') == $p->id ? 'selected' : '' }}>
                                                    {{ $p->nama_pangkat }}</option>
                                            @endforeach
                                        </select>
                                        @error('pangkat_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Jabatan <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('jabatan') is-invalid @enderror"
                                            name="jabatan" value="{{ old('jabatan') }}">
                                        @error('jabatan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Satker/Satwil <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <select class="form-select @error('satker_satwil_id') is-invalid @enderror"
                                            aria-label="Default select example" name="satker_satwil_id">
                                            <option selected="">Pilih Satker</option>
                                            @foreach ($satker_satwil as $satker)
                                                <option value="{{ $satker->id }}"
                                                    {{ old('satker_satwil_id') == $satker->id ? 'selected' : '' }}>
                                                    {{ $satker->nama_satker_satwil }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('satker_satwil_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>


                            </div>
                        </div>

                        {{-- pelanggaran --}}
                        <div class="card">
                            <div class="card-body p-5">
                                <h5 class="card-title">Pelanggaran</h5>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Pangkat <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <select
                                            class="form-select @error('pangkat_saat_terkena_kasus') is-invalid @enderror"
                                            aria-label="Default select example" name="pangkat_saat_terkena_kasus">
                                            <option selected="" value="">Pilih Pangkat</option>
                                            @foreach ($pangkat as $p)
                                                <option value="{{ $p->nama_pangkat }}"
                                                    {{ old('pangkat_saat_terkena_kasus') == $p->nama_pangkat ? 'selected' : '' }}>
                                                    {{ $p->nama_pangkat }}</option>
                                            @endforeach
                                        </select>
                                        @error('pangkat_saat_terkena_kasus')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <small class="text-muted">Pangkat Saat Buat Pelanggaran</small>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Jabatan <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('jabatan_saat_terkena_kasus') is-invalid @enderror"
                                            name="jabatan_saat_terkena_kasus"
                                            value="{{ old('jabatan_saat_terkena_kasus') }}">
                                        @error('jabatan_saat_terkena_kasus')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <small class="text-muted">Jabatan Saat Buat Pelanggaran</small>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Satker/Satwil<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <select class="form-select @error('wilayah_kasus_id') is-invalid @enderror"
                                            aria-label="Default select example" name="wilayah_kasus_id">
                                            <option selected="">Pilih Wilayah</option>
                                            @foreach ($wilayah as $w)
                                                <option value="{{ $w->id }}"
                                                    {{ old('wilayah_kasus_id') == $w->id ? 'selected' : '' }}>
                                                    {{ $w->nama_wilayah }}</option>
                                            @endforeach
                                        </select>
                                        <small class="text-muted">Satker/Satwil Saat Buat Pelanggaran</small>
                                        @error('wilayah_kasus_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Wilayah Kasus <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <select class="form-select @error('wilayah_kasus_id') is-invalid @enderror"
                                            aria-label="Default select example" name="wilayah_kasus_id">
                                            <option selected="">Pilih Wilayah</option>
                                            @foreach ($wilayah as $w)
                                                <option value="{{ $w->id }}"
                                                    {{ old('wilayah_kasus_id') == $w->id ? 'selected' : '' }}>
                                                    {{ $w->nama_wilayah }}</option>
                                            @endforeach
                                        </select>
                                        @error('wilayah_kasus_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="referensi" class="col-sm-2 col-form-label">Referensi</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control @error('referensi') is-invalid @enderror" style="height: 100px" name="referensi">{{ old('referensi') }}</textarea>
                                        @error('referensi')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="uraian" class="col-sm-2 col-form-label">Uraian</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control @error('uraian') is-invalid @enderror" style="height: 100px" name="uraian">{{ old('uraian') }}</textarea>
                                        @error('uraian')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="bentuk_pelanggaran" class="col-sm-2 col-form-label">Bentuk Pelanggaran
                                    </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('bentuk_pelanggaran') is-invalid @enderror"
                                            name="bentuk_pelanggaran" value="{{ old('bentuk_pelanggaran') }}">
                                        @error('bentuk_pelanggaran')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="pasal" class="col-sm-2 col-form-label">Pasal <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('pasal') is-invalid @enderror"
                                            name="pasal" value="{{ old('pasal') }}">
                                        @error('pasal')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="hukuman" class="col-sm-2 col-form-label">Hukuman <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('hukuman') is-invalid @enderror"
                                            name="hukuman" value="{{ old('hukuman') }}">
                                        @error('hukuman')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>


                        {{-- putusan --}}
                        <div class="card">
                            <div class="card-body p-5">
                                <h5 class="card-title">Putusan</h5>

                                <div class="row mb-3">
                                    <label for="tanggal_putusan" class="col-sm-2 col-form-label">Tanggal Putusan <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="date"
                                            class="form-control @error('tanggal_putusan') is-invalid @enderror"
                                            name="tanggal_putusan" value="{{ old('tanggal_putusan') }}">
                                        @error('tanggal_putusan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="nomor_putusan" class="col-sm-2 col-form-label">No Putusan <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control @error('nomor_putusan') is-invalid @enderror" style="height: 100px"
                                            name="nomor_putusan">{{ old('nomor_putusan') }}</textarea>
                                        @error('nomor_putusan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>


                            </div>
                        </div>


                        {{-- Putusan Banding/Keberatan --}}
                        <div class="card">
                            <div class="card-body p-5">
                                <h5 class="card-title">Putusan Banding/Keberatan</h5>

                                <div class="row mb-3">
                                    <label for="tanggal_putusan_keberatan" class="col-sm-2 col-form-label">Tanggal Putusan
                                        Banding/Keberatan <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="date"
                                            class="form-control @error('tanggal_putusan_keberatan') is-invalid @enderror"
                                            name="tanggal_putusan_keberatan"
                                            value="{{ old('tanggal_putusan_keberatan') }}">
                                        @error('tanggal_putusan_keberatan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="nomor_putusan_keberatan" class="col-sm-2 col-form-label">No Putusan
                                        Banding/Keberatan <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control @error('nomor_putusan_keberatan') is-invalid @enderror" style="height: 100px"
                                            name="nomor_putusan_keberatan">{{ old('nomor_putusan_keberatan') }}</textarea>
                                        @error('nomor_putusan_keberatan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="tanggal_dimulai_hukuman" class="col-sm-2 col-form-label">Tanggal Mulai
                                        Hitung Hukuman <span class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="date"
                                            class="form-control @error('tanggal_dimulai_hukuman') is-invalid @enderror"
                                            name="tanggal_dimulai_hukuman" value="{{ old('tanggal_dimulai_hukuman') }}">
                                        @error('tanggal_dimulai_hukuman')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>


                            </div>
                        </div>


                        {{-- RPS --}}
                        <div class="card">
                            <div class="card-body p-5">
                                <h5 class="card-title">RPS</h5>

                                <div class="row mb-3">
                                    <label for="tanggal_rps" class="col-sm-2 col-form-label">Tanggal RPS <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="date"
                                            class="form-control @error('tanggal_rps') is-invalid @enderror"
                                            name="tanggal_rps" value="{{ old('tanggal_rps') }}">
                                        @error('tanggal_rps')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="no_rps" class="col-sm-2 col-form-label">RPS <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control @error('no_rps') is-invalid @enderror" style="height: 100px" name="no_rps">{{ old('no_rps') }}</textarea>
                                        @error('no_rps')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="status_id" class="col-sm-2 col-form-label">Status <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-10">
                                        <select class="form-select @error('status_id') is-invalid @enderror"
                                            name="status_id">
                                            <option selected="">Pilih Status</option>
                                            @foreach ($status as $s)
                                                <option value="{{ $s->id }}"
                                                    {{ old('status_id') == $s->id ? 'selected' : '' }}>
                                                    {{ $s->nama_status }}</option>
                                            @endforeach
                                        </select>
                                        @error('status_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="file_putusan_sidang" class="col-sm-2 col-form-label">Putusan
                                        Sidang</label>
                                    <div class="col-sm-10">
                                        <input class="form-control @error('file_putusan_sidang') is-invalid @enderror"
                                            type="file" name="file_putusan_sidang">
                                        @error('file_putusan_sidang')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="file_banding" class="col-sm-2 col-form-label">Banding/Keberatan</label>
                                    <div class="col-sm-10">
                                        <input class="form-control @error('file_banding') is-invalid @enderror"
                                            type="file" name="file_banding">
                                        @error('file_banding')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="file_rps" class="col-sm-2 col-form-label">Upload File RPS</label>
                                    <div class="col-sm-10">
                                        <input class="form-control @error('file_rps') is-invalid @enderror"
                                            type="file" name="file_rps">
                                        @error('file_rps')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
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
