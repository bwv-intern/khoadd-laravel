<x-layout.app title="Login">

<div class="container">
    <h1>Log in to your account</h1>
    <form action="{{route('login')}}" method="post" id="loginForm">
        @csrf
        <label for="email">Email</label><br>
        <input type="text" name="email" id="email" placeholder="Your email here..." 
            value="{{old('email')}}"><br>
        <label for="password">Password</label><br>
        <input type="password" name="password" id="password" placeholder="Your password here..."><br>
        <button type="submit" class="btn btn-primary">Log in</button><br>
    </form>
    <script>
        $("#loginForm").validate(
            {
                rules: {
                    email: {
                        required: true,
                        requiredHard: true,
                        email: true,
                    },
                    password: {
                        required: true,
                        requiredHard: true,
                    }
                }
            }
        );
    </script>

    <!-- It is quality rather than quantity that matters. - Lucius Annaeus Seneca -->
</div>

</x-layout.app>
