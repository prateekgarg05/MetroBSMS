var map;
var infowindow;
var service;
var losangeles;

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

google.maps.event.addDomListener(window, 'load', initialize);

function initialize() {
	
	var qs = getQueryStrings();	
	var stopid = qs["stopID"];
	var busstopresult = null;
	
	var isnewstop = qs["newstop"];
	if(isnewstop == '1')
		 EnterInformationNewStop();
	else {
	
		$.get('./php/GetBusStopInfo.php?stopID='+ stopid , function(result) {		    
			
			busstop = (JSON.parse(result)).data;		
			busstopresult = busstop[0];
		
			var location = new google.maps.LatLng(busstopresult.latitude,busstopresult.longitude);
		    
			map = new google.maps.Map(document.getElementById('map-small'), {
			    center: location,
			    zoom: 20
			  });
			marker = new google.maps.Marker({
			    map: map,
			    position: location,
				title: busstopresult.onstreet + "/" + busstopresult.crossstreet,
				icon: 'img/busstop.png'
			  });	    
		  
		    loadwizard();
		    document.getElementById("stopname").innerHTML = busstopresult.onstreet + "/" + busstopresult.crossstreet;
		    document.getElementById("busstopid").value = busstopresult.stopID;
		    document.getElementById("latitude").value = busstopresult.latitude;
		    document.getElementById("longitude").value = busstopresult.longitude;
		    document.getElementById("direction").value = busstopresult.direction;
		    document.getElementById("onstreet").value = busstopresult.onstreet;
		    document.getElementById("crossstreet").value = busstopresult.crossstreet;
		    
		    switch(busstopresult.atorbetween)
		    {
		    case 'A': document.getElementById("atorbetween").value = '61';
		    			break;
		    case 'B': document.getElementById("atorbetween").value = '62';
		    			break;
		    case 'O': document.getElementById("atorbetween").value = '63';
		    			break;
		    }	    
		    //document.getElementById("atorbetween").value = busstopresult.atorbetween;
		    document.getElementById("betweenstreet").value = busstopresult.betweenstreet;
		    
		    switch(busstopresult.nearfarmid)
		    {
		    case 'N': document.getElementById("nearfarmid").value = '64';
		    			break;
		    case 'F': document.getElementById("nearfarmid").value = '65';
		    			break;
		    case 'M': document.getElementById("nearfarmid").value = '66';
		    			break;
		    }	 
		    //document.getElementById("nearfarmid").value = busstopresult.nearfarmid;
		    document.getElementById("jurisdiction").value = busstopresult.jurisdiction;
	    
		});
	}
    
}

function loadwizard(){
	$("#wizard").steps({
      	
		headerTag: "h2",
        bodyTag: "div",
        
        transitionEffect: "fade",
        stepsOrientation: "vertical",	
        startIndex: 0,
        onFinishing: onfinishing,
	  	
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

function onfinishing(event, currentIndex)
{
	asset_id = document.getElementById("busstopid").value;
	var qs = getQueryStrings();
	var username = qs["username"];	
	var busdata = ParseData(asset_id,username);
		
	$.get('./php/SaveAssetData.php?busstopData='+ busdata , function(data) {		    
		//result = data;
		//alert (result);
		Redirect();
	    });
}

function Redirect() { 
		
	var qs = getQueryStrings();
	var username = qs["username"];
	window.location.href = "BaseMap.php?username=" + username;
}

function EnterInformationNewStop()
{
	loadwizard();
	var busstopidresult = null;
	
	$.get('./php/GetNewStopID.php' , function(result) {		    
		
		busstopid = (JSON.parse(result)).data;		
		busstopidresult = busstopid[0];
		a = parseInt(busstopidresult.MaxID);
		if (a < 90000001)
			document.getElementById("busstopid").value = '90000001';
		else {
			a = a+1;		
			document.getElementById("busstopid").value = a.toString(); 
		}
	});
}