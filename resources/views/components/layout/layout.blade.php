@props(
    ['title' => 'Ideas']
)

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <x-navbar></x-navbar>
    <main class="max-w-7xl mx-auto">

       
        {{ $slot }}
    </main>

    @session('success')
        <div
        x-data="{show: true}"
        x-init="setTimeout(() => show = false, 3000)"
        x-show="show"
        x-transition
        class="btn btn-primary absolute bottom-3 right-3">
            {{ $value }}
        </div>
    @endsession
</body>
</html>