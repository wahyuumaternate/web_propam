@extends('layouts.main', ['title' => 'Tambah SKHP'])
@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Tambah SKHP (Surat Keterangan Hasil Pemeriksaan)</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item active">Tambah SKHP</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <form action="{{ route('skhp.store') }}" method="POST">
                    @csrf
                    <div class="col-lg-12">

                        {{-- Profil --}}
                        <div class="card">
                            <div class="card-body p-5">
                                <h5 class="card-title"><button type="submit" class="btn btn-outline-primary">Simpan
                                        SKHP</button></h5>

                                <div class="row mb-3">
                                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                            name="nama" id="nama" value="{{ old('nama') }}" required>
                                        @error('nama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Jenis Kelamin --}}
                                <div class="row mb-3">
                                    <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                    <div class="col-sm-10">
                                        <select class="form-select @error('jenis_kelamin') is-invalid @enderror"
                                            name="jenis_kelamin" id="jenis_kelamin" required>
                                            <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                            <option value="Laki-laki"
                                                {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                                            </option>
                                            <option value="Perempuan"
                                                {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan
                                            </option>
                                        </select>
                                        @error('jenis_kelamin')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="nrp_nip" class="col-sm-2 col-form-label">NRP / NIP</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control @error('nrp_nip') is-invalid @enderror"
                                            name="nrp_nip" id="nrp_nip" value="{{ old('nrp_nip') }}" required>
                                        @error('nrp_nip')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Pangkat</label>
                                    <div class="col-sm-10">
                                        <select class="form-select @error('id_pangkat') is-invalid @enderror"
                                            aria-label="Default select example" name="id_pangkat">
                                            <option selected="" value="">Pilih Pangkat</option>
                                            @foreach ($pangkat as $p)
                                                <option value="{{ $p->id }}"
                                                    {{ old('id_pangkat') == $p->id ? 'selected' : '' }}>
                                                    {{ $p->nama_pangkat }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_pangkat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('jabatan') is-invalid @enderror"
                                            name="jabatan" id="jabatan" value="{{ old('jabatan') }}" required>
                                        @error('jabatan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('tempat_lahir') is-invalid @enderror"
                                            name="tempat_lahir" id="tempat_lahir" value="{{ old('tempat_lahir') }}"
                                            required>
                                        @error('tempat_lahir')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                    <div class="col-sm-10">
                                        <input type="date"
                                            class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                            name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                                            required>
                                        @error('tanggal_lahir')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Agama --}}
                                <div class="row mb-3">
                                    <label for="agama" class="col-sm-2 col-form-label">Agama</label>
                                    <div class="col-sm-10">
                                        <select class="form-select @error('agama') is-invalid @enderror" name="agama"
                                            id="agama" required>
                                            <option value="" disabled selected>Pilih Agama</option>
                                            <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam
                                            </option>
                                            <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>
                                                Kristen</option>
                                            <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>
                                                Katolik</option>
                                            <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu
                                            </option>
                                            <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha
                                            </option>
                                            <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>
                                                Konghucu</option>
                                        </select>
                                        @error('agama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Alamat Kantor --}}
                                <div class="row mb-3">
                                    <label for="alamat_kantor" class="col-sm-2 col-form-label">Alamat Kantor</label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('alamat_kantor') is-invalid @enderror"
                                            name="alamat_kantor" id="alamat_kantor" value="{{ old('alamat_kantor') }}"
                                            required>
                                        @error('alamat_kantor')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Alamat Kantor --}}
                                <div class="row mb-3">
                                    <label for="kesatuan_instansi" class="col-sm-2 col-form-label">Kesatuan /
                                        Instansi</label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('kesatuan_instansi') is-invalid @enderror"
                                            name="kesatuan_instansi" id="kesatuan_instansi"
                                            value="{{ old('kesatuan_instansi') }}" required>
                                        @error('kesatuan_instansi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Alamat Kantor --}}
                                <div class="row mb-3">
                                    <label for="peruntukan" class="col-sm-2 col-form-label">Peruntukan</label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('peruntukan') is-invalid @enderror"
                                            name="peruntukan" id="peruntukan" value="{{ old('peruntukan') }}" required>
                                        @error('peruntukan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
