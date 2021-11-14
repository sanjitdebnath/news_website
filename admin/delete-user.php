<?php

// session_start();
    if($_SESSION["user_role"]=='0')
    {
        header("location: http://localhost/news_site/admin/post.php");  
    }




include("config.php");
$id_no = $_GET['id'];


$sql = "DELETE from user where user_id = {$id_no}";
$result = mysqli_query($conn,$sql);

if($result)
{
    echo "delete successfull";
}

header("location: http://localhost/news_site/admin/users.php");

mysqli_close($conn);

?>