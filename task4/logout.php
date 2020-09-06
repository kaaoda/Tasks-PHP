<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <title>Logout</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;700&display=swap">
</head>

    <body>
        <div class="container logout">
            

                    <?php
                    if($_SERVER['REQUEST_METHOD'] == "POST"):
                        if(isset($_SESSION['name'])):
                            session_unset();
                            session_destroy();
                            ?>
                            <div class="alert alert-warning">
                                <strong>Signed out done,</strong> Redirect automatically to Login Page
                            </div>
                            <script>
                                setTimeout(function(){
                                    window.location.href = "http://localhost:8080/tasks/task4/login.php";
                                },3000);
                            </script>
                            <?php
                        else:
                            echo "You are not signed in, please <a href='signup.php'>Signup</a> or <a href='login.php'>Login</a>";
                        endif;
                    else:
                        header("location:http://localhost:8080/tasks/task4/index.php");
                    endif;
                    ?>
        </div>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/js.js"></script>
    </body>

</html>