<x-layout.app title="Login"></x-layout.app>
@section('content')

<div>
    <h1>Log in to your account</h1>
    <form action="{{route('login')}}" method="post">
        @csrf
        <label for="email">Email</label><br>
        <input type="text" name="email" id="email" placeholder="Your email here..." 
            value={{old('email')}}><br>
        <label for="password">Password</label><br>
        <input type="password" name="password" id="password" placeholder="Your password here..."><br>
        <button type="submit" class="btn btn-primary">Log in</button><br>
    </form>

    <!-- It is quality rather than quantity that matters. - Lucius Annaeus Seneca -->
</div>
