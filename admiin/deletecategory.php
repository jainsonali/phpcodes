<?php require_once("includes/session.php") ?>
<?php require_once("includes/server.php") ?>
<?php require_once("includes/direct.php") ?>
<?php  confirm_login_check(); ?>
<?php
     global $connection;
        global $selected;
$id=$_GET['id'];
        $query="delete from category where id='$id'";
        $execute=mysqli_query($connection,$query);
        if($execute){
            $_SESSION["success_message"]="Category deleted Successfully";
            header("location:category.php");
            exit();
        }
        else{
            $_SESSION["errormessage"]="Something went wrong.Please try again!";
            header("location:category.php");
            exit();
        }
    ?>
    