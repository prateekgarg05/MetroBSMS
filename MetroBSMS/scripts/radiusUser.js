var map;
var centerPointLocation;
var markers = [];
var busstopMarkers = [];
var radiusValue;
var busstopcontent = null;

function initialize() {
  var centerLocation = new google.maps.LatLng(34.04861,-118.258822);

  map = new google.maps.Map(document.getElementById('map-canvas'), {
    center: centerLocation,
    zoom: 10
  });  

  google.maps.event.addListener(map, 'click', function(event) {

	    //marker = new google.maps.Marker({position: event.latLng, map: map});
	    deleteMarkers();
	    addMarker(event.latLng);
	    centerPointLocation = event.latLng;
		centerLocation = document.getElementById("centerpoint");
		centerLocation.value = centerPointLocation.lat() + ", " + centerPointLocation.lng();	
	});
}

function addMarker(location) {
	  var marker = new google.maps.Marker({
	    position: location,
	    map: map
	  });
	  markers.push(marker);
	}	
function deleteMarkers() {
	for (var i = 0; i < markers.length; i++) {
	    markers[i].setMap(null);
	  }
	  markers = [];
	}

function createMarker(place,contentString) {
	
  var img = '../img/busstopnotassigned.png';
  var placeLoc = new google.maps.LatLng(place.latitude,place.longitude);
  var placeTitle = place.onstreet + "/" + place.crossstreet;
  var infowindow = new google.maps.InfoWindow();
  
  var marker = new google.maps.Marker({
    map: map,
    position: placeLoc,
	title: placeTitle,
	icon: img
  });

  busstopMarkers.push(marker);  

	google.maps.event.addListener(marker, 'click', function() {
		
	  infowindow.setContent(contentString);
      infowindow.setOptions({maxWidth:500});
      infowindow.open(map, this);  
  	});
}

google.maps.event.addDomListener(window, 'load', initialize);

function ClearFields()
{
	document.getElementById("radius").value = "";
	document.getElementById("centerpoint").value = "";
	document.getElementById("loading").style.visibility = "hidden";	
}

function FilterStops()
{
	document.getElementById("loading").style.visibility = "visible";
	document.getElementById("Count").innerHTML = "";
	
	radiusValue = document.getElementById("radius").value;

	$(document).ready(function() {
		
		$.get('../php/GetUniqueBusStops.php', function(data) {		    
			busstopcontent = data;		
			FilterData();	
		});	
	});
}

function FilterData()
{	
	var contentobj = JSON.parse(busstopcontent);
	var item;
	var stopCount = 0;

	for (var i = 0; i < busstopMarkers.length; i++) {
		busstopMarkers[i].setMap(null);
	  }
	busstopMarkers = [];
	  
	for (var i=0; i< contentobj.data.length ;i++)
	{
		item = (contentobj.data)[i];
		var locationlatlng = new google.maps.LatLng(item.latitude,item.longitude);
		distance = google.maps.geometry.spherical.computeDistanceBetween(centerPointLocation, locationlatlng);
		if (distance <= radiusValue)	{	
			
			contentString = "<div>StopID: "+ item.stopID 
			+ "<br>Title: " +  item.onstreet + "/" + item.crossstreet
			+ "<br>Assigned To: " + item.username
			+ "<br>Click <a href=\'MainPage.php?stopID=" 
			+ item.stopID + "&username=" + item.username 
			+ "\'>here</a> to enter information"
			+ "</div>";
			createMarker(item,contentString);
			stopCount++;
		}
	}
	
	map.setCenter(centerPointLocation);
    map.setZoom(15);
	document.getElementById("loading").style.visibility = "hidden";
	document.getElementById("Count").innerHTML = stopCount + " stops were found";
	
}