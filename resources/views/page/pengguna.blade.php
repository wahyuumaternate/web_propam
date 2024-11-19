@extends('layouts.main', ['title' => 'Daftar Users'])
@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Daftar Users</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item active">Daftar Users</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body table-responsive">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">List Users</h5>
                                <div>
                                    <a href="{{ route('users.create') }}" class="btn btn-primary">
                                        <i class="bi bi-plus-lg"></i> Tambah User
                                    </a>
                                </div>
                            </div>

                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>Nama User</th>
                                        {{-- Tambahkan kolom lain sesuai kebutuhan --}}
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            {{-- Tambahkan kolom lain sesuai kebutuhan --}}
                                            <td>
                                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                @if ($user->id != 1)
                                                    <form id="delete-form-{{ $user->id }}"
                                                        action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                        style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                    <button onclick="confirmDelete({{ $user->id }})"
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
