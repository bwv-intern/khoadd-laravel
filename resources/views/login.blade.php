<x-layout.app title="Login"></x-layout.app>
@section('content')

<div>
    <h1>Log in to your account</h1>
    <form action="/login" method="post">
        @csrf
        <label for="email">Email</label><br>
        <input type="email" name="email" id="email" placeholder="Your email here..." 
            value={{old('email')}}><br>
        <label for="password">Password</label><br>
        <input type="password" name="password" id="password" placeholder="Your password here..."><br>
        <input type="submit"><br>
    </form>

    <!-- It is quality rather than quantity that matters. - Lucius Annaeus Seneca -->
</div>
