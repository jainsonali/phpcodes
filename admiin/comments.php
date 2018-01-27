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
               <?php echo Message();?>
                <?php echo success();?>
                <h1>Un-Approved Comments</h1>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Comment</th>
                            <th>Approve</th>
                            <th>Delete Comment</th>
                            <th>Details</th>
                        </tr>
                        <?php 
                        $connection;
                        $selected;
                        $query="select * from comments where status='OFF'";
                        $execute=mysqli_query($connection,$query);
                        $sno=0;
                        while($data=mysqli_fetch_array($execute)){
                            $id=$data['id'];
                            $datetime=$data['datetime'];
                            $name=$data['name'];
                            $comment=$data['comment'];
                            $admin_panel_id=$data['admin_panel_id'];
                            $sno++;
                            ?>
                            <tr>
                                <td><?php echo $sno; ?></td>
                                <td><?php echo $name; ?></td>
                                <td><?php echo $datetime; ?></td>
                                <td><?php echo $comment; ?></td>
                                <td><a href="approvecomments.php?id=<?php echo $id ?>"><span class="btn btn-success">Approve</span></a></td>
                                <td><a href="deletecomments.php?id=<?php echo $id ?>"><span class="btn btn-danger">Delete Comment</span></a></td>
                                <td><a href="fullpost.php?id=<?php echo $admin_panel_id; ?>"><span class="btn btn-primary">Live Preview</span></a></td>
                            </tr>
                        <?php }
                        ?>
                    </table>
                </div><br><br><br>
                <h1>Approved Comments</h1>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Comment</th>
                            <th>Approved by</th>
                            <th>Dis-Approve</th>
                            <th>Delete Comment</th>
                            <th>Details</th>
                        </tr>
                        <?php 
                        $connection;
                        $selected;
                        $admin=$_SESSION["username"];
                        $query="select * from comments where status='ON'";
                        $execute=mysqli_query($connection,$query);
                        $sno=0;
                        while($data=mysqli_fetch_array($execute)){
                            $id=$data['id'];
                            $datetime=$data['datetime'];
                            $name=$data['name'];
                            $comment=$data['comment'];
                            $approvedBy=$data['approved_by'];
                            $admin_panel_id=$data['admin_panel_id'];
                            $sno++;
                            ?>
                            <tr>
                                <td><?php echo $sno; ?></td>
                                <td><?php echo $name; ?></td>
                                <td><?php echo $datetime; ?></td>
                                <td><?php echo $comment; ?></td>
                                <td><?php echo $approvedBy; ?></td>
                                <td><a href="disapprovecomment.php?id=<?php echo $id ?>"><span class="btn btn-warning">Disapprove</span></a></td>
                                <td><a href="deletecomments.php?id=<?php echo $id ?>"><span class="btn btn-danger">Delete Comment</span></a></td>
                                <td><a href="fullpost.php?id=<?php echo $admin_panel_id; ?>"><span class="btn btn-primary">Live Preview</span></a></td>
                            </tr>
                        <?php }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
