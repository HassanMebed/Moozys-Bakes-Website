<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Order Receipt</title>
<link rel="stylesheet" type="text/css" href="style.css">
<style>
#message
{
    width: 630px;
    height: 40px;
    background-color: #FFFAF0;
	color: #FF69B4;
	margin: 10px auto 0px;
	border-radius: 10px 10px 10px 10px;
	text-align: center;
	border: 1px solid #FF69B4;
	line-height: 20px;
}
#receipt
{
    max-width: 30%;
    background-color: #FFFAF0;
	color: #7D3C98;
	margin: 10px auto 0px;
	border-radius: 10px 10px 10px 10px;
	border: 1px solid #FF69B4;
}
table
{
    margin: 0 auto;
}
#title
{
    border: none;
}
#info
{
    border: 2px solid black;
}
#goback
{
    width: 630px;
    height: 40px;
    text-align: center;
    background-color: #FFFAF0;
	color: #FF69B4;
	margin: 10px auto 0px;
	margin-bottom: 10px;
	border-radius: 10px 10px 10px 10px;
	border: 1px solid #FF69B4;
	line-height: 20px;
}
</style>
</head>
<body>
	
	<div id="message">
			<h4>Thank you for your order, <strong><?php echo $_SESSION['user'][1]; ?></strong>.</h4>
			<h4>Here is your digital receipt:</h4>
	</div>
	
	<div id="receipt">
		<table>
			<tr>
  				<td id="title">Order ID:</td>
  				<td id="info"><?php echo $_SESSION['order'][0]; ?></td>
 			</tr>
 			<tr>
  				<td id="title">Order Date:</td>
  				<td id="info"><?php echo $_SESSION['order'][1]; ?></td>
 			</tr>
 			<tr>
  				<td id="title">Product/Service:</td>
  				<td id="info"><?php echo $_SESSION['order'][2]; ?></td>
 			</tr>
 			<tr>
  				<td id="title">Price:</td>
  				<td id="info"><?php echo $_SESSION['order'][3]; ?>LE</td>
 			</tr>
 			<tr>
  				<td id="title">Quantity Purchased:</td>
  				<td id="info"><?php echo $_SESSION['order'][4]; ?></td>
 			</tr>
 			<tr>
  				<td id="title"><strong>Total Price:</strong></td>
  				<td id="info"><strong><?php echo $_SESSION['order'][5]; ?>LE</strong></td>
 			</tr>
 			<tr>
  				<td id="title">Delivery Date:</td>
  				<td id="info"><?php echo $_SESSION['order'][6]; ?></td>
 			</tr>
 		</table>
 			<label style="display: block;">------------------------------------------------------------</label>
 			<label style="display: block; text-align: center;">Delivery Address</label>
 			<br/>
 		<table>
 			<?php if(count($_SESSION['order']) == 11): ?>
 				<tr>
  					<td id="title">House Number:</td>
  					<td id="info"><i><?php echo $_SESSION['order'][7]; ?></i></td>
 				</tr>
 				<tr>
  					<td id="title">Street:</td>
  					<td id="info"><i><?php echo $_SESSION['order'][8]; ?></i></td>
 				</tr>
 				<tr>
  					<td id="title">Area Name:</td>
  					<td id="info"><i><?php echo $_SESSION['order'][9]; ?></i></td>
 				</tr>
 				<tr>
  					<td id="title">ZIP Code:</td>
  					<td id="info"><i><?php echo $_SESSION['order'][10]; ?></i></td>
 				</tr>
 			<?php else: ?>
 				<tr>
  					<td id="title">House Number:</td>
  					<td id="info"><i><?php echo $_SESSION['order'][7]; ?></i></td>
 				</tr>
 				<tr>
  					<td id="title">Street:</td>
  					<td id="info"><i><?php echo $_SESSION['order'][8]; ?></i></td>
 				</tr>
 				<tr>
  					<td id="title">Area Name:</td>
  					<td id="info"><i><?php echo $_SESSION['order'][9]; ?></i></td>
 				</tr>
 			<?php endif; ?>	
		</table>
	</div>
	
	<div id="goback"> 
		<h5>Please note that delivery costs are included in each product's price on the website.</h5>
		<h5>Click <a href="order_redirect.php">here</a> to return to site.</h5>
	</div>
	
	<div id="footer">	
		<p>Copyright @Moozy's Bakes 2019</p>	
	</div>

</body>
</html>