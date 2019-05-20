<?php

    $moozysbakes = mysqli_connect('localhost', 'root', '', 'moozysbakes');
    
    if(!$moozysbakes)
    {
        die('connection error: ' . mysqli_connect_error());
    }
    
    $errors = array();
    
    if(isset($_POST['signup']))
    {  
        $firstName = ucfirst(mysqli_real_escape_string($moozysbakes, $_POST['firstname']));
        $lastName = ucfirst(mysqli_real_escape_string($moozysbakes, $_POST['lastname']));
        $email = mysqli_real_escape_string($moozysbakes, $_POST['email']);
        $password = mysqli_real_escape_string($moozysbakes, $_POST['userpassword']);
        $telephone = mysqli_real_escape_string($moozysbakes, $_POST['telephone']);
        $street = ucwords(mysqli_real_escape_string($moozysbakes, $_POST['street']));
        $house = strtoupper(mysqli_real_escape_string($moozysbakes, $_POST['house']));  
        $area = ucwords(mysqli_real_escape_string($moozysbakes, $_POST['area']));  
        $zipCode = strtoupper(mysqli_real_escape_string($moozysbakes, $_POST['zipcode']));
        
        if(empty($firstName))
        {
            array_push($errors, "First name is required");
        }
        
        if(empty($lastName))
        {
            array_push($errors, "Last name is required");
        }
        
        if(empty($email))
        {
            array_push($errors, "Email is required");
        }
        else
        {       
            if(filter_var($email, FILTER_VALIDATE_EMAIL) == false)
            {
                array_push($errors, "Email is not valid");
            }
        }
        
        if(empty($password))
        {
            array_push($errors, "Password is required");
        }
        
        if(empty($telephone))
        {
            array_push($errors, "Telephone/Mobile is required");
        }
        
        if(empty($street))
        {
            array_push($errors, "Street address is required");
        }
        
        if(empty($area))
        {
            array_push($errors, "Area name is required");
        }
        
        if(empty($house))
        {
            array_push($errors, "House number is required");
        }
        
        if(count($errors) == 0)
        {
            $check = "SELECT * FROM Customer WHERE Email='$email'";
            $result = mysqli_query($moozysbakes, $check);
            
            if(mysqli_num_rows($result) == 1)
            {
                echo '<script type="text/javascript">';
                echo 'alert("User already exists.");';
                echo 'window.location.href = "signup_page.html";';
                echo '</script>';
                
                mysqli_free_result($result);
            }
            else 
            {
                mysqli_free_result($result);
                $password = md5($password);
                $insert = "INSERT INTO Customer(FirstName, LastName, Email, Password, Telephone) VALUES ('$firstName', '$lastName', '$email', '$password', '$telephone')";
                mysqli_query($moozysbakes, $insert);
                $insert = "INSERT INTO Address(Email, Street, HouseNumber, Area, ZIPCode) VALUES ('$email', '$street', '$house', '$area', '$zipCode')";
                mysqli_query($moozysbakes, $insert);
                mysqli_close($moozysbakes);
                header('location: signup_success.html');
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
            echo 'window.location.href = "signup_page.html";';
            echo '</script>';
        }
    }
                
?>