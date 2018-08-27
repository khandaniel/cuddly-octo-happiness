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

        .visually-hidden {
            opacity: 0;
            position: fixed;
            top: -100px;
        }
    </style>
</head>
<body>
<form action="/new-user" method="post">
    @csrf
    <input type="text" name="name" id="name" value="Name" required/>
    <input type="email" name="email" id="email" value="Email@Mail.com" required/>
    @if(isset($territories))
        <select name="region" id="region" required/>
        <option value="">-- Select value --</option>
        @foreach($territories as $territory)
            <option value="{{ $territory->reg_id }}">{{ $territory->ter_name }}</option>
            @endforeach
            </select>
            <select name="city" id="city" class="visually-hidden"></select>
            <select name="area" id="area" class="visually-hidden"></select>
            @endif
            <input type="submit" value="Go on"/>
</form>
<table id="user-card"></table>
<script>
    $("select#region").chosen();
    $("form").on('submit', function (event) {
        var $name = $("#name");
        var $email = $("#email");
        var $region = $("#region");
        var $city = $("#city");
        var $area = $("#area");
        if ($name.val() !== '' && $email.val() !== '') {
            if ($city.val() === null || $city.val() === undefined) {
                event.preventDefault();
                $("#city").load("/ajax/select/city/" + $region.val(), function () {
                    $("#city").chosen();
                });
            } else if ($area.val() === null || $area.val() === undefined) {
                event.preventDefault();
                $("#area").load("/ajax/select/area/" + $region.val() + "/" + $city.val(), function () {
                    $("#area").chosen();
                });
            } else {
                event.preventDefault();
                // Validation

                // Try email
                $("#user-card").load("/ajax/user/" + $email.val(), function (response, status, xhr) {
                    if (status !== 'error') {
                        alert('User already exists');
                        return;
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "/new-user",
                    data: {
                        "_token": $("input[name='_token']").val(),
                        "name": $name.val(),
                        "email": $email.val(),
                        "region": $region.val(),
                        "city": $city.val(),
                        "area": $area.val()
                    }
                }).done(function () {

                });
            }
        } else {
            event.preventDefault();
            alert("Please, fill out all the fields.");
        }
    });
</script>
</body>
</html>