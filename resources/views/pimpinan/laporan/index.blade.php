@extends('pimpinan.layouts.app')

@section('content')
    <!-- CSS Khusus Halaman Laporan Eksekutif Pimpinan -->
    <style>
        .report-card {
            background-color: #FFFFFF;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(8, 31, 92, 0.05);
            padding: 30px;
        }

        .report-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            border-bottom: 2px solid #e1ecfd;
            padding-bottom: 15px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .report-header h3 {
            margin: 0;
            font-size: 20px;
            color: #081F5C;
            font-weight: 700;
        }

        .report-badge {
            background-color: #081F5C;
            color: #FFFFFF;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
        }

        /* Container khusus agar tabel data banyak tidak merusak layout */
        .table-responsive-container {
            overflow-x: auto;
            width: 100%;
            border: 1px solid #eef2f6;
            border-radius: 8px;
            background-color: #ffffff;
        }

        .executive-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
            min-width: 1200px; /* Memastikan kolom data berjarak ideal saat di-scroll */
        }

        .executive-table th {
            background-color: #f4f7fc;
            color: #081F5C;
            padding: 14px 12px;
            font-weight: 600;
            border-bottom: 2px solid #e1ecfd;
            text-align: left;
            white-space: nowrap;
        }

        .executive-table td {
            padding: 12px;
            border-bottom: 1px solid #eeeeee;
            color: #333333;
            vertical-align: top;
            line-height: 1.4;
        }

        .executive-table tr:hover {
            background-color: #f9fbfd;
        }

        /* Pembatasan lebar teks panjang agar tetap proporsional */
        .text-truncate-custom {
            max-width: 200px;
            word-wrap: break-word;
            white-space: normal;
        }

        /* Komponen Badge Status Data */
        .status-pill {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-align: center;
            white-space: nowrap;
        }

        .status-baru { background-color: #e8f0fe; color: #1a73e8; }
        .status-proses { background-color: #feefe3; color: #b06000; }
        .status-selesai { background-color: #e6f4ea; color: #137333; }
    </style>

    <div class="report-card">
        <!-- Header Dokumen Laporan -->
        <div class="report-header">
            <h3>Rekapitulasi Laporan Konsultasi</h3>
            <div class="report-badge">
                Total Arsip: <strong>{{ $laporan->count() }} Dokumen</strong>
            </div>
        </div>

        <!-- Tabel Data Utama dengan Fitur Scroll Horizontal -->
        <div class="table-responsive-container">
            <table class="executive-table">
                <thead>
                    <tr>
                        <th style="width: 50px; text-align: center;">No</th>
                        <th>No. Tiket</th>
                        <th>Tanggal</th>
                        <th>Nama Lengkap</th>
                        <th>Pelaku Usaha</th>
                        <th>Perusahaan / Instansi</th>
                        <th>Tujuan Konsultasi</th>
                        <th>Permasalahan</th>
                        <th>Solusi / Tindakan</th>
                        <th>Pegawai Penanggung Jawab</th>
                        <th style="width: 100px; text-align: center;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($laporan as $item)
                        <tr>
                            <td style="text-align: center;"><strong>{{ $loop->iteration }}</strong></td>
                            <td><span style="color: #081F5C; font-weight: 600;">{{ $item->kode_tiket }}</span></td>
                            <td style="white-space: nowrap;">
                                📅 {{ date('d-m-Y', strtotime($item->tanggal_konsultasi)) }}
                            </td>
                            <td><strong>{{ $item->nama_lengkap }}</strong></td>
                            <td>{{ $item->pelaku_usaha }}</td>
                            <td>{{ $item->nama_perusahaan_instansi }}</td>
                            <td>
                                <span style="background-color: #f0f4f8; padding: 4px 8px; border-radius: 4px; font-weight: 500; color: #081F5C;">
                                    {{ $item->tujuan->tujuan_konsultasi }}
                                </span>
                            </td>
                            <td>
                                <div class="text-truncate-custom" style="color: #555555;">
                                    {{ $item->permasalahan }}
                                </div>
                            </td>
                            <td>
                                <div class="text-truncate-custom" style="font-style: {{ $item->solusi ? 'normal' : 'italic' }}; color: {{ $item->solusi ? '#333333' : '#999999' }};">
                                    {{ $item->solusi ?? 'Belum ada tindak lanjut' }}
                                </div>
                            </td>
                            <td>
                                @if($item->pegawai)
                                    <strong>👤 {{ $item->pegawai->nama_pegawai }}</strong>
                                @else
                                    <span style="color: #999999; font-style: italic;">-</span>
                                @endif
                            </td>
                            <td style="text-align: center;">
                                @if($item->status == 'Belum Eskalasi')
                                    <span class="status-pill status-baru">Belum Eskalasi</span>
                                @elseif($item->status == 'Eskalasi')
                                    <span class="status-pill status-proses">Eskalasi</span>
                                @else
                                    <span class="status-pill status-selesai">Selesai</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" style="text-align: center; padding: 40px; color: #999999; font-style: italic;">
                                Belum ada riwayat data laporan konsultasi masuk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection