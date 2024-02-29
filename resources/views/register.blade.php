<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 400px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            margin-top: 20px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 10px 0;
            margin: 10px 0 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        span {
            color: red;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>User Registration</h1>
        <form id="register_form">
            <input type="text" name="name" placeholder="Enter Name">
            <span class="error name_err"></span>
            <input type="text" name="email" placeholder="Enter Email" autocomplete="new-email">
            <span class="error email_err"></span>
            <input type="password" name="password" placeholder="Enter Password" autocomplete="new-password">
            <span class="error password_err"></span>
            <input type="password" name="password_confirmation" placeholder="Confirm Password"
                autocomplete="new-password">
            <span class="error password_confirmation_err"></span>
            <input type="submit" value="Register">
        </form>
    </div>
</body>

</html>


<script>
    $(document).ready(function() {
        $("#register_form").submit(function(event) {
            event.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url: "http://daily-dump.test/api/register",
                type: "POST",
                data: formData,
                success: function(data) {
                    if (data.msg) {} else {
                        printErrorMsg(data);
                    }
                }
            });
        });
    });

    function printErrorMsg(msg) {
        $(".error").text("");

        $.each(msg, function(key, value) {
            $("." + key + "_err").text(value);
        });
    }
</script>
