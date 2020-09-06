<?php 
session_start();
require_once("utility.php"); 
require_once("db_processes.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8" />
        <title>Import CSV</title>
        <link rel="stylesheet" href="css/normalize.css" />
        <link rel="stylesheet" href="css/style.css" />

    </head>
    
    <body>


                <?php
                    $db = new Database($_SESSION['user'],$_SESSION['pass']);
                    $util = new Utility();
                    $db->selectDB($_SESSION['db']);
                    $rows = $db->getData("thirdtask");
                    $util->createTable($rows,$_SESSION['headers']);
                ?>
                <form method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <input type="submit" name="reset" value="Reset DB">
                </form>
                <?php
                    if(array_key_exists('reset',$_POST)):
                        $db->resetDB();
                    endif;
                ?>
       
    </body>
</html>