@extends('layouts.main', ['title' => 'Daftar SKHP'])
@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Daftar SKHP (Surat Keterangan Hasil Pemeriksaan)</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item active">Daftar SKHP</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body table-responsive">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">List Anggota yang Memiliki SKHP</h5>
                                <div>
                                    <a href="{{ route('skhp.create') }}" class="btn btn-primary">
                                        <i class="bi bi-plus-lg"></i> Tambah SKHP
                                    </a>
                                </div>
                            </div>

                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Pangkat / NRP / NIP</th>
                                        <th>Instansi</th>
                                        <th>Jabatan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($skhpList as $skhp)
                                        <tr>
                                            <td>{{ $skhp->nama }}</td>
                                            <td>{{ $skhp->pangkat->nama_pangkat }} / {{ $skhp->nrp_nip }}</td>
                                            <td>{{ $skhp->kesatuan_instansi }}</td>
                                            <td>{{ $skhp->jabatan }}</td>
                                            <td>
                                                <!-- Tombol Download PDF -->
                                                <a href="{{ route('skhp.download', $skhp->id) }}" target="blank"
                                                    class="btn btn-primary">
                                                    <i class="bi bi-file-earmark-pdf"></i> PDF
                                                </a>
                                                <a href="{{ route('skhp.edit', $skhp->id) }}" class="btn btn-warning"><i
                                                        class="bi bi-pencil"></i></a>
                                                <form id="delete-form-{{ $skhp->id }}"
                                                    action="{{ route('skhp.destroy', $skhp->id) }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <button onclick="confirmDelete({{ $skhp->id }})"
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

{{-- @section('js')
    <script>
        function updateStatus(skhpId) {
            // Get the selected status from the specific dropdown
            const statusId = document.getElementById(`statusDropdown-${skhpId}`).value;

            // Send an AJAX request to update the status
            fetch(`/dashboard/skhp/update-status/${skhpId}`, {
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

        function confirmDelete(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This action cannot be undone.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }
    </script>
@endsection --}}
