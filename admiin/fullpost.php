<?php require_once("includes/server.php") ?>
<?php require_once("includes/session.php") ?>
<?php
if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $comment=$_POST['comment'];
    $current_time=time();
      $time=strftime("%B-%d-%Y %H:%M:%S",$current_time);
    $time;
    if(empty($name) || empty($email) || empty($comment)){
        $_SESSION["errormessage"]="All Fields are required";
    }
    else{
        global $connection;
        global $selected;
        $postid=$_GET['id'];
        $query="insert into comments(datetime,name,email,comment,approved_by,status,admin_panel_id) values('$time','$name','$email','$comment','Pending',OFF','$postid')";
        $execute=mysqli_query($connection,$query);
        if($execute){
            $_SESSION["success_message"]="Comment Submitted Successfully";
            header("location:fullpost.php?id={$postid}");
            exit();
        }
        else{
            $_SESSION["errormessage"]="Something went wrong.Please try again!";
            header("location:fullpost.php?id={$postid}");
            exit();
        }
    }
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>fullblog</title>
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
       <script src="bootstrap-3.3.7-dist/jquery-3.2.1.min.js"></script>
    <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="publicstyles.css">
</head>
<body>
    <div style="height:10px; background:#27aae1;"></div>
    <nav class="navbar navbar-inverse">
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
                <li class="active"><a href="blog.php">Blog</a></li>
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
    <div class="container">
        <div class="blog-header">
        <h1>My First php Project</h1>
        <p class="lead">This file was generated from the Brackets New Project extension<br/>
        You can open this file in Brackets and start editing right away!</p>
        <div class="row">
            <div class="col-sm-8">
               <?php 
                global $connection;
                global $selected;
                if(isset($_GET['searchbutton'])){
                    $search=$_GET['search'];
                    $query="select * from admin_panel where datetime LIKE '%$search%' or title LIKE '%$search%' or category LIKE '%$search%' or post LIKE '%$search%' ";
                }
                else{
                    $postid=$_GET['id'];
                    $query="select * from admin_panel where id=$postid";
                }
                $execute=mysqli_query($connection,$query);
                while($data=mysqli_fetch_array($execute)){
                        $postid=$data['id'];
                        $datetime=$data['datetime'];
                        $title=$data['title'];
                        $category=$data['category'];
                        $admin=$data['author'];
                        $image=$data['image'];
                        $post=$data['post'];
                ?>
                <div class="blogpost thumbnail">
                    <img class="img-responsive" src="uploads/<?php echo $image; ?>">
                <div class="caption">
                    <h2 class="heading"><?php echo $title; ?></h2>
                    <p class="time">Category:<?php echo $category;?> Published On:<?php echo $datetime; ?></p>
                    <p class="post">echo<?php echo $post; ?>
                    </p>
                </div>
                </div>
                <?php }
                ?>
                <h3>Comments</h3>
                <?php 
                global $connection;
                global $selected;
                $postid=$_GET['id'];
                $query="select * from comments where admin_panel_id='$postid' and status='ON'";
                $execute=mysqli_query($connection,$query);
                while($data=mysqli_fetch_array($execute)){
                    $name=$data['name'];
                      $datetime=$data['datetime'];
                     $comment=$data['comment'];
                    ?>
                    <div style=" background-color: beige; font-family: serif; margin:5px;">
                        <div style="float:left">
                    <img class="image-responsive" src="images/163801.png" alt="person" height="60px" width="80px" style="margin:10px 20px;">
                    </div>
                    <div style="padding:10px; font-size:15px;">
                        <p><b><?php echo $name ?></b></p>
                        <p><i><?php echo $datetime ?></i></p>
                        <p><?php echo $comment ?></p>
                    </div>
                    </div>
                <?php } ?>
                <h3>Share Your thoughts about this post here:</h3>
                <?php echo message(); echo success(); ?>
                <div>
                     <form action="fullpost.php?id=<?php echo $postid; ?>" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">
                            <label for="name">Name:</label>
                             <input class="form-control" type="text" name="name" id="name" placeholder="name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                             <input class="form-control" type="email" name="email" id="email" placeholder="email">
                     </div>
                        <div class="form-group">
                            <label for="comment">Comment:</label>
                             <textarea class="form-control" id="comment" name="comment"></textarea>
                        </div>
                        <input id="categorysubmit" class="btn btn-primary" type="submit" name="submit" value="Comment">
                    </fieldset>
                </form>
                </div>
                
            </div>
            <div class="col-sm-offset-1 col-sm-3">
            <h2>test</h2>
                <p>This file was generated from the Brackets New Project extension<br/>
        You can open this file in Brackets and start editing right away!This file was generated from the Brackets New Project extension You can open this file in Brackets and start editing right away!This file was generated from the Brackets New Project extension You can open this file in Brackets and start editing right away!This file was generated from the Brackets New Project extension You can open this file in Brackets and start editing right away!This file was generated from the Brackets New Project extension
        You can open this file in Brackets and start editing right away!</p>
            </div>
        </div>
    </div>
    </div>
    
</body>
</html>
