@extends('layouts.main', ['title' => isset($user) ? 'Edit User' : 'Tambah User'])
@section('main')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>{{ isset($user) ? 'Edit User' : 'Tambah User' }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Daftar Users</a></li>
                    <li class="breadcrumb-item active">{{ isset($user) ? 'Edit' : 'Tambah' }} User</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ isset($user) ? 'Edit User' : 'Tambah User' }}</h5>

                            <form action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}"
                                method="POST">
                                @csrf
                                @if (isset($user))
                                    @method('PUT')
                                @endif

                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" id="name" name="name" class="form-control"
                                        value="{{ old('name', $user->name ?? '') }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" id="email" name="email" class="form-control"
                                        value="{{ old('email', $user->email ?? '') }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" id="password" name="password" class="form-control"
                                        {{ isset($user) ? '' : 'required' }}>
                                    @if (isset($user))
                                        <small class="text-muted">Kosongkan jika tidak ingin mengubah password.</small>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        class="form-control" {{ isset($user) ? '' : 'required' }}>
                                </div>

                                @if (isset($user) && $user->id != 1)
                                    <div class="mb-3">
                                        <label class="form-label card-title">Roles</label>
                                        <div class="row">
                                            @foreach ($roles as $role)
                                                <div class="col-md-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input role-radio" type="radio"
                                                            id="role-{{ $role->id }}" name="roles"
                                                            value="{{ $role->id }}"
                                                            data-permissions="{{ $role->permissions->pluck('id')->join(',') }}"
                                                            {{ isset($user) && $user->roles->contains($role->id) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="role-{{ $role->id }}">
                                                            {{ $role->name }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                {{-- @if (isset($user))
                                    @if ($user->id != 1)
                                        <div class="mb-3">
                                            <label class="form-label card-title">Roles</label>
                                            <div class="row">
                                                @foreach ($roles as $role)
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <input class="form-check-input role-radio" type="radio"
                                                                id="role-{{ $role->id }}" name="roles"
                                                                value="{{ $role->id }}"
                                                                data-permissions="{{ $role->permissions->pluck('id')->join(',') }}"
                                                                {{ isset($user) && $user->roles->contains($role->id) ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="role-{{ $role->id }}">
                                                                {{ $role->name }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="mb-3">



                                            <label class="form-label card-title">Permissions</label>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox"
                                                    id="check-all-permissions" />
                                                <label class="form-check-label" for="check-all-permissions">Check
                                                    All</label>
                                            </div>

                                            <!-- Kasus Permissions -->
                                            <div class="my-3">
                                                <h5 class="my-2 card-title">Kasus</h5>
                                                <div class="row">
                                                    @foreach ($permissions->filter(fn($p) => str_contains($p->name, 'kasus')) as $permission)
                                                        <div class="col-md-4">
                                                            <div class="form-check">
                                                                <input class="form-check-input permission-checkbox"
                                                                    type="checkbox" id="permission-{{ $permission->id }}"
                                                                    name="permissions[]" value="{{ $permission->id }}"
                                                                    {{ isset($user) && $user->permissions->contains($permission->id) ? 'checked' : '' }}>
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
                                                                <input class="form-check-input permission-checkbox"
                                                                    type="checkbox" id="permission-{{ $permission->id }}"
                                                                    name="permissions[]" value="{{ $permission->id }}"
                                                                    {{ isset($user) && $user->permissions->contains($permission->id) ? 'checked' : '' }}>
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
                                                                <input class="form-check-input permission-checkbox"
                                                                    type="checkbox" id="permission-{{ $permission->id }}"
                                                                    name="permissions[]" value="{{ $permission->id }}"
                                                                    {{ isset($user) && $user->permissions->contains($permission->id) ? 'checked' : '' }}>
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
                                                                <input class="form-check-input permission-checkbox"
                                                                    type="checkbox" id="permission-{{ $permission->id }}"
                                                                    name="permissions[]" value="{{ $permission->id }}"
                                                                    {{ isset($user) && $user->permissions->contains($permission->id) ? 'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                    for="permission-{{ $permission->id }}">
                                                                    {{ $permission->name }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <!-- role Permissions -->
                                            <div class="my-3">
                                                <h5 class="my-2 card-title">Hukuman</h5>
                                                <div class="row">
                                                    @foreach ($permissions->filter(fn($p) => str_contains($p->name, 'hukuman')) as $permission)
                                                        <div class="col-md-4">
                                                            <div class="form-check">
                                                                <input class="form-check-input permission-checkbox"
                                                                    type="checkbox" id="permission-{{ $permission->id }}"
                                                                    name="permissions[]" value="{{ $permission->id }}"
                                                                    {{ isset($user) && $user->permissions->contains($permission->id) ? 'checked' : '' }}>
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
                                                                    name="permissions[]" value="{{ $permission->id }}"
                                                                    {{ isset($user) && $user->permissions->contains($permission->id) ? 'checked' : '' }}>
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
                                                                    name="permissions[]" value="{{ $permission->id }}"
                                                                    {{ isset($user) && $user->permissions->contains($permission->id) ? 'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                    for="permission-{{ $permission->id }}">
                                                                    {{ $permission->name }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <!-- pelanggaran Permissions -->
                                            <div class="my-3">
                                                <h5 class="my-2 card-title">Jenis Pelanggaran</h5>
                                                <div class="row">
                                                    @foreach ($permissions->filter(fn($p) => str_contains($p->name, 'pelanggaran')) as $permission)
                                                        <div class="col-md-4">
                                                            <div class="form-check">
                                                                <input class="form-check-input permission-checkbox"
                                                                    type="checkbox" id="permission-{{ $permission->id }}"
                                                                    name="permissions[]" value="{{ $permission->id }}"
                                                                    {{ isset($user) && $user->permissions->contains($permission->id) ? 'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                    for="permission-{{ $permission->id }}">
                                                                    {{ $permission->name }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <!-- role Permissions -->
                                            <div class="my-3">
                                                <h5 class="my-2 card-title">Role</h5>
                                                <div class="row">
                                                    @foreach ($permissions->filter(fn($p) => str_contains($p->name, 'role')) as $permission)
                                                        <div class="col-md-4">
                                                            <div class="form-check">
                                                                <input class="form-check-input permission-checkbox"
                                                                    type="checkbox" id="permission-{{ $permission->id }}"
                                                                    name="permissions[]" value="{{ $permission->id }}"
                                                                    {{ isset($user) && $user->permissions->contains($permission->id) ? 'checked' : '' }}>
                                                                <label class="form-check-label"
                                                                    for="permission-{{ $permission->id }}">
                                                                    {{ $permission->name }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <!-- Lainnya -->
                                            <div class="my-3">
                                                <h5 class="my-2 card-title">Lainnya</h5>
                                                <div class="row">
                                                    @foreach ($permissions->filter(fn($p) => !str_contains($p->name, 'hukuman') && !str_contains($p->name, 'role') && !str_contains($p->name, 'pelanggaran') && !str_contains($p->name, 'kasus') && !str_contains($p->name, 'kategori') && !str_contains($p->name, 'pangkat') && !str_contains($p->name, 'satker') && !str_contains($p->name, 'status') && !str_contains($p->name, 'skhp')) as $permission)
                                                        <div class="col-md-4">
                                                            <div class="form-check">
                                                                <input class="form-check-input permission-checkbox"
                                                                    type="checkbox" id="permission-{{ $permission->id }}"
                                                                    name="permissions[]" value="{{ $permission->id }}"
                                                                    {{ isset($user) && $user->permissions->contains($permission->id) ? 'checked' : '' }}>
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
                                    @endif
                                @endif --}}
                                <!-- Add this to your user create/edit form -->
                                <div class="form-group mb-3">
                                    <label for="satker_id">Satker</label>
                                    <select class="form-control @error('satker_id') is-invalid @enderror" id="satker_id"
                                        name="satker_id">
                                        <option value="">-- Pilih Satker --</option>
                                        @foreach ($satkers as $satker)
                                            <option value="{{ $satker->id }}"
                                                {{ old('satker_id', $user->satker_id ?? '') == $satker->id ? 'selected' : '' }}>
                                                {{ $satker->nama_satker_satwil }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('satker_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <button type="submit"
                                        class="btn btn-outline-primary">{{ isset($user) ? 'Update' : 'Tambah' }}</button>
                                    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Batal</a>
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
    <script>
        // Check all permissions
        document.getElementById('check-all-permissions').addEventListener('click', function() {
            const checkboxes = document.querySelectorAll('.permission-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });

        // Automatically check permissions based on role selection (radio)
        document.querySelectorAll('.role-radio').forEach(roleRadio => {
            roleRadio.addEventListener('change', function() {
                const permissions = this.dataset.permissions.split(',');

                // Uncheck all permission checkboxes first
                document.querySelectorAll('.permission-checkbox').forEach(permissionCheckbox => {
                    permissionCheckbox.checked = false;
                });

                // Check permissions associated with the selected role
                permissions.forEach(permissionId => {
                    const permissionCheckbox = document.getElementById('permission-' +
                        permissionId);
                    if (permissionCheckbox) {
                        permissionCheckbox.checked = this.checked;
                    }
                });
            });

            // Trigger change event if role is checked on load (for pre-existing user roles)
            if (roleRadio.checked) {
                roleRadio.dispatchEvent(new Event('change'));
            }
        });
    </script>
@endsection
