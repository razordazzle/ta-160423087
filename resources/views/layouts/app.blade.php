<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Singgah | @yield('title','Destinasi Wisata di Bali')</title>

    {{-- Identitas sistem: berkas gambar ada di public/brand --}}
    @php($versiIkon = @filemtime(public_path('brand/logo.png')) ?: 1)
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('brand/favicon-32.png') }}?v={{ $versiIkon }}">
    <link rel="icon" sizes="any" href="{{ asset('brand/favicon.ico') }}?v={{ $versiIkon }}">
    <link rel="apple-touch-icon" href="{{ asset('brand/apple-touch-icon.png') }}?v={{ $versiIkon }}">
    <link rel="manifest" href="{{ asset('manifest.webmanifest') }}">
    <meta name="apple-mobile-web-app-title" content="Singgah">

    @stack('head')

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-background font-body text-gray-900" ontouchstart="">
    @yield('content')
</body>
</html>