@extends('admin.layouts.admin')

@section('content')
    <!-- Pustaka Chart.js untuk Grafik -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- CSS Tambahan Khusus untuk Elemen Dashboard -->
    <style>
        .dashboard-container {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        /* Grid Sistem untuk Statistik / Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        }

        .stat-card {
            background-color: #FFFFFF;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 4px 20px rgba(8, 31, 92, 0.05);
            border-left: 5px solid #081F5C;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: transform 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
        }

        .card-pelaku { border-left-color: #081F5C; }
        .card-tamu { border-left-color: #1a73e8; }
        .card-pegawai { border-left-color: #34a853; }

        .stat-header {
            font-size: 13px;
            font-weight: 700;
            color: #777777;
            text-transform: uppercase;
            margin-bottom: 10px;
            letter-spacing: 0.5px;
        }

        .stat-main-number {
            font-size: 32px;
            font-weight: 800;
            color: #081F5C;
            margin-bottom: 12px;
            line-height: 1;
        }

        .stat-details {
            border-top: 1px solid #f1f4f8;
            padding-top: 10px;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .stat-sub-item {
            font-size: 13px;
            color: #555555;
            display: flex;
            justify-content: space-between;
        }

        .stat-sub-item span.count {
            font-weight: 700;
            color: #081F5C;
        }

        /* Layout Area Grafik */
        .chart-section {
            background-color: #FFFFFF;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(8, 31, 92, 0.05);
        }

        .chart-header {
            margin-bottom: 20px;
        }

        .chart-header h4 {
            margin: 0;
            font-size: 18px;
            color: #081F5C;
            font-weight: 700;
        }

        .chart-header p {
            margin: 4px 0 0 0;
            font-size: 13px;
            color: #777777;
        }

        .chart-wrapper {
            position: relative;
            width: 100%;
            height: 350px;
        }
    </style>

    <div class="dashboard-container">

        <!-- Section 1: Blok Akumulasi Statistik Data -->
        <div class="stats-grid">
            
            <!-- Card 1: Data Pelaku Usaha & Instansi -->
            <div class="stat-card card-pelaku">
                <div>
                    <div class="stat-header">Total Pelaku Usaha / Instansi</div>
                    <div class="stat-main-number">
                        {{ $totalPelakuUsaha + $totalInstansiPemerintah }}
                    </div>
                </div>
                <div class="stat-details">
                    <div class="stat-sub-item">
                        <span>Pelaku Usaha:</span>
                        <span class="count">{{ $totalPelakuUsaha }}</span>
                    </div>
                    <div class="stat-sub-item">
                        <span>Instansi Pemerintah:</span>
                        <span class="count">{{ $totalInstansiPemerintah }}</span>
                    </div>
                </div>
            </div>

            <!-- Card 2: Total Konsultan / Tamu -->
            <div class="stat-card card-tamu">
                <div>
                    <div class="stat-header">Total Konsultan / Tamu</div>
                    <div class="stat-main-number">
                        {{ $totalTamu }}
                    </div>
                </div>
                <div class="stat-details">
                    <div class="stat-sub-item">
                        <span>Tamu Terlayani (Selesai):</span>
                        <span class="count">{{ $totalTamuSelesai }}</span>
                    </div>
                    <div class="stat-sub-item">
                        <span>Dalam Proses:</span>
                        <span class="count">{{ $totalTamuProses }}</span>
                    </div>
                </div>
            </div>

            <!-- Card 3: Jumlah Pegawai & Pimpinan -->
            <div class="stat-card card-pegawai">
                <div>
                    <div class="stat-header">Jumlah Pegawai / Staff</div>
                    <div class="stat-main-number">
                        {{ $totalPegawai + $totalPimpinan }}
                    </div>
                </div>
                <div class="stat-details">
                    <div class="stat-sub-item">
                        <span>Role Pegawai:</span>
                        <span class="count">{{ $totalPegawai }}</span>
                    </div>
                    <div class="stat-sub-item">
                        <span>Role Pimpinan:</span>
                        <span class="count">{{ $totalPimpinan }}</span>
                    </div>
                </div>
            </div>

        </div>

        <!-- Section 2: Grafik Jumlah Tamu Per Sub Bagian -->
        <div class="chart-section">
            <div class="chart-header">
                <h4>Grafik Jumlah Tamu yang Dilayani</h4>
                <p>Analisis kuantitas pelayanan konsultasi tamu berdasarkan per Sub Bagian pegawai</p>
            </div>
            
            <div class="chart-wrapper">
                <canvas id="subBagianChart"></canvas>
            </div>
        </div>

    </div>

    <!-- Script Inisialisasi Grafik Chart.js -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const ctx = document.getElementById('subBagianChart').getContext('2d');
            
            // Map data dari Eloquent Collection ke Array Javascript
            const labelSubBagian = {!! json_encode($grafikData->pluck('nama_sub_bagian')) !!};
            const jumlahTamu = {!! json_encode($grafikData->pluck('total_tamu')) !!};

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labelSubBagian,
                    datasets: [{
                        label: 'Jumlah Tamu Dilayani',
                        data: jumlahTamu,
                        backgroundColor: 'rgba(8, 31, 92, 0.85)',
                        borderColor: '#081F5C',
                        borderWidth: 1,
                        borderRadius: 6,
                        barPercentage: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: '#081F5C',
                            padding: 12,
                            cornerRadius: 8
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: '#f1f4f8' },
                            ticks: {
                                color: '#555555',
                                font: { size: 12 },
                                stepSize: 1
                            }
                        },
                        x: {
                            grid: { display: false },
                            ticks: {
                                color: '#000000',
                                font: { size: 13, weight: '600' }
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection