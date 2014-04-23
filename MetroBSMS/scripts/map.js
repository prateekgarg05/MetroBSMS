var map;
var infowindow;
var service;
var losangeles;

function initialize() {
  losangeles = new google.maps.LatLng(34.0399333, -118.2755667); 
    
  map = new google.maps.Map(document.getElementById('map-full'), {
    center: losangeles,
    zoom: 15    
  });
  
  marker = new google.maps.Marker({
	    map: map,
	    position: losangeles,
		title: 'My Location'		
	  });
  
  /*var request = {
    location: losangeles,
    radius: 2000,
    types: ['bus_station']
  };*/
  infowindow = new google.maps.InfoWindow();
  service = new google.maps.places.PlacesService(map);
  //service.nearbySearch(request, callback);
  google.maps.event.addListenerOnce(map, 'bounds_changed', performSearch);

}

function performSearch() {
	  var request = {
		bounds: map.getBounds(),
		types: ['bus_station']
	  };
	  service.radarSearch(request, callback);
}


function callback(results, status) {
  if (status == google.maps.places.PlacesServiceStatus.OK) {
    for (var i = 0; i < results.length; i++) {
      createMarker(results[i]);
    }
  }
}

function createMarker(place) {
					
  var placeLoc = place.geometry.location;  
  var marker1 = new google.maps.Marker({
    map: map,
    position: placeLoc,
	title: place.name,
	icon: 'img/busstop.png'
  });
  
  
  
  google.maps.event.addListener(marker1, 'click', function() {
	  service.getDetails(place, function(result, status) {
          if (status != google.maps.places.PlacesServiceStatus.OK) {
            alert(status);
            return;
          }
         /* infowindow.setContent(result.name);
          infowindow.open(map, marker1);*/
          
          map2 = new google.maps.Map(document.getElementById('map-small'), {
	  	    center: place.geometry.location,
	  	    zoom: 20
	  	  });
          marker2 = new google.maps.Marker({
	  	    map: map2,
	  	    position: place.geometry.location,
	  		title: result.name,
	  		icon: 'img/busstop.png'
	  	  });
          document.getElementById("info").style.visibility = "visible";	  
    	  document.getElementById("map-full").style.visibility = "hidden";
    	  document.getElementById("map-small").style.visibility = "visible";
    	  document.getElementById("stop").style.visibility = "visible";
    	  document.getElementById("stopname").innerHTML = result.name;
    	  loadwizard();
        });
	  
  });
}

google.maps.event.addDomListener(window, 'load', initialize);

function loadwizard(){
	$("#wizard").steps({
      	
		headerTag: "h2",
        bodyTag: "div",
        
        transitionEffect: "fade",
        stepsOrientation: "vertical",	
        startIndex: 0,
	  	onFinished: onfinish,
	  	
	  	labels: {
			current: "current step:",
			pagination: "Pagination",
			finish: "Finish",
			next: "Save and Continue",
			previous: "Back",
			loading: "Loading ..."
			}				
  		});
}

function onfinish(event, currentIndex) { 
	/*document.getElementById("map-small").style.visibility = "hidden";
	document.getElementById("info").style.visibility = "hidden";
	document.getElementById("stop").style.visibility = "hidden";
	document.getElementById("map-full").style.visibility = "visible";
	loadwizard();*/	
	asset_id = document.getElementById("busstopid").value;
	document.getElementById("busstopData").value = ParseData(asset_id);
	document.getElementById("myform").submit();
	window.location.href = "MainPage.php";
}