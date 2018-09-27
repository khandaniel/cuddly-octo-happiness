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
            var emailRegExp = new RegExp(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
            if (emailRegExp.test($email.val())) {
                $("#user-card").load("/ajax/user/" + $email.val(), function (response) {
                    if (response === '') {
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
                        }).done(function (response) {
                            if (response === 'success') {
                                $("#user-card")
                                    .append("<tr><td>Data saved!</td></tr>")
                                    .css({
                                        "padding": "20px 30px",
                                        "background-color": "#6bce6b"
                                    });
                            }
                        });
                    }
                });
            } else {
                alert("Heh, email is not email");
            }
        } else {
            alert("Please, fill all the fields.");
        }
    });
</script>
</body>
</html>