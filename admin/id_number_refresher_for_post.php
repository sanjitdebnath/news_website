<?php


include "config.php";

$set_interval1="SET @num := 0";
$result1 = mysqli_query($conn,$set_interval1);


$set_interval2="UPDATE post SET post_id = @num := (@num+1)";
$result2 = mysqli_query($conn,$set_interval2);

$set_interval3="ALTER TABLE post AUTO_INCREMENT = 1";
$result3 = mysqli_query($conn,$set_interval3);

                  


?>