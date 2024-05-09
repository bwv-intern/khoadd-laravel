<x-layout.app title="Profile"></x-layout.app>
@section('content')

{{-- <script src="/public/storage/test.js"></script> --}}

<div class="container">
    <h1>Profile</h1>
    <h2>Your email: {{$user->email;}}</h2>
    <h2>Your name: {{$user->name;}}</h2>
    <h2>Days since you joined: {{$elapsedDays}}</h2>
    <h2 id="joinedAt">Joined at:</h2>
    <h2 id="requestTime">The time of this moment:</h2>
    @vite(['resources/js/app.js', 'resources/js/util.js'])
    <script type="module">
        $("#joinedAt").text("Joined at: " + window.toLocaleDateTime("{{$user->created_at->toISOString()}}"));
        $("#requestTime").text("The time of this moment: " + (window.getMoment()));
        // $("#joinedAt").text("Joined at: " + (new Date("{{$user->created_at->toISOString()}}")).toLocaleString());
        // $("#requestTime").text("Current time: " + (new Date("{{$currentTime}}")).toLocaleString());
    </script>
</div>
