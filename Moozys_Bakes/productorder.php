<?php
    session_start();
    
    $moozysbakes = mysqli_connect('localhost', 'root', '', 'moozysbakes');
    
    if(!$moozysbakes)
    {
        die('connection error: ' . mysqli_connect_error());
    }
    
    $errors = array();
    
    if(isset($_POST['submitproductorder']))
    {
        $user = $_SESSION['user'][0];
        $timezone = date_default_timezone_get();
        date_default_timezone_set($timezone);
        $date = date('Y-m-d H:i:s');
        $deliveryDate = $_POST['deliverydate'];
        $product = $_POST['productid'];
        $quantity = mysqli_real_escape_string($moozysbakes, $_POST['quantity']);
        $street = ucwords(mysqli_real_escape_string($moozysbakes, $_POST['street']));
        $house = strtoupper(mysqli_real_escape_string($moozysbakes, $_POST['house']));
        $area = ucwords(mysqli_real_escape_string($moozysbakes, $_POST['area']));
        $zipCode = strtoupper(mysqli_real_escape_string($moozysbakes, $_POST['zipcode']));
        
        if($product == 0)
        {
            array_push($errors, "Product is required");
        }
        
        if($quantity == 0)
        {
            array_push($errors, "Quantity is required");
        }
        
        if($deliveryDate == 0)
        {
            array_push($errors, "Delivery date is required");
        }
               
        if(empty($street))
        {
            array_push($errors, "Street is required");
        }
        
        if(empty($house))
        {
            array_push($errors, "House number is required");
        }
        
        if(empty($area))
        {
            array_push($errors, "Area name is required");
        }      
        
        if(count($errors) == 0)
        {
            $checkQuantity = "SELECT QuantityAvailable FROM Product WHERE ID = $product";
            $result = mysqli_query($moozysbakes, $checkQuantity);
            $rowQuantity = mysqli_fetch_assoc($result);
            $quantityAvailable = $rowQuantity['QuantityAvailable'];
            
            if((int)$quantity > $quantityAvailable)
            {
                echo '<script type="text/javascript">';
                echo 'alert("There is currently not enough product to supply the quantity you wish to purchase. Do not worry, we know about this and more product will be available soon.");';
                echo 'window.location.href = "order_redirect.php";';
                echo '</script>';
                
                mysqli_free_result($result);
            }
            else 
            {  
                mysqli_free_result($result);
                $insertOrder = "INSERT INTO Orders(Customer, OrderDate, DeliveryDate, ProductID, QuantityOrdered) VALUES ('$user', '$date', '$deliveryDate', $product, '$quantity')";
                mysqli_query($moozysbakes, $insertOrder);
                $getOrderID = "SELECT OrderID FROM Orders WHERE Customer = '$user' AND OrderDate = '$date' AND DeliveryDate = '$deliveryDate' AND ProductID = $product AND QuantityOrdered = '$quantity'";
                $result = mysqli_query($moozysbakes, $getOrderID);
                $rowOrder = mysqli_fetch_assoc($result);
                $orderID = $rowOrder['OrderID'];
                mysqli_free_result($result);
                $insertAddress = "INSERT INTO DeliveryAddress(OrderID, Street, HouseNumber, Area, ZIPCode) VALUES ($orderID, '$street', '$house', '$area', '$zipCode')";
                mysqli_query($moozysbakes, $insertAddress);
                $newQuantity = $quantityAvailable - (int)$quantity;
                $updateQuantity = "UPDATE Product SET QuantityAvailable = $newQuantity WHERE ID = $product";
                mysqli_query($moozysbakes, $updateQuantity);
                $getProductInfo = "SELECT Name, Price FROM Deliverable WHERE ID = $product";
                $result = mysqli_query($moozysbakes, $getProductInfo);
                $rowProduct = mysqli_fetch_assoc($result);
                $productName = $rowProduct['Name'];
                $productPrice = $rowProduct['Price'];
                mysqli_free_result($result);
                $totalPrice = ((int)$quantity) * $productPrice;
                $orderInfo = array($orderID, $date, $productName, $productPrice, $quantity, $totalPrice, $deliveryDate, $house, $street, $area, $zipCode);
                
                if(empty($zipCode))
                {
                    $orderInfo = array($orderID, $date, $productName, $productPrice, $quantity, $totalPrice, $deliveryDate, $house, $street, $area);
                }
                
                $_SESSION['order'] = $orderInfo;
                mysqli_close($moozysbakes);
                header('location: receipt.php');
            }
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
            echo 'window.location.href = "order_redirect.php";';
            echo '</script>';
        }
    }

?>