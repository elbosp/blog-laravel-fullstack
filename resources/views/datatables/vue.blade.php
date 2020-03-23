<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Datatables with Vue</title>

    </head>
    <body>
        <div id="datatables-vue">
            <datatables-vue></datatables-vue>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
