<x-layout.app title="Create a todo"></x-layout.app>
@section('content')
<div class="container">
    <h1>Have something on your mind?</h1>
    <form action="{{route('createTodo')}}" method="post" id="createTodoForm">
        @csrf
        <label for="todoText">Todo text</label><br>
        <textarea name="todoText" id="todoText"
        placeholder="Your todo text here..." rows="4" cols="50"
        @if(!empty($previousTodoText)) value={{$previousTodoText}} @endif></textarea>
        <br>
        <button type="submit" class="btn btn-primary">Create todo</button><br>
    </form>
    <script>
        $("#createTodoForm").validate(
            {
                rules: {
                    todoText: {
                        required: true,
                    },
                }
            }
        );
    </script>

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
