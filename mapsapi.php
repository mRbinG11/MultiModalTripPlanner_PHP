
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
	$response_lat=googleapi("https://maps.googleapis.com/maps/api/geocode/json?address=".$sourcename."&key=KEY");
	$responselat=array();
	$responselat=json_decode($response_lat,true);
	$r=$responselat['results'];
	$s=$r['0'];
	$m=$s['geometry'];
	$n=$m['location'];
	$smr=$n['lat'];
	$nys=$n['lng'];
	$response_lng=googleapi("https://maps.googleapis.com/maps/api/geocode/json?address=".$destname."&key=KEY");
	$responselng=array();
	$responselng=json_decode($response_lng,true);
	$ra=$responselng['results'];
	$sa=$ra['0'];
	$ma=$sa['geometry'];
	$na=$ma['location'];
	$smra=$na['lat'];
	$nysa=$na['lng'];

$ubXL=0;
$pool=0;
$ubGo=0;
$ubPre=0;
$dist=0;
$time=0;

$ubXL1=0;
$pool1=0;
$ubGo1=0;
$ubPre1=0;
$dist1=0;
$time1=0;


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
$dist=$result['prices'][0]['distance'];
$time=round(($result['prices'][0]['duration'])/60.0);
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
	file_put_contents("go.txt", $pool);
	file_put_contents("ub.txt", $ubGo);
	file_put_contents("xl.txt", $ubXL);
	file_put_contents("pre.txt", $ubPre);
	file_put_contents("time.txt", $time);
	file_put_contents("dist.txt", $dist);
}
$srclat=file_get_contents("demofile.txt");
$srclong=file_get_contents("demo.txt");

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

  
  	<title>Multimodal Booking</title>
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

    .rad {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 18px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

.rad input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}
td:hover
{
	background-color: #D3D3D3;
}

.chck {
    position: absolute;
    top: 0;
    left: 0;
    height: 20px;
    width: 20px;
    background-color: #eee;
    border-radius: 150%;
}

.rad:hover input ~ .chck{
    background-color: 	#000000;
}


.rad input:checked ~ .chck {
    background-color: 	black;
}


.chck:after {
    content: "";
    position: absolute;
    display: none;
}


.rad input:checked ~ .chck:after {
    display: block;
}


.rad .chck:after {
 	top: 7px;
	left: 7px;
	width: 5px;
	height: 5px;
	border-radius: 30%;
	background: white;
}

#dis
{
	font-size: 18px;
}
    </style>
    <h1 align="center"><b><hr>Smart Transit<hr></b></h1>
  </head>
  <body>
  
    <div id="placemap"></div>
       <select id="mode">
      <option value="DRIVING">Driving</option>
      <option value="WALKING">Walking</option>
      <br><br>
    </select>
    <body>
		<table style="width:100%" border="2px;">
  		<tr>
    		<th align="center">CAB/WALK</th>
    		<th align="center">BUS</th> 
    		<th >CAB/WALK</th>
  		</tr>
  		<tr>
  			<div id="frm">												
    			<td >
				<form action="" method="POST" >
 				<br>
 				<div id="dis">
 				Time taken:<?php echo file_get_contents("time.txt"); ?> Mins <br>
 				Distance:<?php echo file_get_contents("dist.txt");?> Km<br></div>
 				<br>
 				<label class="rad">Pool: <?php echo file_get_contents("go.txt");?>
  				<input type="radio" checked="checked" name="radio">
  				<span class="chck"></span>
				</label>
				<label class="rad">UberGo: <?php echo file_get_contents("go.txt");?>
  				<input type="radio" name="radio">
  				<span class="chck"></span>
				</label>
				<label class="rad">UberXL: <?php echo file_get_contents("xl.txt");?>
  				<input type="radio" name="radio">
  				<span class="chck"></span>
				</label>
				<label class="rad">UberPremier: <?php echo file_get_contents("pre.txt");?>
 				<input type="radio" name="radio">
  				<span class="chck"></span>
				</label>
				</html>
   				<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Book</button>
   				<!-- Modal -->
  				<div class="modal fade" id="myModal" role="dialog">
    			<div class="modal-dialog">
    
    		  	<!-- Modal content-->
      			<div class="modal-content">
        		<div class="modal-header">
          		<button type="button" class="close" data-dismiss="modal">&times;</button>
          		<h4 class="modal-title"></h4>
        		</div>
        		<div class="modal-body">
          		<p>Pool: <?php echo file_get_contents("go.txt");?><br>
				UberGo: <?php echo file_get_contents("go.txt");?><br>
				UberXL: <?php echo file_get_contents("xl.txt");?><br>
				UberPremier: <?php echo file_get_contents("pre.txt");?></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>

				</form>
			</td>		
		</div>
       		<td  align="center"><form action="" >
           	<br><br><b>Starting Bus Station:<?php echo $source; ?><br><br>
           	Destination Station: <?php echo $dest;?></b><br><br>
            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#busmodal">Book</button>
   				<!-- Modal -->
  				<div class="modal fade" id="busmodal" role="dialog">
    			<div class="modal-dialog">
    
    		  	<!-- Modal content-->
      			<div class="modal-content">
        		<div class="modal-header">
          		<button type="button" class="close" data-dismiss="modal">&times;</button>
          		<h4 class="modal-title"></h4>
        		</div>
        		<div class="modal-body">
          		<p>Starting Bus Station:<?php echo $source; ?><br>
				Destination Station: <?php echo $dest;?><br>
				</div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>
        	</form>
        	</td> 
      		<td  align="center">
			<form action="mapsapi.php" method="POST" >
 			<br><br><br>
  				Time taken:<?php echo file_get_contents("time.txt"); ?> Mins <br>
 				Distance:<?php echo file_get_contents("dist.txt");?> Km<br></div>
 				<br>
 				<label class="rad">Pool: <?php echo file_get_contents("go.txt");?>
  				<input type="radio" checked="checked" name="radio">
  				<span class="chck"></span>
				</label>
				<label class="rad">UberGo: <?php echo file_get_contents("go.txt");?>
  				<input type="radio" name="radio">
  				<span class="chck"></span>
				</label>
				<label class="rad">UberXL: <?php echo file_get_contents("xl.txt");?>
  				<input type="radio" name="radio">
  				<span class="chck"></span>
				</label>
				<label class="rad">UberPremier: <?php echo file_get_contents("pre.txt");?>
 				<input type="radio" name="radio">
  				<span class="chck"></span>
				</label>
   			 <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#cabmodal">Book</button>
   				<!-- Modal -->
  				<div class="modal fade" id="cabmodal" role="dialog">
    			<div class="modal-dialog">
    
    		  	<!-- Modal content-->
      			<div class="modal-content">
        		<div class="modal-header">
          		<button type="button" class="close" data-dismiss="modal">&times;</button>
          		<h4 class="modal-title"></h4>
        		</div>
        		<div class="modal-body">
          		<p>Pool: <?php echo file_get_contents("go.txt");?><br>
				UberGo: <?php echo file_get_contents("go.txt");?><br>
				UberXL: <?php echo file_get_contents("xl.txt");?><br>
				UberPremier: <?php echo file_get_contents("pre.txt");?></p>
				</div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>
		</form>
			</td>
     	</tr>
	</table>
</body>


<script type="text/javascript">
	var e="<?php echo file_get_contents("dm.txt"); ?>";
	if(e<1.5)
	{
		jQuery("#frm").attr("disabled",true);
	}
	else
	{
		jQuery("#frm").show();
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
    src="https://maps.googleapis.com/maps/api/js?key=KEY">
    </script>
