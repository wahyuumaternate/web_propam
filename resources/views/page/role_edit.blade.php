@extends('layouts.main', ['title' => 'Edit Role'])
@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Edit Role</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Daftar Role</a></li>
                    <li class="breadcrumb-item active">Edit Role</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Form Edit Role</h5>

                            <form action="{{ route('roles.update', $role->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="roleName" class="form-label">Nama Role</label>
                                    <input type="text" class="form-control" id="roleName" name="name"
                                        value="{{ $role->name }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Permissions</label>
                                    <div class="row">
                                        @foreach ($permissions as $permission)
                                            <div class="col-md-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="permission-{{ $permission->id }}" name="permissions[]"
                                                        value="{{ $permission->id }}"
                                                        @if ($role->permissions->contains($permission)) checked @endif>
                                                    <label class="form-check-label" for="permission-{{ $permission->id }}">
                                                        {{ $permission->name }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="text-end">
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
