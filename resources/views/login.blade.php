@include('layouts.app')

@section('title', 'Sign in')

@section('content')

<div>
    <h1>Log in to your account</h1>
    <form action="/login" method="post">
        @csrf
        <label for="email">Email</label><br>
        <input type="text" name="email" id="email" placeholder="Your email here..." 
        @if(!empty($previousEmail))
            value={{$previousEmail}}
        @endif><br>
        <label for="password">Password</label><br>
        <input type="password" name="password" id="password" placeholder="Your password here..."><br>
        <input type="submit"><br>
    </form>
    @isset($errorMessage)
        <h2>{{$errorMessage}}</h2>
    @endisset

    <!-- It is quality rather than quantity that matters. - Lucius Annaeus Seneca -->
</div>
