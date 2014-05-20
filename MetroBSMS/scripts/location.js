function GetLocation()
{
	var socket = io.connect('http://crg:5000');
	
	 socket.on('readFile', function(data) {
		  
		  var lines = "";		 
	      lines = data.split("\n");
	      
	      mylocation = lines[lines.length - 2];
	      values = mylocation.split(",");
	      
	      lat = values[2];
	      latdir = values[3];
	      long = values[4];
	      longdir = values[5];
	      
	      latitude = parseFloat(lat)/100;
	      longitude = parseFloat(long)/100;
	      if (latdir == 'S')
	    	  latitude *= -1;
	      
	      if (longdir == 'W')
	    	  longitude *= -1;
	      
	      myPoint = new google.maps.LatLng(latitude, longitude); 
	      
	      map.setZoom(15);      
	      map.setCenter(myPoint);
	      
	        marker = new google.maps.Marker({
		    map: map,
		    position: myPoint,
			title: 'My Location'		
		  });
	  });
	  
	  
}