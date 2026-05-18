@extends('admin.layouts.admin')

@section('content')
    <!-- CSS Tambahan Khusus untuk Elemen Filter & Laporan -->
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

        /* Grouping Action Top (Filter & PDF Button) */
        .action-wrapper {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-bottom: 25px;
            background-color: #f8fafc;
            padding: 20px;
            border-radius: 10px;
            border: 1px solid #eef2f6;
        }

        /* Inline Filter Form */
        .filter-form {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            align-items: flex-end;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            min-width: 160px;
            flex: 1;
        }

        .filter-group label {
            font-size: 13px;
            color: #000000;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .filter-group input,
        .filter-group select {
            padding: 10px 12px;
            border: 1px solid #cccccc;
            border-radius: 6px;
            font-size: 14px;
            background-color: #ffffff;
            color: #333333;
            outline: none;
            transition: all 0.2s ease;
            box-sizing: border-box;
            width: 100%;
        }

        .filter-group input:focus,
        .filter-group select:focus {
            border-color: #081F5C;
            box-shadow: 0 0 0 3px rgba(8, 31, 92, 0.1);
        }

        /* Action Buttons */
        .btn-filter {
            background-color: #081F5C;
            color: #FFFFFF;
            border: none;
            padding: 11px 22px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
            height: 40px;
        }

        .btn-filter:hover {
            background-color: #05133b;
        }

        .btn-pdf {
            background-color: #fce8e6;
            color: #c5221f;
            border: 1px solid #fad2cf;
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
            align-self: flex-start;
        }

        .btn-pdf:hover {
            background-color: #fad2cf;
        }

        /* Modern Table Design & Alignment */
        .table-responsive {
            overflow-x: auto;
            width: 100%;
        }

        .modern-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        /* Penyelarasan TH & TD: Sejajar kiri, presisi tinggi */
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
            vertical-align: top; /* Cocok untuk teks deskripsi panjang seperti solusi/masalah */
            text-align: left;
        }

        /* Batasi lebar teks dinamis agar tidak merusak struktur tabel */
        .text-truncate-custom {
            max-width: 200px;
            white-space: normal;
            word-wrap: break-word;
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

        @media (max-width: 768px) {
            .filter-form {
                flex-direction: column;
                align-items: stretch;
            }
            .btn-filter {
                width: 100%;
            }
        }
    </style>

    <div class="content-card">
        <!-- Kepala Halaman Konten -->
        <div class="content-title-area">
            <h3>Laporan Konsultasi</h3>
        </div>

        <!-- Blok Filter & Export (Satu Area) -->
        <div class="action-wrapper">
            <form method="GET" class="filter-form">
                <div class="filter-group">
                    <label for="tanggal_awal">Tanggal Awal</label>
                    <input type="date" id="tanggal_awal" name="tanggal_awal" value="{{ request('tanggal_awal') }}">
                </div>

                <div class="filter-group">
                    <label for="tanggal_akhir">Tanggal Akhir</label>
                    <input type="date" id="tanggal_akhir" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}">
                </div>

                <div class="filter-group">
                    <label for="status">Status</label>
                    <select id="status" name="status">
                        <option value="">Semua Status</option>
                        <option value="Baru" {{ request('status') == 'Baru' ? 'selected' : '' }}>Baru</option>
                        <option value="Diproses" {{ request('status') == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>

                <button type="submit" class="btn-filter">
                    Filter Data
                </button>
            </form>

            <!-- Tombol Cetak PDF -->
            <a href="/admin/laporan/pdf?tanggal_awal={{ request('tanggal_awal') }}&tanggal_akhir={{ request('tanggal_akhir') }}&status={{ request('status') }}" class="btn-pdf">
                📄 Export Dokumen PDF
            </a>
        </div>

        <!-- Struktur Tabel Data -->
        <div class="table-responsive">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>No Tiket</th>
                        <th>Tanggal</th>
                        <th>Nama Lengkap</th>
                        <th>Permasalahan</th>
                        <th>Solusi</th>
                        <th>Nama Pegawai</th>
                        <th style="width: 100px;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($laporan as $item)
                        <tr>
                            <td><strong>{{ $loop->iteration }}</strong></td>
                            <td><span style="color: #081F5C; font-weight: 600;">{{ $item->kode_tiket }}</span></td>
                            <td style="white-space: nowrap;">{{ date('d-m-Y', strtotime($item->tanggal_konsultasi)) }}</td>
                            <td><strong>{{ $item->nama_lengkap }}</strong></td>
                            <td>
                                <div class="text-truncate-custom">{{ $item->permasalahan }}</div>
                            </td>
                            <td>
                                <div class="text-truncate-custom">{{ $item->solusi ?? '-' }}</div>
                            </td>
                            <td>{{ $item->pegawai->nama_pegawai ?? '-' }}</td>
                            <td>
                                @if($item->status == 'Baru')
                                    <span class="badge-status status-baru">Baru</span>
                                @elseif($item->status == 'Diproses')
                                    <span class="badge-status status-proses">Diproses</span>
                                @else
                                    <span class="badge-status status-selesai">Selesai</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" style="text-align: center; padding: 30px; color: #999999;">
                                Tidak ada data laporan yang sesuai dengan kriteria filter.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection