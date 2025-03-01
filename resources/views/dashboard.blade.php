@extends('layouts.main')
@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h5 class="card-title">Total Kasus</h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-card-list"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ $totalKasus }}</h6>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card sales-card">

                        <div class="card-body">
                            <h5 class="card-title">Lihat Grafik Pertahun</h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-bar-chart"></i>
                                </div>
                                <div class="ps-3">

                                    <div class="col-12">
                                        <form method="GET" action="{{ route('dashboard') }}">
                                            {{-- <label for="year">Lihat Berdasarkan Tahun :</label> --}}
                                            <div class="dropdown">
                                                <button class="btn btn-outline-primary dropdown-toggle" type="button"
                                                    id="yearDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Grafik Tahun {{ $selectedYear }}
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="yearDropdown">
                                                    @foreach ($availableYears as $year)
                                                        <li>
                                                            <a href="#" class="dropdown-item"
                                                                onclick="document.getElementById('year-input').value = '{{ $year }}'; this.closest('form').submit();">
                                                                Lihat Grafik Kasus Pada Tahun {{ $year }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <input type="hidden" name="year" id="year-input"
                                                value="{{ $selectedYear }}">
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Year Selector -->

                <div class="col-xxl-4 col-md-6">
                    <!-- Top Selling -->
                    <div class="col-12">
                        <div class="card top-selling overflow-auto">
                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                        class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>
                                    <li><a class="dropdown-item" href="?filter=month">This Month</a></li>
                                    <li><a class="dropdown-item" href="?filter=year">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body pb-0">
                                <h5 class="card-title">Top Kasus <span>|
                                        {{ $filter == 'month' ? 'This Month' : ($filter == 'year' ? 'This Year' : 'All Time') }}</span>
                                </h5>

                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th scope="col">Kategori</th>
                                            <th scope="col" class="text-center">Total Kasus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($topKasusCategories as $category)
                                            <tr>
                                                <td>{{ $category->kategori_nama }}</td>
                                                <td class="fw-bold text-center">{{ $category->total }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!-- End Top Selling -->
                </div>


                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">

                        <!-- Line Chart for Violations per Month -->
                        <div class="col-lg-11">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Kasus Berdasarkan Pelanggaran per Bulan untuk Tahun
                                        {{ $selectedYear }}</h5>

                                    <!-- Line Chart -->
                                    <div id="violationsChart"></div>

                                    <script>
                                        document.addEventListener("DOMContentLoaded", () => {
                                            const chartData = @json($chartData);
                                            const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                                                'October', 'November', 'December'
                                            ];

                                            new ApexCharts(document.querySelector("#violationsChart"), {
                                                series: chartData,
                                                chart: {
                                                    height: 350,
                                                    type: 'line',
                                                    toolbar: {
                                                        show: false
                                                    }
                                                },
                                                xaxis: {
                                                    categories: months,
                                                    title: {
                                                        text: 'Bulan'
                                                    }
                                                },
                                                yaxis: {
                                                    title: {
                                                        text: 'Jumlah Kasus'
                                                    }
                                                },
                                                stroke: {
                                                    curve: 'smooth',
                                                    width: 2
                                                },
                                                colors: ['#ff4560', '#008ffb', '#00e396'],
                                                tooltip: {
                                                    x: {
                                                        format: 'MMM'
                                                    }
                                                }
                                            }).render();
                                        });
                                    </script>
                                    <!-- End Line Chart -->

                                </div>
                            </div>
                        </div><!-- End Line Chart -->

                        <!-- Bar Chart for Cases by Status -->
                        <div class="col-lg-11">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Kasus Berdasarkan Status Tahun {{ $selectedYear }}</h5>

                                    <!-- Bar Chart -->
                                    <div id="statusBarChart"></div>

                                    <script>
                                        document.addEventListener("DOMContentLoaded", () => {
                                            const chartLabels = @json($statusChartData['labels']);
                                            const chartCounts = @json($statusChartData['counts']);

                                            new ApexCharts(document.querySelector("#statusBarChart"), {
                                                series: [{
                                                    name: 'Kasus',
                                                    data: chartCounts
                                                }],
                                                chart: {
                                                    type: 'bar',
                                                    height: 350
                                                },
                                                plotOptions: {
                                                    bar: {
                                                        horizontal: false,
                                                        columnWidth: '50%',
                                                        endingShape: 'rounded'
                                                    },
                                                },
                                                dataLabels: {
                                                    enabled: true
                                                },
                                                stroke: {
                                                    show: true,
                                                    width: 2,
                                                    colors: ['transparent']
                                                },
                                                xaxis: {
                                                    categories: chartLabels
                                                },
                                                yaxis: {
                                                    title: {
                                                        text: 'jumlah kasus'
                                                    }
                                                },
                                                fill: {
                                                    opacity: 1
                                                },
                                                tooltip: {
                                                    y: {
                                                        formatter: function(val) {
                                                            return val + " Kasus"
                                                        }
                                                    }
                                                }
                                            }).render();
                                        });
                                    </script>
                                    <!-- End Bar Chart -->

                                </div>
                            </div>
                        </div><!-- End Bar Chart -->



                    </div>
                </div><!-- End Left side columns -->

            </div>
        </section>

    </main><!-- End #main -->
@endsection
