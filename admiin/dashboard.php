<?php require_once("includes/session.php") ?>
<?php require_once("includes/server.php") ?>
<?php require_once("includes/direct.php") ?>
<?php  confirm_login_check(); ?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="publicstyles.css">
    <script src="main.js"></script>
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
            <div class="col-sm-2"><br><br><br>
                <ul id="side_menu" class="nav nav-pills nav-stacked">
                    <li class="active"><a href="dashboard.php"><span class="glyphicon glyphicon-th"></span>&nbsp;Dashboard</a></li>
                    <li><a href="adpost.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;add new post</a></li>
                    <li><a href="category.php"><span class="glyphicon glyphicon-tag"></span>&nbsp;Categories</a></li>
                    <li><a href="admin.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Manage admins</a></li>
                    <li><a href="comments.php"><span class="glyphicon glyphicon-comment"></span>&nbsp;Comments
                     <?php
                        global $connection;
                        global $selected;
                        $querytotal="select count(*) from comments where status='OFF'";
                        $execute3=mysqli_query($connection,$querytotal);
                        $total=mysqli_fetch_array($execute3);
                            $totalapp=array_shift($total);
                            ?> 
                                   <span class="label pull-right label-warning"><?php echo $totalapp; ?></span>   </a></li>
                    <li><a href="blog.php"><span class="glyphicon glyphicon-equalizer"></span>&nbsp;Live Blog</a></li>
                    <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Log Out</a></li>
                </ul>
            </div>
            <div class="col-sm-10">
                <h1>Admin dashboard</h1>
                <?php echo Message();?>
                <?php echo success();?>
                <div class="table-resposnive">
                    <table class="table table-striped table-hover">
                    <tr>
                        <th>No</th>
                        <th>Post Title</th>
                        <th>Date Time</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th>Banner</th>
                        <th>Comments</th>
                        <th>Action</th>
                        <th>Details</th>
                    </tr>
                    <?php
                        global $connection;
                        global $selected;
                        $query="select * from admin_panel";
                        $execute=mysqli_query($connection,$query);
                        $sno=0;
                        while($data=mysqli_fetch_array($execute)){
                            $id=$data['id'];
                            $datetime=$data['datetime'];
                            $title=$data['title'];
                            $category=$data['category'];
                            $admin=$data['author'];
                            $image=$data['image'];
                            $post=$data['post'];
                            $sno++;
                            ?>
                            <tr>
                                <td><?php echo $sno; ?></td>
                                <td><?php echo $title; ?></td>
                                <td><?php echo $datetime; ?></td>
                                <td><?php echo $admin; ?></td>
                                <td><?php echo $category; ?></td>
                                <td><img src="uploads/<?php echo $image; ?>" width="170px" height="50px"></td>
                                <td>
                                    <?php
                        global $connection;
                        global $selected;
                        $queryapp="select count(*) from comments where admin_panel_id='$id' and status='ON'";
                        $execute1=mysqli_query($connection,$queryapp);
                        $app=mysqli_fetch_array($execute1);
                            $totalapp=array_shift($app);
                            ?>
                                   <span class="label pull-right label-success"><?php echo $totalapp; ?></span>
                                    <?php
                        global $connection;
                        global $selected;
                        $querydisapp="select count(*) from comments where admin_panel_id='$id' and status='OFF'";
                        $execute2=mysqli_query($connection,$querydisapp);
                        $disapp=mysqli_fetch_array($execute2);
                            $totaldisapp=array_shift($disapp);
                            ?> 
                                   <span class="label pull-left label-danger"><?php echo $totaldisapp; ?></span>   
                                </td>
                                <td><a href="editpost.php?E=<?php echo $id; ?>"><span class="btn btn-warning">Edit</span></a>&nbsp;
                                <a href="deletepost.php?D=<?php echo $id; ?>"><span class="btn btn-danger">Delete</span></a></td>
                                <td><a href="fullpost.php?id=<?php echo $id; ?>" target="_blank"><span class="btn btn-primary">Live blog</span></a></td>
                            </tr>
                            <?php } ?>
                </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
