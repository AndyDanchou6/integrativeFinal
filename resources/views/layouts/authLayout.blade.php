<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Danch0u')</title>
    <link href="assets/css/auth.css" rel="stylesheet" />

    @yield('initialScript')

</head>

<body>
    @yield('content')

    @yield('script')

    @include('includes.authPopUps')
</body>

</html>