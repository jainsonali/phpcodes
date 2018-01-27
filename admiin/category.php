<?php require_once("includes/server.php") ?>
<?php require_once("includes/session.php") ?>
<?php require_once("includes/direct.php") ?>
<?php  confirm_login_check(); ?>
<?php
if(isset($_POST['submit'])){
    $category=$_POST['name'];
    $current_time=time();
    $admin=$_SESSION["username"];
    $time=strftime("%B-%d-%Y %H:%M:%S",$currenttime);
    $time;
    if(empty($category)){
        $_SESSION["errormessage"]="All fields are required";
        header("location:category.php");
        exit();
    }
    else{
        global $connection;
        global $selected;
        $query="insert into category(datetime,name,creatorname) values('$time','$category','$admin')";
        $execute=mysqli_query($connection,$query);
        if($execute){
            $_SESSION["success_message"]="Category added Successfully";
            header("location:category.php");
            exit();
        }
        else{
            $_SESSION["errormessage"]="Category failed to add";
            header("location:category.php");
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
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2">
               <h1>Sonali</h1>
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
                 <h1>Manage categories</h1>
                  <?php echo Message();?>
                <?php echo success();?>
                 <form action="category.php" method="post">
                    <fieldset>
                        <div class="form-group">
                            <label for="categoryname">Name:</label>
                             <input class="form-control" type="text" name="name" id="categoryname" placeholder="enter the name of category">
                        </div>
                        <input id="categorysubmit" class="btn btn-success btn-block" type="submit" name="submit" value="Add New category">
                    </fieldset>
                 </form>
                 <div class="table-responsive">
                     <table class="table table-striped table-hover">
                         <tr>
                             <th>Id</th>
                             <th>Date Time</th>
                             <th>Name</th>
                             <th>Creator Name</th>
                             <th>Action</th>
                         </tr>
                         <?php 
                         global $connection;
                        global $selected;
                         $id=0;
                        $query="select * from category order by datetime desc";
                        $execute=mysqli_query($connection,$query);
                         while($data=mysqli_fetch_array($execute)){
                             $id++;
                             $ID=$data['id'];
                             $date=$data['datetime'];
                             $name=$data['name'];
                             $creator=$data['creatorname'];
                            ?>
                        <tr>
                            <td><?php echo $id; ?> </td>
                            <td><?php echo $date; ?> </td>
                            <td><?php echo $name; ?> </td>
                            <td><?php echo $creator; ?> </td>
                            <td><a href="deletecategory.php?id=<?php echo $ID; ?>"><span class="btn btn-danger">Delete Category</span></a></td>
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









