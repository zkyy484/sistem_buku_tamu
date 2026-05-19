<!DOCTYPE html>
<html>

<head>
    <title>Hasil Konsultasi</title>
    <style>
        /* Pengaturan halaman PDF */
        @page {
            size: A4 portrait;
            margin: 15mm 20mm 20mm 20mm;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 14px;
            line-height: 1.5;
            color: #000;
        }

        /* Styling Kop Surat agar Full & Presisi */
        .kop-surat {
            width: 100%;
            border-bottom: 3px double #000;
            /* Garis tebal rangkap khas kop surat */
            padding-bottom: 5px;
            margin-bottom: 20px;
        }

        .kop-surat img {
            width: 100%;
            height: auto;
            display: block;
        }

        /* Judul Dokumen */
        .judul-dokumen {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 25px;
            letter-spacing: 1px;
        }

        /* Detail Tabel Konten */
        .table-konten {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }

        .table-konten td {
            padding: 6px 4px;
            vertical-align: top;
        }

        /* Mengunci lebar kolom label agar sejajar rapi */
        .table-konten td.label {
            width: 25%;
        }

        .table-konten td.separator {
            width: 2%;
            text-align: center;
        }

        /* Area Tanda Tangan */
        .table-ttd {
            width: 100%;
            margin-top: 30px;
        }

        .table-ttd td {
            width: 50%;
            text-align: center;
            vertical-align: top;
        }

        .space-ttd {
            height: 80px;
            /* Ruang kosong jika gambar TTD tidak ada */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .img-ttd {
            max-width: 150px;
            height: 70px;
            object-fit: contain;
        }

        .nama-ttd {
            text-decoration: underline;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="kop-surat">
        <img src="{{ public_path('storage/header_pdf.jpg') }}" alt="Kop Surat">
    </div>

    <div class="judul-dokumen">
        Hasil Konsultasi
    </div>

    <table class="table-konten">
        <tr>
            <td class="label">Kode Tiket</td>
            <td class="separator">:</td>
            <td><strong>{{ $konsultasi->kode_tiket }}</strong></td>
        </tr>
        <tr>
            <td class="label">Hari / Tanggal</td>
            <td class="separator">:</td>
            <td>{{ Str::lower($konsultasi->created_at->format('d/m/Y') )}}</td>
        </tr>
        <tr>
            <td class="label">Waktu</td>
            <td class="separator">:</td>
            <td>{{ $konsultasi->created_at->format('H:i') }} WITA</td>
        </tr>
        <tr>
            <td class="label">Instansi/Perusahaan</td>
            <td class="separator">:</td>
            <td>{{ $konsultasi->nama_perusahaan_instansi }}</td>
        </tr>
        <tr>
            <td class="label">Nama Lengkap</td>
            <td class="separator">:</td>
            <td>{{ $konsultasi->nama_lengkap }}</td>
        </tr>
        <tr>
            <td class="label">Email</td>
            <td class="separator">:</td>
            <td>{{ $konsultasi->email }}</td>
        </tr>
        <tr>
            <td class="label">Tujuan Konsultasi</td>
            <td class="separator">:</td>
            <td>{{ $konsultasi->tujuan->tujuan_konsultasi }}</td>
        </tr>
        <tr>
            <td class="label">Kendala / Permasalahan</td>
            <td class="separator">:</td>
            <td>{{ $konsultasi->permasalahan }}</td>
        </tr>
        <tr>
            <td class="label">Solusi</td>
            <td class="separator">:</td>
            <td>{{ $konsultasi->solusi ?? '-' }}</td>
        </tr>
    </table>

    <table class="table-ttd">
        <tr>
            <td>
                Tanda Tangan Tamu
                <div class="space-ttd">
                    @if ($konsultasi->ttd_tamu)
                    <img src="{{ $konsultasi->ttd_tamu }}" width="200">
                    @endif
                </div>
                <div class="nama-ttd">({{ $konsultasi->nama_lengkap }})</div>
            </td>

            <td>
                Tanda Tangan Pegawai
                <div class="space-ttd">
                    @if ($konsultasi->ttd_pegawai)
                    <img src="{{ $konsultasi->ttd_pegawai }}" width="200">
                    @endif
                </div>
                <div class="nama-ttd">({{ $konsultasi->pegawai->nama_pegawai ?? '-' }})</div>
            </td>
        </tr>
    </table>

</body>

</html>