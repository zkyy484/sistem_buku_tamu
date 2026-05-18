@extends('pegawai.layouts.app')

@section('content')
    @if (session('error'))
        <div style="color:red">

            {{ session('error') }}

        </div>
    @endif
    <h3>Detail Konsultasi</h3>

    <hr>
    @if ($konsultasi->pdf_path)
        <a href="/pegawai/konsultasi/{{ $konsultasi->id_tamu }}/download-pdf">

            <button type="button">

                Download PDF

            </button>

        </a>
    @endif

    <br><br>

    <table cellpadding="10">

        <tr>
            <td>Kode Tiket</td>
            <td>:</td>
            <td>{{ $konsultasi->kode_tiket }}</td>
        </tr>

        <tr>
            <td>Nama Lengkap</td>
            <td>:</td>
            <td>{{ $konsultasi->nama_lengkap }}</td>
        </tr>

        <tr>
            <td>Email</td>
            <td>:</td>
            <td>{{ $konsultasi->email }}</td>
        </tr>

        <tr>
            <td>No HP</td>
            <td>:</td>
            <td>{{ $konsultasi->no_hp }}</td>
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

    </table>

    <hr>


    {{-- <form action="/pegawai/konsultasi/{{ $konsultasi->id_tamu }}" method="POST"> --}}
    <form id="formPegawai" action="/pegawai/konsultasi/{{ $konsultasi->id_tamu }}" method="POST">

        @csrf
        @method('PUT')

        <div>

            <label>Solusi</label>

            <br>

            <textarea name="solusi" rows="8" cols="80">{{ $konsultasi->solusi }}</textarea>

        </div>

        <br>

        <div>

            <label>Tanda Tangan Pegawai</label>

            <br>

            <canvas id="pegawai-signature" width="400" height="200"
                style="
            border:1px solid black;
            border-radius:8px">
            </canvas>

            <input type="hidden" name="ttd_pegawai" id="ttd_pegawai">

            <input type="hidden" name="ttd_lama" value="{{ $konsultasi->ttd_pegawai }}">

            <br><br>

            <button type="button" id="clearPegawai">
                Hapus TTD Baru
            </button>

            <hr>

            <label>
                Preview TTD Pegawai
            </label>

            <br><br>

            @if ($konsultasi->ttd_pegawai)
                <img src="{{ $konsultasi->ttd_pegawai }}" width="300"
                    style="
                border:1px solid #ccc;
                padding:10px;
                border-radius:8px">

                <br><br>

                <small style="color:green">

                    TTD pegawai sudah tersimpan.
                    Jika tidak membuat tanda tangan baru,
                    sistem akan menggunakan TTD ini.

                </small>
            @else
                <div
                    style="
            width:300px;
            padding:15px;
            border:1px dashed #999;
            text-align:center;
            border-radius:8px">

                    TTD pegawai belum tersedia

                </div>

                <br>

                <small style="color:red">

                    Silakan buat tanda tangan terlebih dahulu.

                </small>
            @endif

        </div>

        <br>

        <div>

            <label>Status</label>

            <select name="status">

                <option value="Diproses" {{ $konsultasi->status == 'Diproses' ? 'selected' : '' }}>
                    Diproses
                </option>

                <option value="Selesai" {{ $konsultasi->status == 'Selesai' ? 'selected' : '' }}>
                    Selesai
                </option>

            </select>

        </div>

        <br>

        <button type="submit">
            Simpan Solusi
        </button>

    </form>
@endsection
