<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    {{-- Tailwind --}}
    @vite('resources/css/app.css')

    {{-- Google Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Boxicons CSS --}}
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <section>
        @include('layout.dashboard.sidebar')
        @include('layout.dashboard.header')
        <main class="content-container">
            <div class="px-4 py-10">
                @yield('mainContent')
            </div>
        </main>
    </section>

    @stack('scripts')
</body>

</html>
