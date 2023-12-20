<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Page Title' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="min-h-screen font-sans antialiased bg-base-200/50 dark:bg-base-200">

    <x-nav sticky>
        <x-slot:brand>
            <x-crud-brand />
        </x-slot:brand>
        <x-slot:actions>
            <x-button label="Posts" link="{{Route::is('volt.*') ? route('volt.posts.index') : route('posts.index')}}"
                icon="o-chat-bubble-bottom-center-text" class="btn-ghost btn-sm" />
        </x-slot:actions>
    </x-nav>

    <x-main>
        {{-- The `$slot` goes here --}}
        <x-slot:content>
            {{ $slot }}
        </x-slot:content>
    </x-main>

    {{-- TOAST AREA --}}
    <x-toast />
</body>

</html>
