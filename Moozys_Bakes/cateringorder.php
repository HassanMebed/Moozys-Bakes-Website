<?php
    
    session_start();

    $moozysbakes = mysqli_connect('localhost', 'root', '', 'moozysbakes');
    
    if(!$moozysbakes)
    {
        die('connection error: ' . mysqli_connect_error());
    }
    
    $errors = array();
    
    if(isset($_POST['submitcateringorder']))
    {
        $user = $_SESSION['user'][0];
        $timezone = date_default_timezone_get();
        date_default_timezone_set($timezone);
        $date = date('Y-m-d H:i:s');
        $deliveryDate = $_POST['cateringdate'];
        $product = $_POST['cateringid'];
        $quantity = mysqli_real_escape_string($moozysbakes, $_POST['numpeople']);
        $street = ucwords(mysqli_real_escape_string($moozysbakes, $_POST['street2']));
        $house = strtoupper(mysqli_real_escape_string($moozysbakes, $_POST['house2']));
        $area = ucwords(mysqli_real_escape_string($moozysbakes, $_POST['area2']));
        $zipCode = strtoupper(mysqli_real_escape_string($moozysbakes, $_POST['zipcode2']));

        if($product == 0)
        {
            array_push($errors, "Catering service is required");
        }
        
        if(empty($quantity))
        {
            array_push($errors, "Number of people is required");
        }
        else if(!is_numeric($quantity) || (int)$quantity <= 0 || (int)$quantity != round((int)$quantity, 0))
        {
            array_push($errors, "Please enter valid number of people");
        }
        else if((int)$quantity > 150)
        {
            array_push($errors, "Maximum number of people is 150");
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
            $getAvailability = "SELECT Availability FROM CateringService WHERE ID = $product";
            $result = mysqli_query($moozysbakes, $getAvailability);
            $rowAvailability = mysqli_fetch_assoc($result);
            $availability = $rowAvailability['Availability'];
            if($availability == false)
            {
                echo '<script type="text/javascript">';
                echo 'alert("This catering service is currently not available, please check again soon.");';
                echo 'window.location.href = "order_redirect.php";';
                echo '</script>';
                
                mysqli_free_result($result);
            }
            else 
            {
                mysqli_free_result($result);
                $quantityInsert = $quantity . " people";
                $insertOrder = "INSERT INTO Orders(Customer, OrderDate, DeliveryDate, ProductID, QuantityOrdered) VALUES ('$user', '$date', '$deliveryDate', $product, '$quantityInsert')";
                mysqli_query($moozysbakes, $insertOrder);
                $getOrderID = "SELECT OrderID FROM Orders WHERE Customer = '$user' AND OrderDate = '$date' AND DeliveryDate = '$deliveryDate' AND ProductID = $product AND QuantityOrdered = '$quantityInsert'";
                $result = mysqli_query($moozysbakes, $getOrderID);
                $rowOrder = mysqli_fetch_assoc($result);
                $orderID = $rowOrder['OrderID'];
                mysqli_free_result($result);
                $insertAddress = "INSERT INTO DeliveryAddress(OrderID, Street, HouseNumber, Area, ZIPCode) VALUES ($orderID, '$street', '$house', '$area', '$zipCode')";
                mysqli_query($moozysbakes, $insertAddress);
                $getProductInfo = "SELECT Name, Price FROM Deliverable WHERE ID = $product";
                $result = mysqli_query($moozysbakes, $getProductInfo);
                $rowProduct = mysqli_fetch_assoc($result);
                $productName = $rowProduct['Name'];
                $productPrice = $rowProduct['Price'];
                mysqli_free_result($result);
                $totalPrice = (int)$quantity * $productPrice;
                $orderInfo = array($orderID, $date, $productName, $productPrice, $quantityInsert, $totalPrice, $deliveryDate, $house, $street, $area, $zipCode);
                
                if(empty($zipCode))
                {
                    $orderInfo = array($orderID, $date, $productName, $productPrice, $quantityInsert, $totalPrice, $deliveryDate, $house, $street, $area);
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