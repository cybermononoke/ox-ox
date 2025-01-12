<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="forest">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title.' - '.config('app.name') : config('app.name') }}</title>

    <script src="https://cdn.jsdelivr.net/npm/vanilla-calendar-pro@2.9.6/build/vanilla-calendar.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/theme-change@2.0.2/index.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/vanilla-calendar-pro@2.9.6/build/vanilla-calendar.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen font-sans antialiased bg-base-200/50 dark:bg-base-200">

    {{-- MAIN --}}
    <x-main full-width>
        {{-- The `$slot` goes here --}}
        <x-slot:content>
            {{ $slot }}
        </x-slot:content>
    </x-main>

    <div class="btm-nav fixed bottom-0 w-full bg-base-600 shadow-md flex justify-between">
        <x-button label="Home" class="btn-ghost flex-1" link="/courses" />
        <x-button label="Tasks" class="btn-ghost flex-1" link="/tasks" />
        <x-button label="Grades" class="btn-ghost flex-1" link="/grades" />
        <x-button label="Chatroom" class="btn-ghost flex-1" link="/students/chatroom/index" />
        <x-button label="Profile" class="btn-ghost flex-1" link="/profile" />

    </div>


    {{-- TOAST area --}}
    <x-toast />
</body>

</html>