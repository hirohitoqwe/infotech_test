<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test</title>
    @vite(['resources/js/app.js'])
    @livewireStyles
</head>
<body>
<div class="container">
    <a href="/products">Товары</a>
    <a href="/">Категории</a>
    @yield('content')
</div>
@livewireScripts
</body>
</html>

