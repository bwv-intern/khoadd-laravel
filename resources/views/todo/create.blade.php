<x-layout.app title="Create a todo"></x-layout.app>
@section('content')
<div>
    <h1>Have something on your mind?</h1>
    <form action="{{route('createTodo')}}" method="post">
        @csrf
        <label for="todoText">Todo text</label><br>
        <textarea name="todoText" id="todoText"
        placeholder="Your todo text here..." rows="4" cols="50"
        @if(!empty($previousTodoText)) value={{$previousTodoText}} @endif></textarea>
        <br>
        <button type="submit" class="btn btn-primary">Create todo</button><br>
    </form>

    <!-- It is quality rather than quantity that matters. - Lucius Annaeus Seneca -->
</div>

<script>
    $("#todoText").keypress(function (e) {
    if(e.which === 13 && !e.shiftKey) {
        e.preventDefault();
    
        $(this).closest("form").submit();
    }
});
</script>
