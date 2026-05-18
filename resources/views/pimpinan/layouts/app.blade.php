<!DOCTYPE html>
<html>

<head>
    <title>Dashboard Pimpinan</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <div style="padding:20px">

        <h1>Dashboard Pimpinan</h1>

        <hr>

        <a href="/pimpinan/dashboard">Dashboard</a> |
        <a href="/pimpinan/laporan">Laporan Pimpinan</a> |
        <form action="/logout" method="POST" style="display:inline;">

            @csrf

            <button type="submit">
                Logout
            </button>

        </form>

        <hr>

        @yield('content')

    </div>

</body>

</html>
