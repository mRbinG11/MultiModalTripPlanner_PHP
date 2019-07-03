
<?php
	$lat=file_get_contents("demofile.txt");
	$long=file_get_contents("demo.txt");
	$ch = curl_init();
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

	$response_places=googleapi("https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=".$lat.",".$long."&radius=15000&type=restaurant&keyword=cruise&key=KEY");
	$resplace=array();
	$resplace=json_decode($response_places,true);
	$num = count($resplace['results']);
	$i=0;
	$loc_lat = array();
	$loc_lng = array(); 
	$north_lat = array();
	$north_lng = array();
	$south_lat = array();
	$south_lng = array();
	while($i<$num)
	{
	$loc_lat[$i] = $resplace['results'][$i]['geometry']['location']['lat'];
	$loc_lng[$i] = $resplace['results'][$i]['geometry']['location']['lng'];
	$north_lat[$i] = $resplace['results'][$i]['geometry']['viewport']['northeast']['lat'];
	$north_lng[$i] = $resplace['results'][$i]['geometry']['viewport']['northeast']['lng'];
	$south_lat[$i] = $resplace['results'][$i]['geometry']['viewport']['southwest']['lat'];
	$south_lng[$i] = $resplace['results'][$i]['geometry']['viewport']['southwest']['lng'];
	$i++;
    }
    $response=googleapi("https://maps.googleapis.com/maps/api/geocode/json?latlng=".$south_lat[0].",".$south_lng[0]."&key=KEY");
    $resarr=array();
    $resarr=json_decode($response,true);
    $x=$resarr['results']['0']['formatted_address'];
?>

<!DOCTYPE html>
<html>
<body bgcolor="orange">
<title>Restaurants</title>
<h1>Restaurants</h1>

<div id="googleMap" style="width:100%;height:400px;"></div>
<p><?php echo $x; ?> </p>

<script>
function myMap() {
  var myCenter = new google.maps.LatLng(<?php echo $south_lat[0]; ?>,<?php echo $south_lng[0]; ?>);

  var mapCanvas = document.getElementById("googleMap");
  var mapOptions = {center: myCenter, zoom: 12};
  var map = new google.maps.Map(mapCanvas, mapOptions);
  var marker = new google.maps.Marker({position:myCenter});
  marker.setMap(map);
}
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=KEY"></script>

</body>
</html>
