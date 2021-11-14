<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <h1 class="admin-heading">Website Settings</h1>
             </div>
              <div class="col-md-offset-3 col-md-6">
                <?php
                include("config.php");
                $sql = "SELECT * from setting";
                $result = mysqli_query($conn,$sql) or die("setting query failed");
                if(mysqli_num_rows($result) > 0)
                {
                    while($rows = mysqli_fetch_assoc($result))
                    {
                ?>
                  <!-- Form -->
                  <form  action="save-setting.php" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                          <label for="website_name">website name</label>
                          <input type="text" name="website_name" value="<?php echo $rows['website_name'];?>" class="form-control" autocomplete="off" required>
                      </div>
                      <div class="form-group">
                          <label for="logo">Website Logo</label>
                          <input type="file" name="logo">
                          <img class='img_align' src="images/<?php echo $rows['website_logo'];?>">
                          <input type="hidden" name="old_logo" value="<?php echo $rows['website_logo'];?>" >
                          
                      </div>
                      <div class="form-group">
                          <label for="footer_desc">footer description</label>
                          <textarea name="footer_desc" class="form-control" rows="5" required><?php echo $rows['footer_description'];?></textarea>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Save" required />
                  </form>
                  <!--/Form -->
                  <?php
                    }}
                  ?>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>