<?php
    $moozysbakes = mysqli_connect('localhost', 'root', '', 'moozysbakes');
    
    if(!$moozysbakes)
    {
        die('connection error: ' . mysqli_connect_error());
    }
    
    $errors = array();
    
    if(isset($_POST['submiteditproduct']))
    {
        $product = $_POST['productid'];
        $quantity = $_POST['quantity'];
        
        if($product == 0)
        {
            array_push($errors, "Product is required");
        }
        
        if(empty($quantity))
        {
            array_push($errors, "Quantity is required");
        }
        else if(!is_numeric($quantity) || (int)$quantity <= 0 || (int)$quantity != round((int)$quantity, 0))
        {
            array_push($errors, "Please enter valid quantity");
        }
        else 
        {
            $quantity = (int)$quantity;
        }
        
        if(count($errors) == 0)
        {
            $getQuantity = "SELECT QuantityAvailable FROM Product WHERE ID = $product";
            $result = mysqli_query($moozysbakes, $getQuantity);
            $row = mysqli_fetch_assoc($result);
            mysqli_free_result($result);
            $currentQuantity = $row['QuantityAvailable'];
            $newQuantity = $quantity + $currentQuantity;
            $updateQuantity = "UPDATE Product SET QuantityAvailable = $newQuantity WHERE ID = $product";
            mysqli_query($moozysbakes, $updateQuantity);
            mysqli_close($moozysbakes);
            header('location: service_management.php');
        }
        else 
        {
            $errorMsg = "";
            
            foreach($errors as $error)
            {
                if(empty($errorMsg))
                {
                    $errorMsg = $errorMsg. $error;
                }
                else
                {
                    $errorMsg = $errorMsg. ", " . $error;
                }                
            }
            
            echo '<script type="text/javascript">';
            echo 'alert("'.$errorMsg.'");';
            echo 'window.location.href = "service_management.php";';
            echo '</script>';
        }
    }
?>