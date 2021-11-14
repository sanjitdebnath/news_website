<div id ="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
            include("config-post.php");
                    $sql = "SELECT * from setting";
                    $result = mysqli_query($conn,$sql) or die("setting query failed");
                    if(mysqli_num_rows($result) > 0)
                    {
                        while($rows = mysqli_fetch_assoc($result))
                        {
                    ?>
                <span><?php echo $rows['footer_description']." ";?><a href="https://sdntechdesign.blogspot.com/" target='blank'>SDN TECH</a></span>
                <?php
                        }}
                        ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
