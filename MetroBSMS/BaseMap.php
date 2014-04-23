<!DOCTYPE html>
<html>
<head>
<title>Bus Stop Information</title>

<meta charset="utf-8">
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">

<link rel="stylesheet" href="css/styles.css">

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script src="scripts/jquery.js"></script> 
<script src="scripts/jquery-ui.js"></script>
<script src="scripts/markerclusterer.js"></script>
</head>

<body onload="GetBusStopData()">

<form id="mainform">

<img src="img/loading.gif"></img>
<div id="map-full" class="fullmap"></div>
<div class="sidebar">
  <div class="sidebar-row-upper">
  <div class="logo"><img src="img/site/logo.png" /></div>
	<div class="filter">
		<label for="linenumber">Filter the Stops by Line Number</label>
		<input id="linenumber" name="linenumber" type="text" class="prepopulate" rel="Enter Line Number" />
		<button type="button" title="Filter" value="Filter" class="btn-primary" onclick="FilterStops(false)">Filter</button>
    </div>
    <div class="show-stops">
        <div class="divider"><img src="img/site/sidebar-divider.png"/></div>
        <div class="form-float-left form-label">Show Only My Stops</div>
        <div class="form-float-right">
		<input type="checkbox" id="MyStops" name="mystops" onclick="ShowMyStops()" class="regular-checkbox big-checkbox" />		<label for="MyStops"></label>
		</div>
        <div class="form-clear"></div>
        <div class="divider"><img src="img/site/sidebar-divider.png"/></div>
    </div>
	<div class="legend">
		<div class="legend-label">Legend</div>
		<div class="legend-image"><img src="img/site/legend-image.png" style="width:100%; height:auto;" /></div>
	</div>
    <div class="report-stop">
    	<button type="button" title="Report" class="btn-primary" onclick="ReportNewStop()">Report Missing/New Stop</button>
	</div>
	
	<div class="report-stop">
    	<button type="button" title="Upload" class="btn-primary" onclick="UploadImages()">Upload Images</button>
	</div>
  </div>
  <div class="sidebar-row-lower"></div>
</div>
</form>

<!--<form id="mainform">

<img src="img/loading.gif"></img>
<div id="map-full" class="fullmap"></div>
<div class="sidebar">
	<p class="filter">
		<label for="linenumber">Filter the Stops by Line Number</label><br/>
		<input id="linenumber" name="linenumber" type="text">
		<br/>
		<input type="button" title="Filter" value="Filter" onclick="FilterStops(false)">	
	</p>
	<br/>
	<p class="mydata">	
		<input id="MyStops" name="mystops" type="checkbox" onclick="ShowMyStops()">Show My Stops only
	</p>
	<br/>
	<br/>
	<p class="index">
		<img src="img/busstopcompleted.png">Completed</img><br/>
		<img src="img/busstoptoday.png">Today's Task</img><br/>
		<img src="img/busstoppending.png">Pending</img><br/>
		<img src="img/busstopnotassigned.png">Not Assigned</img>
	</p>
	<br />
	<br /> 
	<p>
		<input type="button" class="missing" onclick="ReportNewStop()">
		<br/>
		<label> Report Missing/New Stop</label> 
	</p>
</div>
</form>-->
<script src="scripts/basemap.js"></script>

</body>
</html>