@extends('pimpinan.layouts.app')

@section('content')
    <!-- CSS Khusus Penyerasian Tema Dashboard Analitik Admin -->
    <style>
        .analytics-title {
            color: #081F5C;
            font-weight: 700;
            font-size: 26px;
            margin: 0;
        }

        .analytics-subtitle {
            color: #555555;
            font-size: 14px;
            margin: 4px 0 0 0;
        }

        /* Card Wrapper Utama */
        .card-panel {
            background-color: #FFFFFF;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(8, 31, 92, 0.06);
            padding: 24px;
            box-sizing: border-box;
        }

        /* Penataan Counter Box (Top Row) */
        .counter-grid {
            display: grid;
            grid-template-columns: repeat(1, minmax(0, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        @media (min-width: 768px) {
            .counter-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        .counter-card {
            background-color: #FFFFFF;
            border-radius: 12px;
            padding: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 15px rgba(8, 31, 92, 0.05);
            border-left: 5px solid #081F5C;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .counter-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(8, 31, 92, 0.1);
        }

        .counter-label {
            color: #666666;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            margin: 0;
        }

        .counter-value {
            color: #081F5C;
            font-size: 32px;
            font-weight: 700;
            margin: 6px 0 0 0;
        }

        .counter-icon-box {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        /* Penataan Grafik Grid (Middle Row) */
        .chart-grid {
            display: grid;
            grid-template-columns: repeat(1, minmax(0, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        @media (min-width: 1024px) {
            .chart-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        .chart-card-title {
            margin: 0 0 15px 0;
            font-size: 15px;
            color: #081F5C;
            font-weight: 700;
            text-align: center;
            border-bottom: 1px solid #e1ecfd;
            padding-bottom: 10px;
        }

        .chart-container-box {
            height: 280px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Tabel Data Responsif */
        .table-section-title {
            margin: 0;
            font-size: 16px;
            color: #081F5C;
            font-weight: 700;
        }

        .table-container-responsive {
            overflow-x: auto;
            width: 100%;
            border: 1px solid #eef2f6;
            border-radius: 8px;
            margin-top: 15px;
        }

        .dashboard-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
            min-width: 900px;
        }

        .dashboard-table th {
            background-color: #f4f7fc;
            color: #081F5C;
            padding: 12px 16px;
            font-weight: 600;
            text-align: left;
            border-bottom: 2px solid #e1ecfd;
        }

        .dashboard-table td {
            padding: 12px 16px;
            border-bottom: 1px solid #eeeeee;
            color: #333333;
        }

        .dashboard-table tr:hover {
            background-color: #f9fbfd;
        }

        /* Badges */
        .status-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-align: center;
        }
        .badge-baru { background-color: #fce8e6; color: #c5221f; }
        .badge-proses { background-color: #feefe3; color: #b06000; }
        .badge-selesai { background-color: #e6f4ea; color: #137333; }
    </style>

    <!-- Header Dokumen Dashboard -->
    <div style="margin-bottom: 25px;">
        <h1 class="analytics-title">Dashboard Analitik</h1>
        <p class="analytics-subtitle">Ringkasan berkas data tamu dan statistik rekapitulasi konsultasi</p>
    </div>

    <!-- ROW 1: BOX COUNTER STATISTIK -->
    <div class="counter-grid">
        <!-- Card 1: Total Registrasi -->
        <div class="counter-card" style="border-left-color: #1a73e8;">
            <div>
                <p class="counter-label">Total Konsultasi</p>
                <h2 class="counter-value">{{ $totalTamu }}</h2>
            </div>
            <div class="counter-icon-box" style="background-color: #e8f0fe; color: #1a73e8;">
                <i class="fas fa-users"></i>
            </div>
        </div>

        <!-- Card 2: Tamu Selesai -->
        <div class="counter-card" style="border-left-color: #137333;">
            <div>
                <p class="counter-label">Konsultasi Selesai</p>
                <h2 class="counter-value">{{ $tamuSelesai }}</h2>
            </div>
            <div class="counter-icon-box" style="background-color: #e6f4ea; color: #137333;">
                <i class="fas fa-check"></i>
            </div>
        </div>

        <!-- Card 3: Menunggu Solusi -->
        <div class="counter-card" style="border-left-color: #b06000;">
            <div>
                <p class="counter-label">Menunggu Solusi</p>
                <h2 class="counter-value">{{ $tamuPending }}</h2>
            </div>
            <div class="counter-icon-box" style="background-color: #feefe3; color: #b06000;">
                <i class="fas fa-clock"></i>
            </div>
        </div>
    </div>

    <!-- ROW 2: GRAFIK DIAGRAM PERSENTASE -->
    <div class="chart-grid">
        <!-- Chart 1: Persentase Status Tamu -->
        <div class="card-panel">
            <h3 class="chart-card-title">Persentase Status Konsultasi</h3>
            <div class="chart-container-box">
                <canvas id="statusChart"></canvas>
            </div>
        </div>

        <!-- Chart 2: Persentase Tujuan Konsultasi -->
        <div class="card-panel">
            <h3 class="chart-card-title">Persentase Tujuan Konsultasi</h3>
            <div class="chart-container-box">
                <canvas id="tujuanChart"></canvas>
            </div>
        </div>

        <!-- Chart 3: Distribusi Sub Bagian -->
        <div class="card-panel">
            <h3 class="chart-card-title">Distribusi Sub Bagian</h3>
            <div class="chart-container-box">
                <canvas id="subBagianChart"></canvas>
            </div>
        </div>
    </div>

    <!-- ROW 3: DAFTAR TAMU TERBARU (TABLE LIST) -->
    <div class="card-panel">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h3 class="table-section-title">Daftar Tamu Terbaru</h3>
            <span style="font-size: 12px; font-weight: 600; padding: 4px 12px; border-radius: 20px; background-color: #e8f0fe; color: #081F5C;">
                📋 5 Tamu Terakhir
            </span>
        </div>
        
        <div class="table-container-responsive">
            <table class="dashboard-table">
                <thead>
                    <tr>
                        <th>Kode Tiket</th>
                        <th>Nama Lengkap</th>
                        <th>Instansi / Perusahaan</th>
                        <th>Tujuan Konsultasi</th>
                        <th>Petugas Pembimbing</th>
                        <th style="text-align: center; width: 110px;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tamuTerbaru ?? [] as $tamu)
                        <tr>
                            <td><strong style="color: #081F5C; font-family: monospace;">{{ $tamu->kode_tiket }}</strong></td>
                            <td>
                                <strong style="color: #111111;">{{ $tamu->nama_lengkap }}</strong>
                                <div style="font-size: 11px; color: #777777; margin-top: 2px;">{{ $tamu->email }}</div>
                            </td>
                            <td>{{ $tamu->nama_perusahaan_instansi ?? '-' }}</td>
                            <td>{{ $tamu->tujuan->tujuan_konsultasi ?? '-' }}</td>
                            <td>
                                @if($tamu->pegawai)
                                    👤 {{ $tamu->pegawai->nama_pegawai }}
                                @else
                                    <span style="color: #999999; font-style: italic;">Belum Ditangani</span>
                                @endif
                            </td>
                            <td style="text-align: center;">
                                @if(strtolower($tamu->status) == 'Belum Eskalasi')
                                    <span class="status-badge badge-baru">Belum Eskalasi</span>
                                @elseif(strtolower($tamu->status) == 'Eskalasi')
                                    <span class="status-badge badge-proses">Eskalasi</span>
                                @elseif(strtolower($tamu->status) == 'Selesai')
                                    <span class="status-badge badge-selesai">Selesai</span>
                                @else
                                    <span class="status-badge" style="background-color: #e2e8f0; color: #4a5568;">{{ $tamu->status }}</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 30px; color: #999999; font-style: italic;">
                                📁 Belum ada data tamu yang tercatat hari ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Script Chart.js Terintegrasi -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Palet warna grafik serasi (Menggunakan base Navy & Biru pendukung)
        const themeColors = ['#081F5C', '#1a73e8', '#4ecde4', '#14b8a6', '#9675ce', '#fa8a60', '#ec4899', '#b2c0c6'];

        const chartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        boxWidth: 12,
                        padding: 12,
                        font: { size: 11, family: 'sans-serif' }
                    }
                }
            }
        };

        // 1. Pemrosesan Data Grafik Status Tamu
        const statusData = @json($statusChart);
        const statusCount = { 'belum eskalasi': 0, 'eskalasi': 0, 'selesai': 0 };
        statusData.forEach(item => {
            if(item.status) { statusCount[item.status.toLowerCase()] = item.total; }
        });

        new Chart(
            document.getElementById('statusChart'),
            {
                type: 'doughnut', /* Mengubah bentuk ke doughnut agar lebih modern */
                data: {
                    labels: ['belum eskalasi', 'eskalasi', 'selesai'],
                    datasets: [{
                        data: [statusCount['belum eskalasi'], statusCount['eskalasi'], statusCount['selesai']],
                        backgroundColor: ['#EF4444', '#F59E0B', '#10B981'],
                        borderWidth: 2,
                        borderColor: '#ffffff'
                    }]
                },
                options: {
                    ...chartOptions,
                    plugins: {
                        ...chartOptions.plugins,
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    let value = context.raw || 0;
                                    let total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    let percentage = total > 0 ? ((value / total) * 100).toFixed(1) : 0;
                                    return ` ${label}: ${value} (${percentage}%)`;
                                }
                            }
                        }
                    }
                }
            }
        );

        // 2. Pemrosesan Data Grafik Tujuan Konsultasi
        const tujuanData = @json($tujuanChart);
        const tujuanLabel = tujuanData.map(item => item.tujuan_konsultasi);
        const tujuanCount = tujuanData.map(item => item.tamu_count);

        new Chart(
            document.getElementById('tujuanChart'),
            {
                type: 'pie',
                data: {
                    labels: tujuanLabel,
                    datasets: [{ data: tujuanCount, backgroundColor: themeColors, borderWidth: 2, borderColor: '#ffffff' }]
                },
                options: chartOptions
            }
        );

        // 3. Pemrosesan Data Grafik Sub Bagian
        const subData = @json($subBagianChart);
        const subLabel = subData.map(item => item.nama_sub_bagian);
        const subCount = subData.map(item => item.total_tamu);

        new Chart(
            document.getElementById('subBagianChart'),
            {
                type: 'pie',
                data: {
                    labels: subLabel,
                    datasets: [{ data: subCount, backgroundColor: themeColors, borderWidth: 2, borderColor: '#ffffff' }]
                },
                options: chartOptions
            }
        );
    </script>
@endsection