<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title}}</title>
    <script src="https://cdn.cubing.net/v0/js/cubing/twisty" type="module"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="text-[#1C1C1C]">
@include('layouts.nav')
<main>
    {{$slot}}
</main>

</body>
</html>
