<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kaloriku</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">

    @include('layouts.navbar-home')

    <div class="pt-16">
        @yield('content')
    </div>

</body>
</html>
