<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Login</title>
<link rel="stylesheet" type="text/css" href="style.css">
<script>
	location.href = "#menu";
</script>
<style>
#mainLog
{
	font-size: 100%;
	width: 40%;
	margin: 10px auto 0px;
	color: #FFFAF0;
	background: #FF69B4;
	text-align: center;
	border: 1px solid #660033;
	border-bottom: none;
	border-radius: 10px 10px 0px 0px;
	padding: 20px;
}
form
{
	font-size: 100%;
	width: 40%;
	margin: 0px auto;
	margin-bottom: 10px;
	padding: 20px;
	border: 1px solid #FF69B4;
	background: #FFFAF0;
	border-radius: 0px 0px 10px 10px;
}
#userInfo
{
	font-size: 120%;
	margin: 10px 0px 10px 0px;
}
#userInfo label
{
	display: block;
	text-align: left;
	margin: 3px
}
#userInfo input
{
	height: 30px;
	width: 93%;
	padding: 5px 10px;
	font-size: 16px;
	border-radius: 5px;
	border: 1px solid #FF69B4;
}
#btn
{
	padding: 10px;
	font-size: 15px;
	color: #FFFAF0;
	background: #FF69B4;
	border: none;
	border-radius: 5px;
	cursor: pointer;
}
</style>
</head>
<body id="loginpage">

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
  				<li id="right"><a href="account.php">My Account</a></li>
  			<?php else: ?>
  				<li id="right"><a id="userout" href="login_page.php">Login/Sign Up</a></li>
  			<?php endif; ?>	
		</ul>	
	</div>
	
	<div id="mainLog">	
		<h2>Login</h2>	
	</div>

	<form method="post" action="login.php">
		<div id="userInfo">
			<label>Email</label>
			<input type="text" name="email">			
		</div>
		<div id="userInfo">
			<label>Password</label>
			<input type="password" name="userpassword">			
		</div>
		<div id="userInfo">
			<button type="submit" name="login" id="btn">Submit</button>			
		</div>
		<p>
			Not yet a member? <a href="signup_page.html">Sign up</a>
		</p>
	</form>
	
	<div id="footer">	
		<p>Copyright @Moozy's Bakes 2019</p>	
	</div>

</body>
</html>