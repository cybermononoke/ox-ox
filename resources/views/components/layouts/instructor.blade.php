<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="forest">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title.' - '.config('app.name') : config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.jsdelivr.net/npm/vanilla-calendar-pro@2.9.6/build/vanilla-calendar.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/vanilla-calendar-pro@2.9.6/build/vanilla-calendar.min.css" rel="stylesheet">
</head>

<body class="min-h-screen font-sans antialiased bg-base-200/50 dark:bg-base-200 flex flex-col">

    <!-- MAIN -->
    <x-main full-width class="flex-grow pb-20">
        <div class="container mx-auto px-4 py-6 mb-16">
            <x-slot:content>
                {{ $slot }}
            </x-slot:content>
        </div>
    </x-main>

    <!-- Bottom Navigation -->
    <div class="btm-nav fixed bottom-0 w-full h-16 bg-base-600 shadow-md flex justify-between z-50">
        <x-button label="Home" class="btn-ghost flex-1" link="/instructors/dashboard" />
        <x-button label="Batches" class="btn-ghost flex-1" link="/instructors/batches" />
        <x-button label="Profile" class="btn-ghost flex-1" link="/profile" />
        <x-button label="Submissions" class="btn-ghost flex-1" link="/instructors/submissions" />
    </div>

</body>

</html>