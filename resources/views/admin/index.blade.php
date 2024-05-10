<x-layout.app title="Profile">

    <div class="container">
        <h1>Admin</h1>
        <a href="{{route('adminExportUsers')}}">Export all users as csv</a>
        <script type="module">
            $.validator.addMethod('filesize', function(value, element, param) {
                return this.optional(element) || (element.files[0].size < param * 1024 * 1024);
            }, 'Please choose a file that is less than {0} MB');
        </script>
        <form action="{{route('adminImportUsers')}}" id="uploadUsersCsv" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="csvToUpload">Import users from csv (max file size: 50MBs)</label>
            <input type="file" id="csvToUpload" name="csvToUpload" accept=".csv">
            <button type="submit">Upload</button>
            <script>
                $("#uploadUsersCsv").validate({
                    rules: {
                        csvToUpload: {
                            required: true,
                            filesize: 50,
                            accept: "csv",
                        }
                    }
                });
            </script>
        </form>
        @isset($numAddedUsers)
        You just imported {{$numAddedUsers}}@if ($numAddedUsers > 1) users @else user @endif
        @endisset
    </div>
    
    </x-layout.app>
    