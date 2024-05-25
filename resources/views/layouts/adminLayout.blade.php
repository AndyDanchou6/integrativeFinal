<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Danchou')</title>

    <link rel="stylesheet" href="assets/css/admin.css">

    <script>
        const token = localStorage.getItem('danchouToken');

        if (!token) {
            window.location.href = '/';
        }

        const csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");
    </script>

</head>

<body>
    <!-- Header -->
    @include('includes.header')

    <!-- Sidebar -->
    @include('includes.sidebar')

    <!-- Content -->
    <section class="column" id="content">
        @yield('content')

        <!-- Footer -->
        @include('includes.footer')
    </section>

    @include('includes.popUp')

    @yield('script')

    <script src="assets/js/admin.js"></script>
</body>

</html>