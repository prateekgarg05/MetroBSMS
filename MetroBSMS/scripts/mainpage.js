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
			if (busstop.length == 1)
			{
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
			    document.getElementById("jurisdiction").value = busstopresult.jurisdiction;
			}
			else
			{
				loadwizard();
				
				var latitude="",longitude="",onstreet="",crossstreet="";
								
				for(var i=0;i<11;i++)
				{
					var currentSection = document.getElementById("wizard-p-" + i);
									
					for(var j=0;j<busstop.length;j++)
					{
						busstopresultitem = busstop[j];
						
						if (busstopresultitem.infotypeid == i+1)
						{
							htmlelement = $(currentSection).find("[name='"+busstopresultitem.fieldtype+"']");
							
							if(htmlelement.length>1)
							{
								for(var k=0;k<htmlelement.length;k++)
								{
									attrval = $(htmlelement[k]).attr("value");
									if (attrval == busstopresultitem.domainvalueid)
										$(htmlelement[k]).prop('checked', true);
								}
							}
							else if(busstopresultitem.fieldtype == "Obstacle type")
								{
									if(busstopresultitem.value != null)
									{
										var obvar = "";
										if (i==3)
											obvar = "#obstaclesm1";
										else if(i==4)
											obvar = "#obstaclesm2";
										
										obsval = busstopresultitem.value.split(":");										
										
										appendhtml = "<div><label>"+ obsval[0] + "</label> Measurements:<input type='text' name='obstacles' value='"
														+ obsval[1] +"' fieldtype_id='97' kind='" + obsval[0] 
														+ "'><button type='button' class='delb'>delete</button><br /><br /></div>";
										$(obvar).append(appendhtml);
									}								
								}
							else if(busstopresultitem.fieldtype == "Image")
								{
									//$(htmlelement).attr("filename",busstopresultitem.value);
								}
							else if(htmlelement)
								htmlelement.val(busstopresultitem.domainvalueid == null ? busstopresultitem.value : busstopresultitem.domainvalueid);
							
							switch(busstopresultitem.fieldtype)
							{
							case "Latitude": latitude = busstopresultitem.value;
											break;
							case "Longitude": longitude = busstopresultitem.value;
											break;
							case "On Street": onstreet = busstopresultitem.value;
											break;
							case "Cross Street": crossstreet = busstopresultitem.value;
											break;
							}
							
						}
					}
				}
				
				var location = new google.maps.LatLng(latitude,longitude);
			    
				map = new google.maps.Map(document.getElementById('map-small'), {
				    center: location,
				    zoom: 20
				  });
				marker = new google.maps.Marker({
				    map: map,
				    position: location,
					title: onstreet + "/" + crossstreet,
					icon: 'img/busstop.png'
				  });	    
			  			    
			    document.getElementById("stopname").innerHTML = onstreet + "/" + crossstreet;
			    document.getElementById("busstopid").value = stopid;
			}
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
        onStepChanging: onstepChanging,
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

function onstepChanging(event, currentIndex, newIndex)
{	
	var errormsg = "";
    var flag = 0;
    var flag2 = 0;
    
    var currentSection = document.getElementById("wizard-p-" + currentIndex);
	var currentImages = currentSection.querySelectorAll("input[type=file]");    
    
	if (currentImages.length > 0 )
	{
	    if(currentIndex>1)
	    {    	
	    	for(var k=0;k<currentImages[0].files.length;k++)
	    	{
	    		flag = 0;
	    		var currentFile = currentImages[0].files[k];
		    	for(var i=1;i<currentIndex;i++)
		    	{
		    		var section = document.getElementById("wizard-p-" + i);
		    		var images = section.querySelectorAll("input[type=file]");
		    		
		    		for(var j=0;j<images[0].files.length;j++)
		    		{
		    			var fileItem = images[0].files[j];
		    			if (currentFile.name == fileItem.name)
		    				{
		    					errormsg += currentFile.name + " was already used in the previous tab<br />";
		    					flag = 1;
		    				}
		    			if (flag == 1)
		    				break;
		    		}
		    		if (flag == 1)
	    				break;	    		
		    	}
	    	}   	
	    	msg1 = $(currentSection).find("#fileError");
	    	if (flag == 1)
	    	{	
	    		errormsg += "Please choose the Images again";	    		
				msg1.show();
				msg1.html(errormsg);	    		
	    		return false;
	    	}
	    	else
	    		msg1.html("");
	    }   
	    
	    if(currentIndex>0)
	    {
		    asset_id = document.getElementById("busstopid").value;
			var qs = getQueryStrings();
			var username = qs["username"];	
			var imgData;	       
			var imageData = [];		
			
			for(var k=0;k<currentImages[0].files.length;k++)
	    	{
	    		var item = currentImages[0].files[k];
	    		var newobj = {"name":"_"+item.name};
	    		imageData.push(newobj);
	    	}
	
			imgData = JSON.stringify(imageData);	
			
			$.ajax({ url: './php/CheckImages.php',
			    data: {
			    	imageData:imgData,
			    	username:username
			    },
			    type: 'post',
			    async : false,
			    success: function(output) {
			    	if (output != "")
			    	{	
			    		flag2 = 1;
			    		errormsg = output;						
			    	}
			    }
			});
			msg = $(currentSection).find("#fileError");
			if(flag2 == 1)
			{				
				msg.show();
				msg.html(errormsg);
				return false;
			}
			else
				msg.html("");
	    }
	}
	
	
    $("#myform").validate().settings.ignore = ":disabled,:hidden";
    return $("#myform").valid();
    
}

