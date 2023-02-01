<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">

    <style>
        /*.form-signin {*/
        /*    width: 100%;*/
        /*    max-width: 330px;*/
        /*    padding: 15px;*/
        /*    margin: auto;*/
        /*}*/
    </style>
    <title>Login page</title>
</head>

<body>

<div class="d-flex justify-content-center align-items-center vh-100">
    <form action="doAuth.php" class="form-signin text-center" method="post" >
        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
        <input type="text" name="inputLogin" class="form-control mb-3" placeholder="Login" required="" autofocus="">
        <input type="password" name="inputPassword" class="form-control mb-3" placeholder="Password" required="">
        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    </form>
</div>

</body>
</html>

