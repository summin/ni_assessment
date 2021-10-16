<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>NI-assignment login</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->


        <style>

            .container {
                font-family: 'Nunito', sans-serif;
                display: flex;
                flex-direction: column;
                max-width: 30%;
                padding-left: 35%;
            }

            .container>* {
                justify-content: space-around;
                margin: 5px;
            }
        </style>
    </head>
    <body class="antialiased">

        <form id="form" class = "container" onsubmit = "submit">
            <h2>Login to your account</h2>

            <input id="username" type="text" title="username" placeholder="username" />
            <input id="password" type="password" title="username" placeholder="password" />
            <button type="submit" class="btn">Login</button>
        </form>

        <div class = container>
            <p align = "center" id = "loggedin" hidden> You Are Logged In! </p>
            <p id = "error" hidden> Error! </p>

        </div>

        <script>
          const form = document.getElementById('form');
          const password = document.getElementById('password');
          const username = document.getElementById('username');
          const loggedin = document.getElementById('loggedin');
          const error = document.getElementById('error');

          username.oninvalid = password.oninvalid = invalid;

          form.onsubmit = submit;

          function invalid(event) {
            error.removeAttribute('hidden');
          }

          function submit(event) {
            event.preventDefault();



            console.log(window.location)
            form.remove();
            loggedin.removeAttribute('hidden');
            event.preventDefault();

          }
        </script>
    </body>
</html>
