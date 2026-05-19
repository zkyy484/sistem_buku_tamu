<!DOCTYPE html>
<html>

<head>

    <title>Laporan Pengunjung</title>

    <style>

        body{
            font-size: 10px;
            font-family: Arial, sans-serif;
        }

        h2{
            text-align: center;
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

    <h2>Laporan Pengunjung</h2>

    <table border="1"
        width="100%"
        cellpadding="5"
        cellspacing="0">

        <tr>

            <th>No</th>
            <th>Nama</th>
            <th>NIK</th>
            <th>Email</th>
            <th>Nomor</th>
            <th>Perusahaan</th>

        </tr>

        @foreach ($laporan as $item)

        <tr>

            <td>
                {{ $loop->iteration }}
            </td>

            <td>
                {{ $item->nama_lengkap }}
            </td>

            <td>
                {{ $item->nik }}
            </td>

            <td>
                {{ $item->email }}
            </td>

            <td>
                {{ $item->no_hp }}
            </td>

            <td>
                {{ $item->nama_perusahaan_instansi }}
            </td>

        </tr>

        @endforeach

    </table>

</body>

</html>