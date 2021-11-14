<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                 <!-- post-container -->
                 <div class="post-container">
                    <?php

                    include("config-post.php");
                    if(isset($_GET['aid'])){
                        $author_id = $_GET['aid'];
    
                    
                        $sql1 = "SELECT * FROM post JOIN user
                          ON post.author = user.user_id
                          WHERE author = {$author_id}";
                    $result1  = mysqli_query($conn,$sql1);
                    $show_rows = mysqli_fetch_assoc($result1);
                    $total_no1_record = mysqli_num_rows($result1);
                    // echo $total_no1_record;
                    
                    
                  echo "<h2 class='page-heading'>author : {$show_rows['username']}</h2>";

                        // $author_id = $_GET['aid'];
                        
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




                        $sql = "SELECT post.post_img,post.category,post.post_id, post.title, post.description,post.post_date,
                        category.category_name,category.category_id,user.username,post.category,post.author FROM post
                        LEFT JOIN category ON post.category = category.category_id
                        LEFT JOIN user ON post.author = user.user_id 
                        where  author = {$author_id}
                        LIMIT {$offset},{$limit}

                        ";

                        $result = mysqli_query($conn,$sql) or die("query unsuccessful");

                        if(mysqli_num_rows($result) > 0)
                        {
                            while($rows = mysqli_fetch_assoc($result))
                            {
                        
                        ?>
                        <div class="post-content">
                            <div class="row">
                                <div class="col-md-4">
                                    <a class="post-img" href="single.php?id=<?php echo $rows['post_id'];?>"><img src="admin/upload/<?php echo $rows['post_img'];?>" alt=""/></a>                               
                                </div>

                                <div class="col-md-8">
                                    <div class="inner-content clearfix">
                                        <h3><a href='single.php?id=<?php echo $rows['post_id'];?>'><?php echo $rows['title'];?></a></h3>
                                        <div class="post-information">
                                            <span>
                                                <i class="fa fa-tags" aria-hidden="true"></i>
                                                <a href='category.php?catid=<?php echo $rows['category_id'];?>'><?php echo $rows['category_name'];?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                                <a href='author.php?aid=<?php echo $rows['author'];?>'><?php echo $rows['username'];?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                <?php echo $rows['post_date'];?>
                                            </span>
                                        </div>
                                        <p class="description">
                                        <?php echo substr($rows['description'],0,150)."...."; ?>
                                        </p>
                                        <a class='read-more pull-right' href='single.php?id=<?php echo $rows['post_id'];?>'>read more</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        }
                        
                        

                        if(mysqli_num_rows($result1) > 3){

                            $total_records = mysqli_num_rows($result1);
        
                            $total_pages = ceil($total_records / $limit);
        
                            echo '<ul class="pagination admin-pagination">';
                            if($pages > 1){
                              echo '<li><a href="author.php?aid='.$author_id .'&page='.($pages - 1).'">Prev</a></li>';
                            }
                            for($i = 1; $i <= $total_pages; $i++){
                              if($i == $pages){
                                $active = "active";
                              }else{
                                $active = "";
                              }
                              echo '<li class="'.$active.'"><a href="author.php?aid='.$author_id .'&page='.$i.'">'.$i.'</a></li>';
                            }
                            if($total_pages > $pages){
                              echo '<li><a href="author.php?aid='.$author_id .'&page='.($pages + 1).'">Next</a></li>';
                            }
        
                            echo '</ul>';
                          }
                        }else{
                          echo "<h2>No Record Found.</h2>";
                        }
                    
                    ?> 
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
