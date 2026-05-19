@extends('admin.layouts.admin')

@section('content')
    <!-- CSS Khusus Halaman Detail & Formulir Solusi -->
    <style>
        .detail-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 25px;
        }

        @media (min-width: 992px) {
            .detail-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        .card-custom {
            background-color: #FFFFFF;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(8, 31, 92, 0.05);
            padding: 30px;
            margin-bottom: 25px;
        }

        .card-title {
            margin: 0 0 20px 0;
            font-size: 18px;
            color: #081F5C;
            font-weight: 700;
            border-bottom: 2px solid #e1ecfd;
            padding-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Notifikasi Error */
        .alert-error {
            background-color: #fce8e6;
            color: #c5221f;
            border: 1px solid #fad2cf;
            padding: 12px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            font-weight: 500;
        }

        /* Desain Info List */
        .info-table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table td {
            padding: 12px 8px;
            font-size: 14px;
            vertical-align: top;
            color: #333333;
        }

        .info-table td.label-field {
            font-weight: 600;
            color: #081F5C;
            width: 35%;
        }

        .info-table td.colon-field {
            width: 5%;
            text-align: center;
            color: #999999;
        }

        /* Tombol-Tombol */
        .btn-download-pdf {
            display: inline-block;
            background-color: #1a73e8;
            color: #FFFFFF;
            border: none;
            padding: 10px 18px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-download-pdf:hover {
            background-color: #1557b0;
        }

        .btn-submit {
            background-color: #081F5C;
            color: #FFFFFF;
            border: none;
            padding: 12px 24px;
            border-radius: 6px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            transition: background 0.2s;
        }

        .btn-submit:hover {
            background-color: #05133b;
        }

        .btn-clear {
            background-color: #f8fafc;
            color: #e53e3e;
            border: 1px solid #e2e8f0;
            padding: 8px 14px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-clear:hover {
            background-color: #fff5f5;
            border-color: #fed7d7;
        }

        /* Form Controls */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #081F5C;
            margin-bottom: 8px;
        }

        .custom-textarea {
            width: 100%;
            box-sizing: border-box;
            padding: 12px;
            border: 1px solid #cccccc;
            border-radius: 8px;
            font-size: 14px;
            font-family: inherit;
            resize: vertical;
            outline: none;
        }

        .custom-textarea:focus,
        .custom-select:focus {
            border-color: #081F5C;
            box-shadow: 0 0 0 3px rgba(8, 31, 92, 0.1);
        }

        .custom-select {
            width: 100%;
            padding: 12px;
            border: 1px solid #cccccc;
            border-radius: 8px;
            font-size: 14px;
            background-color: #FFFFFF;
            outline: none;
        }

        /* Canvas TTD Area */
        .canvas-container {
            background-color: #fafafa;
            border: 2px dashed #cbd5e1;
            border-radius: 8px;
            display: inline-block;
            padding: 5px;
            margin-bottom: 10px;
        }

        #pegawai-signature {
            background-color: #FFFFFF;
            display: block;
            cursor: crosshair;
        }

        .badge-status-info {
            font-size: 12px;
            padding: 4px 12px;
            border-radius: 20px;
            font-weight: 600;
        }
    </style>

    <!-- Notifikasi Sistem Gagal/Error -->
    @if (session('error'))
        <div class="alert-error">
            ⚠️ {{ session('error') }}
        </div>
    @endif

    <div class="detail-grid">

        <!-- BAGIAN KIRI: DATA PROFILE TAMU KONSULTASI -->
        <div class="card-custom">
            <div class="card-title">
                <span>Informasi Konsultasi</span>
                @if ($konsultasi->pdf_path)
                    <a href="/admin/konsultasi/{{ $konsultasi->id_tamu }}/download-pdf" class="btn-download-pdf">
                        🖨️ Unduh Dokumen PDF
                    </a>
                @endif
            </div>

            <table class="info-table">
                <tr>
                    <td class="label-field">Kode Tiket</td>
                    <td class="colon-field">:</td>
                    <td><strong style="color: #081F5C; font-size: 16px;">{{ $konsultasi->kode_tiket }}</strong></td>
                </tr>
                <tr>
                    <td class="label-field">Nama Lengkap</td>
                    <td class="colon-field">:</td>
                    <td><strong>{{ $konsultasi->nama_lengkap }}</strong></td>
                </tr>
                <tr>
                    <td class="label-field">Alamat Email</td>
                    <td class="colon-field">:</td>
                    <td>{{ $konsultasi->email }}</td>
                </tr>
                <tr>
                    <td class="label-field">Nomor HP / WhatsApp</td>
                    <td class="colon-field">:</td>
                    <td>{{ $konsultasi->no_hp }}</td>
                </tr>
                <tr>
                    <td class="label-field">Tujuan Konsultasi</td>
                    <td class="colon-field">:</td>
                    <td><span class="badge-status-info"
                            style="background-color: #e8f0fe; color: #081F5C;">{{ $konsultasi->tujuan->tujuan_konsultasi }}</span>
                    </td>
                </tr>
                <tr>
                    <td class="label-field">Permasalahan</td>
                    <td class="colon-field">:</td>
                    <td>
                        <div
                            style="background-color: #f8fafc; padding: 12px; border-radius: 6px; border-left: 3px solid #081F5C; line-height: 1.5;">
                            {{ $konsultasi->permasalahan }}
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <!-- BAGIAN KANAN: FORMULIR SOLUSI & DATA TANDA TANGAN -->
        <div class="card-custom">
            <div class="card-title">Form Tindakan & Solusi Pegawai</div>

            <form id="formPegawai" action="/admin/konsultasi/{{ $konsultasi->id_tamu }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Input Deskripsi Solusi -->
                <div class="form-group">
                    <label for="solusi">Solusi / Rekomendasi Petugas</label>
                    <textarea name="solusi" id="solusi" class="custom-textarea" rows="6"
                        placeholder="Ketikkan langkah-langkah solusi di sini...">{{ $konsultasi->solusi }}</textarea>
                </div>

                <!-- Input Pad Tanda Tangan Baru -->
                <div class="form-group">
                    <label>Bubuhkan Tanda Tangan Petugas Baru</label>
                    <div class="canvas-container">
                        <canvas id="pegawai-signature" width="380" height="180"></canvas>
                    </div>

                    <input type="hidden" name="ttd_pegawai" id="ttd_pegawai">
                    <input type="hidden" name="ttd_lama" value="{{ $konsultasi->ttd_pegawai }}">

                    <div>
                        <button type="button" id="clearPegawai" class="btn-clear">
                            🔄 Bersihkan Papan Coretan
                        </button>
                    </div>
                </div>

                <!-- Preview Gambar TTD Tersimpan Lama -->
                <div class="form-group"
                    style="background-color: #f8fafc; padding: 15px; border-radius: 8px; border: 1px dashed #cbd5e1;">
                    <label style="margin-bottom: 10px;">Arsip Tanda Tangan Saat Ini</label>
                    @if ($konsultasi->ttd_pegawai)
                        <div
                            style="background-color: #ffffff; display: inline-block; padding: 8px; border-radius: 6px; border: 1px solid #e2e8f0;">
                            <img src="{{ $konsultasi->ttd_pegawai }}" width="200" alt="TTD Pegawai">
                        </div>
                        <p style="margin: 8px 0 0 0; font-size: 12px; color: #137333; font-weight: 500;">
                            ✓ TTD Sudah tersimpan di basis data. Sistem otomatis menggunakan TTD ini jika Anda tidak menimpa
                            dengan coretan baru.
                        </p>
                    @else
                        <div style="color: #666666; font-size: 13px; font-style: italic; padding: 10px 0;">
                            ⚠️ Berkas tanda tangan petugas belum terekam di sistem.
                        </div>
                    @endif
                </div>

                <!-- Dropdown Status Layanan -->
                <div class="form-group">
                    <label for="status">Status Tindak Lanjut</label>
                    <select name="status" id="status" class="custom-select">
                        <option value="Belum Eskalasi" {{ $konsultasi->status == 'Belum Eskalasi' ? 'selected' : '' }}>⏳ Belum Eskalasi
                        </option>
                        <option value="Eskalasi" {{ $konsultasi->status == 'Eskalasi' ? 'selected' : '' }}>⏳ Eskalasi
                        </option>
                        <option value="Selesai" {{ $konsultasi->status == 'Selesai' ? 'selected' : '' }}>✅ Selesai</option>
                    </select>
                </div>

                <!-- Tombol Submit Form -->
                <button type="submit" class="btn-submit">
                    💾 Simpan Berkas Solusi & Update Status
                </button>
            </form>
        </div>

    </div>

    <!-- JAVASCRIPT CORE UNTUK MATRIKS PAD TANDA TANGAN -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const canvas = document.getElementById('pegawai-signature');
            const ctx = canvas.getContext('2d');
            const clearBtn = document.getElementById('clearPegawai');
            const hiddenInput = document.getElementById('ttd_pegawai');
            const form = document.getElementById('formPegawai');

            let isDrawing = false;

            // Setelan garis coretan kuas TTD
            ctx.strokeStyle = "#081F5C";
            ctx.lineWidth = 3;
            ctx.lineCap = "round";
            ctx.lineJoin = "round";

            // Deteksi posisi kursor koordinat mouse
            function getMousePos(e) {
                const rect = canvas.getBoundingClientRect();
                return {
                    x: (e.clientX || e.touches[0].clientX) - rect.left,
                    y: (e.clientY || e.touches[0].clientY) - rect.top
                };
            }

            // Fungsi mulai mencoret balik layar
            function startDrawing(e) {
                isDrawing = true;
                const pos = getMousePos(e);
                ctx.beginPath();
                ctx.moveTo(pos.x, pos.y);
                e.preventDefault();
            }

            function draw(e) {
                if (!isDrawing) return;
                const pos = getMousePos(e);
                ctx.lineTo(pos.x, pos.y);
                ctx.stroke();
                e.preventDefault();
            }

            function stopDrawing() {
                isDrawing = false;
            }

            // Event Listener Mouse (Desktop Komputer)
            canvas.addEventListener('mousedown', startDrawing);
            canvas.addEventListener('mousemove', draw);
            canvas.addEventListener('mouseup', stopDrawing);
            canvas.addEventListener('mouseout', stopDrawing);

            // Event Listener Layar Sentuh (Smartphone / Tablet)
            canvas.addEventListener('touchstart', startDrawing);
            canvas.addEventListener('touchmove', draw);
            canvas.addEventListener('touchend', stopDrawing);

            // Fungsi Hapus Coretan Papan TTD
            clearBtn.addEventListener('click', function() {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                hiddenInput.value = "";
            });

            // Konversi coretan canvas menjadi string Base64 sebelum form dikirim ke controller
            form.addEventListener('submit', function() {
                const blank = document.createElement('canvas');
                blank.width = canvas.width;
                blank.height = canvas.height;

                // Jika canvas tidak kosong / ada coretan baru, inject datanya ke input hidden
                if (canvas.toDataURL() !== blank.toDataURL()) {
                    hiddenInput.value = canvas.toDataURL();
                }
            });
        });
    </script>
@endsection
