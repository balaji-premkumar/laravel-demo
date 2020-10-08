<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel Test</title>
    {{--    <link rel="stylesheet" href="/css/pubilc.css"/>--}}
    <link rel="stylesheet" href={{mix('css/app.css')}} />
    <script src={{mix("js/manifest.js")}}></script>
    <script src={{mix("js/vendor.js")}}></script>
</head>
<body>
<nav>
    <div class="nav-wrapper">
        <a href="#" class="brand-logo">Laravel Test Data</a>
    </div>
</nav>
<div class="container">
    @yield("content")
</div>
<script src={{mix("js/app.js")}}></script>
</body>
</html>
