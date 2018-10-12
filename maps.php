<html>
<title>Test</title>
<form action="maps.php" method="POST">
	<p>Source:<input type="text" name="source">
	Destination:<input type="text" name="destination"></p>
	<input type="submit" name="submit">
	<div id="displaymap"> </div>
</form>
<form method="GET" action="maps.php">
	<input type="text" id="bussource" name="bussource">
	<input type="text" id="busdest" name="busdest">
	<input type="submit" name="submit2">
</form>
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
</script>

<?php
	$dbName = "hackathon";
	$dbUsername = "root";
	$dbPassword= '';
	$server="localhost";
	$port=3306;

	// Connect to mysql server
	$dbconnect = mysqli_connect($server, $dbUsername, $dbPassword, $dbName, $port);
	$source=$_POST['source'];
	$destination=$_POST['destination'];

	$sourcename=$_GET['bussource'];
	$dest=$_GET['busdest'];

	$destname=urlencode($dest);
	
	$sql="SELECT * FROM stopdata WHERE source REGEXP '$source' and destination REGEXP '$destination'";
	$query=mysqli_query($dbconnect,$sql);

	echo "<table id='datatable'>";

	while($row = mysqli_fetch_assoc($query))
	{   
		echo "<tr><td>" . $row['busno'] . "</td><td>" . $row['source'] . "</td><td>" .$row['destination']."</td></tr>"; 
	}

	echo "</table>";
function googleapi($url) 
{
	$options=array(
		CURLOPT_RETURNTRANSFER => true,			//returns webpage
		CURLOPT_HEADER => false,				//no headers to return
		CURLOPT_FOLLOWLOCATION => true,			//follow redirects
		CURLOPT_MAXREDIRS => 10,				//stop after 10 redirects
		CURLOPT_ENCODING => "",					//handle compressed
		CURLOPT_USERAGENT => "test",			//name of client
		CURLOPT_AUTOREFERER => true,			//set referrer on redirect
		CURLOPT_CONNECTTIMEOUT => 120,			//time out on connect
		CURLOPT_TIMEOUT => 120,					//time out on response
	);

	$ch=curl_init($url);
	curl_setopt_array($ch, $options);
	$content=curl_exec($ch);
	curl_close($ch);
	return $content;

}
$response_directions = googleapi("https://maps.googleapis.com/maps/api/directions/json?origin='.$sourcename.'&destination='.$destname.'&key=AIzaSyDnfJA1FX86cFbGxLE9-BnseJXAZ41b8Ek");
//$response_places=googleapi("https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=-33.8670522,151.1957362&radius=1500&type=restaurant&keyword=cruise&key=AIzaSyDnfJA1FX86cFbGxLE9-BnseJXAZ41b8Ek");

$resdir=array();
$resdir=json_decode($response_directions,true);
print_r($resdir);




?>

