@include('layouts.app')

@section('title', "Todo #{$todo['id']}")

@section('content')

<div>
    <h1>Todo #{{$todo['id']}}</h1>
    <form>
        <label for="todoText">Todo text</label><br>
        <textarea type="textarea" disabled name="todoText" id="todoText" rows="4" cols="50">{{$todo['todoText']}}</textarea><br>
    </form>

    <!-- It is quality rather than quantity that matters. - Lucius Annaeus Seneca -->
</div>