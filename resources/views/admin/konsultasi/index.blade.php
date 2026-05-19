@extends('admin.layouts.admin')

@section('content')
    <!-- CSS Tambahan Khusus untuk Elemen Data Konsultasi -->
    <style>
        .content-card {
            background-color: #FFFFFF;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(8, 31, 92, 0.05);
            padding: 30px;
        }

        .content-title-area {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .content-title-area h3 {
            margin: 0;
            font-size: 20px;
            color: #081F5C;
            font-weight: 700;
        }

        .data-count-badge {
            background-color: #e8f0fe;
            color: #1a73e8;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
        }

        /* Alert Box Sukses */
        .alert-success {
            background-color: #e6f4ea;
            color: #137333;
            border: 1px solid #ceead6;
            padding: 12px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            font-weight: 500;
        }

        /* Action Bar: Search Input inline */
        .action-wrapper {
            background-color: #f8fafc;
            padding: 16px 20px;
            border-radius: 10px;
            border: 1px solid #eef2f6;
            margin-bottom: 25px;
        }

        .search-form {
            display: flex;
            gap: 12px;
            max-width: 450px;
        }

        .search-input {
            flex-grow: 1;
            padding: 10px 14px;
            border: 1px solid #cccccc;
            border-radius: 6px;
            font-size: 14px;
            background-color: #ffffff;
            color: #333333;
            outline: none;
            transition: all 0.2s ease;
        }

        .search-input:focus {
            border-color: #081F5C;
            box-shadow: 0 0 0 3px rgba(8, 31, 92, 0.1);
        }

        .btn-search {
            background-color: #081F5C;
            color: #FFFFFF;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-search:hover {
            background-color: #05133b;
        }

        /* Modern Table Design (Penyelarasan TH & TD Sejajar Kiri) */
        .table-responsive {
            overflow-x: auto;
            width: 100%;
        }

        .modern-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        .modern-table th {
            background-color: #f4f7fc;
            color: #081F5C;
            padding: 14px 16px;
            font-weight: 600;
            border-bottom: 2px solid #e1ecfd;
            text-align: left;
            white-space: nowrap;
        }

        .modern-table td {
            padding: 14px 16px;
            border-bottom: 1px solid #eeeeee;
            color: #333333;
            text-align: left;
            vertical-align: middle;
        }

        .modern-table tr:hover {
            background-color: #f9fbfd;
        }

        /* Badge Status */
        .badge-status {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-align: center;
        }

        .status-baru { background-color: #e8f0fe; color: #1a73e8; }
        .status-proses { background-color: #feefe3; color: #b06000; }
        .status-selesai { background-color: #e6f4ea; color: #137333; }

        /* Tombol Aksi */
        .btn-detail {
            display: inline-block;
            background-color: #ffffff;
            color: #081F5C;
            border: 1px solid #081F5C;
            padding: 6px 14px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.2s;
        }

        .btn-detail:hover {
            background-color: #081F5C;
            color: #ffffff;
        }

        @media (max-width: 576px) {
            .search-form {
                flex-direction: column;
            }
            .btn-search {
                width: 100%;
            }
        }
    </style>

    <div class="content-card">
        <!-- Kepala Halaman Konten -->
        <div class="content-title-area">
            <h3>Data Konsultasi</h3>
            <div class="data-count-badge">
                Jumlah Data: <strong>{{ $konsultasi->count() }}</strong>
            </div>
        </div>

        <!-- Notifikasi Berhasil -->
        @if (session('success'))
            <div class="alert-success">
                🛈 {{ session('success') }}
            </div>
        @endif

        <!-- Filter Pencarian Data -->
        <div class="action-wrapper">
            <form method="GET" class="search-form">
                <input type="text" name="search" class="search-input" placeholder="Cari nama atau kode tiket..." value="{{ request('search') }}">
                <button type="submit" class="btn-search">
                    Cari Data
                </button>
            </form>
        </div>

        <!-- Struktur Tabel Data -->
        <div class="table-responsive">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th style="width: 60px;">No</th>
                        <th>Kode Tiket</th>
                        <th>Nama Lengkap</th>
                        <th>Tujuan Konsultasi</th>
                        <th style="width: 120px;">Status</th>
                        <th style="width: 100px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($konsultasi as $item)
                        <tr>
                            <td><strong>{{ $loop->iteration }}</strong></td>
                            <td><span style="color: #081F5C; font-weight: 600;">{{ $item->kode_tiket }}</span></td>
                            <td><strong>{{ $item->nama_lengkap }}</strong></td>
                            <td>{{ $item->tujuan->tujuan_konsultasi }}</td>
                            <td>
                                @if($item->status == 'Belum Eskalasi')
                                    <span class="badge-status status-baru">Belum Eskalasi</span>
                                @elseif($item->status == 'Eskalasi')
                                    <span class="badge-status status-proses">Eskalasi</span>
                                @else
                                    <span class="badge-status status-selesai">Selesai</span>
                                @endif
                            </td>
                            <td style="text-align: center;">
                                <a href="/admin/konsultasi/{{ $item->id_tamu }}" class="btn-detail">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 30px; color: #999999;">
                                Tidak ada data konsultasi yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection