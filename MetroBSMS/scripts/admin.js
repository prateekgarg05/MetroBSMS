function addOption(selectbox, text, value) {
    var optn = document.createElement("OPTION");
    optn.text = text;
    optn.value = value;
    selectbox.options.add(optn);  
}

function populateUser()
{
	var selectUser = document.getElementById("selectuser");	
	
	$.get('../php/GetUser.php' , function(data) {
		userData = JSON.parse(data);
		for(var i=0;i<userData.data.length;i++)	{
			var item = (userData.data)[i];
			addOption(selectUser,item.username,item.username);
		}					
	});
}

function populateCrew()
{
	var selectCrew = document.getElementById("selectcrew");
	var selectCrew0 = document.getElementById("selectcrew0");
	var selectCrew1 = document.getElementById("selectcrew1");
	var selectCrew6 = document.getElementById("selectcrew6");
	var selectCrew7 = document.getElementById("selectcrew7");
	
	$.get('../php/GetCrew.php' , function(data) {
		crewData = JSON.parse(data);
		for(var i=0;i<crewData.data.length;i++)	{
			var item = (crewData.data)[i];
			addOption(selectCrew,item.name,item.name);
			addOption(selectCrew0,item.name,item.name);
			addOption(selectCrew1,item.name,item.name);
			addOption(selectCrew6,item.name,item.name);
			addOption(selectCrew7,item.name,item.name);
		}					
	});
}

function populateLine()
{
	var selectLine = document.getElementById("selectline");	
	
	$.get('../php/GetLine.php' , function(data) {
		lineData = JSON.parse(data);
		for(var i=0;i<lineData.data.length;i++)	{
			var item = (lineData.data)[i];
			addOption(selectLine,item.lineNumber,item.lineNumber);
		}					
	});
}

function populateUserfromCrew(selectcrew,selectusercrew)
{
	var selectUserfromCrew = document.getElementById(selectusercrew);	
	var selectedcrew = document.getElementById(selectcrew);
	var selectedcrewvalue = selectedcrew.options[selectedcrew.selectedIndex].value;
	
	$.get('../php/GetUser.php?crewName='+selectedcrewvalue , function(data) {
		userData = JSON.parse(data);
		$("#"+selectusercrew).empty();
		for(var i=0;i<userData.data.length;i++)	{
			var item = (userData.data)[i];
			addOption(selectUserfromCrew,item.username,item.username);
		}					
	});
}

$(function() {
	ui_tabs = $( "#tabs" ).tabs(
		{ 
			active: document.cookie!=''?parseInt(document.cookie.substring(10)):0,			
			activate: function( event, ui ) {
					resizeMap(map);
					resizeMap(map1);
					resizeMap(map2);
					if (ui.newTab.index() == 5)	{
						searchType = 1;						
						document.cookie="activeTab=5";						
						location.reload();						
						}
					if (ui.newTab.index() == 6)	{
						searchType = 2;						
						document.cookie="activeTab=6";
						location.reload();						
						}
			}
		});
		
	populateUser();
	populateCrew();
	populateLine();
	
	$(document).on("change","#selectcrew1", function () {
	   
		populateUserfromCrew("selectcrew1","selectuserfromcrew");
	});
	
	$(document).on("change","#selectcrew6", function () {

		populateUserfromCrew("selectcrew6","selectuserfromcrew6");
	});
	
	$(document).on("change","#selectcrew7", function () {

		populateUserfromCrew("selectcrew7","selectuserfromcrew7");
	});
});

function resizeMap(m)
{
	x = m.getZoom();
    c = m.getCenter();
    google.maps.event.trigger(m, 'resize');
    m.setZoom(x);
    m.setCenter(c);
}

function checkUserAvailability()
{
	var userName = document.getElementById("username").value;
	var message = document.getElementById("userAvailable");

	if (userName != '')	{
		
		$.get('../php/CheckUserAvailability.php?userName='+ userName , function(data) {
				if (data == '1')
					message.innerHTML = "Available";
				else if (data == '0')
					message.innerHTML = "Not Available";							
		});
	}
	else message.innerHTML = "Please fill the required fields";
}

function addUser()
{
	var userName = document.getElementById("username").value;
	var passWord = document.getElementById("password").value;
	var firstName = document.getElementById("firstname").value;
	var lastName = document.getElementById("lastname").value;
	var message = document.getElementById("userConfirmation");
	
	if (userName != '' && passWord != '')	{		
		
		$.get('../php/CheckUserAvailability.php?userName='+ userName , function(data) {
			if (data == '1')	{
				$.get('../php/AddUser.php?userName='+ userName + '&password=' + passWord + '&firstName=' + firstName + '&lastName=' + lastName , function(data) {
					if (data == '1')	{
							message.innerHTML = "User added Successfully";
							
						}
					else if (data == '0')
						message.innerHTML = "Error!!";							
				});
			}
			else if (data == '0')
				message.innerHTML = "Username already exists";							
		});		
		
	}
	else message.innerHTML = "Please fill the required fields";
}

