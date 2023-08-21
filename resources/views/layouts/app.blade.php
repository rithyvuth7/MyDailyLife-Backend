<!doctype html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MyDailyLife</title>
    <!-- CSS -->
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/bootstrap/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/bootstrap/font/bootstrap-icon-sizes.css">
    <link rel="stylesheet" href="/css/custom.css">
    <link rel="stylesheet" href="/css/selectize.bootstrap5.css">

    @yield('style')

    <!-- JS -->
    <script src="/bootstrap/js/popper.min.js"></script>
    <script src="/bootstrap/js/bootstrap.min.js"></script>
    <script src="/js/jquery.min.js"></script>
    <script src="/js/selectize.min.js"></script>

    <script>
        $(document).ready(function (){
            $('select[multiple][required]').selectize({
                plugins: ['remove_button', 'clear_button'],
                create: true,
                sortField: 'text'
            });
            $('select').selectize({
                plugins: ['remove_button', 'clear_button'],
                create: true,
                sortField: 'text'
            });
        });
        $(document).ready(function (){
            $('#currency1').on('click', function (){
                $('#basic-addon2').text('KHR');
            });
            $('#currency2').on('click', function (){
                $('#basic-addon2').text('USD');
            });
        });

    </script>

    @yield('script')

</head>
<body>
    @include('layouts.app.header')
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
