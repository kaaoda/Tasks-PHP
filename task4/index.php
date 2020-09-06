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
    <title>Welcome to TASK 4</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;700&display=swap">
</head>

    <body>
        <div class="container">
            <h1 class="head text-center">Home</h1>

            <div class="text-center show">
                <h3>Welcome 
                    <?php
                        if(isset($_SESSION['name'])):
                            echo"<strong>". $_SESSION['name']."</strong>";
                            ?>
                            <form action="logout.php" method="POST">
                            <input type="submit" value="Logout" class="form-control btn btn-danger btn-block"/ >
                            </form>
                            <?php
                        else:
                            echo "You are not signed in, please <a href='signup.php'>Signup</a> or <a href='login.php'>Login</a>";
                        endif;
                    ?>
                </h3>

                <div class="alert alert-danger db-alert"  role="alert">
                    <strong>Error </strong>when connecting to Server
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                
            </div>
            

        </div>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/js.js"></script>
    </body>

</html>