<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Sistem Buku Tamu</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#D0E3FF] font-sans m-0 p-0 flex flex-col md:flex-row min-h-screen text-black">

    <!-- Sidebar Menu Navigasi -->
    <div class="w-full relative md:fixed md:top-0 md:bottom-0 md:left-0 md:w-[260px] bg-[#081F5C] text-white flex flex-col z-[100] shadow-[4px_0_15px_rgba(8,31,92,0.1)]">
        <div class="p-6 text-[20px] font-bold text-center border-b border-[#D0E3FF]/20 tracking-[0.5px]">
            Admin Panel
        </div>
        
        <ul class="list-none py-5 px-3 m-0 grow overflow-y-auto">
            <!-- Menu Utama Tanpa Dropdown: Dashboard -->
            <li class="mb-2">
                <a href="/admin/dashboard" 
                   class="nav-link flex justify-between items-center w-full py-3 px-4 no-underline text-[15px] rounded-[8px] transition-all duration-[250ms] ease-in-out
                   {{ request()->is('admin/dashboard') 
                      ? 'bg-[#D0E3FF] text-[#081F5C] font-semibold pl-6 shadow-[0_4px_12px_rgba(208,227,255,0.2)]' 
                      : 'text-[#D0E3FF] font-medium hover:bg-[#D0E3FF] hover:text-[#081F5C] hover:font-semibold hover:pl-6 hover:shadow-[0_4px_12px_rgba(208,227,255,0.2)]' 
                   }}">
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Menu Utama Tanpa Dropdown: Konsultasi Tamu -->
            <li class="mb-2">
                <a href="{{ route('index.admin.konsultasi') }}" 
                   class="nav-link flex justify-between items-center w-full py-3 px-4 no-underline text-[15px] rounded-[8px] transition-all duration-[250ms] ease-in-out
                   {{ request()->routeIs('index.admin.konsultasi') || request()->is('admin/konsultasi*')
                      ? 'bg-[#D0E3FF] text-[#081F5C] font-semibold pl-6 shadow-[0_4px_12px_rgba(208,227,255,0.2)]' 
                      : 'text-[#D0E3FF] font-medium hover:bg-[#D0E3FF] hover:text-[#081F5C] hover:font-semibold hover:pl-6 hover:shadow-[0_4px_12px_rgba(208,227,255,0.2)]' 
                   }}">
                    <span>Konsultasi Tamu</span>
                </a>
            </li>

            <!-- Dropdown: Data Master -->
            <li class="mb-2">
                <button class="dropdown-btn flex justify-between items-center w-full py-3 px-4 text-[#D0E3FF] text-[15px] font-medium bg-transparent border-none text-left cursor-pointer rounded-[8px] transition-all duration-[250ms] ease-in-out hover:bg-[#D0E3FF] hover:text-[#081F5C] hover:font-semibold hover:pl-6 hover:shadow-[0_4px_12px_rgba(208,227,255,0.2)] after:content-['▼'] after:text-[10px] after:transition-transform after:duration-200 after:opacity-70 [&.active]:after:rotate(-180deg)" data-menu="data-master">
                    Data Master
                </button>
                <ul class="dropdown-container hidden bg-black/15 list-none p-2 mt-1 rounded-[8px] space-y-1">
                    <li>
                        <a href="/admin/sub-bagian" class="nav-link block py-2.5 pr-4 pl-6 text-[14px] no-underline rounded-[6px] transition-all duration-[250ms] ease-in-out
                           {{ request()->is('admin/sub-bagian*') 
                              ? 'bg-[#D0E3FF] text-[#081F5C] font-semibold pl-8 shadow-[0_4px_12px_rgba(208,227,255,0.2)]' 
                              : 'text-[#D0E3FF] font-medium hover:bg-[#D0E3FF] hover:text-[#081F5C] hover:font-semibold hover:pl-8' 
                           }}">
                            Sub Bagian
                        </a>
                    </li>
                    <li>
                        <a href="/admin/tujuan-konsultasi" class="nav-link block py-2.5 pr-4 pl-6 text-[14px] no-underline rounded-[6px] transition-all duration-[250ms] ease-in-out
                           {{ request()->is('admin/tujuan-konsultasi*') 
                              ? 'bg-[#D0E3FF] text-[#081F5C] font-semibold pl-8 shadow-[0_4px_12px_rgba(208,227,255,0.2)]' 
                              : 'text-[#D0E3FF] font-medium hover:bg-[#D0E3FF] hover:text-[#081F5C] hover:font-semibold hover:pl-8' 
                           }}">
                            Tujuan Konsultasi
                        </a>
                    </li>
                    <li>
                        <a href="/admin/pegawai" class="nav-link block py-2.5 pr-4 pl-6 text-[14px] no-underline rounded-[6px] transition-all duration-[250ms] ease-in-out
                           {{ request()->is('admin/pegawai*') 
                              ? 'bg-[#D0E3FF] text-[#081F5C] font-semibold pl-8 shadow-[0_4px_12px_rgba(208,227,255,0.2)]' 
                              : 'text-[#D0E3FF] font-medium hover:bg-[#D0E3FF] hover:text-[#081F5C] hover:font-semibold hover:pl-8' 
                           }}">
                            Akun Pegawai
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Dropdown: Laporan -->
            <li class="mb-2">
                <button class="dropdown-btn flex justify-between items-center w-full py-3 px-4 text-[#D0E3FF] text-[15px] font-medium bg-transparent border-none text-left cursor-pointer rounded-[8px] transition-all duration-[250ms] ease-in-out hover:bg-[#D0E3FF] hover:text-[#081F5C] hover:font-semibold hover:pl-6 hover:shadow-[0_4px_12px_rgba(208,227,255,0.2)] after:content-['▼'] after:text-[10px] after:transition-transform after:duration-200 after:opacity-70 [&.active]:after:rotate(-180deg)" data-menu="laporan">
                    Laporan
                </button>
                <ul class="dropdown-container hidden bg-black/15 list-none p-2 mt-1 rounded-[8px] space-y-1">
                    <li>
                        <a href="/admin/laporan" class="nav-link block py-2.5 pr-4 pl-6 text-[14px] no-underline rounded-[6px] transition-all duration-[250ms] ease-in-out
                           {{ request()->is('admin/laporan') 
                              ? 'bg-[#D0E3FF] text-[#081F5C] font-semibold pl-8 shadow-[0_4px_12px_rgba(208,227,255,0.2)]' 
                              : 'text-[#D0E3FF] font-medium hover:bg-[#D0E3FF] hover:text-[#081F5C] hover:font-semibold hover:pl-8' 
                           }}">
                            Laporan Konsultasi
                        </a>
                    </li>
                    <li>
                        <a href="/admin/laporan/pengunjung" class="nav-link block py-2.5 pr-4 pl-6 text-[14px] no-underline rounded-[6px] transition-all duration-[250ms] ease-in-out
                           {{ request()->is('admin/laporan/pengunjung*') 
                              ? 'bg-[#D0E3FF] text-[#081F5C] font-semibold pl-8 shadow-[0_4px_12px_rgba(208,227,255,0.2)]' 
                              : 'text-[#D0E3FF] font-medium hover:bg-[#D0E3FF] hover:text-[#081F5C] hover:font-semibold hover:pl-8' 
                           }}">
                            Laporan Pengunjung
                        </a>
                    </li>
                </ul>
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
    <div class="grow p-[25px] box-border w-full md:ml-[260px] md:max-w-[calc(100%-260px)]">
        @yield('content')
    </div>

    <!-- Signature Pad Lib -->
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>

    <!-- Script Tanda Tangan & Logika Dropdown Sidebar Persisten -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const dropdowns = document.getElementsByClassName("dropdown-btn");
            
            // 1. Cek status dropdown yang tersimpan di localStorage saat halaman dimuat
            for (let i = 0; i < dropdowns.length; i++) {
                const menuKey = dropdowns[i].getAttribute("data-menu");
                const dropdownContent = dropdowns[i].nextElementSibling;
                const isOpened = localStorage.getItem("sidebar_" + menuKey);

                if (isOpened === "true") {
                    dropdowns[i].classList.add("active");
                    dropdownContent.classList.remove("hidden");
                }

                // 2. Event listener klik untuk menyimpan state terbaru
                dropdowns[i].addEventListener("click", function() {
                    this.classList.toggle("active");
                    const content = this.nextElementSibling;
                    
                    if (content.classList.contains("hidden")) {
                        content.classList.remove("hidden");
                        localStorage.setItem("sidebar_" + menuKey, "true");
                    } else {
                        content.classList.add("hidden");
                        localStorage.setItem("sidebar_" + menuKey, "false");
                    }
                });
            }

            // 3. Reset state dropdown khusus jika menu non-dropdown (Dashboard/Konsultasi) diklik
            const navLinks = document.querySelectorAll(".nav-link");
            navLinks.forEach(link => {
                link.addEventListener("click", function() {
                    if (!this.closest('.dropdown-container')) {
                        for (let i = 0; i < dropdowns.length; i++) {
                            const menuKey = dropdowns[i].getAttribute("data-menu");
                            localStorage.removeItem("sidebar_" + menuKey);
                        }
                    }
                });
            });

            // 4. Pengondisian Automatis: Jika ada sub-menu aktif di dalam container, paksa dropdown terbuka
            const activeSubMenus = document.querySelectorAll(".dropdown-container .font-semibold");
            activeSubMenus.forEach(subMenu => {
                const parentContainer = subMenu.closest('.dropdown-container');
                const parentButton = parentContainer.previousElementSibling;
                const menuKey = parentButton.getAttribute("data-menu");

                parentButton.classList.add("active");
                parentContainer.classList.remove("hidden");
                localStorage.setItem("sidebar_" + menuKey, "true");
            });
        });

        // Script SignaturePad Terkondisi Aman
        const canvasPegawai = document.getElementById('pegawai-signature');
        if (canvasPegawai) {
            const signaturePegawai = new SignaturePad(canvasPegawai);
            const formPegawai = document.getElementById('formPegawai');
            const clearBtn = document.getElementById('clearPegawai');

            if (formPegawai) {
                formPegawai.addEventListener('submit', function() {
                    if (!signaturePegawai.isEmpty()) {
                        const inputTtd = document.getElementById('ttd_pegawai');
                        if (inputTtd) inputTtd.value = signaturePegawai.toDataURL();
                    }
                });
            }

            if (clearBtn) {
                clearBtn.addEventListener('click', function() {
                    signaturePegawai.clear();
                });
            }
        }
    </script>

</body>

</html>