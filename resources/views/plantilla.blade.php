<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$titulo}}</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/b5/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font_awesome/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/jquery/jquery.js') }}"></script>
    <script src="{{ asset('js/font_awesome/all.js') }}"></script>
    <script src="{{ asset('js/b5/popper.js') }}"></script>
    <script src="{{ asset('js/b5/bootstrap.js') }}"></script>
</head>

<body>
    <section class="v-100">
        @yield('contenido')
    </section>
</body>
</html>
