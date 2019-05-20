<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Current Product Details</title>
<link rel="stylesheet" type="text/css" href="style.css">
<style>
table
{
    
    margin: 10px auto 0px;
    background-color: #FFFAF0;
	color: #7D3C98;
	border: 1px solid black;
}
td
{
    text-align: center;
}
#goback
{
    width: 78.75px;
    height: 25px;
    background-color: #FF69B4;
	color: #FFFAF0;
	margin: 10px auto 0px;
	border-radius: 5px 5px 5px 5px;
	border: 1px solid #FF69B4;
	text-align: center;
}
#backlink
{
     color: #FFFAF0;
}
</style>
</head>
<body>
	<?php 
    	$moozysbakes = mysqli_connect('localhost', 'root', '', 'moozysbakes');
    		
    	if(!$moozysbakes)
   		{
   		    die('connection error: ' . mysqli_connect_error());
   		}
    		
    	$getProducts = "SELECT Product.ID, Deliverable.Name, Product.QuantityAvailable FROM Product, Deliverable WHERE Product.ID = Deliverable.ID ORDER BY Product.QuantityAvailable ASC";
    	$result = mysqli_query($moozysbakes, $getProducts);
        	    
       	echo "<table border='1'>
                 <tr>
                 <th>Product ID</th>
                 <th>Product Name</th>                    
                 <th>Current Available Quantity</th>
                 </tr>";
        	   
        while($row = mysqli_fetch_assoc($result))
        {
           echo "<tr>";
           echo "<td>" . $row['ID'] . "</td>";
           echo "<td>" . $row['Name'] . "</td>";
           echo "<td>" . $row['QuantityAvailable'] . "</td>";
           echo "</tr>";
        }
        echo "</table>";
        mysqli_free_result($result);
        mysqli_close($moozysbakes);   	   
	?>
	
	<div id="goback"> 
		<h3><a id="backlink" href="index.html">Go Back</a></h3>
	</div>
		
	<div id="footer">	
		<p>Copyright @Moozy's Bakes 2019</p>	
	</div>

</body>
</html>