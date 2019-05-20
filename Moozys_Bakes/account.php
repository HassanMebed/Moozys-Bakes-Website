<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>My Account</title>
<link rel="stylesheet" type="text/css" href="style.css">
<script>
	location.href = "#menu";
</script>
<style>
#welcome
{
    width: 630px;
    height: 40px;
    background-color: #FFFAF0;
	color: #7D3C98;
	margin: 10px auto 0px;
	border-radius: 10px 10px 10px 10px;
	border: 1px solid #FF69B4;
	text-align: center;
}
#orders
{
    width: 630px;
    height: 415px;
    background-color: #FFFAF0;
	color: #7D3C98;
	margin: 10px auto 0px;
	overflow-y: scroll;
	overflow-x: scroll;
	border-radius: 10px 10px 10px 10px;
	border: 1px solid #FF69B4;
	
}
#logout
{
    width: 78.75px;
    height: 25px;
    background-color: #FF69B4;
	color: #FFFAF0;
	margin: 10px auto 0px;
	margin-bottom: 10px;
	border-radius: 5px 5px 5px 5px;
	border: 1px solid #FF69B4;
	text-align: center;
}
#logoutlink
{
     color: #FFFAF0;
}
td
{
    text-align: center;
}
</style>
</head>
<body id="account">

	<div id="logo">
		<img src="resources\logo.png" style = "width: 630px; height: 350px">
	</div>
	
	<div id="menu">	
		<p></p>		
		<ul>
  			<li><a href="index.php">Home</a></li>
  			<li><a href="index.php">Products &amp; Catering Services</a></li>
  			<li><a href="index.php">Contact</a></li>
  			<li><a href="order_redirect.php">Order</a></li>
  			<?php if(isset($_SESSION['user'])): ?>
  				<li id="right"><a id="userin" href="account.php">My Account</a></li>
  			<?php else: ?>
  				<li id="right"><a href="login_page.php">Login/Sign Up</a></li>
  			<?php endif; ?>	
		</ul>	
	</div>
	
	<div id="welcome">
			<h4>Welcome <strong><?php echo $_SESSION['user'][1]; ?></strong>!</h4>
			<h4>Current/Past Orders:</h4>
	</div>
	
	<div id="orders">
		<?php 
    		$moozysbakes = mysqli_connect('localhost', 'root', '', 'moozysbakes');
    		$email = $_SESSION['user'][0];
    		
    		if(!$moozysbakes)
    		{
    		    die('connection error: ' . mysqli_connect_error());
    		}
    		
    		$check = "SELECT OrderID FROM Orders WHERE Customer='$email'";
    		$result = mysqli_query($moozysbakes, $check);
    		
    	   if(mysqli_num_rows($result) == 0)
    	   {
    	       echo "<h5 style='text-align: center;'>You haven't made any orders yet, go to the <a href='order_redirect.php'>order page</a> to start making online orders.</h5>";   	       
    	   }
    	   else
    	   {
        	    $getOrderInfo = "SELECT * FROM Orders INNER JOIN DeliveryAddress ON Orders.OrderID = DeliveryAddress.OrderID INNER JOIN Deliverable ON Orders.ProductID = Deliverable.ID WHERE Orders.Customer = '$email' ORDER BY Orders.OrderDate DESC";
        	    $orderInfo = mysqli_query($moozysbakes, $getOrderInfo);
        	    
        	    echo "<table border='1'>
                    <tr>
                    <th>Order ID</th>
                    <th>Ordered On</th>                    
                    <th>Product/Service</th>
                    <th>Price</th>
                    <th>Quantity Purchased</th>
                    <th>Total Price</th>
                    <th>Delivery Date</th>
                    <th>Delivery Address</th>
                    </tr>";
        	    
        	    while($row = mysqli_fetch_assoc($orderInfo))
        	    {
        	        echo "<tr>";
        	        echo "<td>" . $row['OrderID'] . "</td>";
        	        echo "<td>" . $row['OrderDate'] . "</td>";
        	        echo "<td>" . $row['Name'] . "</td>";
        	        echo "<td>" . $row['Price'] . "LE" . "</td>";
        	        echo "<td>" . $row['QuantityOrdered'] . "</td>";
        	        echo "<td>" . ($row['Price'] * (int) filter_var($row['QuantityOrdered'], FILTER_SANITIZE_NUMBER_INT)) . "LE" . "</td>";
        	        echo "<td>" . $row['DeliveryDate'] . "</td>";
        	        
        	        $address = "";
        	        
        	        if(empty($row['ZIPCode']))
        	        {
        	            $address = $row['HouseNumber'] . "\n" . $row['Street'] . "\n" . $row['Area'];
        	            echo "<td>" . nl2br($address) ."</td>";
        	        }
        	        else
        	        {
        	            $address = $row['HouseNumber'] . "\n" . $row['Street'] . "\n" . $row['Area'] . "\n" . $row['ZIPCode'];
        	            echo "<td>" . nl2br($address) . "</td>";
        	        }
        	        echo "</tr>";
        	    }
        	    echo "</table>";
        	    mysqli_free_result($result);
        	    mysqli_free_result($orderInfo);
        	    mysqli_close($moozysbakes);
    	   }
		?>
	</div>
	
	<div id="logout"> 
		<h3><a id="logoutlink" href="logout.php">Log out</a></h3>
	</div>
	
	<div id="footer">	
		<p>Copyright @Moozy's Bakes 2019</p>	
	</div>

</body>
</html>