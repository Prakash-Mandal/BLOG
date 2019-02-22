<?php

if(!session_status()) {
    session_start();
}

if (isset($_SESSION["name"])) {
    $name = $_SESSION['name'];
    $email = $_SESSION["email"];
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>BLOG</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container-fluid mt-md-2">
        <div class="Header jumbotron row" >
            <div class="col-sm-7 text-center" >
              <h1>My Blog Page</h1>
              <p>Write out you life!!</p>
            </div>
            <div class="jumbotron-fluid col-sm-5 row" >
                <?php
                if (!empty($name))  { ?>
                    <form class="form-inline" action="index.php" method="post">
                        <h4> Hello <?php echo $name; ?> </h4>
                        <button class="btn text-warning ml-md-3"
                        type="submit" name="logout" value="true" >
                            Logout
                        </button>
                    </form>
                <?php } else { ?>
                    <form name="LoginForm" class="form-group" method="POST" action="index.php"
                          onsubmit="return validateLogin()">
                        <div class="form-inline">
                            <input type="email" class="form-control mb-2
                                mr-sm-2" id="u_email" name="u_email"
                                autocomplete="username" placeholder="Enter Email">
                            <input type="password" class="form-control mb-2 mr-sm-2" id="login_pass"
                                name="pass" autocomplete="current-password" placeholder="Enter Password">
                            <button type="submit" class="btn btn-primary mb-2"
                                name="loginViewSubmit" value="Submit" > Login </button>
                        </div>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>
</body>
</html>