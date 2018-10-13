

<?php
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

	$source=$_POST['bussource'];
	$dest=$_POST['busdest'];
	$destname=urlencode($dest);
	$sourcename=urlencode($source);
	//$response_directions = googleapi("https://maps.googleapis.com/maps/api/directions/json?origin=".$sourcename."&destination=".$destname."&key=AIzaSyDnfJA1FX86cFbGxLE9-BnseJXAZ41b8Ek");

	

	//$resdir=array();
	//$resdir=json_decode($response_directions,true);
	//print_r($resdir);
	/*$temp=$resdir['routes'];
	$t=$temp[0];
	$a=$t['bounds'];
	$b=$a['northeast'];
	$lat=$b['lat'];
	$long=$b['lng'];
	echo $lat;
	echo $long;*/


	//$response_places=googleapi("https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=".$lat.",".$long."&radius=1500&type=bus_station&keyword=cruise&key=AIzaSyDnfJA1FX86cFbGxLE9-BnseJXAZ41b8Ek");
	//$resplace=array();
	//$resplace=json_decode($response_places,true);
	//print_r($resplace);

	$response_lat=googleapi("https://maps.googleapis.com/maps/api/geocode/json?address=".$sourcename."&key=AIzaSyDnfJA1FX86cFbGxLE9-BnseJXAZ41b8Ek");
	$responselat=array();
	$responselat=json_decode($response_lat,true);
	//print_r($responselat);
	$r=$responselat['results'];
	$s=$r['0'];
	$m=$s['geometry'];
	$n=$m['location'];
	$smr=$n['lat'];
	$nys=$n['lng'];
	//print($smr);
	//print($nys);

	$response_lng=googleapi("https://maps.googleapis.com/maps/api/geocode/json?address=".$destname."&key=AIzaSyDnfJA1FX86cFbGxLE9-BnseJXAZ41b8Ek");
	$responselng=array();
	$responselng=json_decode($response_lng,true);
	//print_r($responselat);
	$ra=$responselng['results'];
	$sa=$ra['0'];
	$ma=$sa['geometry'];
	$na=$ma['location'];
	$smra=$na['lat'];
	$nysa=$na['lng'];
	//print($smra);
	//print($nysa);

$ubXL;
$pool;
$ubGo;
$ubPre;
$dist;
$time;

function ubfare($src_latitude,$src_longitude,$dest_latitude,$dest_longitude)
	{
$initial = curl_init();
$url="https://api.uber.com/v1.2/estimates/price?start_latitude=".$src_latitude."&start_longitude=".$src_longitude."&end_latitude=".$dest_latitude."&end_longitude=".$dest_longitude;
curl_setopt($initial, CURLOPT_URL, $url);
curl_setopt($initial, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($initial, CURLOPT_CUSTOMREQUEST, "GET");
$res = array();
$res[] = "Authorization: Token 5ay12-tO8WAJY9HZB0IDyYZfe3EPhf6J7cL6KfLB";
$res[] = "Accept-Language: en_US";
$res[] = "Content-Type: application/json";
curl_setopt($initial, CURLOPT_HTTPHEADER, $res);
$res = curl_exec($initial);
if (curl_errno($initial)) {
    echo 'Error:' . curl_error($initial);
}
curl_close ($initial);
$result = array();
$result = json_decode($res,true);
//print_r($result['prices']);
$dist=$result['prices'][0]['distance'];
$time=round(($result['prices'][0]['duration'])/60.0);
echo $dist."\n";
echo $time."\n";
//file_put_contents("dm.txt", $dist);
$i=0;
$num = count($result['prices']);
while ($i<$num) 
{	if($result['prices'][$i]['display_name']=='Pool')
		$pool=$result['prices'][$i]['estimate'];
	else if($result['prices'][$i]['display_name']=='UberGo')
		$ubGo=$result['prices'][$i]['estimate'];
	else if($result['prices'][$i]['display_name']=='UberXL')
		$ubXL=$result['prices'][$i]['estimate'];
	else if($result['prices'][$i]['display_name']=='Premier')
		$ubPre=$result['prices'][$i]['estimate'];
	$i++;
}
echo $pool."\n";
echo $ubGo."\n";
echo $ubXL."\n";
echo $ubPre."\n";
}

$srclat=file_get_contents("demofile.txt");
$srclong=file_get_contents("demo.txt");

ubfare($srclat,$srclong,$smr,$nys);

$destlat=12.9716;
$destlong=77.5946;
ubfare($smra,$nysa,$destlat,$destlong);
?>

<html>
  <head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="http://malsup.github.com/jquery.form.js"></script> 
  
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
  integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
  integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
  integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  
  	<title> Black Hats</title>
    <style>      
    .butt
	{
		background-color: #555555;
    	color: white;
    	padding: 15px 32px;
    	text-align: center;
    	font-size: 15px;
    	margin: 4px 2px;
    	cursor: pointer;
	}
    #placemap
    {
        height: 50%;
        width: 30%;
        margin-left: 450px;
    }
    #mode
    {
    	margin-left: 450px;
    }
    </style>
  </head>
  <body>
  
    <div id="placemap"></div>
       <select id="mode">
      <option value="DRIVING">Driving</option>
      <option value="WALKING">Walking</option>
      <br><br>
    </select>
    <body>
		<table style="width:100%">
  		<tr>
    		<th>CAB</th>
    		<th>BUS</th> 
    		<th>CAR</th>
  		</tr>
  		<tr>
    		<td  align="center">
				<form action="" method="POST" >
 				<br><br><br>
   				<button type="submit" class="btn btn-outline-success cab" value="cab">Book</button>
				</form>
			</td>		
       		<td  align="center"><form action="" >
           	<br><br><br>
            <input type="button" name="bus" class="butt" value="Book">
        	</form>
        	</td> 
      		<td  align="center">
			<form action="mapsapi.php" method="POST" >
 			<br><br><br>
   			<input type="button" name="cab2" class="butt" value="Book">
		</form>
			</td>
     	</tr>
	</table>
</body>


<script type="text/javascript">
	var e="<?php echo file_get_contents("dm.txt"); ?>";
	if(e<1.5)
	{
		jQuery(".cab").attr("disabled",true);
	}
	else
	{
		jQuery(".cab").show();
	}
</script>

<script type="text/javascript">
       function initMap() {
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var directionsService = new google.maps.DirectionsService;
        var map = new google.maps.Map(document.getElementById('placemap'), {
          zoom: 14,
          center: {lat: 12.9716, lng: 77.5946}
        });
        directionsDisplay.setMap(map);

        maproute(directionsService, directionsDisplay);
        document.getElementById('mode').addEventListener('change', function() {
          maproute(directionsService, directionsDisplay);
        });
      }

      function maproute(directionsService, directionsDisplay) {
        var selectedMode = document.getElementById('mode').value;
        directionsService.route({
          origin: {lat: <?php echo $smr; ?> , lng: <?php echo $nys; ?>},  
          destination: {lat: <?php echo $smra; ?> , lng: <?php echo $nysa; ?>},  
          travelMode: google.maps.TravelMode[selectedMode]
        }, function(response, status) {
          if (status == 'OK') {
            directionsDisplay.setDirections(response);
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
      }



  </script>
    <script async defer 
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDnfJA1FX86cFbGxLE9-BnseJXAZ41b8Ek&callback=initMap">
    </script>
