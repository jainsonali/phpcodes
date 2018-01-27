<?php require_once("includes/server.php") ?>
<?php require_once("includes/session.php") ?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>blog</title>
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
elseif(isset($_GET['category'])){
    $category=$_GET['category'];
                    $query="select * from admin_panel where category='$category'";
}
                else{
                    $query="select * from admin_panel";
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
                    <p class="post">echo<?php if(strlen($post)>150){$post=substr($post,0,150)."...";}  echo $post; ?>
                    </p>
                    <div>
                        <a href="fullpost.php?id=<?php echo $postid; ?>" target="_blank"><span class="btn btn-info">Read More &rsaquo;&rsaquo;</span></a>
                    </div>
                </div>
                </div>
                <?php }
                ?>
            </div>
            <div class="col-sm-offset-1 col-sm-3">
            <h2>About Me</h2>
               <img class="img-resposnive img-circle" src="images/163801.png">
                <p>This file was generated from the Brackets New Project extension<br/>
        You can open this file in Brackets and start editing right away!This file was generated from the Brackets New Project extension You can open this file in Brackets and start editing right away!This file was generated from the Brackets New Project extension You can open this file in Brackets and start editing right away!This file was generated from the Brackets New Project extension You can open this file in Brackets and start editing right away!This file was generated from the Brackets New Project extension
        You can open this file in Brackets and start editing right away!</p>
           <div class="panel panel-info">
               <div class="panel-heading">
                   <h2 class="panel-title">categories</h2>
               </div>
               <div class="panel-body">
                   <?php 
                global $connection;
                global $selected;
                    $query="select * from category";
                $execute=mysqli_query($connection,$query);
                while($data=mysqli_fetch_array($execute)){
                        $id=$data['id'];
                        $category_name=$data['name'];
                ?>
                <a href="blog.php?category=<?php echo $category_name; ?>">
                    <span class="heading"><?php echo $category_name; ?></span></a><br>
                <?php } ?>
               </div>
               <div class="panel-footer">
                   
               </div>
           </div>
           <div class="panel panel-info">
               <div class="panel-heading">
                   <h2 class="panel-title">Recent Post</h2>
               </div>
               <div class="panel-body">
                   <?php 
                global $connection;
                global $selected;
                    $query="select * from admin_panel order by datetime desc limit 0,4";
                $execute=mysqli_query($connection,$query);
                while($data=mysqli_fetch_array($execute)){
                        $postid=$data['id'];
                        $datetime=$data['datetime'];
                        $title=$data['title'];
                        $image=$data['image'];
                    $post=$data['post'];
                ?>
                <div>
                    <img style="border:1px solid black;" src="uploads/<?php echo $image; ?>" width="100px" height="100px">
                    <h3 style="float:right;"><?php echo $title; ?></h3>
                </div>
                <?php } ?>
               </div>
               <div class="panel-footer">
                   
               </div>
           </div>
            </div>
        </div>
    </div>
    </div>
    
</body>
</html>
