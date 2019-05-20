<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Manage</title>
<link rel="stylesheet" type="text/css" href="style.css">
<style>
#container
{
    width: 630px;
    height: 300px;
    margin: 10px auto 0px;
	background-color: #FFFAF0;
	color: #7D3C98;
	border-radius: 10px 10px 10px 10px;
    display: flex;
}
#section
{
    border-radius: 10px 10px 10px 10px;
    border: 1px solid #FF69B4;
    flex: 50%;
}
#selectionlist
{
  	width: 40%;
    border: 1px solid #FF69B4;
    border-radius: 5px 5px 5px 5px;
}
#selectionlist2
{
  	width: 80px;
    border: 1px solid #FF69B4;
    border-radius: 5px 5px 5px 5px;
}
#titles
{
    margin-left: 5px;
	display: inline-block;
  	width: 150px;
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
input
{
	border: 1px solid #FF69B4;
    border-radius: 5px 5px 5px 5px;
    width: 40%;
}
#btn
{
	color: #FFFAF0;
	background: #FF69B4;
	border-radius: 5px;
	margin-left: 200px;
}
#btn2
{
	color: #FFFAF0;
	background: #FF69B4;
	border-radius: 5px;
	margin-left: 243px;
}
</style>
</head>
<body>
	<div id="container">	
    	<div id="section">
    		<h3 style="text-align: center;">Products</h3>
    		<hr>
    		<br/>
    		<form method="post" action="editproduct.php">
				<label id="titles">Select Product</label>
             	<select id = "selectionlist" name="productid">
	               <option value = 0>---Select Product---</option>
	               <option value = 1>Banana Sour Cream Bread</option>
	               <option value = 2>Chocolate Zucchini Bread</option>
	               <option value = 3>Apple Cinnamon Cake</option>
	               <option value = 4>Lemon Cake</option>
	               <option value = 5>Chocolate Cake</option>
	               <option value = 6>Banana Cake</option>
	               <option value = 7>Vanilla Cake</option>
	               <option value = 8>Marble Cake</option>
	               <option value = 9>Brownies</option>
	               <option value = 10>Vanilla Cookies</option>
            	 </select>
            	<br/>
            	<br/>
            	<label id="titles">Quantity to Add</label>
            	<input type="text" name="quantity">
            	<br/>
            	<br/>
				<button type="submit" name="submiteditproduct" id="btn">Submit</button>
			</form>
    	</div>
    	
    	<div id="section">
    		<h3 style="text-align: center;">Catering Services</h3>
    		<hr>
    		<br/>
    		<?php 
        		$moozysbakes = mysqli_connect('localhost', 'root', '', 'moozysbakes');
        		
        		if(!$moozysbakes)
        		{
        		    die('connection error: ' . mysqli_connect_error());
        		}
        		
        		$catering = "SELECT Availability FROM CateringService";
        		$result = mysqli_query($moozysbakes, $catering);
        		$availability = Array();
        		
        		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) 
        		{
        		    $availability[] =  $row['Availability'];
        		}
        		
        		mysqli_free_result($result);
        		mysqli_close($moozysbakes);
        	?>
    		<form method="post" action="editcatering.php">
    			<table border='1'>
    				<tr>
                        <th>Catering Service</th>
                        <th>Current Availability</th>                    
                        <th>Availability</th>
                	</tr>
                	<tr>
                		<td>Wedding Catering</td>
                		<?php if($availability[0] == true): ?>
                			<td>Available</td>
                		<?php else: ?>
                			<td>Not Available</td>
                		<?php endif; ?>	
                		
                		<?php if($availability[0] == true): ?>
                			<td>
                				<select id = "selectionlist2" name="wedding">
                	               <option value = true>Available</option>
                	               <option value = false>Not Available</option>
                        		</select>
                        	</td>
                		<?php else: ?>
                			<td>
                				<select id = "selectionlist2" name="wedding">
                	               <option value = false>Not Available</option>
                	               <option value = true>Available</option>
                        		</select>
                        	</td>
                		<?php endif; ?>	
                	</tr>
                	<tr>
                		<td>Corporate Catering</td>
                		<?php if($availability[1] == true): ?>
                			<td>Available</td>
                		<?php else: ?>
                			<td>Not Available</td>
                		<?php endif; ?>	
                		
                		<?php if($availability[1] == true): ?>
                			<td>
                				<select id = "selectionlist2" name="corporate">
                	               <option value = true>Available</option>
                	               <option value = false>Not Available</option>
                        		</select>
                        	</td>
                		<?php else: ?>
                			<td>
                				<select id = "selectionlist2" name="corporate">
                	               <option value = false>Not Available</option>
                	               <option value = true>Available</option>
                        		</select>
                        	</td>
                		<?php endif; ?>	
                	</tr>
                	<tr>
                		<td>Social Event Catering</td>
                		<?php if($availability[2] == true): ?>
                			<td>Available</td>
                		<?php else: ?>
                			<td>Not Available</td>
                		<?php endif; ?>	
                		
                		<?php if($availability[2] == true): ?>
                			<td>
                				<select id = "selectionlist2" name="social">
                	               <option value = true>Available</option>
                	               <option value = false>Not Available</option>
                        		</select>
                        	</td>
                		<?php else: ?>
                			<td>
                				<select id = "selectionlist2" name="social">
                	               <option value = false>Not Available</option>
                	               <option value = true>Available</option>
                        		</select>
                        	</td>
                		<?php endif; ?>	
                	</tr>
                	<tr>
                		<td>Concession Catering</td>
                		<?php if($availability[3] == true): ?>
                			<td>Available</td>
                		<?php else: ?>
                			<td>Not Available</td>
                		<?php endif; ?>	
                		
                		<?php if($availability[3] == true): ?>
                			<td>
                				<select id = "selectionlist2" name="concession">
                	               <option value = true>Available</option>
                	               <option value = false>Not Available</option>
                        		</select>
                        	</td>
                		<?php else: ?>
                			<td>
                				<select id = "selectionlist2" name="concession">
                	               <option value = false>Not Available</option>
                	               <option value = true>Available</option>
                        		</select>
                        	</td>
                		<?php endif; ?>	
                	</tr>
                </table>
                <br/>
                <button type="submit" name="submiteditcatering" id="btn2">Submit</button>
			</form>    	
    	</div>
    </div>
    
    <div id="goback"> 
		<h3><a id="backlink" href="index.html">Go Back</a></h3>
	</div>
	
	<div id="footer">	
		<p>Copyright @Moozy's Bakes 2019</p>	
	</div>

</body>
</html>
