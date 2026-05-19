<!DOCTYPE html>
<html>

<head>
    <title>Laporan Konsultasi</title>
    <style>
        /* 1. Atur margin halaman PDF menjadi seminimal mungkin */
        @page {
            size: A4 landscape;
            /* Mengubah orientasi ke Landscape agar muat banyak kolom */
            margin: 10mm 10mm 10mm 10mm;
            /* Atur margin atas, kanan, bawah, kiri */
        }

        body {
            font-size: 9px;
            /* Sedikit dikecilkan agar teks panjang tidak merusak lebar kolom */
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            width: 100%;
        }

        h2 {
            text-align: center;
            margin-bottom: 15px;
        }

        /* 2. Pastikan tabel benar-benar memanfaatkan 100% lebar kertas */
        table {
            border-collapse: collapse;
            width: 100%;
            table-layout: fixed;
            /* Memaksa kolom mengikuti lebar yang ditentukan atau membagi rata */
            word-wrap: break-word;
            /* Memaksa teks panjang (seperti solusi/permasalahan) bungkus ke bawah */
        }

        th {
            background: #f2f2f2;
            font-weight: bold;
            text-align: center;
        }

        td,
        th {
            border: 1px solid #000;
            /* Menegaskan border hitam tipis */
            padding: 4px 3px;
            /* Memperkecil padding agar menghemat ruang horizontal */
            vertical-align: top;
        }

        img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        /* 3. Atur persentase lebar kolom secara spesifik agar proporsional */
        .col-no {
            width: 3%;
        }

        .col-tiket {
            width: 7%;
        }

        .col-tgl {
            width: 7%;
        }

        .col-nama {
            width: 9%;
        }

        .col-pelaku {
            width: 8%;
        }

        .col-pt {
            width: 9%;
        }

        .col-tujuan {
            width: 10%;
        }

        .col-masalah {
            width: 14%;
        }

        .col-solusi {
            width: 14%;
        }

        .col-pegawai {
            width: 9%;
        }

        .col-ttd {
            width: 5%;
        }
    </style>
</head>

<body>

    <h2>Laporan Konsultasi</h2>

    <!-- Hapus atribut border, cellpadding, cellspacing jadul, ganti dengan CSS -->
    <table>
        <thead>
            <tr>
                <th class="col-no">No</th>
                <th class="col-tiket">No Tiket</th>
                <th class="col-tgl">Tanggal</th>
                <th class="col-nama">Nama</th>
                <th class="col-pelaku">Pelaku Usaha</th>
                <th class="col-pt">Perusahaan</th>
                <th class="col-tujuan">Tujuan</th>
                <th class="col-masalah">Permasalahan</th>
                <th class="col-solusi">Solusi</th>
                <th class="col-pegawai">Pegawai</th>
                <th class="col-ttd">TTD Tamu</th>
                <th class="col-ttd">TTD Pegawai</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporan as $item)
                <tr>
                    <td align="center">{{ $loop->iteration }}</td>
                    <td>{{ $item->kode_tiket }}</td>
                    <td>{{ date('d-m-Y', strtotime($item->tanggal_konsultasi)) }}</td>
                    <td>{{ $item->nama_lengkap }}</td>
                    <td>{{ $item->pelaku_usaha }}</td>
                    <td>{{ $item->nama_perusahaan_instansi }}</td>
                    <td>{{ $item->tujuan->tujuan_konsultasi }}</td>
                    <td>{{ $item->permasalahan }}</td>
                    <td>{{ $item->solusi ?? '-' }}</td>
                    <td>{{ $item->pegawai->nama_pegawai ?? '-' }}</td>
                    <td align="center">
                        @if ($item->ttd_tamu)
                            <img src="{{ $item->ttd_tamu }}" width="50" height="25">
                        @else
                            -
                        @endif
                    </td>
                    <td align="center">
                        @if ($item->ttd_pegawai)
                            <img src="{{ $item->ttd_pegawai }}" width="50" height="25">
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
