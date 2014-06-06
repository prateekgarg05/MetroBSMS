var map;
var markerCluster = null;
var busstopcontent = null;
var user = '';
var ifmystop = false;
var qs = getQueryStrings();
user = qs["username"];
var centerPoint;
var markers = [];

$(function() {	
	$(document).on("change","#MyStops", function () {
		if (this.checked == true)
			ifmystop = true;
		else
			ifmystop = false;
	});
});

function getQueryStrings() { 
	  var assoc  = {};
	  var decode = function (s) { return decodeURIComponent(s.replace(/\+/g, " ")); };
	  var queryString = window.location.search.substring(1); 
	  var keyValues = queryString.split('&'); 

	  for(var i in keyValues) { 
	    var key = keyValues[i].split('=');
	    if (key.length > 1) {
	      assoc[decode(key[0])] = decode(key[1]);
	    }
	  } 

	  return assoc; 
	} 

function GetBusStopData()
{	
	$(document).ready(function() {
		
		$.get('./php/GetBusStops.php', function(data) {		    
			busstopcontent = data;			
			if (busstopcontent != null)
				initialize(false);
		    });		
	});	
	
}

function initialize() {
  centerPoint = new google.maps.LatLng(34.0399333, -118.2755667); 
    
  map = new google.maps.Map(document.getElementById('map-full'), {
    center: centerPoint,
    zoom: 10    
  });
  
  if(qs["mystop"] == 1)
  {
  	ifmystop = true;
  	document.getElementById("MyStops").checked = true;
  }
  
  ReadData();
}

function GetCurrentDate()
{
	var currentDate = new Date();
	var day = currentDate.getDate();
	var month = currentDate.getMonth() + 1;
	var year = currentDate.getFullYear();
	if (day.toString().length == 1)
		day = '0' + day.toString();
	if (month.toString().length == 1)
		month = '0' + month.toString();
	return year + "-" + month + "-" + day;
}

function ReadData()
{	
	var contentobj = JSON.parse(busstopcontent);
	var item;
	var completed = 'img/busstopcompleted.png';
	var today = 'img/busstoptoday.png';
	var pending = 'img/busstoppending.png';
	var notassigned = 'img/busstopnotassigned.png';
	var content = '';
	
	for (var i = 0; i < markers.length; i++) {
		markers[i].setMap(null);
	  }
	markers = [];
	
	if (markerCluster)
		markerCluster.clearMarkers();
	
	map.setCenter(centerPoint);
    map.setZoom(10);
        
    
	for (var i=0; i< contentobj.data.length ;i++)
		{
			if (document.getElementById("linenumber").value == "" && ifmystop == false && i % 25 != 0)
				continue;
				
			item = (contentobj.data)[i];
			if (user == item.username || user == 'admin')
				{
					content = "<div>StopID: "+ item.stopID 
						+ "<br>Title: " +  item.onstreet + "/" + item.crossstreet
						+ "<br>Direction: " + item.direction
						+ "<br>Assigned To: " + item.username
						+ "<br>Click <a href=\'MainPage.php?stopID=" 
						+ item.stopID + "&username=" + item.username 
						+ "\'>here</a> to enter information"
						+ "</div>";
				}
			else if (user != item.username)
				{
					content = "<div>StopID: "+ item.stopID 
						+ "<br>Title: " +  item.onstreet + "/" + item.crossstreet
						+ "<br>Direction: " + item.direction
						+ "<br>Assigned To: " + item.username						
						+ "</div>";
				}
			
			if ((ifmystop == false) || (ifmystop == true && user == item.username))
			{				
				if (item.status == 'C')
					createMarker (item, completed, content);
				else if (item.status == 'P')
					{
						if (item.start_date != '')
						{
							if (item.start_date == GetCurrentDate())
								createMarker (item, today, content);
							else createMarker(item, pending, content);
						}
					}
				else if(item.status == 'NA')
					createMarker (item, notassigned, content);
			}
		}
	if (markers.length > 10000)
	{
		var mcOptions = {gridSize: 50, maxZoom: 15};
		markerCluster = new MarkerClusterer(map, markers, mcOptions);
	}
}

function createMarker(place,img,contentString) {
					
  var placeLoc = new google.maps.LatLng(place.latitude,place.longitude);
  var placeTitle = place.onstreet + "/" + place.crossstreet;
  var infowindow = new google.maps.InfoWindow();
  
  var marker = new google.maps.Marker({
    map: map,
    position: placeLoc,
	title: placeTitle,
	icon: img
  });
    
  google.maps.event.addListener(marker, 'click', function() {    
	  
	  infowindow.setContent(contentString);
      infowindow.setOptions({maxWidth:500});
      infowindow.open(map, this);  
  });
  
  markers.push(marker);
}

function FilterStops()
{
	$(document).ready(function() {
		var lineNumber = document.getElementById("linenumber");
		
		$.get('./php/GetBusStops.php?lineNumber='+lineNumber.value  , function(data) {		    
			busstopcontent = data;			
			if (busstopcontent != null)
				ReadData();
		    });
	});	
}

function ShowMyStops()
{		
	/*if (document.getElementById("MyStops").checked == true)
		initialize();
	else*/
	ReadData();
}

function ReportNewStop()
{
	window.location.href = "MainPage.php?username="+user + "&newstop=1";
}

function UploadImages()
{
	window.location.href = "Upload.php?username="+user;
}
