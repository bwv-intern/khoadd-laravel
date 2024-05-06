<!DOCTYPE html>
<html>

<head>
    <title>@yield('title', 'Some default title')</title>
</head>

<body>
    <a href="/home">Home page</a>
    @auth
    Hello, {{ Auth::user()['name']}}!
    <a href="/logout">Log out</a>
    @endauth
    @guest
    You are not logged in!
    <a href="/login">Log in</a>
    <a href="/register">Register</a>
    @endguest
    @yield('content')
</body>

</html>