<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title','Duckpay')</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>
<body class="app">
<main class="container">
    @yield('title.section','')
    @section('sidebar')
    @show
    <section class="mt-2">
        @yield('content')
    </section>
</main>
</body>
</html>
