@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="mb-3">
            <h4>Dashboard</h4>
        </div>

        <div class="d-flex flex-wrap">
            <!-- Uang Masuk -->
            <div class="card flex-fill border-0 m-2" style="min-width: 300px;">
                <div class="card-body py-4">
                    <div class="d-flex align-items-start">
                        <div class="flex-grow-1">
                            <h4 class="mb-2">
                                <i class="fa-solid fa-money-bill-trend-up"></i>
                                <a href="{{ route('enter.index') }}">
                                 Uang Masuk
                                </a>
                            </h4>
                            <p class="mb-2">
                                Bulan {{ date('F') }}
                            </p>
                            <div class="mb-0">
                                <span class="badge text-success me-2">
                                    <i class="fa-solid fa-arrow-up"></i> {{ $moneyIn }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Uang Keluar -->
            <div class="card flex-fill border-0 m-2" style="min-width: 300px;">
                <div class="card-body py-4">
                    <div class="d-flex align-items-start">
                        <div class="flex-grow-1">
                            <h4 class="mb-2">
                                <i class="fa-solid fa-money-bill"></i> 
                                <a href="{{ route('out.index') }}">
                                Uang Keluar
                            </a>
                            </h4>
                            <p class="mb-2">
                                Bulan {{ date('F') }}
                            </p>
                            <div class="mb-0">
                                <span class="badge text-danger me-2">
                                    <i class="fa-solid fa-arrow-down mx-2"></i> {{ $moneyOut }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total -->
            <div class="card flex-fill border-0 m-2" style="min-width: 300px;">
                <div class="card-body py-4">
                    <div class="d-flex align-items-start">
                        <div class="flex-grow-1">
                            <h4 class="mb-2">
                                <i class="fa-solid fa-scale-balanced"></i> Total
                            </h4>
                            <p class="mb-2">
                                Bulan {{ date(format: 'F') }}
                            </p>
                            <div class="mb-0">
                                <span class="badge text-danger me-2">
                                    <i class="fa-solid fa-arrow-down mx-2"></i> {{ $total }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Download Excel -->
            <div class="card flex-fill border-0 m-2" style="min-width: 300px;">
                <div class="card-body py-4">
                    <div class="d-flex align-items-start">
                        <div class="flex-grow-1">
                            <h4 class="mb-2">
                                <i class="fa-solid fa-file-excel"></i> Download Excel
                            </h4>
                            <p class="mb-2">
                                Bulan {{ date('F') }}
                            </p>
                            <div class="mb-0">
                                <a href="{{ route('enter-out-export') }}" class="btn btn-success">Download</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex flex-wrap">
            <!-- Chart -->
            <div class="card flex-fill border-0 m-2" style="min-width: 300px;">
                <div class="card-body py-4">
                    <canvas id="enterOutChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        fetch("{{ url('/api/enter-out') }}")
            .then(response => response.json())
            .then(data => {
                const labels = data.enter.map(item => item.name);
                const enterData = data.enter.map(item => item.balance);
                const outData = data.out.map(item => item.balance);
    
                const ctx = document.getElementById('enterOutChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [
                            {
                                label: 'Uang Masuk',
                                data: enterData,
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'Uang Keluar',
                                data: outData,
                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
    });
    </script>
@endsection
