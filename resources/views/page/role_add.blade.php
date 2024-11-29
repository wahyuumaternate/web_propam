@extends('layouts.main', ['title' => 'Tambah Role'])
@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Tambah Role</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Daftar Role</a></li>
                    <li class="breadcrumb-item active">Tambah Role</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Form Tambah Role</h5>

                            <form action="{{ route('roles.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="roleName" class="form-label">Nama Role</label>
                                    <input type="text" class="form-control" id="roleName" name="name" required>
                                </div>

                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-lg-6">

                                            <label class="form-label card-title">Permissions</label>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox"
                                                    id="check-all-permissions" />
                                                <label class="form-check-label" for="check-all-permissions">Check
                                                    All</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <button type="submit" class="btn btn-outline-primary mt-5">Simpan</button>
                                        </div>
                                    </div>

                                    <!-- Kasus Permissions -->
                                    <div class="my-3">
                                        <h5 class="my-2 card-title">Kasus</h5>
                                        <div class="row">
                                            @foreach ($permissions->filter(fn($p) => str_contains($p->name, 'kasus')) as $permission)
                                                <div class="col-md-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input permission-checkbox" type="checkbox"
                                                            id="permission-{{ $permission->id }}" name="permissions[]"
                                                            value="{{ $permission->id }}">
                                                        <label class="form-check-label"
                                                            for="permission-{{ $permission->id }}">
                                                            {{ $permission->name }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- Kategori Permissions -->
                                    <div class="my-3">
                                        <h5 class="my-2 card-title">Kategori (Pelanggaran)</h5>
                                        <div class="row">
                                            @foreach ($permissions->filter(fn($p) => str_contains($p->name, 'kategori')) as $permission)
                                                <div class="col-md-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input permission-checkbox" type="checkbox"
                                                            id="permission-{{ $permission->id }}" name="permissions[]"
                                                            value="{{ $permission->id }}">
                                                        <label class="form-check-label"
                                                            for="permission-{{ $permission->id }}">
                                                            {{ $permission->name }} Pelanggaran
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- Pangkat Permissions -->
                                    <div class="my-3">
                                        <h5 class="my-2 card-title">Pangkat</h5>
                                        <div class="row">
                                            @foreach ($permissions->filter(fn($p) => str_contains($p->name, 'pangkat')) as $permission)
                                                <div class="col-md-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input permission-checkbox" type="checkbox"
                                                            id="permission-{{ $permission->id }}" name="permissions[]"
                                                            value="{{ $permission->id }}">
                                                        <label class="form-check-label"
                                                            for="permission-{{ $permission->id }}">
                                                            {{ $permission->name }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- Satker Permissions -->
                                    <div class="my-3">
                                        <h5 class="my-2 card-title">Satker</h5>
                                        <div class="row">
                                            @foreach ($permissions->filter(fn($p) => str_contains($p->name, 'satker')) as $permission)
                                                <div class="col-md-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input permission-checkbox" type="checkbox"
                                                            id="permission-{{ $permission->id }}" name="permissions[]"
                                                            value="{{ $permission->id }}">
                                                        <label class="form-check-label"
                                                            for="permission-{{ $permission->id }}">
                                                            {{ $permission->name }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- Hukuman Permissions -->
                                    <div class="my-3">
                                        <h5 class="my-2 card-title">Hukuman</h5>
                                        <div class="row">
                                            @foreach ($permissions->filter(fn($p) => str_contains($p->name, 'hukuman')) as $permission)
                                                <div class="col-md-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input permission-checkbox" type="checkbox"
                                                            id="permission-{{ $permission->id }}" name="permissions[]"
                                                            value="{{ $permission->id }}">
                                                        <label class="form-check-label"
                                                            for="permission-{{ $permission->id }}">
                                                            {{ $permission->name }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- Status Permissions -->
                                    <div class="my-3">
                                        <h5 class="my-2 card-title">Status</h5>
                                        <div class="row">
                                            @foreach ($permissions->filter(fn($p) => str_contains($p->name, 'status')) as $permission)
                                                <div class="col-md-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input permission-checkbox"
                                                            type="checkbox" id="permission-{{ $permission->id }}"
                                                            name="permissions[]" value="{{ $permission->id }}">
                                                        <label class="form-check-label"
                                                            for="permission-{{ $permission->id }}">
                                                            {{ $permission->name }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- SKHP Permissions -->
                                    <div class="my-3">
                                        <h5 class="my-2 card-title">SKHP</h5>
                                        <div class="row">
                                            @foreach ($permissions->filter(fn($p) => str_contains($p->name, 'skhp')) as $permission)
                                                <div class="col-md-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input permission-checkbox"
                                                            type="checkbox" id="permission-{{ $permission->id }}"
                                                            name="permissions[]" value="{{ $permission->id }}">
                                                        <label class="form-check-label"
                                                            for="permission-{{ $permission->id }}">
                                                            {{ $permission->name }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- Jenis Pelanggaran Permissions -->
                                    <div class="my-3">
                                        <h5 class="my-2 card-title">Jenis Pelanggaran</h5>
                                        <div class="row">
                                            @foreach ($permissions->filter(fn($p) => str_contains($p->name, 'pelanggaran')) as $permission)
                                                <div class="col-md-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input permission-checkbox"
                                                            type="checkbox" id="permission-{{ $permission->id }}"
                                                            name="permissions[]" value="{{ $permission->id }}">
                                                        <label class="form-check-label"
                                                            for="permission-{{ $permission->id }}">
                                                            {{ $permission->name }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- Role Permissions -->
                                    <div class="my-3">
                                        <h5 class="my-2 card-title">Role</h5>
                                        <div class="row">
                                            @foreach ($permissions->filter(fn($p) => str_contains($p->name, 'role')) as $permission)
                                                <div class="col-md-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input permission-checkbox"
                                                            type="checkbox" id="permission-{{ $permission->id }}"
                                                            name="permissions[]" value="{{ $permission->id }}">
                                                        <label class="form-check-label"
                                                            for="permission-{{ $permission->id }}">
                                                            {{ $permission->name }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- Lainnya Permissions -->
                                    <div class="my-3">
                                        <h5 class="my-2 card-title">Lainnya</h5>
                                        <div class="row">
                                            @foreach ($permissions->filter(fn($p) => !str_contains($p->name, 'hukuman') && !str_contains($p->name, 'role') && !str_contains($p->name, 'pelanggaran') && !str_contains($p->name, 'kasus') && !str_contains($p->name, 'kategori') && !str_contains($p->name, 'pangkat') && !str_contains($p->name, 'satker') && !str_contains($p->name, 'status') && !str_contains($p->name, 'skhp')) as $permission)
                                                <div class="col-md-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input permission-checkbox"
                                                            type="checkbox" id="permission-{{ $permission->id }}"
                                                            name="permissions[]" value="{{ $permission->id }}">
                                                        <label class="form-check-label"
                                                            for="permission-{{ $permission->id }}">
                                                            {{ $permission->name }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>



                                <div class="mt-5">
                                    <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary">Batal</a>
                                    <button type="submit" class="btn btn-outline-primary">Simpan</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection
@section('js')
    <!-- JavaScript untuk "Check All" -->
    <script>
        document.getElementById('check-all-permissions').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.permission-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });
    </script>
@endsection
