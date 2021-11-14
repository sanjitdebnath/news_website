<?php include 'header.php'; ?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                  <!-- post-container -->
                    <div class="post-container">
                    <?php
                        include("config-post.php");
                        $post_id = $_GET['id'];
                        $limit = 3;

                        $sql = "SELECT post.post_img,post.post_id, post.title, post.description,post.post_date,
                        category.category_name,category.category_id,user.username,post.category,post.author FROM post
                        LEFT JOIN category ON post.category = category.category_id
                        LEFT JOIN user ON post.author = user.user_id 
                        where post_id = {$post_id}
                        ";

                        $result = mysqli_query($conn,$sql) or die("query unsuccessful");

                        if(mysqli_num_rows($result) > 0)
                        {
                            while($rows = mysqli_fetch_assoc($result))
                            {
                        
                        ?>
                        <div class="post-content single-post">
                            <h3><?php echo $rows['title'];?></h3>
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
                            <img class="single-feature-image" src="admin/upload/<?php echo $rows['post_img'];?>" alt=""/>
                            <p class="description">
                            <?php echo $rows['description'];?>
                            </p>
                        </div>
                    </div>
                    <?php
                        }}
                        ?>
                    <!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
