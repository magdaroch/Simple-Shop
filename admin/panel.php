<?php

require_once 'src/Admin.php';
require_once 'src/User.php';
require_once 'config.php';

session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   

    if (isset($_POST['email']) && strlen(trim($_POST['email'])) >= 5 && isset($_POST['password']) && isset($_POST['password']) >= 6) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $userAdmin = Admin::getUserByEmail($conn, $email);
        if ($userAdmin) {
            
            $_SESSION['userId'] =  $userAdmin->getIdUser();


            header('Location: index_login.php');
        } else {
            echo 'Niepoprawne dane logowania';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Sign in to Simple Shop and shop with us!</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


    </head>

    <body>

        <div class="container">
            <div class="col-md-4 col-md-offset-4"><br>
                <h2 class="form-signin-heading">Please sign in</h2><br>
            </div>
            <div class="col-md-4 col-md-offset-4">
                <form class="form-signin" method="post" action="#">
                    <label for="inputEmail" class="sr-only">Email address</label>
                    <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus><br>
                    <label for="inputPassword" class="sr-only">Password</label>
                    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="remember-me"> Remember me
                        </label>
                    </div>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                    <br>
                    <button class="btn btn-lg btn-primary btn-block" onclick="location.href = 'register.php'" type="button">
                        regjster</button>
                </form>





            </div>
        </div> <!-- /container -->

    </body>
</html>

