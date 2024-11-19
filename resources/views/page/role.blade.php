@extends('layouts.main', ['title' => 'Daftar Role'])
@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Daftar Role</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item active">Daftar Role</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body table-responsive">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">List Role</h5>
                                <div>
                                    <a href="{{ route('roles.create') }}" class="btn btn-primary">
                                        <i class="bi bi-plus-lg"></i> Tambah Role
                                    </a>
                                </div>
                            </div>

                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>Nama Role</th>
                                        {{-- <th>Permissions</th> --}}
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td>{{ $role->name }}</td>
                                            {{-- <td>
                                                <ul>
                                                    @foreach ($role->permissions as $permission)
                                                        <li>{{ $permission->name }}</li>
                                                    @endforeach
                                                </ul>
                                            </td> --}}
                                            <td>
                                                @if ($role->id != 1)
                                                    <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <form id="delete-form-{{ $role->id }}"
                                                        action="{{ route('roles.destroy', $role->id) }}" method="POST"
                                                        style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                    <button onclick="confirmDelete({{ $role->id }})"
                                                        class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection

@section('js')
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Tindakan ini tidak dapat dibatalkan.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }
    </script>
@endsection
