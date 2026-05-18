@extends('pegawai.layouts.app')

@section('content')
    <h3>Data Konsultasi</h3>

    <p>
        Jumlah data konsultasi:
        <b>{{ $konsultasi->count() }}</b>
    </p>

    @if (session('success'))
        <p style="color:green">
            {{ session('success') }}
        </p>
    @endif

    @if (session('success'))
        <p style="color:green">
            {{ session('success') }}
        </p>
    @endif

    <form method="GET">

        <input type="text" name="search" placeholder="Cari nama / tiket">

        <button type="submit">
            Cari
        </button>

    </form>

    <br>

    <table border="1" cellpadding="10">

        <tr>
            <th>No</th>
            <th>Kode Tiket</th>
            <th>Nama</th>
            <th>Tujuan</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        @foreach ($konsultasi as $item)
            <tr>

                <td>{{ $loop->iteration }}</td>

                <td>{{ $item->kode_tiket }}</td>

                <td>{{ $item->nama_lengkap }}</td>

                <td>{{ $item->tujuan->tujuan_konsultasi }}</td>

                <td>{{ $item->status }}</td>

                <td>

                    <a href="/pegawai/konsultasi/{{ $item->id_tamu }}">
                        Detail
                    </a>

                </td>

            </tr>
        @endforeach

    </table>
@endsection
