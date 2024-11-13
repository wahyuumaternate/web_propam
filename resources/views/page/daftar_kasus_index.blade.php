@extends('layouts.main', ['title' => 'Daftar Kasus'])
@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Daftar Kasus</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item active">Daftar Kasus</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body table-responsive">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">List Anggota Yang Melakukan Pelanggaran</h5>
                                <div>
                                    <a href="{{ route('kasus.export') }}" class="btn btn-success">
                                        <i class="bi bi-file-earmark-excel"></i>
                                    </a>
                                    <a href="{{ route('daftarKasus.create') }}" class="btn btn-primary">
                                        <i class="bi bi-plus-lg"></i>
                                    </a>
                                </div>
                            </div>

                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Pangkat</th>
                                        <th>NRP</th>
                                        <th>Satker</th>
                                        <th>Pelanggaran</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($daftarKasus as $kasus)
                                        <tr>
                                            <td>{{ $kasus->nama }}</td>
                                            <td>{{ $kasus->pangkat->nama_pangkat }}</td>
                                            <td>{{ $kasus->nrp }}</td>
                                            <td>{{ $kasus->satkerSatwil->nama_satker_satwil }}</td>
                                            <td>{{ $kasus->kategori->nama_kategori }}</td>
                                            <td>
                                                <select class="form-select" id="statusDropdown-{{ $kasus->id }}"
                                                    onchange="updateStatus({{ $kasus->id }})">
                                                    @foreach ($statuses as $status)
                                                        <option value="{{ $status->id }}"
                                                            {{ $kasus->status_id == $status->id ? 'selected' : '' }}>
                                                            {{ $status->nama_status }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <a href="{{ route('daftarKasus.edit', $kasus->id) }}"
                                                    class="btn btn-warning"><i class="bi bi-pencil"></i></a>
                                                <form id="delete-form-{{ $kasus->id }}"
                                                    action="{{ route('kasus.destroy', $kasus->id) }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>

                                                <button onclick="confirmDelete({{ $kasus->id }})"
                                                    class="btn btn-danger"><i class="bi bi-trash"></i></button>
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
        function updateStatus(kasusId) {
            // Get the selected status from the specific dropdown
            const statusId = document.getElementById(`statusDropdown-${kasusId}`).value;

            // Send an AJAX request to update the status
            fetch(`/dashboard/kasus/update-status/${kasusId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // CSRF token for security
                    },
                    body: JSON.stringify({
                        status_id: statusId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Show a success message using SweetAlert
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Status updated successfully!',
                            timer: 1000,
                            showConfirmButton: false
                        });
                    } else {
                        // Show an error message using SweetAlert
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to update status.',
                            timer: 1000,
                            showConfirmButton: false
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Show an error message using SweetAlert
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An unexpected error occurred.',
                        timer: 2000,
                        showConfirmButton: false
                    });
                });
        }
    </script>
@endsection
