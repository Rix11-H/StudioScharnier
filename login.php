<?php

include_once("bootstrap.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <title>Login | Studio Scharnier</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!--- css --->
    <link rel="stylesheet" href="css/app.css?v=<?php echo time() ?>">
</head>

<body>
    <?php include_once("Includes/nav.inc.php"); ?>
    <main class="login">
        <div class="background">
            <div class="content">
                <form class="form form--account">
                    <h1 class="pb-3">Login</h1>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Enter Password">
                        <small id="passwordforget" class="form-text text-muted"><a href="#">Forgot password</a></small>
                    </div>
                    <input type="submit" class="btn btn--primary" value="Login"></input>
                    <hr class="mt-4">
                    <small id="noAccountYet" class="form-text text-muted">No account yet? | <a href="register.php" class="card__link">Register</a></small>
                </form>
            </div>
        </div>
    </main>
    <?php include_once("Includes/footer.inc.php"); ?>
</body>

</html>