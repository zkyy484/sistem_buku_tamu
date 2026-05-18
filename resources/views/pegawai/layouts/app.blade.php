<!DOCTYPE html>
<html>

<head>
    <title>Dashboard Pegawai</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <div style="padding:20px">

        <h2>Dashboard Pegawai</h2>

        <hr>

        <a href="/pegawai/dashboard">Dashboard</a> |
        <a href="/pegawai/konsultasi">Data Konsultasi Tamu</a> |
        <form action="/logout" method="POST" style="display:inline;">

            @csrf

            <button type="submit">
                Logout
            </button>

        </form>

        <hr>

        @yield('content')

    </div>

    {{-- <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>

    <script>
        const canvas =
            document.getElementById('signature-pad');

        const signaturePad =
            new SignaturePad(canvas);

        document.querySelector('form')
            .addEventListener('submit', function() {

                if (!signaturePad.isEmpty()) {

                    document
                        .getElementById('ttd_pegawai')
                        .value =
                        signaturePad.toDataURL();

                }

            });

        document
            .getElementById('clear')
            .addEventListener('click', () => {

                signaturePad.clear();

            });
    </script> --}}

    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>

    <script>
        const canvasPegawai =
            document.getElementById(
                'pegawai-signature'
            );

        const signaturePegawai =
            new SignaturePad(canvasPegawai);


        document
            .getElementById('formPegawai')
            .addEventListener(
                'submit',
                function() {

                    if (!signaturePegawai.isEmpty()) {

                        document
                            .getElementById(
                                'ttd_pegawai'
                            ).value =
                            signaturePegawai.toDataURL();

                    }

                }
            );


        document
            .getElementById(
                'clearPegawai'
            )
            .addEventListener(
                'click',
                function() {

                    signaturePegawai.clear();

                });
    </script>

</body>

</html>
