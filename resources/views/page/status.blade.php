@extends('layouts.main')
@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Status</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item active">Status</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body table-responsive">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">List Status</h5>
                                <div>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                        data-bs-target="#basicModal">
                                        <i class="bi bi-plus-lg"></i>
                                    </button>

                                    {{-- Add Modal --}}
                                    <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Tambah status</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('status.store') }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="nama_status">Nama status</label>
                                                            <input type="text" class="form-control" id="nama_status"
                                                                name="nama_status" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit"
                                                            class="btn btn-outline-primary">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>

                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($status as $kat)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $kat->nama_status }}</td>
                                            <td>
                                                <button type="button" class="btn btn-outline-warning"
                                                    data-bs-toggle="modal" data-bs-target="#updateModal"
                                                    onclick="showUpdateModal({{ $kat->id }}, '{{ $kat->nama_status }}')">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <button type="button" class="btn btn-outline-danger"
                                                    onclick="confirmDelete({{ $kat->id }})">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                                <form id="delete-form-{{ $kat->id }}"
                                                    action="{{ route('status.destroy', $kat->id) }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>

                                        {{-- update modal --}}
                                        {{-- Update Modal --}}
                                        <div class="modal fade" id="updateModal" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Ubah status</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form id="updateForm" method="POST"
                                                        action="{{ route('status.update', $kat->id) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="update_nama_status">Nama status</label>
                                                                <input type="text" class="form-control"
                                                                    id="update_nama_status" name="nama_status" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit"
                                                                class="btn btn-outline-primary">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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
        function showUpdateModal(id, namastatus) {
            const formAction = "status/" + id;
            document.getElementById('updateForm').action = formAction;
            document.getElementById('update_nama_status').value = namastatus;
            var updateModal = new bootstrap.Modal(document.getElementById('updateModal'), {});
            updateModal.show();
        }

        // Fungsi untuk menutup modal dan memastikan overlay dihilangkan
        document.getElementById('updateModal').addEventListener('hidden.bs.modal', function() {
            var body = document.querySelector('body');
            body.classList.remove('modal-open');
            var modalBackdrop = document.querySelector('.modal-backdrop');
            if (modalBackdrop) {
                modalBackdrop.remove();
            }
        });
    </script>
    {{-- <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit form untuk menghapus data
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }
    </script> --}}
@endsection
