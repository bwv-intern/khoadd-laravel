<x-layout.app title="Profile"></x-layout.app>
@section('content')

{{-- <script src="/public/storage/test.js"></script> --}}

<div class="container">
    <h1>Profile</h1>
    <h2>Your email: {{$user->email;}}</h2>
    <h2>Your name: {{$user->name;}}</h2>
    <h2>Days since you joined: {{$elapsedDays}}</h2>
    <h2 id="joinedAt">Joined at:</h2>
    <h2 id="serverTime">The time of this moment:</h2>
    <h2 id="requestTime">The time of this moment:</h2>
    @vite(['resources/js/app.js', 'resources/js/util.js'])
    <script type="module">
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
