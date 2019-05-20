<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Order</title>
<link rel="stylesheet" type="text/css" href="style.css">
<script>
	location.href = "#menu";
</script>
<style>
#typeselection
{
	display: block;
    border: 1px solid #FF69B4;
    border-radius: 5px 5px 5px 5px;
    position: absolute;
  	bottom: 0;
  	left: 50%;
  	margin-left: -70px;
}
#selectionlist
{
  	width: 30%;
    border: 1px solid #FF69B4;
    border-radius: 5px 5px 5px 5px;
}
#titles
{
    margin-left: 5px;
	display: inline-block;
  	width: 150px;
}
#titles2
{
    margin-left: 5px;
	display: inline-block;
  	width: 160px;
}
input
{
	border: 1px solid #FF69B4;
    border-radius: 5px 5px 5px 5px;
    width: 30%;
}
#btn
{
	color: #FFFAF0;
	background: #FF69B4;
	border-radius: 5px;
	margin-left: 205px;
	cursor: pointer;
}
#btn2
{
	color: #FFFAF0;
	background: #FF69B4;
	border-radius: 5px;
	margin-left: 225px;
	cursor: pointer;
}
#selection
{
	width: 630px;
	height: 70px;
	margin: 10px auto 0px;
	background-color: #FFFAF0;
	color: #7D3C98;
	border-radius: 10px 10px 10px 10px;
	border: 1px solid #FF69B4;
	text-align: center;
	line-height: 20px;
	position: relative;
}
#wrapper
{
	position: relative;
	width: 370px;
	height: 280px;
	margin: 10px auto 0px;
	margin-bottom: 10px;
	background-color: #FFFAF0;
	color: #7D3C98;
	border-radius: 10px 10px 10px 10px;
	border: 1px solid #FF69B4;
	line-height: 30px;
}
#orderproduct, #ordercatering
{
	position: absolute;
	width: 630px;
	height: 300px;
}
</style>
<script>
	function showDiv(element)
	{
	   if(element.value == 0)
	   {
		   document.getElementById('orderproduct').style.display = "none";
		   document.getElementById('ordercatering').style.display = "none";
	   }
	   else if(element.value == 1)
	   {
		   document.getElementById('ordercatering').style.display = "none";
		   document.getElementById('orderproduct').style.display = "block";
	   }
	   else
	   {
		   document.getElementById('orderproduct').style.display = "none";
		   document.getElementById('ordercatering').style.display = "block";		   
	   }

	}
	
	var date1 = new Date();
	var date2 = new Date();
	var date3 = new Date();
	var date4 = new Date();
	var date5 = new Date();
	
	date1.setDate(date1.getDate() + 1);
	date2.setDate(date2.getDate() + 2);
	date3.setDate(date3.getDate() + 3);
	date4.setDate(date4.getDate() + 4);
	date5.setDate(date5.getDate() + 5);
	
	var day1 = date1.getDate(); var day2 = date2.getDate(); var day3 = date3.getDate(); var day4 = date4.getDate(); var day5 = date5.getDate();
	var month1 = date1.getMonth() + 1; var month2 = date2.getMonth() + 1; var month3 = date3.getMonth() + 1; var month4 = date4.getMonth() + 1; var month5 = date5.getMonth() + 1;
	var year1 = date1.getFullYear(); var year2 = date2.getFullYear(); var year3 = date3.getFullYear(); var year4 = date4.getFullYear(); var year5 = date5.getFullYear();

	var formattedDay1 = day1 + '/'+ month1 + '/'+ year1;
	var formattedDay2 = day2 + '/'+ month2 + '/'+ year2;
	var formattedDay3 = day3 + '/'+ month3 + '/'+ year3;
	var formattedDay4 = day4 + '/'+ month4 + '/'+ year4;
	var formattedDay5 = day5 + '/'+ month5 + '/'+ year5;
	
	var formattedDay1Value = year1 + '-'+ month1 + '-'+ day1;
	var formattedDay2Value = year2 + '-'+ month2 + '-'+ day2;
	var formattedDay3Value = year3 + '-'+ month3 + '-'+ day3;
	var formattedDay4Value = year4 + '-'+ month4 + '-'+ day4;
	var formattedDay5Value = year5 + '-'+ month5 + '-'+ day5;
	
	window.onload = function()
	{
	    document.getElementById('day1').innerHTML = formattedDay1;
	    document.getElementById('day2').innerHTML = formattedDay2;
	    document.getElementById('day3').innerHTML = formattedDay3;
	    document.getElementById('day1two').innerHTML = formattedDay1;
	    document.getElementById('day2two').innerHTML = formattedDay2;
	    document.getElementById('day3two').innerHTML = formattedDay3;
	    document.getElementById('day4').innerHTML = formattedDay4;
	    document.getElementById('day5').innerHTML = formattedDay5;

	    document.getElementById('day1').value = formattedDay1Value;
	    document.getElementById('day2').value = formattedDay2Value;
	    document.getElementById('day3').value = formattedDay3Value;
	    document.getElementById('day1two').value = formattedDay1Value;
	    document.getElementById('day2two').value = formattedDay2Value;
	    document.getElementById('day3two').value = formattedDay3Value;
	    document.getElementById('day4').value = formattedDay4Value;
	    document.getElementById('day5').value = formattedDay5Value;
	};
