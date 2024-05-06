@include('layouts.app')

@section('title', 'Sign up')

@section('content')

<div>
    <h1>Register a new account</h1>
    <form action="/register" method="post">
        @csrf
        <label for="email">Email</label><br>
        <input type="text" name="email" id="email" placeholder="Your email here..." 
        @isset($previousEmail)
            value={{$previousEmail}}
        @endisset><br>
        <label for="name">Name</label><br>
        <input type="text" name="name" id="name" placeholder="Your name here..." 
        @isset($previousName)
            value={{$previousName}}
        @endisset><br>
        <label for="password">Password</label><br>
        <input type="password" name="password" id="password" placeholder="Your password here..."><br>
        <label for="password_confirmation">Repeat password</label><br>
        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Repeat password here..."><br>
        <input type="submit"><br>
    </form>
    @isset($errorMessage)
        <h2>{{$errorMessage}}</h2>
    @endisset

    <!-- It is quality rather than quantity that matters. - Lucius Annaeus Seneca -->
</div>
