@extends('admin.layouts.admin')

@section('content')
    <!-- CSS Tambahan Khusus untuk Elemen Form Halaman Ini -->
    <style>
        .content-card {
            background-color: #FFFFFF;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(8, 31, 92, 0.05);
            padding: 30px;
            max-width: 600px; /* Dibatasi agar tampilan form tidak terlalu lebar */
            margin: 0 auto; /* Posisi di tengah halaman */
        }

        .content-title-area {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
            border-bottom: 1px solid #eeeeee;
            padding-bottom: 14px;
        }

        .content-title-area h3 {
            margin: 0;
            font-size: 20px;
            color: #081F5C;
            font-weight: 700;
        }

        .btn-back {
            color: #081F5C;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: color 0.2s;
        }

        .btn-back:hover {
            color: #05133b;
            text-decoration: underline;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 22px;
        }

        .form-group label {
            color: #000000;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .form-group input, 
        .form-group textarea {
            padding: 12px 14px;
            border: 1px solid #cccccc;
            border-radius: 8px;
            font-size: 14px;
            background-color: #f9f9f9;
            color: #000000;
            outline: none;
            transition: all 0.2s ease;
            box-sizing: border-box;
            width: 100%;
            font-family: inherit;
        }

        .form-group input:focus, 
        .form-group textarea:focus {
            border-color: #081F5C;
            background-color: #ffffff;
            box-shadow: 0 0 0 3px rgba(8, 31, 92, 0.15);
        }

        .form-group textarea {
            resize: none;
        }

        .btn-container {
            margin-top: 10px;
            text-align: right;
        }

        .btn-submit {
            background-color: #081F5C;
            color: #FFFFFF;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s, transform 0.1s;
            box-shadow: 0 4px 10px rgba(8, 31, 92, 0.2);
            display: inline-block;
        }

        .btn-submit:hover {
            background-color: #05133b;
        }

        .btn-submit:active {
            transform: scale(0.98);
        }
    </style>

    <div class="content-card">
        <!-- Kepala Form -->
        <div class="content-title-area">
            <h3>Tambah Sub Bagian</h3>
            <a href="/admin/sub-bagian" class="btn-back">
                ← Kembali ke Data
            </a>
        </div>

        <!-- Form Input -->
        <form action="/admin/sub-bagian" method="POST">
            @csrf

            <!-- Input Nama Sub Bagian -->
            <div class="form-group">
                <label for="nama_sub_bagian">Nama Sub Bagian</label>
                <input type="text" id="nama_sub_bagian" name="nama_sub_bagian" placeholder="Contoh: Tata Usaha, Keuangan" required autocomplete="off">
            </div>

            <!-- Tombol Aksi -->
            <div class="btn-container">
                <button type="submit" class="btn-submit">
                    Simpan Data
                </button>
            </div>

        </form>
    </div>
@endsection