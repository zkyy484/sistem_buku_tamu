<!DOCTYPE html>
<html>

<head>

    <title>Laporan Konsultasi</title>

    <style>

        body{
            font-size: 10px;
            font-family: Arial, sans-serif;
        }

        table{
            border-collapse: collapse;
        }

        th{
            background: #f2f2f2;
        }

        td, th{
            padding: 5px;
            vertical-align: top;
        }

        img{
            border: 1px solid #ccc;
        }

    </style>

</head>

<body>

    <h2>Laporan Konsultasi</h2>

    <table border="1"
        width="100%"
        cellpadding="5"
        cellspacing="0">

        <tr>

            <th>No</th>
            <th>No Tiket</th>
            <th>Tanggal</th>
            <th>Nama</th>
            <th>Pelaku Usaha</th>
            <th>Perusahaan</th>
            <th>Tujuan</th>
            <th>Permasalahan</th>
            <th>Solusi</th>
            <th>Pegawai</th>
            <th>TTD Tamu</th>
            <th>TTD Pegawai</th>
            <th>Status</th>

        </tr>

        @foreach ($laporan as $item)

        <tr>

            <td>
                {{ $loop->iteration }}
            </td>

            <td>
                {{ $item->kode_tiket }}
            </td>

            <td>
                {{ date('d-m-Y',
                    strtotime($item->tanggal_konsultasi)) }}
            </td>

            <td>
                {{ $item->nama_lengkap }}
            </td>

            <td>
                {{ $item->pelaku_usaha }}
            </td>

            <td>
                {{ $item->nama_perusahaan_instansi }}
            </td>

            <td>
                {{ $item->tujuan->tujuan_konsultasi }}
            </td>

            <td>
                {{ $item->permasalahan }}
            </td>

            <td>
                {{ $item->solusi ?? '-' }}
            </td>

            <td>
                {{ $item->pegawai->nama_pegawai ?? '-' }}
            </td>

            <td align="center">

                @if($item->ttd_tamu)

                    <img src="{{ $item->ttd_tamu }}"
                        width="80"
                        height="40">

                @else

                    -

                @endif

            </td>

            <td align="center">

                @if($item->ttd_pegawai)

                    <img src="{{ $item->ttd_pegawai }}"
                        width="80"
                        height="40">

                @else

                    -

                @endif

            </td>

            <td>
                {{ $item->status }}
            </td>

        </tr>

        @endforeach

    </table>

</body>

</html>