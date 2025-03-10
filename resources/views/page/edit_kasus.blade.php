@extends('layouts.main', ['title' => 'Edit Kasus'])
@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Edit Kasus</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('daftarKasus') }}">Daftar Kasus</a></li>
                    <li class="breadcrumb-item active">Edit Kasus</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <form action="{{ route('daftarKasus.update', $kasus->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-lg-12">

                        {{-- kategori --}}
                        <div class="card">
                            <div class="card-body p-5">
                                <h5 class="card-title">Laporan Pelanggaran</h5>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Jenis Pelanggaran </label>
                                    <div class="col-sm-10">
                                        <select class="form-select @error('kategori_id') is-invalid @enderror"
                                            aria-label="Default select example" name="kategori_id">
                                            <option value="">Pilih Jenis Pelanggaran</option>
                                            @foreach ($kategori as $k)
                                                <option value="{{ $k->id }}"
                                                    {{ old('kategori_id', $kasus->kategori_id) == $k->id ? 'selected' : '' }}>
                                                    {{ $k->nama_kategori }}
                                                </option>
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
                                    <label for="tanggal_lapor" class="col-sm-2 col-form-label">Tanggal Lapor </label>
                                    <div class="col-sm-10">
                                        <input type="date" name="tanggal_lapor"
                                            class="form-control @error('tanggal_lapor') is-invalid @enderror"
                                            value="{{ old('tanggal_lapor', $kasus->tanggal_lapor) }}">
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
                                    <label for="nrp" class="col-sm-2 col-form-label">NRP </label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control @error('nrp') is-invalid @enderror"
                                            name="nrp" value="{{ old('nrp', $kasus->nrp) }}">
                                        @error('nrp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="nama" class="col-sm-2 col-form-label">Nama </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                            name="nama" value="{{ old('nama', $kasus->nama) }}">
                                        @error('nama')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Pangkat </label>
                                    <div class="col-sm-10">
                                        <select class="form-select @error('pangkat_id') is-invalid @enderror"
                                            name="pangkat_id">
                                            <option value="">Pilih Pangkat</option>
                                            @foreach ($pangkat as $psa)
                                                <option value="{{ $psa->id }}"
                                                    {{ old('pangkat_id', $kasus->pangkat_id) == $psa->id ? 'selected' : '' }}>
                                                    {{ $psa->nama_pangkat }}</option>
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
                                    <label for="jabatan" class="col-sm-2 col-form-label">Jabatan </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('jabatan') is-invalid @enderror"
                                            name="jabatan" value="{{ old('jabatan', $kasus->jabatan) }}">
                                        @error('jabatan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Satker/Satwil </label>
                                    <div class="col-sm-10">
                                        <select class="form-select @error('satker_satwil_id') is-invalid @enderror"
                                            name="satker_satwil_id">
                                            <option value="">Pilih Satker</option>
                                            @foreach ($satker_satwil as $satker)
                                                <option value="{{ $satker->id }}"
                                                    {{ old('satker_satwil_id', $kasus->satker_satwil_id) == $satker->id ? 'selected' : '' }}>
                                                    {{ $satker->nama_satker_satwil }}</option>
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
                                    <label class="col-sm-2 col-form-label">Pangkat </label>
                                    <div class="col-sm-10">
                                        <select
                                            class="form-select @error('pangkat_saat_terkena_kasus') is-invalid @enderror"
                                            aria-label="Default select example" name="pangkat_saat_terkena_kasus">
                                            <option value="">Pilih Pangkat</option>
                                            @foreach ($pangkat as $p)
                                                <option value="{{ $p->nama_pangkat }}"
                                                    {{ old('pangkat_saat_terkena_kasus', $kasus->pangkat_saat_terkena_kasus) == $p->nama_pangkat ? 'selected' : '' }}>
                                                    {{ $p->nama_pangkat }}
                                                </option>
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
                                    <label for="jabatan_saat_terkena_kasus" class="col-sm-2 col-form-label">Jabatan </label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('jabatan_saat_terkena_kasus') is-invalid @enderror"
                                            name="jabatan_saat_terkena_kasus"
                                            value="{{ old('jabatan_saat_terkena_kasus', $kasus->jabatan_saat_terkena_kasus) }}">
                                        @error('jabatan_saat_terkena_kasus')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <small class="text-muted">Jabatan Saat Buat Pelanggaran</small>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Wilayah Kasus </label>
                                    <div class="col-sm-10">
                                        <select class="form-select @error('wilayah_kasus_id') is-invalid @enderror"
                                            aria-label="Default select example" name="wilayah_kasus_id">
                                            <option value="">Pilih Wilayah</option>
                                            @foreach ($wilayah as $w)
                                                <option value="{{ $w->id }}"
                                                    {{ old('wilayah_kasus_id', $kasus->wilayah_kasus_id) == $w->id ? 'selected' : '' }}>
                                                    {{ $w->nama_wilayah }}
                                                </option>
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
                                        <textarea class="form-control @error('referensi') is-invalid @enderror" style="height: 100px" name="referensi">{{ old('referensi', $kasus->referensi) }}</textarea>
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
                                        <textarea class="form-control @error('uraian') is-invalid @enderror" style="height: 100px" name="uraian">{{ old('uraian', $kasus->uraian) }}</textarea>
                                        @error('uraian')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <!-- Dropdown untuk Pelanggaran -->
                                    <label class="col-sm-2 col-form-label">Bentuk Pelanggaran </label>
                                    <div class="col-sm-10">
                                        <select class="form-select @error('pelanggaran_id') is-invalid @enderror"
                                            name="pelanggaran_id" aria-label="Pilih Pelanggaran">
                                            <option selected="">Pilih Bentuk Pelanggaran</option>
                                            @foreach ($pelanggaran as $p)
                                                <option value="{{ $p->id }}"
                                                    {{ (old('pelanggaran_id') ?? $kasus->pelanggaran_id) == $p->id ? 'selected' : '' }}>
                                                    {{ $p->nama_pelanggaran }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('pelanggaran_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="pasal" class="col-sm-2 col-form-label">Pasal </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('pasal') is-invalid @enderror"
                                            name="pasal" value="{{ old('pasal', $kasus->pasal) }}">
                                        @error('pasal')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Hukuman</label>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            @foreach ($hukuman as $index => $h)
                                                <div class="col-md-3 mb-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="hukuman_id[]" value="{{ $h->id }}"
                                                            id="hukuman{{ $h->id }}"
                                                            {{ in_array($h->id, old('hukuman_id', $kasusHukuman)) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="hukuman{{ $h->id }}">
                                                            {{ $h->nama_hukuman }}
                                                        </label>
                                                    </div>
                                                </div>
                                                @if (($index + 1) % 4 == 0 && !$loop->last)
                                        </div>
                                        <div class="row">
                                            @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- putusan --}}
                        <div class="card">
                            <div class="card-body p-5">
                                <h5 class="card-title">Putusan</h5>

                                <div class="row mb-3">
                                    <label for="tanggal_putusan" class="col-sm-2 col-form-label">Tanggal Putusan </label>
                                    <div class="col-sm-10">
                                        <input type="date"
                                            class="form-control @error('tanggal_putusan') is-invalid @enderror"
                                            name="tanggal_putusan"
                                            value="{{ old('tanggal_putusan', $kasus->tanggal_putusan) }}">
                                        @error('tanggal_putusan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="nomor_putusan" class="col-sm-2 col-form-label">No Putusan </label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control @error('nomor_putusan') is-invalid @enderror" style="height: 100px"
                                            name="nomor_putusan">{{ old('nomor_putusan', $kasus->nomor_putusan) }}</textarea>
                                        @error('nomor_putusan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="tanggal_dimulai_hukuman" class="col-sm-2 col-form-label"><small>Selesai
                                            Melaksanakan Hukuman</small></label>
                                    <div class="col-sm-10">
                                        <input type="date"
                                            class="form-control @error('tanggal_dimulai_hukuman') is-invalid @enderror"
                                            name="tanggal_dimulai_hukuman"
                                            value="{{ old('tanggal_dimulai_hukuman', $kasus->tanggal_dimulai_hukuman) }}">
                                        @error('tanggal_dimulai_hukuman')
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
                                        Banding/Keberatan </label>
                                    <div class="col-sm-10">
                                        <input type="date"
                                            class="form-control @error('tanggal_putusan_keberatan') is-invalid @enderror"
                                            name="tanggal_putusan_keberatan"
                                            value="{{ old('tanggal_putusan_keberatan', $kasus->tanggal_putusan_keberatan) }}">
                                        @error('tanggal_putusan_keberatan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="nomor_putusan_keberatan" class="col-sm-2 col-form-label">No Putusan
                                        Banding/Keberatan </label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control @error('nomor_putusan_keberatan') is-invalid @enderror" style="height: 100px"
                                            name="nomor_putusan_keberatan">{{ old('nomor_putusan_keberatan', $kasus->nomor_putusan_keberatan) }}</textarea>
                                        @error('nomor_putusan_keberatan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>



                            </div>
                        </div>

                        {{-- RPS --}}
                        {{-- RPS --}}
                        <div class="card">
                            <div class="card-body p-5">
                                <h5 class="card-title">RPS/RPPH</h5>

                                <div class="row mb-3">
                                    <label for="tanggal_rps" class="col-sm-2 col-form-label">Tanggal RPS/RPPH </label>
                                    <div class="col-sm-10">
                                        <input type="date"
                                            class="form-control @error('tanggal_rps') is-invalid @enderror"
                                            name="tanggal_rps" value="{{ old('tanggal_rps', $kasus->tanggal_rps) }}">
                                        @error('tanggal_rps')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="no_rps" class="col-sm-2 col-form-label">RPS/RPPH </label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control @error('no_rps') is-invalid @enderror" style="height: 100px" name="no_rps">{{ old('no_rps', $kasus->no_rps) }}</textarea>
                                        @error('no_rps')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="status_id" class="col-sm-2 col-form-label">Status </label>
                                    <div class="col-sm-10">
                                        <select class="form-select @error('status_id') is-invalid @enderror"
                                            name="status_id">
                                            <option value="">Pilih Status</option>
                                            @foreach ($status as $s)
                                                <option value="{{ $s->id }}"
                                                    {{ old('status_id', $kasus->status_id) == $s->id ? 'selected' : '' }}>
                                                    {{ $s->nama_status }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('status_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- File Putusan Sidang --}}
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
                                        @if ($kasus->file_putusan_sidang)
                                            <small class="form-text text-muted">
                                                <a href="{{ asset('storage/' . $kasus->file_putusan_sidang) }}"
                                                    download="File_Putusan_Sidang_{{ $kasus->nama }}_{{ basename($kasus->file_putusan_sidang) }}">
                                                    Download
                                                </a>
                                            </small>
                                        @endif
                                    </div>
                                </div>

                                {{-- File Banding --}}
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
                                        @if ($kasus->file_banding)
                                            <small class="form-text text-muted">

                                                <a href="{{ asset('storage/' . $kasus->file_banding) }}"
                                                    download="File_Banding_{{ $kasus->nama }}_{{ basename($kasus->file_banding) }}">Download</a>
                                            </small>
                                        @endif
                                    </div>
                                </div>

                                {{-- File RPS --}}
                                <div class="row mb-3">
                                    <label for="file_rps" class="col-sm-2 col-form-label">Upload File RPS/RPPH</label>
                                    <div class="col-sm-10">
                                        <input class="form-control @error('file_rps') is-invalid @enderror"
                                            type="file" name="file_rps">
                                        @error('file_rps')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        @if ($kasus->file_rps)
                                            <small class="form-text text-muted">

                                                <a href="{{ asset('storage/' . $kasus->file_rps) }}"
                                                    download="File_RPS_{{ $kasus->nama }}_{{ basename($kasus->file_rps) }}">Download</a>
                                            </small>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>


                        {{-- The rest of the form fields can be updated similarly --}}
                        <button class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
