<!DOCTYPE html>
<html>

<head>

    <title>Hasil Konsultasi</title>

</head>

<body>

    <h2>Hasil Konsultasi</h2>

    <hr>

    <table cellpadding="8">

        <tr>
            <td>Kode Tiket</td>
            <td>:</td>
            <td>{{ $konsultasi->kode_tiket }}</td>
        </tr>

        <tr>
            <td>Nama</td>
            <td>:</td>
            <td>{{ $konsultasi->nama_lengkap }}</td>
        </tr>

        <tr>
            <td>Email</td>
            <td>:</td>
            <td>{{ $konsultasi->email }}</td>
        </tr>

        <tr>
            <td>Tujuan Konsultasi</td>
            <td>:</td>
            <td>{{ $konsultasi->tujuan->tujuan_konsultasi }}</td>
        </tr>

        <tr>
            <td>Permasalahan</td>
            <td>:</td>
            <td>{{ $konsultasi->permasalahan }}</td>
        </tr>

        <tr>
            <td>Solusi</td>
            <td>:</td>
            <td>{{ $konsultasi->solusi }}</td>
        </tr>

        <tr>
            <td>Status</td>
            <td>:</td>
            <td>{{ $konsultasi->status }}</td>
        </tr>

    </table>

    <br><br>

    <br><br>

    <table width="100%">

        <tr>

            <td align="center">

                Tanda Tangan Tamu

                <br><br>

                @if ($konsultasi->ttd_tamu)
                    <img src="{{ $konsultasi->ttd_tamu }}" width="200">
                @endif

                <br><br><br>

                <hr width="200">
                <b>
                    ({{ $konsultasi->nama_lengkap }})
                </b>

            </td>


            <td align="center">

                Tanda Tangan Pegawai

                <br><br>

                @if ($konsultasi->ttd_pegawai)
                    <img src="{{ $konsultasi->ttd_pegawai }}" width="200">
                @endif

                <br><br><br>

                <hr width="200">
                <b>
                    ({{ $konsultasi->pegawai->nama_pegawai ?? '-' }})
                </b>

            </td>

        </tr>

    </table>

</body>

</html>
