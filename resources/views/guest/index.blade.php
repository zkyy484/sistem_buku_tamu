<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Buku Tamu</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#D0E3FF] min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 font-sans">

    <div class="max-w-3xl w-full bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        
        <!-- Header Banner -->
        <div class="bg-[#081F5C] px-8 py-6 text-center">
            <h2 class="text-2xl font-bold text-white tracking-wide">Form Konsultasi Tamu</h2>
            <p class="text-blue-200 text-sm mt-1">Silakan isi data diri dan keperluan konsultasi Anda</p>
        </div>

        <div class="p-8">
            <!-- Alert Success -->
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-r-lg flex items-center">
                    <svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-green-800 font-medium text-sm">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Form -->
            <form action="/konsultasi/store" method="POST" class="space-y-6 text-black">
                @csrf

                <!-- Grid Layout untuk Form Input -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <!-- Pelaku Usaha -->
                    <div class="flex flex-col">
                        <label class="text-sm font-semibold mb-2">Pelaku Usaha</label>
                        <select name="pelaku_usaha" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#081F5C] focus:border-[#081F5C] transition outline-none bg-gray-50 text-black">
                            <option value="">Pilih</option>
                            <option value="Pelaku Usaha">Pelaku Usaha</option>
                            <option value="Instansi Pemerintah">Instansi Pemerintah</option>
                        </select>
                    </div>

                    <!-- NIK -->
                    <div class="flex flex-col">
                        <label class="text-sm font-semibold mb-2">NIK</label>
                        <input type="text" name="nik" placeholder="Masukkan NIK Anda" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#081F5C] focus:border-[#081F5C] transition outline-none bg-gray-50 text-black">
                    </div>

                    <!-- Nama Lengkap -->
                    <div class="flex flex-col">
                        <label class="text-sm font-semibold mb-2">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" placeholder="Nama sesuai KTP" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#081F5C] focus:border-[#081F5C] transition outline-none bg-gray-50 text-black">
                    </div>

                    <!-- Nama Perusahaan / Instansi -->
                    <div class="flex flex-col">
                        <label class="text-sm font-semibold mb-2">Nama Perusahaan / Instansi</label>
                        <input type="text" name="nama_perusahaan_instansi" placeholder="Nama perusahaan/instansi" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#081F5C] focus:border-[#081F5C] transition outline-none bg-gray-50 text-black">
                    </div>

                    <!-- Jabatan -->
                    <div class="flex flex-col">
                        <label class="text-sm font-semibold mb-2">Jabatan</label>
                        <input type="text" name="jabatan" placeholder="Contoh: Direktur, Staf, dll" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#081F5C] focus:border-[#081F5C] transition outline-none bg-gray-50 text-black">
                    </div>

                    <!-- No HP -->
                    <div class="flex flex-col">
                        <label class="text-sm font-semibold mb-2">No HP</label>
                        <input type="text" name="no_hp" placeholder="08xxxxxxxxxx" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#081F5C] focus:border-[#081F5C] transition outline-none bg-gray-50 text-black">
                    </div>

                </div>

                <!-- Email (Full Width) -->
                <div class="flex flex-col">
                    <label class="text-sm font-semibold mb-2">Email</label>
                    <input type="email" name="email" placeholder="alamat@email.com" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#081F5C] focus:border-[#081F5C] transition outline-none bg-gray-50 text-black">
                </div>

                <!-- Tujuan Konsultasi (Full Width) -->
                <div class="flex flex-col">
                    <label class="text-sm font-semibold mb-2">Tujuan Konsultasi</label>
                    <select name="id_tujuan" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#081F5C] focus:border-[#081F5C] transition outline-none bg-gray-50 text-black">
                        <option value="">Pilih Tujuan</option>
                        @foreach ($tujuan as $item)
                            <option value="{{ $item->id_tujuan }}">
                                {{ $item->tujuan_konsultasi }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Permasalahan (Full Width) -->
                <div class="flex flex-col">
                    <label class="text-sm font-semibold mb-2">Permasalahan</label>
                    <textarea name="permasalahan" rows="4" placeholder="Deskripsikan detail permasalahan Anda di sini..." class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#081F5C] focus:border-[#081F5C] transition outline-none bg-gray-50 text-black resize-none"></textarea>
                </div>

                <!-- Tanda Tangan Section -->
                <div class="flex flex-col items-center p-4 bg-gray-50 border border-dashed border-gray-300 rounded-xl">
                    <label class="text-sm font-semibold mb-3 self-start text-black">Tanda Tangan</label>
                    
                    <div class="bg-white rounded-lg p-2 border border-gray-200 shadow-sm">
                        <canvas id="signature-pad" width="400" height="200" class="cursor-crosshair block max-w-full"></canvas>
                    </div>

                    <div class="mt-3 flex w-full justify-between items-center px-2">
                        <button type="button" id="clear" class="px-4 py-1.5 text-xs font-medium text-red-600 bg-red-50 hover:bg-red-100 rounded-md border border-red-200 transition">
                            Hapus TTD
                        </button>
                        <span class="text-xs text-gray-400">Gunakan mouse atau layar sentuh</span>
                    </div>
                </div>

                <!-- Hidden Input TTD -->
                <input type="hidden" name="ttd_tamu" id="ttd_tamu">

                <!-- Submit Button -->
                <div class="pt-4">
                    <button type="submit" class="w-full bg-[#081F5C] hover:bg-[#0c2b7a] text-white font-bold py-3.5 px-4 rounded-xl shadow-md hover:shadow-lg transition duration-200 tracking-wider">
                        Kirim Konsultasi
                    </button>
                </div>

            </form>
        </div>
    </div>

    <!-- Script Signature Pad -->
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
    <script>
        const canvas = document.getElementById('signature-pad');
        const signaturePad = new SignaturePad(canvas);

        document.querySelector('form').addEventListener('submit', function() {
            const signature = signaturePad.toDataURL();
            document.getElementById('ttd_tamu').value = signature;
        });

        document.getElementById('clear').addEventListener('click', function() {
            signaturePad.clear();
        });
    </script>

</body>

</html>