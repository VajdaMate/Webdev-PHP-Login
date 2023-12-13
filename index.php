<?php 
    session_start();
    if (isset($_SESSION['bazdmegIttARendorseg']) && $_SESSION['bazdmegIttARendorseg']) {
        header('refresh:3; url=https://police.hu');
        session_destroy();
    }
    
    $color = '';
    if (isset($_SESSION['fav_color'])) {
    $color = ' background-color: ' . $_SESSION['fav_color'] . ';';
    }
?>


<!DOCTYPE html>
<html>
<head>
    <title>Webfejlesztés 2. Beadandó Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    body {
        background: linear-gradient(to bottom, #2980b9, #6dd5fa);
    }
    .container {
        background-color: rgba(255, 255, 255, 0.8); 
        padding: 20px;
        border-radius: 8px;
    }
    .circle {
        width: 300px;
        height: 300px;
        border-radius: 50%;
        <?= $color ?>
        margin: 50px auto;
    }
</style>

<body class="d-flex justify-content-center align-items-center" style="height: 75vh;">
    <div class="col-md-6">
        <div class="text-center display-4 font-weight-bold mb-2">Login</div>
        <?php
        if ((key_exists('login', $_SESSION) && !$_SESSION['login']) || (key_exists('bazdmegIttARendorseg', $_SESSION) && $_SESSION['bazdmegIttARendorseg']) ) {
                echo(
                '<div class="alert alert-danger" role="alert">
                    <p>Invalid credentials! (not going to say there is no such user, that is a security risk) </p>
                </div>'
                ); 
        }
        ?>

        <form class="mt-10" method="post" action="login.php" >
            <div class="form-group">
                <label class="display-8 font-weight-bold" for="usernameInput">Username:</label>
                <input type="email" class="form-control" name="username" id="usernameInput" placeholder="Enter email:">
            </div>
            
            <div class="form-group">
                <label class="display-8 font-weight-bold" for="passwordInput">Password:</label>
                <input type="password" class="form-control" name="password" id="passwordInput" placeholder="Password:">
            </div>
            
            <div class="text-center">
                <button type="submit" class="btn btn-lg btn-primary">Login</button>
            </div>
        </form>
        
        <?php
        if (key_exists('fav_color', $_SESSION) && isset($_SESSION['fav_color']) && !isset($_SESSION['bazdmegIttARendorseg'])) {
            echo('
            <div class="circle"></div>
            <div class="d-flex justify-content-center align-items-center"> 
                <a href="reset.php"><button class="btn btn-danger">Reset</button></a>
            </div>
            ');
        }
        ?>
        </div>
</body>

</html>
