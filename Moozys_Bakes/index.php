<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Home</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body id="home">

	<div id="logo">
		<img src="resources\logo.png" style = "width: 630px; height: 350px">
	</div>
	
	<div id="menu">	
		<p></p>		
		<ul>
  			<li><a id="pg1" href="index.php">Home</a></li>
  			<li><a href="index.php">Products &amp; Catering Services</a></li>
  			<li><a href="index.php">Contact</a></li>
  			<li><a href="order_redirect.php">Order</a></li>
  			<?php if(isset($_SESSION['user'])): ?>
  				<li id="right"><a href="account.php">My Account</a></li>
  			<?php else: ?>
  				<li id="right"><a href="login_page.php">Login/Sign Up</a></li>
  			<?php endif; ?>	
		</ul>	
	</div>
	
	<div id="main">	
		<h1>Welcome to Moozy's Bakes!</h1>			
		<p>Moozy's Bakes is a small baking business and catering service in Cairo, Egypt.</p>
		<p>It offers a variety of delicious food items made from fresh ingredients.</p>	
	</div>
	
	<div id="footer">	
		<p>Copyright @Moozy's Bakes 2019</p>	
	</div>

</body>
</html>