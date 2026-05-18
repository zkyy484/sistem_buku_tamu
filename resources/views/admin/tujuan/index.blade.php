@extends('admin.layouts.admin')

@section('content')
    <!-- CSS Tambahan Khusus untuk Elemen Tabel & Tombol Aksi Halaman Ini -->
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

        .btn-add {
            background-color: #081F5C;
            color: #FFFFFF;
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            transition: background 0.2s;
            box-shadow: 0 4px 10px rgba(8, 31, 92, 0.15);
        }

        .btn-add:hover {
            background-color: #05133b;
        }

        .alert-success {
            background-color: #e6f4ea;
            border-left: 4px solid #34a853;
            color: #137333;
            padding: 12px 16px;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 14px;
            font-weight: 500;
        }

        /* Modern Table Design */
        .table-responsive {
            overflow-x: auto;
            width: 100%;
        }

        .modern-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 14px;
        }

        .modern-table th {
            background-color: #f4f7fc;
            color: #081F5C;
            padding: 14px 16px;
            font-weight: 600;
            border-bottom: 2px solid #e1ecfd;
        }

        .modern-table td {
            padding: 14px 16px;
            border-bottom: 1px solid #eeeeee;
            color: #333333;
            vertical-align: middle;
        }

        .modern-table tr:hover {
            background-color: #f9fbfd;
        }

        /* Buttons Inside Table */
        .action-container {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .btn-table-action {
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            border: 1px solid transparent;
            transition: all 0.15s ease;
        }

        /* Status Aktif / Nonaktif */
        .btn-status-active {
            background-color: #e6f4ea;
            color: #137333;
            border-color: #c2e7cd;
        }
        .btn-status-active:hover {
            background-color: #d2e9d7;
        }

        .btn-status-inactive {
            background-color: #feefe3;
            color: #b06000;
            border-color: #fde2cd;
        }
        .btn-status-inactive:hover {
            background-color: #fcd7b9;
        }

        /* Edit & Delete */
        .btn-edit {
            background-color: #e8f0fe;
            color: #1a73e8;
            border-color: #d2e3fc;
        }
        .btn-edit:hover {
            background-color: #d2e3fc;
        }

        .btn-delete {
            background-color: #fce8e6;
            color: #c5221f;
            border-color: #fad2cf;
        }
        .btn-delete:hover {
            background-color: #fad2cf;
        }

        .inline-form {
            display: inline;
        }
    </style>

    <div class="content-card">
        <!-- Kepala Halaman Konten -->
        <div class="content-title-area">
            <h3>Data Tujuan Konsultasi</h3>
            <a href="/admin/tujuan-konsultasi/create" class="btn-add">
                + Tambah Data
            </a>
        </div>

        <!-- Notifikasi Sukses -->
        @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Struktur Tabel Data -->
        <div class="table-responsive">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Tujuan Konsultasi</th>
                        <th style="width: 140px;">Status</th>
                        <th style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tujuan as $item)
                        <tr>
                            <td><strong>{{ $loop->iteration }}</strong></td>
                            <td><strong>{{ $item->tujuan_konsultasi }}</strong></td>

                            <!-- Kolom Status Toggle -->
                            <td>
                                <form action="/admin/tujuan-status/{{ $item->id_tujuan }}" method="POST" class="inline-form">
                                    @csrf
                                    @method('PUT')

                                    @if ($item->is_active)
                                        <button type="submit" class="btn-table-action btn-status-active">
                                            Nonaktifkan
                                        </button>
                                    @else
                                        <button type="submit" class="btn-table-action btn-status-inactive">
                                            Aktifkan
                                        </button>
                                    @endif
                                </form>
                            </td>

                            <!-- Kolom Aksi Modifikasi -->
                            <td>
                                <div class="action-container">
                                    <a href="/admin/tujuan-konsultasi/{{ $item->id_tujuan }}/edit" class="btn-table-action btn-edit">
                                        Edit
                                    </a>

                                    <form action="/admin/tujuan-konsultasi/{{ $item->id_tujuan }}" method="POST" class="inline-form" onsubmit="return confirm('Apakah Anda yakin ingin menghapus tujuan konsultasi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-table-action btn-delete">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection