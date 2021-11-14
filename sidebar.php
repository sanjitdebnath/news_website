<div id="sidebar" class="col-md-4">
    <!-- search box -->
    <div class="search-box-container">
        <h4>Search</h4>
        <form class="search-post" action="search.php" method ="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search .....">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-danger">Search</button>
                </span>
            </div>
        </form>
    </div>
    <!-- /search box -->
    <!-- recent posts box -->
    <div class="recent-post-container">
        <h4>Recent Posts</h4>
        <?php
        
        include("config-post.php");
        $sql = "SELECT post.post_img,post.post_id, post.title, post.description,post.post_date,
                        category.category_name,category.category_id,post.category,post.author FROM post
                        LEFT JOIN category ON post.category = category.category_id
                        order by post_id desc
                        limit 0,5
                        ";
        $result = mysqli_query($conn,$sql);
        // echo mysqli_num_rows($result);
        // die();
        
        if(mysqli_num_rows($result) > 0)
        {
            while($rows = mysqli_fetch_assoc($result))
            {       
        ?>
        <div class="recent-post">
            <a class="post-img" href="single.php?id=<?php echo $rows['post_id'];?>">
                <img src="admin/upload/<?php echo $rows['post_img'];?>" alt="not available"/>
               
                 
            </a>
            <div class="post-content">
                <h5><a href="single.php?id=<?php echo $rows['post_id'];?>"><?php echo  substr($rows['title'],0,30)."...";?></a></h5>
                <span>
                    <i class="fa fa-tags" aria-hidden="true"></i>
                    <a href='category.php?catid=<?php echo $rows['category_id'];?>'><?php echo $rows['category_name'];?></a>
                </span>
                <span>
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    <?php echo $rows['post_date'];?>
                </span>
                <a class="read-more" href="single.php?id=<?php echo $rows['post_id'];?>">read more</a>
            </div>
        </div>
        <?php
            }
            } 
        ?>
        
    </div>
    <!-- /recent posts box -->
</div>