function onfinishing(event, currentIndex)
{
	asset_id = document.getElementById("busstopid").value;
	var qs = getQueryStrings();
	var username = qs["username"];	
	var busdata = ParseData(asset_id,username);
			
	$.ajax({ url: './php/SaveAssetData.php',
	    data: {
	    	busstopData:busdata        	
	    },
	    type: 'post',
	    success: function(output) {
	    	Redirect();
	             }
	});
}

function Redirect() { 
		
	var qs = getQueryStrings();
	var username = qs["username"];
	window.location.href = "BaseMap.php?username=" + username + "&mystop=1";
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
function obstBut1()
{
	var val=$("#obstacles1").val();
	switch (val) {
	    case "112":
	        $("#obstaclesm1").append("<div><label for='pobox'>PO Box</label> Measurements:<input type='text' name='obstacles' fieldtype_id='97' kind='PO Box'><button type='button' class='delb'>delete</button><br /><br /></div>");
	        break;
	    case "113":
	        $("#obstaclesm1").append("<div><label for='newspaper'>Newspaper</label> Measurements:<input type='text' name='obstacles' fieldtype_id='97' kind='Newspaper'><button type='button' class='delb'>delete</button><br /><br /></div>");
	        break;
	    case "114":
	        $("#obstaclesm1").append("<div><label for='lightpole'>Light Pole</label> Measurements:<input type='text' name='obstacles' fieldtype_id='97' kind='Light Pole'><button type='button' class='delb'>delete</button><br /><br /></div>");
	        break;
	    case "115":
	        $("#obstaclesm1").append("<div><label for='trash'>Trash</label> Measurements:<input type='text' name='obstacles' fieldtype_id='97' kind='Trash'><button type='button' class='delb'>delete</button><br /><br /></div>");
	        break;
	    case "116":
	        $("#obstaclesm1").append("<div><label for='utility'>Utility Box</label> Measurements:<input type='text' name='obstacles' fieldtype_id='97' kind='Utility Box'><button type='button' class='delb'>delete</button><br /><br /></div>");
	        break;
	    default:
	        break;
	}
}
function obstBut2()
{
	var val=$("#obstacles2").val();
	switch (val) {
	    case "112":
	        $("#obstaclesm2").append("<div><label for='pobox'>PO Box</label> Measurements:<input type='text' name='obstacles' fieldtype_id='97' kind='PO Box'><button type='button' class='delb'>delete</button><br /><br /></div>");
	        break;
	    case "113":
	        $("#obstaclesm2").append("<div><label for='newspaper'>Newspaper</label> Measurements:<input type='text' name='obstacles' fieldtype_id='97' kind='Newspaper'><button type='button' class='delb'>delete</button><br /><br /></div>");
	        break;
	    case "114":
	        $("#obstaclesm2").append("<div><label for='lightpole'>Light Pole</label> Measurements:<input type='text' name='obstacles' fieldtype_id='97' kind='Light Pole'><button type='button' class='delb'>delete</button><br /><br /></div>");
	        break;
	    case "115":
	        $("#obstaclesm2").append("<div><label for='trash'>Trash</label> Measurements:<input type='text' name='obstacles' fieldtype_id='97' kind='Trash'><button type='button' class='delb'>delete</button><br /><br /></div>");
	        break;
	    case "116":
	        $("#obstaclesm2").append("<div><label for='utility'>Utility Box</label> Measurements:<input type='text' name='obstacles' fieldtype_id='97' kind='Utility Box'><button type='button' class='delb'>delete</button><br /><br /></div>");
	        break;
	    default:
	        break;
	}
}

$(function () {
    $(document).on('click', '.delb', function () {
        $(this).parent().remove();
    });
});
