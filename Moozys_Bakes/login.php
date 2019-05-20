<?php
    
    $moozysbakes = mysqli_connect('localhost', 'root', '', 'moozysbakes');
    
    if(!$moozysbakes)
    {
        die('connection error: ' . mysqli_connect_error());
    }
    
    $errors = array();
    
    if(isset($_POST['login']))
    {
        $email = mysqli_real_escape_string($moozysbakes, $_POST['email']);
        $password = mysqli_real_escape_string($moozysbakes, $_POST['userpassword']);
        
        if(empty($email))
        {
            array_push($errors, "Email is required");
        }
        
        if(empty($password))
        {
            array_push($errors, "Password is required");
        }
        
        if(count($errors) == 0)
        {
            $password = md5($password);
            $check = "SELECT * FROM Customer WHERE Email='$email' AND Password='$password'";
            $result = mysqli_query($moozysbakes, $check);
            
            if(mysqli_num_rows($result) == 1)
            {
                session_start();
                
                mysqli_free_result($result);
                $getFirstName = "SELECT FirstName FROM Customer WHERE Email='$email'";
                $result = mysqli_query($moozysbakes, $getFirstName);
                $row = mysqli_fetch_assoc($result);
                $firstName = $row['FirstName'];
                $userInfo = array($email, $firstName);             
                $_SESSION['user'] = $userInfo;
                mysqli_free_result($result);
                mysqli_close($moozysbakes);
                header('location: account.php');              
            }
            else
            {
                echo '<script type="text/javascript">';
                echo 'alert("The email or password you entered is inccorect.");';
                echo 'window.location.href = "login_page.html";';
                echo '</script>';
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
            echo 'window.location.href = "login_page.html";';
            echo '</script>';
        }
    }

?>