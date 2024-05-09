<!DOCTYPE html>
<html>

<head>
    <title>{{$title}}</title>
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Boostrap js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

    <!-- jQueryvalidation -->
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.js" crossorigin="anonymous"></script>

    <script type="module">
        $.validator.addMethod("requiredHard", function(value, element) {
            value = value ?? "";
            // console.log(value);
            // console.log(value? 1: 0);
            // console.log(!value.split('').every(function(val) {
            //     return val === " ";
            // })? 1: 0);
            // console.log((value !== "" && !value.split('').every(function(val) {
            //     return val == " ";
            // }))? "good" : "bad");
            return this.optional(element) || (value !== "" && !value.split('').every(function(val) {
                return val == " ";
            }));
        }, 'This field is required.');
    </script>
</head>

<body>
    <x-navbar></x-navbar>
    <x-alert></x-alert>
    {{$slot}}
</body>
</html>
