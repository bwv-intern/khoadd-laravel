<x-layout.app :title="'Todo #' . $todo['id']"></x-layout.app>
@section('content')

<div>
    <h1>Todo #{{$todo['id']}}</h1>
    <form>
        @csrf
        <label for="todoText">Todo text</label><br>
        <textarea type="textarea" @if(!(Auth::check() && Auth::user()->id === $todo['userId']) || $todo->trashed()) disabled @endif name="todoText" id="todoText" rows="4" cols="50">{{$todo['todoText']}}</textarea><br>
        <div id="buttonRow">
        @if(Auth::check() && Auth::user()->id === $todo['userId'])
            @if($todo->trashed())
            <button type="button" class="btn btn-primary" id='restoreBtn'>Restore</button>
            @else
            <button type="button" class="btn btn-primary" id='updateBtn'>Update</button>
            <button type="button" class="btn btn-primary" id='deleteBtn'>Delete</button>
            @endif
        @endif
        </div>
        <div id="spinner" class="spinner-border" style="display: none"></div>
    </form>

    <!-- It is quality rather than quantity that matters. - Lucius Annaeus Seneca -->
</div>

<script>
    // $(document).ajaxStart(function() {
    //     console.log('loading');
    //     $('#spinner').show();
    //     $('#buttonRow').hide();
    // })
    // .ajaxStop(function() {
    //     console.log('done');
    //     $('#spinner').hide();
    //     $('#buttonRow').show();
    // });
    $('#updateBtn').click(function () {
        var csrfToken = $('input[name="_token"]')[0].value;
        var newTodoText = $('#todoText').first().val();
        $.ajax({
            url: "{{route('updateTodo', ['id' => $todo['id']])}}", 
            type: "put", 
            data: {
                _token: csrfToken,
                todoText: newTodoText,
            },
            beforeSend: function() {
                $('#spinner').show();
                $('#buttonRow').hide();
            },
            complete: function() {
                $('#spinner').hide();
                $('#buttonRow').show();
            }
        });
    });
    $('#deleteBtn').click(function () {
        var csrfToken = $('input[name="_token"]')[0].value;
        $.ajax({url: "{{route('deleteTodo', ['id' => $todo['id']])}}", 
        type: "delete", 
        data: {
            _token: csrfToken,
        }, 
        success: function(result) {
            location.reload();
        },
        beforeSend: function() {
            $('#spinner').show();
            $('#buttonRow').hide();
        },
        error: function() {
                $('#spinner').hide();
                $('#buttonRow').show();
            }});
    });
    $('#restoreBtn').click(function () {
        var csrfToken = $('input[name="_token"]')[0].value;
        $.ajax({url: "{{route('restoreTodo', ['id' => $todo['id']])}}", 
        type: "post", 
        data: {
            _token: csrfToken,
        }, 
        success: function(result) {
            location.reload();
        },
        beforeSend: function() {
            $('#spinner').show();
            $('#buttonRow').hide();
        },
        error: function() {
            $('#spinner').hide();
            $('#buttonRow').show();
        }});
    });
</script>