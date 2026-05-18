@extends('admin.layouts.admin')

@section('content')
    <!-- CSS Tambahan Khusus untuk Elemen Form Halaman Ini -->
    <style>
        .content-card {
            background-color: #FFFFFF;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(8, 31, 92, 0.05);
            padding: 30px;
            max-width: 700px; /* Sedikit lebih lebar karena data pegawai cukup banyak */
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

        /* Form Grid System */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 18px;
        }

        /* Input Alamat memakan 2 kolom penuh */
        .form-group.full-width {
            grid-column: span 2;
        }

        .form-group label {
            color: #000000;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .form-group input, 
        .form-group select, 
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
        .form-group select:focus, 
        .form-group textarea:focus {
            border-color: #081F5C;
            background-color: #ffffff;
            box-shadow: 0 0 0 3px rgba(8, 31, 92, 0.15);
        }

        .form-group textarea {
            resize: none;
        }

        .btn-container {
            margin-top: 15px;
            text-align: right;
            border-top: 1px solid #eeeeee;
            padding-top: 20px;
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

        /* Responsif untuk Layanan Mobile/Kecil */
        @media (max-width: 600px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
            .form-group.full-width {
                grid-column: span 1;
            }
        }
    </style>

    <div class="content-card">
        <!-- Kepala Form -->
        <div class="content-title-area">
            <h3>Edit Pegawai</h3>
            <a href="/admin/pegawai" class="btn-back">
                ← Kembali ke Data
            </a>
        </div>

        <!-- Form Input -->
        <form action="/admin/pegawai/{{ $pegawai->id_pegawai }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <!-- Input Nama -->
                <div class="form-group">
                    <label for="nama_pegawai">Nama Lengkap</label>
                    <input type="text" id="nama_pegawai" name="nama_pegawai" value="{{ $pegawai->nama_pegawai }}" required autocomplete="off">
                </div>

                <!-- Input NIP -->
                <div class="form-group">
                    <label for="nip">NIP</label>
                    <input type="text" id="nip" name="nip" value="{{ $pegawai->nip }}" required autocomplete="off">
                </div>

                <!-- Input Email -->
                <div class="form-group">
                    <label for="email">Alamat Email</label>
                    <input type="email" id="email" name="email" value="{{ $pegawai->email }}" required autocomplete="off">
                </div>

                <!-- Input Jabatan -->
                <div class="form-group">
                    <label for="jabatan">Jabatan</label>
                    <input type="text" id="jabatan" name="jabatan" value="{{ $pegawai->jabatan }}" required autocomplete="off">
                </div>

                <!-- Pilihan Sub Bagian -->
                <div class="form-group">
                    <label for="id_sub_bagian">Sub Bagian</label>
                    <select id="id_sub_bagian" name="id_sub_bagian" required>
                        <option value="" disabled>-- Pilih Sub Bagian --</option>
                        @foreach($subBagian as $item)
                            <option value="{{ $item->id_sub_bagian }}" {{ $pegawai->id_sub_bagian == $item->id_sub_bagian ? 'selected' : '' }}>
                                {{ $item->nama_sub_bagian }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Input No HP -->
                <div class="form-group">
                    <label for="no_hp">Nomor HP / WhatsApp</label>
                    <input type="text" id="no_hp" name="no_hp" value="{{ $pegawai->no_hp }}" autocomplete="off">
                </div>

                <!-- Input Alamat (Lebar Penuh) -->
                <div class="form-group full-width">
                    <label for="alamat">Alamat Tinggal</label>
                    <textarea id="alamat" name="alamat" rows="4" placeholder="Tuliskan alamat lengkap di sini...">{{ $pegawai->alamat }}</textarea>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="btn-container">
                <button type="submit" class="btn-submit">
                    Perbarui Data
                </button>
            </div>

        </form>
    </div>
@endsection