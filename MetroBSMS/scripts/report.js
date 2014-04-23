var busstopcontent = null;
var busstopuniquecontent = null;
var mybusstopcontent = null;
var radiusValue;
var map1,map2;
var searchType = 0;
var stopsCircle = null;
var busstopMarkers = [];

google.maps.event.addDomListener(window, 'load', initialize);

$(function() {
	$(document).on("change",'input[type="checkbox"]', function () {	 
		    if(this.checked) {	    		
		    	if (searchType == 1)
		    		mybusstopcontent = busstopcontent;
		    	else 
		    		mybusstopcontent = busstopuniquecontent;
	    		FilterData(this.value,this.id);
		    }
		    else
		    	ClearMarkers(this.id);
	 	});
	
	/*$('#tabs, #tabs-6').tabs({
        select: function(event, ui){            
            searchType = 1;
            location.reload();
        }
    });
	
	$('#tabs, #tabs-7').tabs({
        select: function(event, ui){            
            searchType = 2;
            location.reload();
        }
    });*/
});

function initialize() {
	
	  var centerLocation = new google.maps.LatLng(34.04861,-118.258822);

	  map1 = new google.maps.Map(document.getElementById('map-canvas1'), {
	    center: centerLocation,
	    zoom: 10
	  }); 
	  
	  map2 = new google.maps.Map(document.getElementById('map-canvas2'), {
		    center: centerLocation,
		    zoom: 10
		  });	 
}

function GenerateReport()
{
	searchType = 1;
	radiusValue = document.getElementById("radius1").value;
	
	document.getElementById("loading1").style.visibility = "visible";
	document.getElementById("Count" + searchType).innerHTML = "";
	
	$(document).ready(function() {		
		$.get('../php/GetRadiusSearchData.php?radius=' + radiusValue + '&type=1', function(data) {			
			content = JSON.parse(data);			
			if (content.data.length == 0)
				{
					$.get('../php/GetBusStops.php', function(data) {		    
						busstopcontent = data;		
						GetData();	
					});	
				}
			else {
					$.get('../php/GetBusStops.php', function(data) {		    
						busstopcontent = data;
						DisplayRadiusSearchData(content.data);
					});				
				}
		});		
	});
}

function GenerateUniqueReport()
{
	searchType = 2;
	radiusValue = document.getElementById("radius2").value;
	document.getElementById("loading2").style.visibility = "visible";
	document.getElementById("Count" + searchType).innerHTML = "";
	
	$(document).ready(function() {		
		$.get('../php/GetRadiusSearchData.php?radius=' + radiusValue + '&type=2', function(data) {			
			content = JSON.parse(data);
			
			if (content.data.length == 0)
				{
					$.get('../php/GetUniqueBusStops.php', function(data) {		    
						busstopuniquecontent = data;		
						GetData();	
					});	
				}
			else {
					$.get('../php/GetUniqueBusStops.php', function(data) {		    
						busstopuniquecontent = data;	
						DisplayRadiusSearchData(content.data);
					});
				}
		});		
	});
}

function GetData()
{	
	var contentobj;
	if (searchType == 1)
		contentobj = JSON.parse(busstopcontent);
	else
		contentobj = JSON.parse(busstopuniquecontent);
	
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

		if (stopCount >= 20)
		{
			var result = new Object();
			result.stopID = item1.stopID;
			result.latitude = item1.latitude;
			result.longitude = item1.longitude;
			result.count = stopCount;
						
			resultsArray.push(result);
		}		
	}

	resultsArray.sort(function(a,b) { return b.count.valueOf() - a.count.valueOf();});
	
	DisplayRadiusSearchData(resultsArray);
	SaveRadiusSearchData(resultsArray);
}

function DisplayRadiusSearchData(resultsArray)
{
	var outputHTML;
	//outputHTML = "<table border=\"1\" style=\"width:30%\"><tr><th>Map</th><th>StopID</th><th>Coordinates</th><th>Number of Stops</th></tr>";
	
	outputHTML = "<table class='extruder-container-table table-first'><tr><th class='first'>Map</th><th>StopID</th><th>Coordinates</th><th class='last'># of Stops</th></tr></table><div class='extruder-holder'><table class='extruder-container-table'>";
	
	for (var k =0;k<resultsArray.length;k++)
	{
		var stopItem = resultsArray[k];
		var checkbox = "<input type=\"checkbox\" id=\"" + k+1 + "\" name=\"stop\" value=\"" + stopItem.latitude + "," + stopItem.longitude + "\">"; 
		var output = "<tr><td style='width:10%'>" + checkbox + "</td>"
					+ "<td style='width:20%'>" + stopItem.stopID + "</td>" 
					+  "<td style='width:50%'>(" + stopItem.latitude + "," + stopItem.longitude + ")</td>"
					+ "<td style='width:20%'>" + stopItem.count + "</td>"
					+ "</tr>";	
		outputHTML += output;
	}
	
	outputHTML += "</table></div>";
	document.getElementById("Count" + searchType).innerHTML = outputHTML;	
	document.getElementById("loading" + searchType).style.visibility = "hidden";
}

