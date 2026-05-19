<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pegawai Dashboard - Sistem Buku Tamu</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#D0E3FF] font-sans m-0 p-0 flex flex-col md:flex-row min-h-screen text-black">

    <!-- Sidebar Menu Navigasi Pegawai -->
    <div class="w-full relative md:fixed md:top-0 md:bottom-0 md:left-0 md:w-[260px] bg-[#081F5C] text-white flex flex-col z-[100] shadow-[4px_0_15px_rgba(8,31,92,0.1)]">
        <div class="p-6 text-[20px] font-bold text-center border-b border-[#D0E3FF]/20 tracking-[0.5px]">
            Pegawai Panel
        </div>
        
        <ul class="list-none py-5 px-3 m-0 grow">
            <li class="mb-2">
                <a href="/pegawai/dashboard" 
                   class="block py-3 px-4 no-underline text-[15px] rounded-[8px] transition-all duration-[250ms] ease-in-out
                   {{ request()->is('pegawai/dashboard') 
                      ? 'bg-[#D0E3FF] text-[#081F5C] font-semibold pl-6 shadow-[0_4px_12px_rgba(208,227,255,0.2)]' 
                      : 'text-[#D0E3FF] font-medium hover:bg-[#D0E3FF] hover:text-[#081F5C] hover:font-semibold hover:pl-6 hover:shadow-[0_4px_12px_rgba(208,227,255,0.2)]' 
                   }}">
                    Dashboard
                </a>
            </li>
            <li class="mb-2">
                <a href="/pegawai/konsultasi" 
                   class="block py-3 px-4 no-underline text-[15px] rounded-[8px] transition-all duration-[250ms] ease-in-out
                   {{ request()->is('pegawai/konsultasi') 
                      ? 'bg-[#D0E3FF] text-[#081F5C] font-semibold pl-6 shadow-[0_4px_12px_rgba(208,227,255,0.2)]' 
                      : 'text-[#D0E3FF] font-medium hover:bg-[#D0E3FF] hover:text-[#081F5C] hover:font-semibold hover:pl-6 hover:shadow-[0_4px_12px_rgba(208,227,255,0.2)]' 
                   }}">
                    Data Konsultasi Tamu
                </a>
            </li>
        </ul>

        <div class="border-t border-[#D0E3FF]/20 py-[15px] px-6">
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="w-full bg-[#e53e3e] hover:bg-[#c53030] text-white border-none p-3 rounded-[8px] font-semibold cursor-pointer transition-colors duration-200">
                    Keluar Aplikasi
                </button>
            </form>
        </div>
    </div>

    <!-- Area Konten Halaman Dinamis -->
    <div class="grow p-5 md:p-10 box-border w-full md:ml-[260px] md:max-w-[calc(100%-260px)]">


        <!-- Bagian tempat halaman lain akan merender kontennya -->
        @yield('content')
    </div>

    <!-- JAVASCRIPT LIBRARI SIGNATURE PAD -->
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const canvasPegawai = document.getElementById('pegawai-signature');

            if (canvasPegawai) {
                const signaturePegawai = new SignaturePad(canvasPegawai);
                const formPegawai = document.getElementById('formPegawai');
                const clearBtn = document.getElementById('clearPegawai');

                if (clearBtn) {
                    clearBtn.addEventListener('click', function() {
                        signaturePegawai.clear();
                        const hiddenInput = document.getElementById('ttd_pegawai');
                        if (hiddenInput) hiddenInput.value = "";
                    });
                }

                if (formPegawai) {
                    formPegawai.addEventListener('submit', function() {
                        if (!signaturePegawai.isEmpty()) {
                            const hiddenInput = document.getElementById('ttd_pegawai');
                            if (hiddenInput) {
                                hiddenInput.value = signaturePegawai.toDataURL();
                            }
                        }
                    });
                }
            }
        });
    </script>
</body>

</html>