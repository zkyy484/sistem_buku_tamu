<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang - Sistem Buku Tamu</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background-color: #D0E3FF;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            box-sizing: border-box;
        }

        .welcome-card {
            background-color: #FFFFFF;
            width: 100%;
            max-width: 550px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(8, 31, 92, 0.15);
            overflow: hidden;
            text-align: center;
            padding: 40px 30px;
            box-sizing: border-box;
        }

        .icon-container {
            width: 120px;
            /* Sedikit disesuaikan agar logo terlihat proporsional */
            height: 120px;
            /* background-color: #D0E3FF; */
            /* border-radius: 50%; */
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 24px auto;
            overflow: hidden;
            /* Memastikan gambar tetap bulat mengikuti container */
        }

        .icon-container img {
            width: 85%;
            /* Menjaga logo tetap presisi di dalam lingkaran */
            height: 85%;
            object-fit: contain;
        }

        h1 {
            color: #081F5C;
            font-size: 28px;
            font-weight: 700;
            margin: 0 0 12px 0;
        }

        p {
            color: #333333;
            font-size: 15px;
            line-height: 1.6;
            margin: 0 0 30px 0;
        }

        .features {
            text-align: left;
            background-color: #f8faff;
            border: 1px solid #e1ecfd;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 35px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
            color: #000000;
            font-size: 14px;
        }

        .feature-item:last-child {
            margin-bottom: 0;
        }

        .feature-item svg {
            width: 18px;
            height: 18px;
            fill: #081F5C;
            margin-right: 12px;
            flex-shrink: 0;
        }

        .btn-start {
            display: inline-block;
            background-color: #081F5C;
            color: #FFFFFF;
            text-decoration: none;
            width: 100%;
            padding: 16px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 700;
            box-sizing: border-box;
            transition: background-color 0.2s, transform 0.1s, box-shadow 0.2s;
            box-shadow: 0 6px 15px rgba(8, 31, 92, 0.25);
        }

        .btn-start:hover {
            background-color: #05133b;
            box-shadow: 0 8px 20px rgba(8, 31, 92, 0.35);
        }

        .btn-start:active {
            transform: scale(0.99);
        }

        .footer-text {
            display: block;
            margin-top: 20px;
            font-size: 12px;
            color: #666666;
        }
    </style>
</head>

<body>

    <div class="welcome-card">
        <div class="icon-container">
            <img src="{{ asset('storage/1.png') }}" alt="Logo Pura Adikara Bhana Bhavana">
        </div>

        <h1>Sistem Buku Tamu</h1>
        <p>Selamat datang di layanan konsultasi resmi kami. Silakan klik tombol di bawah untuk mengisi data kunjungan
            dan menyampaikan permasalahan Anda.</p>

        <div class="features">
            <div class="feature-item">
                <svg viewBox="0 0 24 24">
                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z" />
                </svg>
                <span>Isi data diri, instansi, dan kontak aktif Anda</span>
            </div>
            <div class="feature-item">
                <svg viewBox="0 0 24 24">
                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z" />
                </svg>
                <span>Pilih tujuan konsultasi dan deskripsikan kendala</span>
            </div>
            <div class="feature-item">
                <svg viewBox="0 0 24 24">
                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z" />
                </svg>
                <span>Lengkapi dengan tanda tangan digital langsung dari perangkat</span>
            </div>
        </div>

        <a href="/buku-tamu" class="btn-start">
            Mulai Isi Buku Tamu
        </a>

        <span class="footer-text">© 2026 Aplikasi Buku Tamu & Konsultasi. All Rights Reserved.</span>
    </div>

</body>

</html>
