<?php include "header.php";

$cat_id = $_GET["cata_id"];
include("config.php");

$sql = "SELECT category_name from category where category_id ={$cat_id}";
$result = mysqli_query($conn,$sql) or die("query failed");


?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <?php
                  if(mysqli_num_rows($result) > 0)
                  {
                      while($rows = mysqli_fetch_assoc($result))
                      {
                        
                  ?>
                  <form action="<?php $_SERVER['PHP_SELF']?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="cat_id"  class="form-control" value="<?php echo $rows['category_name'];?>" >
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>  
                          <input type="text" name="cat_name" class="form-control" value="<?php echo $rows['category_name'];?>" required>
                      </div>
                      <input type="submit" name="sumbit" class="btn btn-primary" value="Update" required />
                  </form>
                  <?php
                   }}

                   if(isset($_POST['sumbit']))
                    {             
                   $updated_category_name = $_POST['cat_name'];

                   $sql1 = "UPDATE category set category_name = '{$updated_category_name}' where category_id = {$cat_id}";
                   $result = mysqli_query($conn,$sql1) or die("data not update");

                   header("location: http://localhost/news_site/admin/category.php"); 
                    }


                    ?>
                </div>
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>
