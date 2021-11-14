<?php include "header.php"; 

if($_SESSION["user_role"] == 0)
{
    include("config.php");
    $id_no = $_GET['id'];
        $sql2 = "SELECT author from post where post_id = {$id_no}";
        $result2 = mysqli_query($conn,$sql2) or die("query failed");

        $rows2 = mysqli_fetch_assoc($result2);

        if($rows2['author'] != $_SESSION["user_id"])
        {
            header("location: http://localhost/news_site/admin/post.php"); 
        }
    }
?>
<div id="admin-content">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="admin-heading">Update Post</h1>
    </div>
    <div class="col-md-offset-3 col-md-6">
        <!-- Form for show edit-->
        <?php
        include("config.php");
        $id_no = $_GET['id'];

        $sql = "SELECT post_id,title,description,category,post_img from post where post_id = {$id_no}";
        $result = mysqli_query($conn,$sql) or die("query failed");

        if(mysqli_num_rows($result) > 0)
        {
            while($rows = mysqli_fetch_assoc($result))
            {
        ?>
        <form action="save_update_post.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">

                <input type="hidden" name="post_id"  class="form-control" value="<?php echo $rows['post_id'];?>" >
                
            </div>
            <div class="form-group">
                <label for="exampleInputTile">Title</label>
                <input type="text" name="post_title"  class="form-control" id="exampleInputUsername" value="<?php echo $rows['title'];?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"> Description</label>
                <textarea name="description" class="form-control"  required rows="5">
                <?php echo $rows['description'];?>
                </textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputCategory">Category</label>
                <select class="form-control" name="category">
                    <option selected>choose chategory</option>
                    <?php
                    $sql1 = "SELECT * from category";
                    $result1 = mysqli_query($conn,$sql1);
                    if(mysqli_num_rows($result1) > 0)
                    {
                        while($rows1 = mysqli_fetch_assoc($result1))
                        {
                            if($rows['category'] == $rows1['category_id'])
                            {
                                $selected = "selected";
                            }
                            else{
                                $selected = "";
                            }
                        echo "<option {$selected} value='{$rows1['category_id']}'>{$rows1['category_name']}</option>";
                        }
                    }
                    ?>
                </select>
                <input type="hidden" name="old_category" value="<?php echo $rows['category']; ?>">
            </div>
            <div class="form-group">
                <label for="">Post image</label>
                <input type="file" name="new-image">
                <?php echo '<img  src="upload/'.$rows['post_img'].'" height="150px">'?>
                <input type="hidden" name="old-image" value="<?php echo $rows['post_img'];?>">
            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
        </form>
        <?php
            }}
            ?>
        <!-- Form End -->
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
