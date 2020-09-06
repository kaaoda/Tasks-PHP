<?php
session_start();
require_once("external_data.php");
if($_SERVER['REQUEST_METHOD'] == "POST"):
    $flagSecure = true;
    $nameInput = new InputDataProcessing("name","text");
    $emailInput = new InputDataProcessing("email","email");
    $passInput = new InputDataProcessing("password","password");
    $phoneInput = new InputDataProcessing("phone","number");
    $addrInput = new InputDataProcessing("address","text");

    $errors = "";

    $errors .=
    $nameInput->findErrors().
    $emailInput->findErrors().
    $passInput->findErrors().
    $phoneInput->findErrors().
    $addrInput->findErrors();
endif;
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
            <h1 class="head text-center">Signup</h1>
            <form class="signup-form" method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <?php
                if(!empty($errors)):
                    $flagSecure = false;
            ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php      
                    echo $errors;         
                    ?>
                    <button
                        type="button"
                        class="close"
                        data-dismiss="alert"
                        aria-label="Close">
                        <span
                            aria-hidden="true">&times;
                        </span>
                    </button>
                </div>
            <?php
                endif;
            ?>
                    <div class="form-group">
                        <input
                            type="text"
                            name="name"
                            
                            placeholder="Enter Your Name..."
                            id="username"
                            class="form-control"/>
                        <i class="fa fa-user fa-fw"></i>
                        <div class="alert alert-danger my-alert">
                            <strong>Name</strong> can't be empty
                        </div>
                    </div>

                    <div class="form-group">
                    <input
                        type="email"
                        name="email"
                        
                        placeholder="Enter Your Email..."
                        id="email"
                        class="form-control"/>
                        <i class="fa fa-envelope fa-fw"></i>
                        <div class="alert alert-danger my-alert">
                            <strong>Email</strong> can't be empty
                        </div>
                    </div>

                <div class="form-group">
                    <input 
                        type="password"
                        name="password"
                        
                        placeholder="Enter Your Password..."
                        id="password"
                        class="form-control"/>
                        <i class="fa fa-key fa-fw"></i>
                        <div class="alert alert-danger my-alert">
                            <strong>Password</strong> can't be empty
                        </div>
                </div>

                <div class="form-group">
                    <input
                        type="number"
                        name="phone"
                        
                        placeholder="Enter Your Phone..."
                        id="phone"
                        class="form-control"/>
                        <i class="fa fa-phone fa-fw"></i>
                        <div class="alert alert-danger my-alert">
                            <strong>Phone Number</strong> can't be empty
                        </div>
                </div>

                <div class="form-group">
                    <input
                        type="text"
                        name="address"
                        
                        placeholder="Enter Your Address..."
                        id="address"
                        class="form-control"/>
                        <i class="fa fa-home fa-fw"></i>
                        <div class="alert alert-danger my-alert">
                            <strong>Address</strong> can't be empty
                        </div>
                </div>

                <div class="form-group">
                    <input
                        type="submit"
                        value="Signup"
                        id="submit"
                        class="btn btn-block btn-outline-primary form-control submit-btn"/>
                        <i class="fa fa-user-plus fa-fw"></i>
                    <div class="alert alert-info my-alert">
                        <strong>Check</strong>  Form Errors
                    </div>
                </div>
            </form>
        

        <?php
        if(isset($flagSecure) && $flagSecure):
            
            require_once("db_processes.php");
            $db = new Database("tasks");
            $dataToBeStored = array(
                "name"=>($nameInput->getValue()),
                "email"=>$emailInput->getValue(),
                "pass"=>sha1($passInput->getValue()),
                "phone"=>$phoneInput->getValue(),
                "addr"=>$addrInput->getValue());
            $msg = $db->insert($dataToBeStored);
            
            if(stripos($msg,"Done") !== FALSE):
                $_SESSION['name'] = $nameInput->getValue();
                ?>
                <div class="alert alert-info">
                <?php
                    echo $msg;
                ?>
                </div>
                <div class="alert alert-warning">
                <?php
                    echo "You will be redirect to <a href='index.php'>Home</a> page after 3 seconds automatically";
                ?>
                </div>
                <script>
                    setTimeout(function(){
                        window.location.href = "http://localhost:8080/tasks/task4/index.php";
                    },3000);
                </script>
                <?php
            else:
                ?>
                <div class="alert alert-danger">
                <?php
                    echo $msg;
                ?>
                </div>
                <?php
            endif;



        endif;
        ?>

        </div>






    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/js.js"></script>
    </body>

</html>