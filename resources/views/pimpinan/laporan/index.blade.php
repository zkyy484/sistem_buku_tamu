@extends('pimpinan.layouts.app')

@section('content')

<h3>Laporan Konsultasi</h3>

<table border="1" cellpadding="10">

    <tr>

        <th>No</th>
        <th>No Tiket</th>
        <th>Tanggal Konsultasi</th>
        <th>Nama Lengkap</th>
        <th>Pelaku Usaha</th>
        <th>Nama Perusahaan</th>
        <th>Tujuan Konsultasi</th>
        <th>Permasalahan</th>
        <th>Solusi</th>
        <th>Nama Pegawai</th>
        <th>Status</th>

    </tr>

    @foreach($laporan as $item)

    <tr>

        <td>{{ $loop->iteration }}</td>

        <td>{{ $item->kode_tiket }}</td>

        <td>
            {{ date('d-m-Y', strtotime($item->tanggal_konsultasi)) }}
        </td>

        <td>{{ $item->nama_lengkap }}</td>

        <td>{{ $item->pelaku_usaha }}</td>

        <td>{{ $item->nama_perusahaan_instansi }}</td>

        <td>
            {{ $item->tujuan->tujuan_konsultasi }}
        </td>

        <td>{{ $item->permasalahan }}</td>

        <td>{{ $item->solusi ?? '-' }}</td>

        <td>
            {{ $item->pegawai->nama_pegawai ?? '-' }}
        </td>

        <td>{{ $item->status }}</td>

    </tr>

    @endforeach

</table>

@endsection