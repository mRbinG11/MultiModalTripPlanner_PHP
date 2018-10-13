

<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<style type="text/css">
	
	body 
	{
		background-image: url("image/sin.gif");
		background-repeat: no-repeat;
		background-size: cover;
		background-position: center;
	}

	h2
	{
		text-align: center;
		font-size: 35px;
	}

 	h2
	{
		color:#2A3457;
		font-size:45px;
		margin: auto;
		width: 220px;
		border: 3px solid #595775;
		text-align: center;
		padding: 8px;
	}
	.butt
{

     background-color: #191970;
    
    color: white;
    padding: 15px 25px;
    text-align: center;
    font-size: 20px;
    margin: 3px 2px;
    cursor: pointer;

}
	
	#name
	{
		color:red;
	}

	#num
	{
		color:red;
	}
	
</style>
	

<title>Sign up</title>

</head>

<body>
	<br>
	<h2>Sign Up</h2><br>
	<div class="container-fluid">
		<div class="row text-center">
			<div class="col-md-4"></div>
			<div class="col-md-4 col-md-offset-5">
				<div class="col-md-4"></div>

	<form name="myform" action="" method="POST" onsubmit="return checkform(myform)">
				<br><br><b>Username</b><br>
				<input type="text" name="username" placeholder="Enter Username" required><br><br>
				<div id="name">
				
				</div>
				
				<b>Password</b><br>
				<input type="password" name="password" placeholder="Enter Password" required><br><br>
				<b>Confirm Password</b><br>
				<input type="password" name="confirm" placeholder="Confirm Password" required><br><br>
				<b>Email</b><br>
				<input type="text" name="email" placeholder="Enter Email" required><br><br>
				<b>Phone Number</b><br>
				<input type="text" name="phone" placeholder="Enter Phone" required><br><br>
				<div id="num">
				
				</div>
		
				<input type="submit" class="butt" value="Submit"><br>
			</form>
			</div>
		</div>
	</div>
</body>

</html>

