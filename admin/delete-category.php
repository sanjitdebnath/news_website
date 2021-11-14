<?php

include("config.php");

$cat_id = $_GET['cata_id'];

$sql = "DELETE from category where category_id = {$cat_id}";
$result = mysqli_query($conn,$sql) or die("file not dete due to some reason");

header("location: http://localhost/news_site/admin/category.php");

mysqli_close($conn);








?>