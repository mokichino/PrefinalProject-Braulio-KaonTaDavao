<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', "Kaon Ta! Davao - Braulio's Food Guide")</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#fffaf0] text-[#24302b]">
    <header class="border-b border-[#d9cdb8] bg-[#173b35] text-[#fffaf0]">
        @include('partials.nav')
    </header>
    @include('partials.flash')
    <main>@yield('content')</main>
    <footer class="mt-16 border-t border-[#d9cdb8] bg-[#173b35] px-5 py-8 text-center text-sm text-[#fffaf0]">Kaon Ta! Davao - Braulio's Food Guide</footer>
</body>
</html>
