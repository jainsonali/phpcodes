<?php require_once("includes/server.php") ?>
<?php require_once("includes/session.php") ?>
<?php require_once("includes/direct.php") ?>
<?php  confirm_login_check(); ?>
<?php
if(isset($_POST['submit'])){
    $title=$_POST['title'];
    $category=$_POST['category'];
    $post=$_POST['post'];
    $current_time=time();
    $admin='sonali';
    $image=$_FILES['image']['name'];
    $target="uploads/".$_FILES['image']['name'];
    $time=strftime("%B-%d-%Y %H:%M:%S",$currenttime);
    $time;
        global $connection;
        global $selected;
        $deleteid=$_GET['D'];
        $query="delete from admin_panel where id='$deleteid'";
        $execute=mysqli_query($connection,$query);
        move_uploaded_file($_FILES['image']['tmp_name'],$target);
        if($execute){
            $_SESSION["success_message"]="Post deleted Successfully";
            header("location:dashboard.php");
            exit();
        }
        else{
            $_SESSION["errormessage"]="Something went wrong.Please try again!";
            header("location:dashboard.php");
            exit();
        }
    }
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>editpost</title>
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
                    <li ><a href="dashboard.php"><span class="glyphicon glyphicon-th"></span>&nbsp;Dashboard</a></li>
                    <li><a href="adpost.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;add new post</a></li>
                    <li ><a href="category.php"><span class="glyphicon glyphicon-tag"></span>&nbsp;Categories</a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp;Manage admins</a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-comment"></span>&nbsp;Comments</a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-equalizer"></span>&nbsp;Live Blog</a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Log Out</a></li>
                </ul>
            </div>
            <div class="col-sm-10">
                 <h1>Delete Post</h1>
                <?php echo Message();?>
                <?php echo success();?>
                <?php 
                global $connection;
                global $selected;
                $id=$_GET['D'];
                $query="select * from admin_panel where id=$id";
                $execute=mysqli_query($connection,$query);
                while($data=mysqli_fetch_array($execute)){
                    $deletetitle=$data['title'];
                    $deletecategory=$data['category'];
                    $deletepost=$data['post'];
                    $deleteimage=$data['image'];
                }
                ?>
                 <form action="deletepost.php?D=<?php echo $id;?>" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">
                            <label for="title">Title:</label>
                             <input class="form-control" type="text" name="title" id="title" placeholder="enter the title" value="<?php echo $deletetitle;?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="category">Existing Category:<br><?php echo $deletecategory;?></label>
                            <select class="form-control" name="category" id="category" disabled>
                                    <?php 
                         global $connection;
                        global $selected;
                        $query="select * from category order by datetime desc";
                        $execute=mysqli_query($connection,$query);
                         while($data=mysqli_fetch_array($execute)){
                             $name=$data['name'];
                            ?>
                                <option><?php echo $name; ?></option>
                         <?php }
                          ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="selectimage">Existing image:<br><img src="uploads/<?php echo $deleteimage;?>" height="100px" width="100px"></label>
                             <input class="form-control" type="file" name="image" id="selectimage" disabled>
                        </div>
                        <div class="form-group">
                            <label for="post">Post:</label>
                             <textarea class="form-control" id="post" name="post" disabled><?php echo $deletepost; ?></textarea>
                        </div>
                        <input id="categorysubmit" class="btn btn-danger btn-block" type="submit" name="submit" value="Delete Post">
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