</script>
</head>
<body id="orderpage">

	<div id="logo">
		<img src="resources\logo.png" style = "width: 630px; height: 350px">
	</div>
	
	<div id="menu">	
		<p></p>		
		<ul>
  			<li><a href="index.php">Home</a></li>
  			<li><a href="index.php">Products &amp; Catering Services</a></li>
  			<li><a href="index.php">Contact</a></li>
  			<li><a id="order" href="order_redirect.php">Order</a></li>
  			<?php if(isset($_SESSION['user'])): ?>
  				<li id="right"><a href="account.php">My Account</a></li>
  			<?php else: ?>
  				<li id="right"><a href="login_page.php">Login/Sign Up</a></li>
  			<?php endif; ?>	
		</ul>	
	</div>
	
	<div id="selection">
		<p></p>		
		<h4>Welcome to the order page, to start making your order, please choose whether you are interested in a product or a catering service:</h4>
		<select id="typeselection" name="option_select" onchange="showDiv(this)">
			<option value="0">---Select Option---</option>
			<option value="1">Product</option>
			<option value="2">Catering Service</option>
		</select>	
	</div>
	
	<div id="wrapper">
		<div id="orderproduct" style="display: none;">
			<form method="post" action="productorder.php">
				<label id="titles">Select Product*</label>
             	<select id = "selectionlist" name="productid">
	               <option value = 0>---Select Product---</option>
	               <option value = 1>Banana Sour Cream Bread (110LE)</option>
	               <option value = 2>Chocolate Zucchini Bread (110LE)</option>
	               <option value = 3>Apple Cinnamon Cake (90LE)</option>
	               <option value = 4>Lemon Cake (70LE)</option>
	               <option value = 5>Chocolate Cake (70LE)</option>
	               <option value = 6>Banana Cake (70LE)</option>
	               <option value = 7>Vanilla Cake (70LE)</option>
	               <option value = 8>Marble Cake (90LE)</option>
	               <option value = 9>Brownies (70LE)</option>
	               <option value = 10>Vanilla Cookies (70LE)</option>
            	 </select>
            	<p></p>
            	<label id="titles">Select Quantity*</label>
             	<select id = "selectionlist" name="quantity">
	               <option value = "0">---Select Quantity---</option>
	               <option value = "1">1</option>
	               <option value = "2">2</option>
	               <option value = "3">3</option>
	               <option value = "4">4</option>
	               <option value = "5">5</option>
            	 </select>
            	<p></p>
            	<label id="titles">Select Delivery Date*</label>
             	<select id = "selectionlist" name="deliverydate">
	               <option value = 0>---Select Delivery Date---</option>
	               <option id="day1" value = ""></option>
	               <option id="day2" value = ""></option>
	               <option id="day3" value = ""></option>
            	 </select>
            	<p></p>
            	<label style="margin-left: 5px;">Delivery Address:</label>
            	<p></p>
            	<label id="titles">Street*</label>
            	<input type="text" name="street">
            	<p></p>
            	<label id="titles">House Number*</label>
            	<input type="text" name="house">
            	<p></p>
            	<label id="titles">Area Name*</label>
            	<input type="text" name="area">
            	<p></p>
            	<label id="titles">ZIP Code</label>
            	<input type="text" name="zipcode">
            	<p></p>
				<button type="submit" name="submitproductorder" id="btn">Submit</button>
			</form>
		</div>
		<div id="ordercatering" style="display: none;">
			<form method="post" action="cateringorder.php">
				<label id="titles2">Select Catering Service*</label>
             	<select id = "selectionlist" name="cateringid">
	               <option value = 0>---Select Catering Service---</option>
	               <option value = 11>Wedding Catering (400LE per person)</option>
	               <option value = 12>Corporate Catering (200LE per person)</option>
	               <option value = 13>Social Event Catering (320LE per person)</option>
	               <option value = 14>Concession Catering (320LE per person)</option>
            	 </select>
            	<p></p>
            	<label id="titles2">Number of People*</label>
             	<input type="text" name="numpeople">
            	<p></p>
            	<label id="titles2">Select Delivery Date*</label>
             	<select id = "selectionlist" name="cateringdate">
	               <option>---Select Delivery Date---</option>
	               <option id="day1two" value = ""></option>
	               <option id="day2two" value = ""></option>
	               <option id="day3two" value = ""></option>
	               <option id="day4" value = ""></option>
	               <option id="day5" value = ""></option>
            	 </select>
            	<p></p>
            	<label style="margin-left: 5px;">Delivery Address:</label>
            	<p></p>
            	<label id="titles2">Street*</label>
            	<input type="text" name="street2">
            	<p></p>
            	<label id="titles2">House Number*</label>
            	<input type="text" name="house2">
            	<p></p>
            	<label id="titles2">Area Name*</label>
            	<input type="text" name="area2">
            	<p></p>
            	<label id="titles2">ZIP Code</label>
            	<input type="text" name="zipcode2">
            	<p></p>
				<button type="submit" name="submitcateringorder" id="btn2">Submit</button>
			</form>
		</div>
	</div>
	
	<div id="footer">	
		<p>Copyright @Moozy's Bakes 2019</p>	
	</div>

</body>
</html>