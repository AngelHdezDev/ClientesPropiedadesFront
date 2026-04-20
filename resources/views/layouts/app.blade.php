<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seminuevos - El auto que buscas, con el respaldo que mereces</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!-- <link rel="stylesheet" href="{{ asset('css/navbar.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    @stack('styles') 
    
</head>

<body>

    @auth
        @include('partials.navbar')
    @endauth

    <main>
        @yield('content') {{-- Aquí se inyectará el contenido de cada página --}}
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('scripts') 
    
</body>

</html>