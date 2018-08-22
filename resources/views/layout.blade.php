<!DOCTYPE html>

<html lang="es" class="dark">
    <head>

        @include('partials.htmlheader')

    </head>
    <body>

        @yield('login')
        @yield('body')
        @include('partials.scripts')

    </body>
</html>
