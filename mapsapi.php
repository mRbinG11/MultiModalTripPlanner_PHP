
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
	print($smr);
	print($nys);

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
	print($smra);
	print($nysa);

?>
<html>
  <head>
    <style>      
    #placemap 
      {
        height: 50%;
        width: 30%;
      }
    </style>
  </head>
  <body>
    <div id="placemap"></div>
    <select id="start">
    	
    	<option value="<?php echo $source; ?>"><?php echo $source; ?></option>
    </select>
    <select id="end">
    	<option value="<?php echo $dest; ?>"><?php echo $dest; ?></option>
    </select>

<script type="text/javascript">
	
      function initMap() {
        var map = new google.maps.Map(document.getElementById('placemap'), {
          zoom: 12,
          center: {lat:12.9716 , lng:77.5946 },
          mapTypeId: 'terrain'
        });

        var points = [
          {lat:<?php echo $smr; ?> , lng: <?php echo $nys; ?>},
          {lat:<?php echo $smra; ?> , lng: <?php echo $nysa; ?> }
        ];
        var pathway = new google.maps.Polyline({
          path: points,
          geodesic: true,
          strokeColor: '#FF0000',
          strokeOpacity: 1.0,
          strokeWeight: 2
        });

        pathway.setMap(map);
      } 
</script>
    


