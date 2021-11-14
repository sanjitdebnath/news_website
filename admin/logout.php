<?php

session_start();

session_unset();

session_destroy();

header("location: http://localhost/news_site/admin/"); 

?>
