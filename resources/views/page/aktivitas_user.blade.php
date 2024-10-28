@extends('layouts.main')
@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Activity Log</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item active">Activity Log</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body table-responsive">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">User Activity Log</h5>
                                <div>
                                    <a href="{{ route('activityLogs.export') }}" class="btn btn-success">
                                        <i class="bi bi-file-earmark-excel"></i> Export to Excel
                                    </a>
                                </div>
                            </div>

                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        {{-- <th>No</th> --}}
                                        <th>User</th>
                                        <th>Action</th>
                                        <th>Description</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($activityLogs as $log)
                                        <tr>
                                            {{-- <td>{{ $loop }}</td> --}}
                                            <td>{{ $log->user->name ?? 'System' }}</td>
                                            <td>
                                                <span
                                                    class="
                                                        @if ($log->action === 'update') badge bg-warning
                                                        @elseif($log->action === 'delete') badge bg-danger
                                                        @elseif($log->action === 'create') badge bg-success @endif
                                                    ">
                                                    {{ ucfirst($log->action) }}
                                                </span>

                                            </td>
                                            <td>{{ $log->description }}</td>
                                            <td>{{ $log->created_at->timezone('Asia/Jayapura')->format('Y-m-d H:i:s') }}
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
