<!DOCTYPE html>

<html lang="en">
<head>

    @include('partials.htmlheader')

</head>

<body>

    @include('partials.messages')
    @yield('body')
    @include('partials.scripts')

</body>
</html>
