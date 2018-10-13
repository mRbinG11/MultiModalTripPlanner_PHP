<html>
<head><link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<title>Smart Transit</title>	
</head>
<style>




h1
{
	background-color:#D3D3D3;
	text-align: center;
	font-size: 30px;
	font-style: oblique;
}
#sr{
	
  font-size: 30px;
    border: 2px solid #98FB98;
    color: #D3D3D3;
    
}
#ds{
	font-size: 30px;
	border: 2px solid #FFCC11;
}
.butt
{

     background-color: #555555;
    
    color: white;
    padding: 15px 32px;
    text-align: center;
    font-size: 10px;
    margin: 4px 2px;
    cursor: pointer;

}
body
{
  background-color: #D3D3D3;
	background-image: url("image/trns.gif");
	background-repeat: no-repeat;
	background-position: top;
	 font-family: "Lato", sans-serif;
  
}

.sbar {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: #111;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 50px;
}

.sbar a {
    padding: 7px 7px 7px 31px;
    text-decoration: none;
    font-size: 24px;
    color: #D3D3D3;
    display: block;
    transition: 0.4s;
}

.sbar a:hover {
    color: #696969;
}

.sbar .clsbtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 35px;
    margin-left: 50px;
}

.obtn {
    font-size: 20px;
    cursor: pointer;
    background-color: #000000;
    color: white;
    padding: 10px 16px;
    
}

.obtn:hover {
    background-color: #696969;
}

#min {
    transition: margin-left .5s;
    padding: 16px;
}

#frm{
	margin-left: 800px;
}
#busrc{
    margin-left: 600px;
    margin-top: 200px;
    position: absolute;

}
#sb{
    margin-left: 280px;
}
#datatable
{
	margin-top: 110px;
	position: relative;
}

	</style>
	<body><h1><b>Smart Transit</b></h1>
	<div id="Sbar" class="sbar">
  <a href="javascript:void(0)" class="clsbtn" onclick="closeNav()">×</a>
  <a href="#">Account Details</a>
  <a href="#">Wallet</a>
  <a href="restaurants.php">Restaurants near by</a>
</div>
<div id="min">
  <button class="obtn" onclick="openNav()">☰ </button>
  <div class="container-fluid">
<div id ="frm">
<br>
<br>
<br>
<br>
<br>
<form action="maps.php" method="POST">
	Source:<br>
	<input type="text" name="source"><br>
	Destination:<br>
	<input type="text" name="destination"></p>
	<input type="submit" class="butt" name="submit">
</div>
	<div id="displaymap"> </div>
</form>
<div id="busrc">
<form method="POST" action="mapsapi.php">
	Start Point:
	<input type="text" id="bussource" name="bussource">
	Destination:
	<input type="text" id="busdest" name="busdest"><br><br>
	<input type="submit" id="sb" name="submit2">

</form>
</div>
</div>
</div>
</html>

<script type="text/javascript">
	(function () {
    if (window.addEventListener) {
        window.addEventListener('load', run, false);
    } else if (window.attachEvent) {
        window.attachEvent('onload', run);
    }

    function run() {
        var tb = document.getElementById('datatable');
        tb.onclick = function (event) {
            event = event || window.event; 
            var data = event.data || event.srcElement;
            while (data && data.nodeName != 'TR') 
            { 
                data = data.parentElement;
            }
            var row = data.cells; 
            var src = document.getElementById('bussource');
            var dest = document.getElementById('busdest');
            src.value = row[1].innerHTML;
            dest.value = row[2].innerHTML;
        };
    }

})();
function openNav() {
    document.getElementById("Sbar").style.width = "250px";
    document.getElementById("min").style.marginLeft = "250px";
}

function closeNav() {
    document.getElementById("Sbar").style.width = "0";
    document.getElementById("min").style.marginLeft= "0";
}
</script>

<?php
	error_reporting(0);
	$dbName = "hackathon";
	$dbUsername = "root";
	$dbPassword= '';
	$server="localhost";
	$port=3306;

	// Connect to mysql server
	$dbconnect = mysqli_connect($server, $dbUsername, $dbPassword, $dbName, $port);
	$source=$_POST['source'];
	$destination=$_POST['destination'];

	
	
	$sql="SELECT * FROM stopdata WHERE source REGEXP '$source' and destination REGEXP '$destination'";
	$query=mysqli_query($dbconnect,$sql);

	echo "<table id='datatable' border='2px solid black'>";
    echo "<tr><td><b>Bus Number</b></td><td><b>Start Date</b></td><td><b>Destination</b></td></tr>";


	while($row = mysqli_fetch_assoc($query))
	{   
		echo "<tr><td>" . $row['busno'] . "</td><td>" . $row['source'] . "</td><td>" .$row['destination']."</td></tr>"; 
	}

	echo "</table>";

?>
<script type="text/javascript">
	jQuery("#datatable").hide();
    jQuery("#busrc").hide();
	jQuery(".butt").click(function(event) {
		event.preventDefault();
        jQuery("#frm").hide();
		jQuery("#datatable").show();
        jQuery("#busrc").show();

	});


</script>

