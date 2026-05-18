@extends('admin.layouts.admin')

@section('content')
    <!-- CSS Tambahan Khusus untuk Elemen Form Halaman Ini -->
    <style>
        .content-card {
            background-color: #FFFFFF;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(8, 31, 92, 0.05);
            padding: 30px;
            max-width: 800px; /* Lebar optimal untuk form dua kolom */
            margin: 0 auto;
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

        /* Form Layout Sesi */
        .form-section-title {
            font-size: 16px;
            color: #081F5C;
            font-weight: 700;
            margin: 25px 0 15px 0;
            padding-bottom: 6px;
            border-bottom: 2px solid #f4f7fc;
        }

        .form-section-title.first {
            margin-top: 0;
        }

        /* Form Grid System */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

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
            margin-top: 25px;
            text-align: right;
            border-top: 1px solid #eeeeee;
            padding-top: 20px;
        }

        .btn-submit {
            background-color: #081F5C;
            color: #FFFFFF;
            border: none;
            padding: 12px 28px;
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
        @media (max-width: 650px) {
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
            <h3>Tambah Pegawai baru</h3>
            <a href="/admin/pegawai" class="btn-back">
                ← Kembali ke Data
            </a>
        </div>

        <!-- Form Input -->
        <form action="/admin/pegawai" method="POST">
            @csrf

            <!-- SEKSI 1: Biodata Pegawai -->
            <div class="form-section-title first">Biodata Pegawai</div>
            
            <div class="form-grid">
                <!-- Input Nama -->
                <div class="form-group">
                    <label for="nama_pegawai">Nama Lengkap</label>
                    <input type="text" id="nama_pegawai" name="nama_pegawai" placeholder="Masukkan nama pegawai" required autocomplete="off">
                </div>

                <!-- Input NIP -->
                <div class="form-group">
                    <label for="nip">NIP</label>
                    <input type="text" id="nip" name="nip" placeholder="Masukkan nomor induk pegawai" required autocomplete="off">
                </div>

                <!-- Input Email -->
                <div class="form-group">
                    <label for="email">Alamat Email</label>
                    <input type="email" id="email" name="email" placeholder="contoh@domain.com" required autocomplete="off">
                </div>

                <!-- Input Jabatan -->
                <div class="form-group">
                    <label for="jabatan">Jabatan</label>
                    <input type="text" id="jabatan" name="jabatan" placeholder="Contoh: Staff Utama, Analis" required autocomplete="off">
                </div>

                <!-- Pilihan Sub Bagian -->
                <div class="form-group">
                    <label for="id_sub_bagian">Sub Bagian</label>
                    <select id="id_sub_bagian" name="id_sub_bagian" required>
                        <option value="" selected disabled>Pilih Sub Bagian</option>
                        @foreach($subBagian as $item)
                            <option value="{{ $item->id_sub_bagian }}">
                                {{ $item->nama_sub_bagian }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Input No HP -->
                <div class="form-group">
                    <label for="no_hp">Nomor HP / WhatsApp</label>
                    <input type="text" id="no_hp" name="no_hp" placeholder="Contoh: 081234567xxx" autocomplete="off">
                </div>

                <!-- Input Alamat (Lebar Penuh) -->
                <div class="form-group full-width">
                    <label for="alamat">Alamat Tinggal</label>
                    <textarea id="alamat" name="alamat" rows="3" placeholder="Tuliskan alamat lengkap domisili saat ini..."></textarea>
                </div>
            </div>

            <!-- SEKSI 2: Kredensial Akses Akun -->
            <div class="form-section-title">Akun Login Sistem</div>
            
            <div class="form-grid">
                <!-- Input Username -->
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Buat username unik" required autocomplete="off">
                </div>

                <!-- Input Password -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Buat sandi minimal 8 karakter" required>
                </div>

                <!-- Pilihan Role Akses -->
                <div class="form-group">
                    <label for="id_role_akses">Hak Akses (Role)</label>
                    <select id="id_role_akses" name="id_role_akses" required>
                        <option value="" selected disabled>Pilih Hak Akses / Role</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id_role_akses }}">
                                {{ $role->nama_role }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Tombol Aksi Kirim -->
            <div class="btn-container">
                <button type="submit" class="btn-submit">
                    Simpan Data Pegawai
                </button>
            </div>

        </form>
    </div>
@endsection