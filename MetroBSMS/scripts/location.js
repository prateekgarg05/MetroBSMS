function GetLocation()
{
	var socket = io.connect('http://crg:5000');
	
	 socket.on('readFile', function(data) {
		  
		  var lines = "";		 
	      lines = data.split("\n");
	      
	      mylocation = lines[lines.length - 2];
	      values = mylocation.split(",");
	      
	      if (values[0] = "$GPGGA")
	      {
		      lat = values[2];
		      latdir = values[3];
		      long = values[4];
		      longdir = values[5];
		      
		      latitude = new Object();
		      latvalue = lat.split(".");
		      latitude.seconds = parseFloat("0." + latvalue[1]) * 60;
		      latitude.degree = Math.floor(parseInt(latvalue[0])/100);
		      latitude.minutes = parseFloat(latvalue[0])%100;
		      latitude.direction = latdir;
		      
		      longitude = new Object();
		      longvalue = long.split(".");
		      longitude.seconds = parseFloat("0." + longvalue[1]) * 60;
		      longitude.degree = Math.floor(parseInt(longvalue[0])/100);
		      longitude.minutes = parseFloat(longvalue[0])%100;
		      longitude.direction = longdir;    
		      
		      latVal = ConvertToDecimal(latitude);
		      longVal = ConvertToDecimal(longitude);
		      
		      latfield = document.getElementById("latitude");
			  longfield = document.getElementById("longitude");
			  
			  if(latfield)
				  latfield.value = latVal;
			  if(longfield)
				  longfield.value = longVal;
			  
		      myPoint = new google.maps.LatLng(latVal, longVal); 
		      
		      map.setZoom(16);      
		      map.setCenter(myPoint);
		      
		        marker = new google.maps.Marker({
			    map: map,
			    position: myPoint,
				title: 'My Location'		
			  });
	    }
	  });
	 
	  
}

function ConvertToDecimal(item)
{
	var dd = item.degree + item.minutes/60 + item.seconds/(60*60);
	
	if (item.direction == "S" || item.direction == "W") {
        dd = dd * -1;
    } // Don't do anything for N or E
    return dd;
	
}