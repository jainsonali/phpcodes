<?php require_once("includes/server.php") ?>
<?php require_once("includes/session.php") ?>
<?php require_once("includes/direct.php") ?>
<?php
if(isset($_POST['login'])){
    $username=$_POST['Username'];
    $pass=$_POST['Password'];
    $admin='sonali';
    if(empty($username)||empty($pass)){
        $_SESSION["errormessage"]="All fields are required";
        header("location:login.php");
        exit();
    }
    else{
       $found_account=login($username,$pass);
        if($found_account){
            $_SESSION["id"]=$found_account['id'];
            $_SESSION["username"]=$found_account['username'];
            $_SESSION["success_message"]="Welcome {$_SESSION["username"]}";
            header("location:dashboard.php");
            exit();
        }
        else{
            $_SESSION["errormessage"]="Invalid username or paasword";
            header("location:login.php");
            exit();
        }
    }
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="main.js"></script>
    <style>
    body{
    background-color: white;
        }
    </style>
</head>
<body>
  <div class="line" style="height:10px; background:#27aae1;"></div>
   <nav class="navbar navbar-inverse" style="margin-bottom:0px;">
        <div class="conatiner">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="collapse">
                <ul class="nav navbar-nav">
                <li><a href="#">Home</a></li>
                <li class="active"><a href="blog.php" target="_blank">Blog</a></li>
                <li><a href="#">About us</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Contact Us</a></li>
                <li><a href="#">Features</a></li>
            </ul>
            <form action="blog.php" class="navbar-form navbar-right">
               <div class="form-group">
                   <input type="text" class="form-control" placeholder="search" name="search">
               </div>
                <button class="btn btn-default" name="searchbutton">Go</button>
            </form>
            </div>
        </div>
    </nav>
    <div class="line" style="height:10px; background:#27aae1;"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-offset-4 col-sm-4">
                 <h1 style="text-align:center;">Welcome!</h1><br><br><br>
                  <?php echo Message();?>
                <?php echo success();?>
                 <form action="login.php" method="post">
                    <fieldset>
                        <div class="form-group">
                            <label for="Username">Username:</label>
                            <div class="input-group input-group-lg">
                               <span class="input-group-addon"><span class="glyphicon glyphicon-envelope text-primary"></span></span>
                               <input class="form-control" type="text" name="Username" id="Username" placeholder="Username">
                           </div>
                        </div>
                        <div class="form-group">
                            <label for="Password">Password:</label>
                            <div class="input-group input-group-lg">
                               <span class="input-group-addon"><span class="glyphicon glyphicon-lock text-primary"></span></span>
                             <input class="form-control" type="password" name="Password" id="Password" placeholder="Password">
                            </div>
                        </div><br>
                        <input id="login" class="btn btn-info btn-block" type="submit" name="login" value="login">
                    </fieldset>
                 </form>
            </div>
        </div>
    </div>
</body>
</html>









