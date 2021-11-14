<?php

include("config-post.php");
$let_try = basename($_SERVER['PHP_SELF']);

switch($let_try)
{
    case "single.php":
        if(isset($_GET['id']))
        {
            $sql = "SELECT * from post where post_id = {$_GET['id']}";
            $result = mysqli_query($conn,$sql);
            $rows = mysqli_fetch_assoc($result);
            $title_name = $rows['title'];
        }
        else{
            $title_name = "no record found";
        }
        break;
    case "category.php":
        if(isset($_GET['catid']))
        {
            $sql = "SELECT * from category where category_id = {$_GET['catid']}";
            $result = mysqli_query($conn,$sql);
            $rows = mysqli_fetch_assoc($result);
            $title_name = $rows['category_name']." page";
        }
        else{
            $title_name = "no record found";
        }
        break;
    case "author.php":
        if(isset($_GET['aid']))
        {
            $sql = "SELECT * from user where user_id = {$_GET['aid']}";
            $result = mysqli_query($conn,$sql);
            $rows = mysqli_fetch_assoc($result);
            $title_name = "news by ".$rows['username'];
        }
        else{
            $title_name = "no record found";
        }
        break;
    case "search.php":
        if(isset($_GET['search'])){
            $title_name = $_GET['search'];
        }
        else{
            $title_name = "no record found";
        }
        break;
    default :
    $title_name =  "home page";

}

    




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $title_name;?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <div class=" col-md-offset-4 col-md-4">
            <?php
                    include("config-post.php");
                    $sql = "SELECT * from setting";
                    $result = mysqli_query($conn,$sql) or die("setting query failed");
                    if(mysqli_num_rows($result) > 0)
                    {
                        while($rows = mysqli_fetch_assoc($result))
                        {
                    ?>
                        <a href="post.php"><img class="logo" src="admin/images/<?php echo $rows['website_logo'];?>"></a>
                        <?php
                        }}
                        ?>
                    </div>
            </div>
            <!-- /LOGO -->
        </div>
    </div>
</div>
<!-- /HEADER -->
<!-- Menu Bar -->
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class='menu'>
                <li><a href='index.php'>home</a></li>
                    <?php
                        include("config-post.php");
                        if(isset($_GET['catid']))
                        {
                            $cat_id = $_GET['catid'];
                        }
                        $sql = "SELECT * from category where post > 0 ";
                        $result = mysqli_query($conn,$sql);
                        if(mysqli_num_rows($result)>0)
                        {
                            $active = "";
                            while($rows = mysqli_fetch_assoc($result))
                            {  
                                if(isset($_GET['catid']))
                                {
                                    if($rows['category_id'] == $cat_id)
                                    {
                                        $active = "active";
                                    }
                                    else{
                                        $active = "";
                                    }
                                }
                                
                                echo "<li><a class='{$active}' href='category.php?catid={$rows['category_id']} '>{$rows['category_name']}</a></li>";
                            }
                        }
                    ?>

                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /Menu Bar -->
