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
    function load_territory(element, url) {
        $(element).load(url, function () {
            $(element).trigger("chosen:updated");
            $(element).chosen();
        });
    }

    $("select#region").chosen();
    $("#region").on('change', function () {
        load_territory("#city", "/ajax/select/city/" + $(this).val());
    });
    $("#city").on('change', function () {
        load_territory("#area", "/ajax/select/area/" + $("#region").val() + "/" + $(this).val());
    });
    $("form").on('submit', function (event) {
        event.preventDefault();
        var $name = $("#name");
        var $email = $("#email");
        var $region = $("#region");
        var $city = $("#city");
        var $area = $("#area");
        if ($name.val() !== '' && $email.val() !== '') {
            // Validation

            // Try email
            $("#user-card").load("/ajax/user/" + $email.val(), function (response, status) {
                if (status !== 'error') {
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
        } else {
            alert("Please, fill out all the fields.");
        }
    });
</script>
</body>
</html>