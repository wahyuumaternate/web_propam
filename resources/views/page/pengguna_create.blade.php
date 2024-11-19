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


                                @if (isset($user))
                                    @if ($user->id != 1)
                                        <div class="mb-3">
                                            <label class="form-label">Roles</label>
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
                                            <label class="form-label">Permissions</label>
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox"
                                                    id="check-all-permissions" />
                                                <label class="form-check-label" for="check-all-permissions">Check
                                                    All</label>
                                            </div>
                                            <div class="row">
                                                @foreach ($permissions as $permission)
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
                                    @endif
                                @endif

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