function SaveRadiusSearchData(resultsArray)
{
	var radiusSearchData = [];
	//radiusSearchData.data = [];
	
	for (var a=0;a<resultsArray.length;a++)
	{
		var stopItem = resultsArray[a];
		var newobj = {
				"stopid":stopItem.stopID,
				"latitude":stopItem.latitude,
				"longitude":stopItem.longitude,				
				"count": stopItem.count,
				"radius": radiusValue
			};
		radiusSearchData.push(newobj);	
	}
	
	radiusSearchData = JSON.stringify(radiusSearchData);
		
	$.ajax({ url: '../php/SaveRadiusSearchData.php',
        data: {
        	data:radiusSearchData,
        	type:searchType
        },
        type: 'post',
        success: function(output) {
                 }
	});
	
}

function FilterData(centerPointCoord,checkBoxID)
{	
	var contentobj = JSON.parse(mybusstopcontent);
	var centerPointLocation = new google.maps.LatLng((centerPointCoord.split(","))[0],(centerPointCoord.split(","))[1]);
	var item;
	var stopCount = 0;	
	var myMap;
	var markerArray = [];
	
	if (searchType == 1)
		myMap = map1;
	else
		myMap = map2;

	/*for (var i = 0; i < busstopMarkers.length; i++) {
		busstopMarkers[i].setMap(null);
	  }
	busstopMarkers = [];
	
	if (stopsCircle)
		stopsCircle.setMap(null);*/
	var markerObj = new Object();
	markerObj.checkbox = checkBoxID;	
	
	for (var i=0; i< contentobj.data.length ;i++)
	{
		item = (contentobj.data)[i];
		if(item.latitude != "" && item.longitude != "")	{
			
			var locationlatlng = new google.maps.LatLng(item.latitude,item.longitude);
			distance = google.maps.geometry.spherical.computeDistanceBetween(centerPointLocation, locationlatlng);
			if (distance <= radiusValue)	{	
				
				contentString = "<div>StopID: "+ item.stopID 
				+ "<br>Title: " +  item.onstreet + "/" + item.crossstreet
				+ "<br>Assigned To: " + item.username
				+ "<br>Click <a href ='#' onclick='SelectReportStop(" + item.stopID
				+ ",\"" + (searchType==1?"selectstop6":"selectstop7") + "\""
				+ ")'>here</a> to select stop"
				+ "</div>";
				marker = createMarker(item,contentString,myMap);				
				markerArray.push(marker);				
				stopCount++;
			}
		}
	}	
	
	markerObj.markers = markerArray;	
	
	var circleOptions = {
		      strokeColor: '#FF0000',
		      strokeOpacity: 0.8,
		      strokeWeight: 2,
		      fillOpacity: 0,
		      map: myMap,
		      center: centerPointLocation,
		      radius: parseInt(radiusValue)
		    };
		    // Add the circle for this city to the map.
	stopsCircle = new google.maps.Circle(circleOptions);	
	stopsCircle.setMap(myMap);
	markerObj.circle = stopsCircle;
	busstopMarkers.push(markerObj);
	
	myMap.setCenter(centerPointLocation);
	myMap.setZoom(15);	
}

function createMarker(place,contentString,myMap) {
	
  var img = '../img/busstopnotassigned.png';
  var placeLoc = new google.maps.LatLng(place.latitude,place.longitude);
  var placeTitle = place.onstreet + "/" + place.crossstreet;
  var infowindow = new google.maps.InfoWindow();
  
  var marker = new google.maps.Marker({
    map: myMap,
    position: placeLoc,
	title: placeTitle,
	icon: img
  });
  
	google.maps.event.addListener(marker, 'click', function() {
		
	  infowindow.setContent(contentString);
      infowindow.setOptions({maxWidth:500});
      infowindow.open(myMap, this);  
  	});
	
	return marker;
}

function ClearMarkers(checkboxID)
{	
	for (var i = 0; i < busstopMarkers.length; i++) {
		{
			if (busstopMarkers[i] != '')
			{
				if (busstopMarkers[i].checkbox == checkboxID)
				{
					for(var j=0;j<busstopMarkers[i].markers.length;j++)
					{
						(busstopMarkers[i].markers)[j].setMap(null);
					}
					busstopMarkers[i].circle.setMap(null);
					busstopMarkers[i] = '';
					break;
				}
			}
		}
	  }
	
}

function SelectReportStop(stopID,stopselect)
{
	var stopselected = document.getElementById(stopselect);
	stopselected.value = stopID;
}