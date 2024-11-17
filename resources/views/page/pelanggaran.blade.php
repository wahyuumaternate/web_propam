@extends('layouts.main', ['title' => 'Jenis  Pelanggaran'])
@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Jenis Pelanggaran</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item active">Jenis Pelanggaran</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body table-responsive">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">List Jenis Pelanggaran</h5>
                                <div>
                                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                        data-bs-target="#basicModal">
                                        <i class="bi bi-plus-lg"></i>
                                    </button>

                                    {{-- Add Modal --}}
                                    <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Tambah Pelanggaran</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('pelanggaran.store') }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="nama_pelanggaran">Nama Pelanggaran</label>
                                                            <input type="text" class="form-control" id="nama_pelanggaran"
                                                                name="nama_pelanggaran" required>
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
                                    @foreach ($pelanggaran as $plgrn)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $plgrn->nama_pelanggaran }}</td>
                                            <td>
                                                <!-- Tombol Edit -->
                                                <button type="button" class="btn btn-outline-warning"
                                                    onclick="showUpdateModal({{ $plgrn->id }}, '{{ $plgrn->nama_pelanggaran }}')">
                                                    <i class="bi bi-pencil"></i>
                                                </button>

                                                <!-- Tombol Hapus -->
                                                <button type="button" class="btn btn-outline-danger"
                                                    onclick="confirmDelete({{ $plgrn->id }})">
                                                    <i class="bi bi-trash"></i>
                                                </button>

                                                <!-- Form Hapus (Tersembunyi) -->
                                                <form id="delete-form-{{ $plgrn->id }}"
                                                    action="{{ route('pelanggaran.destroy', $plgrn->id) }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>

                                        <!-- Modal Edit (ID dinamis berdasarkan ID item) -->
                                        <div class="modal fade" id="updateModal-{{ $plgrn->id }}" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Ubah Pelanggaran</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form id="updateForm-{{ $plgrn->id }}" method="POST"
                                                        action="{{ route('pelanggaran.update', $plgrn->id) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label
                                                                    for="update_nama_pelanggaran_{{ $plgrn->id }}">Nama
                                                                    Pelanggaran</label>
                                                                <input type="text" class="form-control"
                                                                    id="update_nama_pelanggaran_{{ $plgrn->id }}"
                                                                    name="nama_pelanggaran" required>
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

    </main>
@endsection
@section('js')
    <script>
        function showUpdateModal(id, namaPelanggaran) {
            // Set action form untuk ID yang tepat
            const formAction = "pelanggaran/" + id;
            document.getElementById('updateForm-' + id).action = formAction;

            // Set nilai input nama pelanggaran yang akan diedit
            document.getElementById('update_nama_pelanggaran_' + id).value = namaPelanggaran;

            // Tampilkan modal berdasarkan ID unik
            var updateModal = new bootstrap.Modal(document.getElementById('updateModal-' + id));
            updateModal.show();
        }
    </script>
@endsection
