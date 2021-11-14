<?php

include("config.php");
$row_id = $_GET['id'];
$cat_id = $_GET['catid'];

$sql1 = "SELECT post_img from post where post_id  = {$row_id}";
$result = mysqli_query($conn,$sql1);

$rows = mysqli_fetch_assoc($result);

unlink("upload/".$rows['post_img']);
$sql = "DELETE from post where post_id = {$row_id};";
$sql .="UPDATE category set post = post-1 where category_id = {$cat_id}";
// mysqli_query($conn,$sql);

if(mysqli_multi_query($conn,$sql))
{
    header("location: http://localhost/news_site/admin/post.php"); 
}
else{
    echo 'post cannot be deleted';
}
mysqli_close($conn);


 
?>