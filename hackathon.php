<html>
<head>
	<title>BLACK HATS</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<style>

h1{
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
	background-position: bottom;
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

}





	</style>
	<body><h1><b>BLACK HATS<img  id="black" src="image\black.jpg" alt="blckhat" height="50px" weight="50px" align="middle" ></b></h1>

<div id="Sbar" class="sbar">
  <a href="javascript:void(0)" class="clsbtn" onclick="closeNav()">×</a>
  <a href="#">Account Details</a>
  <a href="#">Wallet</a>
  <a href="#">Restaurants near by</a>
  
</div>

<div id="min">
  <button class="obtn" onclick="openNav()">☰ </button>  
<div id ="frm">
<form action="" id >
  Source:<br>
  <input id="sr" type="text" name="sce" required><br>
   Destination:<br>
  <input id="ds" type="text" name="dest" required><br><br>
   <input type="button" class="butt" value="Submit">
</form>
</div>


</div>

<script>
function openNav() {
    document.getElementById("Sbar").style.width = "250px";
    document.getElementById("min").style.marginLeft = "250px";
}

function closeNav() {
    document.getElementById("Sbar").style.width = "0";
    document.getElementById("min").style.marginLeft= "0";
}
</script>



	</body>