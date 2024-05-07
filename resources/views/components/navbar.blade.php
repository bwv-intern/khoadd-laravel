<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{route('home')}}">Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        @auth
        <li class="nav-item">
            <a class="nav-link">Hello, {{ Auth::user()['name']}}!</a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" href="{{route('logout')}}">Log out</a>
        </li>
        @endauth
        @guest
        <li class="nav-item">
          <a class="nav-link" href="{{route('login')}}">Log in</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('register')}}">Register</a>
        </li>
        @endguest
        <li class="nav-item">
            <a class="nav-link" href="{{route('viewAllTodos')}}">Todos</a>
        </li>
      </ul>
    </div>
</nav>