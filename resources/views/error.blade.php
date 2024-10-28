<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error - TypStr</title>
</head>

<body>
    <div class="h-100 d-flex align-items-center justify-content-center">
        <h1>{{ $error ?? "Some Error Occured" }}</h1>
        <a href="{{ url('/') }}" class="btn btn-primary">Go to Homepage</a>
    </div>
</body>

</html>