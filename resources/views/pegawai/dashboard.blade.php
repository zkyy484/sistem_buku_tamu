@extends('pegawai.layouts.app')

@section('content')
    <h2>Dashboard Pegawai</h2>

    <br>

    <div style="
display:flex;
gap:20px;
flex-wrap:wrap">

        <div style="
padding:20px;
border:1px solid #ccc">

            <h3>Total Ditangani</h3>

            <h1>
                {{ $totalDitangani }}
            </h1>

        </div>


        <div style="
padding:20px;
border:1px solid #ccc">

            <h3>Belum Ditangani</h3>

            <h1>
                {{ $belumDitangani }}
            </h1>

        </div>


        <div style="
padding:20px;
border:1px solid #ccc">

            <h3>Status Baru</h3>

            <h1>
                {{ $baru }}
            </h1>

        </div>


        <div style="
padding:20px;
border:1px solid #ccc">

            <h3>Diproses</h3>

            <h1>
                {{ $diproses }}
            </h1>

        </div>


        <div style="
padding:20px;
border:1px solid #ccc">

            <h3>Selesai</h3>

            <h1>
                {{ $selesai }}
            </h1>

        </div>

    </div>
    <br><br>

    <h3>
        Grafik Konsultasi per Sub Bagian
    </h3>

    <canvas id="subBagianChart" height="100">
    </canvas>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const labels = @json($subBagian->pluck('nama_sub_bagian'));

        const data = @json($subBagian->pluck('total'));


        new Chart(
            document.getElementById(
                'subBagianChart'
            ), {

                type: 'bar',

                data: {

                    labels: labels,

                    datasets: [{

                        label: 'Jumlah Konsultasi',

                        data: data

                    }]

                }

            });
    </script>
@endsection
