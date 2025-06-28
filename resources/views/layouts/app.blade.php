<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'BRIGHTEYE') }}</title>
    <link rel="icon" href="{{ asset('eyes.ico') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>{{ config('app.name', 'BRIGHTEYE') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f6f9;
        }
    </style>
</head>

<body class="font-sans bg-gray-100">

    <body>
        <div class="min-h-screen flex flex-col">
            @include('layouts.navigation')

            <main class="flex-1 py-6 px-4">
                @yield('content')
            </main>
        </div>
    </body>

</html>
