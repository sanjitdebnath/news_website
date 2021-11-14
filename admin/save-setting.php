<?php
include("config.php");
if(isset($_POST['submit']))
            {


                if(empty($_FILES['logo']['name']))
                {
                    echo $file_name = $_POST['old_logo'];
                }
                else{
                    $errors = array();

                    $file_name = $_FILES['logo']['name'];
                    $file_size = $_FILES['logo']['size'];
                    $file_tmp = $_FILES['logo']['tmp_name'];
                    $file_type = $_FILES['logo']['type'];
                    $file_ext = end(explode('.',$file_name));

                    $extensions = array("jpeg","jpg","png");

                    if(in_array($file_ext,$extensions) === false)
                    {
                    $errors[] = "This extension file not allowed, Please choose a JPG or PNG file.";
                    }

                    if($file_size > 2097152){
                    $errors[] = "File size must be 2mb or lower.";
                    }
                    $target = "images/".$file_name;

                    if(empty($errors) == true){
                    move_uploaded_file($file_tmp,$target);
                    }else{
                    print_r($errors);
                    die();
                    }
                }
                $website_name_update = $_POST['website_name'];
                $footer_description_update = $_POST['footer_desc'];


                $sql = "UPDATE setting SET website_name='{$website_name_update}',footer_description='{$footer_description_update}',website_logo='{$file_name}'
                ";

                $result = mysqli_query($conn,$sql);
                if($result)
                {
                header("location: http://localhost/news_site/admin/settings.php");  
                echo "update successful";
                }
                else{
                    echo "update unsucessful";
                }
                mysqli_close($conn);
            }

?>