<!doctype html>
<html>
<head>
    <link rel="stylesheet" href="/chosen/chosen.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="/chosen/chosen.jquery.min.js"></script>
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
<form action="/new-user" method="post">
    @csrf
    <input type="text" name="name" id="name" value="Name" required/>
    <input type="email" name="email" id="email" value="Email@Mail.com" required/>
    <select name="region" id="region" required/>
    <option value="Region">Region</option>
    <option value="Region1">Region 1</option>
    <option value="Region2">Region 2</option>
    </select>
    {{--<select name="city" id="city" class="hidden"><option value="12">City 12</option></select>--}}
    {{--<select name="area" id="area"><option value="Area">Area</option></select>--}}
    <input type="submit" value="Go on"/>
</form>
<script>
    $("select#region").chosen();
    $("form").on('submit', function (event) {
        var name = $("#name");
        var email = $("#email");
        var region = $("#region");
        var city = $("#city");
        var area = $("#area");
        if (name.val() !== '' && email.val() !== '') {
            if (city.val() === null || city.val() === undefined) {
                var cityHtml = '<select name="city" id="city"><option value="12">City 12</option></select>'; // ajax loads
                $(cityHtml).insertBefore("input[type='submit']");
                $("#city").chosen();
                event.preventDefault();
            } else if (area.val() === null || area.val() === undefined) {
                var areaHtml = '<select name="area" id="area"><option value="122">Area 122</option></select>'; // ajax loads
                $(areaHtml).insertBefore("input[type='submit']");
                $("#area").chosen();
                event.preventDefault();
            }
        }
    });
</script>
</body>
</html>