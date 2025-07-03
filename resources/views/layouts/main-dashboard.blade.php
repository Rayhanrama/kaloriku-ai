<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Kaloriku</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    @include('layouts.sidebar')

    <div class="ml-64 mt-16 p-6">
        @include('layouts.navbar')
        <div class="mt-6">
            @yield('content')
        </div>
    </div>
</body>

</html>
