<?php require_once("includes/server.php") ?>
<?php require_once("includes/session.php") ?>
<?php 
function redirect_to($newlocation){
    header("location:".$newlocation);
        exit();
}
function login($username,$pass){
        global $connection;
        global $selected;
        $query="select * from admin_register where username='$username' and password='$pass'";
        $execute=mysqli_query($connection,$query);
        if($admin=mysqli_fetch_assoc($execute)){
            return $admin;
        }
    else{
        return null;
    }
}
function login_check(){
    if(isset($_SESSION["id"])){
        return true;
    }
}
function confirm_login_check(){
    if(!login_check()){
        $_SESSION["errormessage"]="Login Required!";
        header("location:login.php");
            exit();
    }
}
?>