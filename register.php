<?php
require_once __DIR__.'/src/User.php';
require_once __DIR__.'/config.php';



if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['name'] ) && strlen(trim($_POST['name'])) > 1 
    &&isset($_POST['surname'] ) && strlen(trim($_POST['surname'])) > 1 
        && isset($_POST['email'] ) && strlen(trim($_POST['email'])) > 5  
       // && isset($_POST['password']) && strlen($_POST['password'] > 5)
        //&& isset($_POST['retyped_password'])
         ){
        if(trim($_POST['retyped_password']) == trim($_POST['password']) ){
                        
            $user = new User();
            $user->setName(trim($_POST['name']));
            $user->setSurname(trim($_POST['surname']));
            $user->setEmail(trim($_POST['email']));
            $user->setPassword(trim($_POST['password']));
            $user->saveToDB($conn);
            echo 'dokonano rejestracji uzytkownika: '.$_POST['name'];
            header('Location:login.php');
            
            
            
        }  else {
            echo 'Podane hasla nie sa identyczne nie udalo sie zarejestowac';    
        }
        
    }  else {
        

        echo 'podano nieprawidlowe dane';    
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

    <title>Register to Simple Shop to get the access to the best shop in the world!</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</head>

<body>

<div class="container">
    <div class="'col-md-4 col-md-offset-4"><br>
        <h2 class="form-signin-heading">Please provide your details:</h2><br>
    </div>
    <div class="col-md-4 col-md-offset-4">
        <form class="form-signin" method="post" action="#">
            <label for="inputName" class="sr-only">Name</label>
            <input type="text" name="name" id="inputName" class="form-control" placeholder="Name" required><br>
            <label for="inputSurname" class="sr-only">Surname</label>
            <input type="text" name="surname" id="inputSurname" class="form-control" placeholder="Surname" required><br>

            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus><br>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required><br>
            <label for="inputPassword" class="sr-only">Retype password</label>
            <input type="password" name="retyped_password" id="inputPassword" class="form-control" placeholder="retyped_password" required><br>
<!--            <label for="inputAddress" class="sr-only">Address</label>
            <input type="text" id="inputAddress" class="form-control" placeholder="Adress"><br>-->

            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        </form>
    </div>
</div> <!-- /container -->

</body>
</html>

