<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <h4>Aglet Movie Database</h4>

    <p>Good day {{ $contact['name'] }}</p>

    <p>We have received your message and we will contact very soon</p>
    <br>
    <div>Regards</div>
</body>
</html>

