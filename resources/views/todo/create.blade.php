@include('layouts.app')

@section('title', 'Create a todo')

@section('content')

<div>
    <h1>Have something on your mind?</h1>
    <form action="/todos/new" method="post">
        @csrf
        <label for="todoText">Todo text</label><br>
        <textarea name="todoText" id="todoText"
        placeholder="Your todo text here..." rows="4" cols="50"
        @if(!empty($previousTodoText)) value={{$previousTodoText}} @endif></textarea>
        <br>
        <input type="submit"><br>
    </form>
    @isset($errorMessage)
    <h2>{{$errorMessage}}</h2>
    @endisset

    <!-- It is quality rather than quantity that matters. - Lucius Annaeus Seneca -->
</div>