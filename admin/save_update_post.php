<?php
include("config.php");
if(isset($_POST['submit']))
            {


                if(empty($_FILES['new-image']['name']))
                {
                    $new_name = $_POST['old-image'];
                }
                else{
                    $errors = array();

                    $file_name = $_FILES['new-image']['name'];
                    $file_size = $_FILES['new-image']['size'];
                    $file_tmp = $_FILES['new-image']['tmp_name'];
                    $file_type = $_FILES['new-image']['type'];
                    $file_ext = end(explode('.',$file_name));

                    $extensions = array("jpeg","jpg","png");

                    if(in_array($file_ext,$extensions) === false)
                    {
                    $errors[] = "This extension file not allowed, Please choose a JPG or PNG file.";
                    }

                    if($file_size > 2097152){
                    $errors[] = "File size must be 2mb or lower.";
                    }

                    $new_name = time(). "-".basename($file_name);
                    $target = "upload/".$new_name;

                    if(empty($errors) == true){
                    move_uploaded_file($file_tmp,$target);
                    }else{
                    print_r($errors);
                    die();
                    }
                }

                $id_no = $_POST['post_id'];
                $title_update = $_POST['post_title'];
                $description_update = $_POST['description'];
                $category_update = $_POST['category'];
                // $old_category = $_POST['old_category'];
                // echo $old_category;

                // $sql2 = "UPDATE post set title = '{$title_update}',description = '{$description_update}',
                // category = {$category_update},post_img = '{$file_name}'  where post_id = {$id_no};";

                // $sq2 .= "UPDATE category SET post= post - 1 WHERE category_id = {$_POST['old_category']};";
                // $sq2 .= "UPDATE category SET post= post + 1 WHERE category_id = {$_POST["category"]};";
                

                // $result2 = mysqli_multi_query($conn,$sq2);


                $sql = "UPDATE post SET title='{$_POST["post_title"]}',description='{$description_update}',category={$category_update},post_img='{$new_name}'
                WHERE post_id={$id_no};";
                if($_POST['old_category'] != $_POST["category"] ){
                $sql .= "UPDATE category SET post= post - 1 WHERE category_id = {$_POST['old_category']};";
                $sql .= "UPDATE category SET post= post + 1 WHERE category_id = {$_POST["category"]};";
                }

                $result = mysqli_multi_query($conn,$sql);
                if($result)
                {
                header("location: http://localhost/news_site/admin/post.php");  

                }
                else{
                    echo "update unsucessful";
                }
                mysqli_close($conn);
            }

?>