<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Sistem Buku Tamu</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background-color: #D0E3FF;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            min-height: 100vh;
            color: #000000;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 260px;
            background-color: #081F5C;
            color: #FFFFFF;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            box-shadow: 4px 0 15px rgba(8, 31, 92, 0.1);
        }

        .sidebar-brand {
            padding: 24px;
            font-size: 20px;
            font-weight: 700;
            text-align: center;
            border-bottom: 1px solid rgba(208, 227, 255, 0.2);
            letter-spacing: 0.5px;
        }

        .sidebar-menu {
            list-style: none;
            padding: 20px 0;
            margin: 0;
            flex-grow: 1;
        }

        .sidebar-menu li a {
            display: block;
            padding: 14px 24px;
            color: #D0E3FF;
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .sidebar-menu li a:hover {
            background-color: rgba(208, 227, 255, 0.1);
            color: #FFFFFF;
            padding-left: 30px;
        }

        /* Khusus tombol logout agar menyatu dengan menu */
        .logout-form {
            border-top: 1px solid rgba(208, 227, 255, 0.2);
            padding: 15px 24px;
        }

        .btn-logout {
            width: 100%;
            background-color: #e53e3e;
            color: #FFFFFF;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-logout:hover {
            background-color: #c53030;
        }

        /* Main Content Container Area */
        .main-wrapper {
            margin-left: 260px;
            flex-grow: 1;
            padding: 25px;
            box-sizing: border-box;
            max-width: calc(100% - 260px);
        }

        /* Welcome Banner Card Layout Style */
        .welcome-banner {
            background: linear-gradient(135deg, #081F5C 0%, #1a3a8f 100%);
            color: #FFFFFF;
            padding: 24px 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(8, 31, 92, 0.15);
            margin-bottom: 30px;
        }

        .welcome-banner h2 {
            margin: 0 0 6px 0;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: 0.3px;
        }

        .welcome-banner p {
            margin: 0;
            font-size: 14px;
            opacity: 0.85;
            line-height: 1.5;
        }

        /* Responsif untuk layar kecil / Tablet */
        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                position: relative;
                bottom: auto;
            }

            .main-wrapper {
                margin-left: 0;
                max-width: 100%;
                padding: 20px;
            }
        }
    </style>
</head>

<body>

    <!-- Sidebar Menu Navigasi -->
    <div class="sidebar">
        <div class="sidebar-brand">
            Admin Panel
        </div>
        <ul class="sidebar-menu">
            <li><a href="/admin/dashboard">Dashboard</a></li>
            <li><a href="/admin/sub-bagian">Sub Bagian</a></li>
            <li><a href="/admin/tujuan-konsultasi">Tujuan Konsultasi</a></li>
            <li><a href="/admin/laporan">Laporan</a></li>
            <li><a href="/admin/pegawai">Akun Pegawai</a></li>
        </ul>

        <div class="logout-form">
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="btn-logout">
                    Keluar Aplikasi
                </button>
            </form>
        </div>
    </div>

    <!-- Area Konten Halaman Dinamis -->
    <div class="main-wrapper">

        <!-- Banner Selamat Datang Komponen (Pengganti Judul Lama) -->
        <div class="welcome-banner">
            <h2>Selamat Datang di Dashboard Admin</h2>
            <p>Ringkasan akumulasi data operasional, pelayanan tamu konsultasi, dan manajemen pegawai terbaru.</p>
        </div>

        <!-- Bagian tempat halaman lain akan merender kontennya -->
        @yield('content')
    </div>

</body>

</html>
