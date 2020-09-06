<?php 
session_start();
require_once("utility.php"); 
require_once("db_processes.php");
require_once("csv_operations.php");
require_once("upload_process.php");
$util = new Utility();
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8" />
        <title>Import CSV</title>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
        <link rel="stylesheet" href="css/normalize.css" />
        <link rel="stylesheet" href="css/style.css" />

    </head>
    
    <body>
        <form action="index.php" method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend>Select CSV File</legend>
                <label for="file-up" class="up-btn">
                    <i class="fas fa-file-upload"></i>
                    Choose File
                </label>
                <input type="hidden" name="MAX_FILE_SIZE" value="1000000"/>
                <input type="file" name="csv_file" id="file-up" hidden/>
                <input type="text" name="username" placeholder="Enter Username" required/>
                <input type="password" name="password" placeholder="Enter password" required/>
                <input type="submit" value="Upload CSV" />
            </fieldset>
        </form>
        <?php
            
            if($_SERVER['REQUEST_METHOD'] == 'POST'):
                    $uploadObject = new UploadProcess('csv_file');
                    $checker = $uploadObject->upload_file();
                    if($checker):
                        $csv = new CSV(__DIR__.'/'.'file.csv');
                        
                        $user = $_POST['username'];
                        $pass = $_POST['password'];
                        $_SESSION['user'] = $user;
                        $_SESSION['pass'] = $pass;
                        if($user !== NULL && $pass !== NULL):
                            
                            $db = new Database($user,$pass);
                            $db-> createDB("tasks");
                            $_SESSION['db'] = "tasks";
                            $fields = ['client_name','client_id','deal_name','deal_id','hour','accepted','refused'];
                            $_SESSION['headers'] = $fields;
                            $row = $csv->createFormatedRow();
                            while(($row = $csv->createFormatedRow()) !== NULL)
                                $db->insert($row,"thirdtask",$fields);
                            $util->produceSuccessMsg("Data inserted into Database");
                        endif;
                        ?>
                        <a href="show.php">Show File</a>
                        <?php
                    endif;
            endif;

            
            
        ?>
    </body>
</html>