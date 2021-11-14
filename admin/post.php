<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Posts</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-post.php">add post</a>
              </div>
              <div class="col-md-12">
                  
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>Date</th>
                          <th>Author</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                      <?php
                  include("config.php");
                include("id_number_refresher_for_post.php");

                $limit = 3;

                if(isset($_GET['page']))
                {
                    $pages = $_GET['page'];
                }
                else{
                    $pages = 1;   
                }

                // $pages = $_GET['page'];
                $offset = ($pages - 1) * $limit;

                // if($_SESSION["user_role"]=='1')
                //     {
                //         $sql = "SELECT * from post 
                //         left join category on post.category = category.category_id
                //         left join user on post.author = user.user_id
                //         limit {$offset} ,{$limit}
                //         ";
                //     }
                // elseif($_SESSION["user_role"] == '0'){
                //         $sql = "SELECT * from post 
                //         left join category on post.category = category.category_id
                //         left join user on post.author = user.user_id
                //         WHERE post.author = {$_SESSION['user_id']}
                //         limit {$offset} ,{$limit}
                //         ";
                //     }


                    if($_SESSION["user_role"] == '1'){
                        /* select query of post table for admin user */
                        $sql = "SELECT post.post_id, post.title, post.description,post.post_date,
                        category.category_name,user.username,post.category,post.author FROM post
                        LEFT JOIN category ON post.category = category.category_id
                        LEFT JOIN user ON post.author = user.user_id
                        ORDER BY post.post_id DESC LIMIT {$offset},{$limit}";
                      }elseif($_SESSION["user_role"] == '0'){
                        /* select query of post table for normal user */
                        $sql = "SELECT post.post_id, post.title, post.description,post.post_date,
                        category.category_name,user.username,post.category,post.author FROM post
                        LEFT JOIN category ON post.category = category.category_id
                        LEFT JOIN user ON post.author = user.user_id
                        WHERE post.author = {$_SESSION["user_id"]}
                        LIMIT {$offset},{$limit}";
                      }
                
                  $result = mysqli_query($conn,$sql) or die("query unsuccessful");

                  if(mysqli_num_rows($result) > 0)
                  {
                      while($rows = mysqli_fetch_assoc($result))
                      {
                  ?>
                          <tr>
                              <td class='id'><?php echo $rows['post_id'];?></td>
                              <td><?php echo $rows['title'];?></td>
                              <td><?php echo $rows['category_name'];?></td>
                              <td><?php echo $rows['post_date'];?></td>
                              <td><?php echo $rows['username'];?></td>
                              <td class='edit'><a href='update-post.php?id=<?php echo $rows['post_id'];?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-post.php?id=<?php echo $rows['post_id'];?>&catid=<?php echo $rows['category'];?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                          <?php
                            }
                            }   
                          ?>
                          
                      </tbody>
                  </table>
                  <?php

                    $sql1 = "SELECT * from post";
                    $result1  = mysqli_query($conn,$sql1);

                    if(mysqli_num_rows($result) > 0)
                    {
                        $total_records = mysqli_num_rows($result1);
                        $limit = 3;
                        $total_pages = ceil($total_records / $limit);
                        

                        echo "<ul class='pagination admin-pagination'>";
                        if($pages > 1)
                        {
                        echo "<li><a href='post.php?page=".($pages-1)."'><<</a></li>";
                        }

                        for($i=1;$i<=$total_pages;$i++)
                        {
                            if($i == $pages)
                            {
                                $active = "active";
                            }
                            else{
                                $active ="";
                            }
                            echo "<li class ='".$active."'><a href='post.php?page={$i}'>{$i}</a></li>";
                        }
                        if($total_pages>$pages)
                        {
                        echo "<li><a href='post.php?page=".($pages+1)."'>>></a></li>";
                        }
                    //   <!-- <li class="active"><a>1</a></li> -->
                        echo "</ul>";
                    }
                    ?>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
