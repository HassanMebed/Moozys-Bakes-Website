<?php

    session_start();
    
    if(isset($_SESSION['user']))
    {
        header('location: orderonline_page.php');
    }
    else
    {
        header('location: login_page.php');
    }
?>
