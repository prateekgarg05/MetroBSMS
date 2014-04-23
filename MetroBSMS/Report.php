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

<script type="text/javascript">

//google.maps.event.addDomListener(window, 'load', initialize);

var busstopcontent = null;
var radiusValue;

function ClearFields()
{
	document.getElementById("radius").value = "";	
	document.getElementById("loading").style.visibility = "hidden";	
}

function GenerateReport()
{
	radiusValue = document.getElementById("radius").value;
	document.getElementById("loading").style.visibility = "visible";
	
	$(document).ready(function() {
		
		$.get('./php/GetUniqueBusStops.php', function(data) {		    
			busstopcontent = data;		
			GetData();	
		});	
	});
}

function GetData()
{
	document.getElementById("Count").innerHTML = "StopID;Coordinates;Number of Stops<br/>";
		
	var contentobj = JSON.parse(busstopcontent);
	var item1,item2;
	var sourcelatlng, destlatlng;
	var stopCount = 0;
	var resultsArray = [];
	 
	for (var i=0; i< contentobj.data.length ;i++)
	{
		item1 = (contentobj.data)[i];
		sourcelatlng = new google.maps.LatLng(item1.latitude,item1.longitude);		
		stopCount = 0;
		
		for (var j=0; j< contentobj.data.length; j++)
		{
			if (j != i)
			{
				item2 = (contentobj.data)[j];
				destlatlng = new google.maps.LatLng(item2.latitude,item2.longitude);
			
				distance = google.maps.geometry.spherical.computeDistanceBetween(sourcelatlng, destlatlng);
			
				if (distance <= radiusValue)	{	
					stopCount++;
				}				
			}
		}

		if (stopCount >= 10)
		{
			var result = item1.stopID + ";(" + item1.latitude + "," + item1.longitude + ");" + stopCount;
			//document.getElementById("Count").innerHTML += result;
			resultsArray.push(result);
		}		
	}

	resultsArray.sort(function(a,b) { return (b.split(";"))[2].valueOf() - (a.split(";"))[2].valueOf();});

	for (var k =0;k<resultsArray.length;k++)
	{
		document.getElementById("Count").innerHTML += resultsArray[k] + "<br />";
	}
	
	document.getElementById("loading").style.visibility = "hidden";
}

</script>

</head>
<body onload="ClearFields()">
<form id="mainform" >		
	<div id="map-canvas" style="width: 75%;height: 100%;position: absolute;"></div>
	<div class="sidebar">
	  <div class="sidebar-row-upper">
	  <div class="logo"><img src="img/site/logo.png" /></div>		
	    <div class="filter">
			<label for="radius">Enter Radius (In Meters)</label>
			<input id="radius" name="radius" type="text" class="prepopulate" rel="Enter Radius" />
			<button type="button" title="Filter" value="Filter" class="btn-primary" onclick="GenerateReport()">Generate</button>
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
