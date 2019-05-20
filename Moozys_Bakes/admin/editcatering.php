<?php
    $moozysbakes = mysqli_connect('localhost', 'root', '', 'moozysbakes');
    
    if(!$moozysbakes)
    {
        die('connection error: ' . mysqli_connect_error());
    }
    
    if(isset($_POST['submiteditcatering']))
    {
        $wedding = $_POST['wedding'];
        $corporate = $_POST['corporate'];
        $social = $_POST['social'];
        $concession = $_POST['concession'];
        
        $update11 = "UPDATE CateringService SET Availability = $wedding WHERE ID = 11";
        $update12 = "UPDATE CateringService SET Availability = $corporate WHERE ID = 12";
        $update13 = "UPDATE CateringService SET Availability = $social WHERE ID = 13";
        $update14 = "UPDATE CateringService SET Availability = $concession WHERE ID = 14";
        
        mysqli_query($moozysbakes, $update11);
        mysqli_query($moozysbakes, $update12);
        mysqli_query($moozysbakes, $update13);
        mysqli_query($moozysbakes, $update14);
        
        mysqli_close($moozysbakes);
        header('location: service_management.php');       
    }
?>