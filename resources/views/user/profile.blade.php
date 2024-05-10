<x-layout.app title="Profile">

<div class="container">
    <h1>Profile</h1>
    <h2>Your email: {{$user->email;}}</h2>
    <h2>Your name: {{$user->name;}}</h2>
    <h2>Days since you joined: {{$elapsedDays}}</h2>
    <h2 id="joinedAt">Joined at:</h2>
    <h2 id="serverTime">Server time:</h2>
    <h2 id="requestTime">The time of this moment:</h2>
    <h2 id="randomWords">Your random words: <button id="getRandomWordsBtn">reveal</button><div id="spinner" class="spinner-border" style="display: none"></div></h2>
    @vite(['resources/js/app.js', 'resources/js/util.js'])
    <script type="module">
        $.validator.addMethod('filesize', function(value, element, param) {
            return this.optional(element) || (element.files[0].size < param * 1024 * 1024);
        }, 'Please choose a file that is less than {0} MB');
        $("#getRandomWordsBtn").on("click", function() {
            $.ajax({
            url: "{{route('getRandomWords')}}", 
            type: "get",
            beforeSend: function() {
                $("#getRandomWordsBtn").hide();
                $("#spinner").show();
            },
            complete: function() {
                $("#spinner").hide();
            },
            success: function(response) {
                $("#randomWords").text("Your random words: " + response);
            },
            error: function(response, status, error) {
                $("#getRandomWordsBtn").show();
                alert("Something went wrong, please try again later.");
            }
        });
        });
        $("#joinedAt").text("Joined at: " + window.toLocaleDateTime("{{$user->created_at->toISOString()}}"));
        $("#serverTime").text("Server time: " + window.toLocaleDateTime("{{$serverTime}}"));
        $("#requestTime").text("The time of this moment: " + (window.getMoment()));
    </script>
    @if($hasYourImage)
    <p>You have already uploaded an image, you can:</p>
    <ul>
        <li>
    @endif
    <form action="{{route('uploadYourImage')}}" id="uploadImageForm" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="imageToUpload">@if(!$hasYourImage)Upload an image here @else Overwrite it with another upload @endif (max file size: 5MBs)</label>
        <input type="file" id="imageToUpload" name="imageToUpload" accept="image/*">
        <button type="submit">Upload</button>
        <script>
            $("#uploadImageForm").validate({
                rules: {
                    imageToUpload: {
                        required: true,
                        requiredHard: true,
                        filesize: 5,
                    }
                }
            })
            </script>
    </form>
    @if($hasYourImage)
        </li>
        <li>
            <a href="{{route('downloadYourImage')}}">Download it here</a>
        </li>
        <li>
            <a href="{{route('deleteYourImage')}}">Delete it here</a>
        </li>
    </ul>
    @endif
</div>

</x-layout.app>
