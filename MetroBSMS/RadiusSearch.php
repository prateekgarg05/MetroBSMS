<!DOCTYPE html>
<html>
<head>
<title>Place searches</title>

<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<meta charset="utf-8">

<link rel="stylesheet" href="css/styles.css">

<script src="scripts/jquery.js"></script> 
<script src="scripts/jquery-ui.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=geometry&sensor=false"></script>
<script type="text/javascript" src="/scripts/radiusUser.js"></script>

</head>
<body onload="ClearFields()">       
<form id="mainform" >		
	<div id="map-canvas" style="width: 75%;height: 100%;position: absolute;"></div>
	<div class="sidebar">
	  <div class="sidebar-row-upper">
	  <div class="logo"><img src="img/site/logo.png" /></div>
		<div class="filter">
			<label for="centerpoint">Select a Point on Map</label>
			<input id="centerpoint" name="centerpoint" type="text" class="prepopulate" rel="Select a Point on Map" />				
	    </div>
	    <div class="filter">
			<label for="radius">Enter Radius (In Meters)</label>
			<input id="radius" name="radius" type="text" class="prepopulate" rel="Enter Radius" />
			<button type="button" title="Filter" value="Filter" class="btn-primary" onclick="FilterStops()">Find</button>
	    </div>	    
	  </div>
	  <div class="sidebar-row-lower"></div>
	  <div class="count">
	  	<label id="Count"></label>
	  </div>
	  <div id="loading">
		<img src="img/loading.gif"></img>
	  </div>	  		  
	</div>
	
</form>
</body>
</html>