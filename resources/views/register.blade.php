<x-layout.app title="Signup"></x-layout.app>
@section('content')

<div>
    <h1>Register a new account</h1>
    <form action="/register" method="post">
        @csrf
        <label for="email">Email</label><br>
        <input type="email" name="email" id="email" placeholder="Your email here..." 
            value={{old('email')}}><br>
        <label for="name">Name</label><br>
        <input type="text" name="name" id="name" placeholder="Your name here..." 
            value={{old('name')}}><br>
        <label for="password">Password</label><br>
        <input type="password" name="password" id="password" placeholder="Your password here..."><br>
        <label for="password_confirmation">Repeat password</label><br>
        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Repeat password here..."><br>
        <input type="submit"><br>
    </form>

    <!-- It is quality rather than quantity that matters. - Lucius Annaeus Seneca -->
</div>
