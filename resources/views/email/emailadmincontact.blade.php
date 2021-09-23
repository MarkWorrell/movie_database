<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <h4>Aglet Movie Database</h4>

    <p>A message was sent from the site with the following:</p>
    <br>
    <p>Full Name: {{ $contact['name'] }}</p>
    <br>
    <p>Cell number: {{ $contact['cell'] }}</p>
    <br>
    <p>Email: {{ $contact['email'] }}</p>
    <br>
    <p>Social Media Links: {{ $contact['social_media'] }}</p>
    <br>
    <p>Message: {{ $contact['message'] }}</p>
    <br>
    <div>Regards</div>
</body>
</html>

