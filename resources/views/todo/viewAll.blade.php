<x-layout.app title="Todos"></x-layout.app>
@section('content')

<div class="container">
    <h1>Todos</h1>
    @auth <a href="{{route('createTodo')}}">Or create a new one now</a> @endauth
    <h2>Search options</h2>
    <form action="{{route('viewAllTodos')}}" method="get">
        <label for="search">Search</label><br>
        <input type="text" name="search" id="search" placeholder="Your search here..." value="{{app('request')->input('search') ?? ''}}"><br>
        <label for="limit">Page limit</label><br>
        <input type="number" min="5" max="20" name="limit" id="limit" placeholder="Set your page limit here..." value="{{app('request')->input('limit') ?? 5}}"><br>
        <button type="submit" class="btn btn-primary">Search</button><br>
    </form>
    <h2>Search result</h2>
    @foreach($todoPaginator as $todo)
    <a href="{{route('viewTodo', ['id' => $todo->id]);}}">Todo #{{$todo->id}} @if($todo->freshness === app\Models\Freshness::New->value) (new) @endif</a><br>
    @endforeach

    {{$todoPaginator->links();}}

    <!-- It is quality rather than quantity that matters. - Lucius Annaeus Seneca -->
</div>