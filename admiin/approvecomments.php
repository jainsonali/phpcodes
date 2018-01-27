<?php require_once("includes/session.php") ?>
<?php require_once("includes/server.php") ?>
<?php require_once("includes/direct.php") ?>
<?php  confirm_login_check(); ?>
<?php
     global $connection;
        global $selected;
$admin=$_SESSION["username"];
$admin_panel_id=$_GET['id'];
        $query="update comments set status='ON',approved_by='$admin' where id='$admin_panel_id'";
        $execute=mysqli_query($connection,$query);
        if($execute){
            $_SESSION["success_message"]="Comment approved Successfully";
            header("location:comments.php");
            exit();
        }
        else{
            $_SESSION["errormessage"]="Something went wrong.Please try again!";
            header("location:comments.php");
            exit();
        }
    ?>
    