function checkCrewAvailability()
{
	var crewname = document.getElementById("crewname").value;
	var message = document.getElementById("crewAvailable");

	if (crewname != '')	{		
	
		$.get('../php/CheckCrewAvailability.php?crewName='+ crewname , function(data) {
				if (data == '1')
					message.innerHTML = "Available";
				else if (data == '0')
					message.innerHTML = "Not Available";							
		});
	}
	else message.innerHTML = "Please fill the required fields";
}

function addCrew()
{	
	var crewname = document.getElementById("crewname").value;
	var message = document.getElementById("crewConfirmation");
	
	if (crewname != '')	{
		
		$.get('../php/CheckCrewAvailability.php?crewName='+ crewname , function(data) {
			if (data == '1')	{
				$.get('../php/AddCrew.php?crewName='+ crewname , function(data) {
					if (data == '1')
						message.innerHTML = "Crew added Successfully";
					else if (data == '0')
						message.innerHTML = "Error!!";							
				});
			}
			else if (data == '0')
				message.innerHTML = "Crew name already exists";							
		});		
	}
	else message.innerHTML = "Please fill the required fields";
}

function assignCrew()
{
	var selecteduser = document.getElementById("selectuser");
	var selectedcrew = document.getElementById("selectcrew");
	var selecteduservalue = selecteduser.options[selecteduser.selectedIndex].value;
	var selectedcrewvalue = selectedcrew.options[selectedcrew.selectedIndex].value;
	var message = document.getElementById("assignCrewConfirmation");
	
	if (selecteduservalue != '0' && selectedcrewvalue != '0')	{
		
		$.get('../php/AssignCrew.php?userName='+ selecteduservalue + '&crewName=' + selectedcrewvalue , function(data) {
			if (data == '1')
				message.innerHTML = "Crew assigned Successfully";
			else if (data == '0')
				message.innerHTML = "Error!!";							
		});
	}
	else message.innerHTML = "Please choose the required fields";
	
}

function assignStop(tabNumber)
{
	var selectcrew="",selectusercrew="",selectstop="",stopconfirm="";
	if (tabNumber == 4)
	{
		selectcrew = "selectcrew1";
		selectusercrew = "selectuserfromcrew";
		selectstop = "selectstop";
		stopconfirm = "assignStopConfirmation";
	}
	else if (tabNumber == 6)
	{
		selectcrew = "selectcrew6";
		selectusercrew = "selectuserfromcrew6";
		selectstop = "selectstop6";
		stopconfirm = "assignStopConfirmation6";
	}
	else if (tabNumber == 7)
	{
		selectcrew = "selectcrew7";
		selectusercrew = "selectuserfromcrew7";
		selectstop = "selectstop7";
		stopconfirm = "assignStopConfirmation7";
	}
	
	var selectedcrew = document.getElementById(selectcrew);
	var selectedcrewvalue = selectedcrew.options[selectedcrew.selectedIndex].value;
	var selecteduser = document.getElementById(selectusercrew);	
	var selecteduservalue = selecteduser.options[selecteduser.selectedIndex].value;
	var selectedStop = document.getElementById(selectstop).value;
	var message = document.getElementById(stopconfirm);
	
	if (selectedcrewvalue != '0' && selecteduservalue != '0' && selectedStop != '')	{
		
		$.get('../php/AssignStop.php?userName=' + selecteduservalue + '&stopID=' + selectedStop , function(data) {
			if (data == '1')
				message.innerHTML = "Stop assigned Successfully";
			else if (data == '0')
				message.innerHTML = "Error!!";							
		});
	}
	else message.innerHTML = "Please choose the required fields";
}

function assignLine()
{	
	var selectedcrew = document.getElementById("selectcrew0");
	var selectedline = document.getElementById("selectline");	
	var selectedcrewvalue = selectedcrew.options[selectedcrew.selectedIndex].value;
	var selectedlinevalue = selectedline.options[selectedline.selectedIndex].value;
	var message = document.getElementById("assignLineConfirmation");
	
	if (selectedcrewvalue != '0' && selectedlinevalue != '0')	{
		
		$.get('../php/AssignLine.php?crewName='+ selectedcrewvalue + '&lineNumber=' + selectedlinevalue , function(data) {
			if (data == '1')
				message.innerHTML = "Line assigned Successfully";
			else if (data == '0')
				message.innerHTML = "Error!!";							
		});
	}
	else message.innerHTML = "Please choose the required fields";
}