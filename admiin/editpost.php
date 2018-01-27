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
    if(empty($title)){
        $_SESSION["errormessage"]="Title is required";
        header("location:addpost.php");
            exit();
    }
    elseif(empty($category)){
        $_SESSION["errormessage"]="Category is required";
        header("location:addpost.php");
            exit();
    }
    else{
        global $connection;
        global $selected;
        $editid=$_GET['E'];
        $query="update admin_panel set datetime='$time',title='$title',category='$category',author='$admin',image='$image',post='$post' where id='$editid'";
        $execute=mysqli_query($connection,$query);
        move_uploaded_file($_FILES['image']['tmp_name'],$target);
        if($execute){
            $_SESSION["success_message"]="Post updated Successfully";
            header("location:dashboard.php");
            exit();
        }
        else{
            $_SESSION["errormessage"]="Something went wrong.Please try again!";
            header("location:dashboard.php");
            exit();
        }
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
                 <h1>Update Post</h1>
               <?php echo Message();?>
                <?php echo success();?>
                <?php 
                global $connection;
                global $selected;
                $id=$_GET['E'];
                $query="select * from admin_panel where id=$id";
                $execute=mysqli_query($connection,$query);
                while($data=mysqli_fetch_array($execute)){
                    $updatetitle=$data['title'];
                    $updatecategory=$data['category'];
                    $updatepost=$data['post'];
                    $updateimage=$data['image'];
                }
                ?>
                 <form action="editpost.php?E=<?php echo $id;?>" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">
                            <label for="title">Title:</label>
                             <input class="form-control" type="text" name="title" id="title" placeholder="enter the title" value="<?php echo $updatetitle;?>">
                        </div>
                        <div class="form-group">
                            <label for="category">Existing Category:<br><?php echo $updatecategory;?></label>
                            <select class="form-control" name="category" id="category">
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
                            <label for="selectimage">Existing image:<br><img src="uploads/<?php echo $updateimage;?>" height="100px" width="100px"></label>
                             <input class="form-control" type="file" name="image" id="selectimage">
                        </div>
                        <div class="form-group">
                            <label for="post">Post:</label>
                             <textarea class="form-control" id="post" name="post"><?php echo $updatepost; ?></textarea>
                        </div>
                        <input id="categorysubmit" class="btn btn-success btn-block" type="submit" name="submit" value="Update Post">
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
