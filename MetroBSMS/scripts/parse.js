var busstopData = {};
busstopData.data = [];

var busstopidnum;

function ParseData(asset_id,username)
{
	busstopidnum = asset_id;
	for(var i=0;i<11;i++)
	{
		var section = document.getElementById("wizard-p-" + i);
		getTextNodes(section,i+1,username);		
		getSelectNodes(section,i+1,username);
		getRadioButtons(section,i+1,username);
		getCheckBoxes(section,i+1,username);
		getTextArea(section,i+1,username);
		getImages(section,i+1,username);
	}
	//alert (JSON.stringify(busstopData));
	return JSON.stringify(busstopData);
	
}

function getTextNodes(section,sectionId,username)
{
	var textnodes = section.querySelectorAll("input[type=text]");
		
	for (var i=0; i<textnodes.length; i++)
		{
			if (textnodes[i].id != "busstopid" && textnodes[i].value != "")
			{				
				var newobj = {
					"assettype_id":"1",
					"informationtype_id": sectionId.toString(),
					"fieldtype_id": textnodes[i].getAttribute("fieldtype_id"),
					"asset_id": busstopidnum,
					"value": ((textnodes[i].getAttribute("kind") != null)?(textnodes[i].getAttribute("kind") + ":" + textnodes[i].value):textnodes[i].value),
					"domainvalue_id": "",
					"enteredby_username":username
				};
				busstopData.data.push(newobj);	
				//alert( JSON.stringify(newobj));
			}		
		}	
}

function getSelectNodes(section,sectionId,username)
{
	var selectnodes = section.querySelectorAll("select");
	
	for (var i=0; i<selectnodes.length; i++)
	{
		if (selectnodes[i].options[selectnodes[i].selectedIndex].value != "0" && selectnodes[i].getAttribute("fieldtype_id") != "97")
		{				
			var newobj = {
				"assettype_id":"1",
				"informationtype_id": sectionId.toString(),
				"fieldtype_id": selectnodes[i].getAttribute("fieldtype_id"),
				"asset_id": busstopidnum,
				"value": "",
				"domainvalue_id": selectnodes[i].options[selectnodes[i].selectedIndex].value,
				"enteredby_username":username				
			};
			busstopData.data.push(newobj);				
			//alert( JSON.stringify(newobj));
		}		
	}	
}

function getRadioButtons(section,sectionId,username)
{
	var radionodes = section.querySelectorAll("input[type=radio]");
	
	for (var i=0; i<radionodes.length; i++)
	{
		if (radionodes[i].checked == true)
		{				
			var newobj = {
				"assettype_id":"1",
				"informationtype_id": sectionId.toString(),
				"fieldtype_id": radionodes[i].getAttribute("fieldtype_id"),
				"asset_id": busstopidnum,
				"value": "",
				"domainvalue_id": radionodes[i].value,
				"enteredby_username":username				
			};
			busstopData.data.push(newobj);				
			//alert( JSON.stringify(newobj));
		}		
	}	
}

function getCheckBoxes(section,sectionId,username)
{
	var checkboxes = section.querySelectorAll("input[type=checkbox]");
	
	for (var i=0; i<checkboxes.length; i++)
	{
		if (checkboxes[i].checked == true)
		{				
			var newobj = {
				"assettype_id":"1",
				"informationtype_id": sectionId.toString(),
				"fieldtype_id": checkboxes[i].getAttribute("fieldtype_id"),
				"asset_id": busstopidnum,
				"value": "",
				"domainvalue_id": checkboxes[i].value,
				"enteredby_username":username				
			};
			busstopData.data.push(newobj);				
			//alert( JSON.stringify(newobj));
		}		
	}	
}

function getTextArea(section,sectionId,username)
{
	var textareas = section.querySelectorAll("textarea");
	
	for (var i=0; i<textareas.length; i++)
	{
		if (textareas[i].value != "")
		{				
			var newobj = {
				"assettype_id":"1",
				"informationtype_id": sectionId.toString(),
				"fieldtype_id": textareas[i].getAttribute("fieldtype_id"),
				"asset_id": busstopidnum,
				"value": textareas[i].value,
				"domainvalue_id": "",
				"enteredby_username":username				
			};
			busstopData.data.push(newobj);				
			//alert( JSON.stringify(newobj));
		}		
	}	
}

/*function getImages(section,sectionId,username)
{
	var images = section.querySelectorAll("input[type=file]");
	
	for (var i=0; i<images.length; i++)
	{					
		for(var j=0;j<images[i].files.length;j++)
		{
			var fileItem = images[i].files[j];
			var newobj = {
				"assettype_id":"1",
				"informationtype_id": sectionId.toString(),
				"fieldtype_id": images[i].getAttribute("fieldtype_id"),
				"asset_id": busstopidnum,
				"value": fileItem.name,
				"domainvalue_id": "",
				"enteredby_username":username				
			};
			busstopData.data.push(newobj);				
			//alert( JSON.stringify(newobj));
		}		
	}	
}*/

function getImages(section,sectionId,username)
{
	var images = section.querySelectorAll("img.myimage");
	
	for (var i=0; i<images.length; i++)
	{		
		//var fileItem = images[i].files[j];
		var newobj = {
			"assettype_id":"1",
			"informationtype_id": sectionId.toString(),
			"fieldtype_id": images[i].getAttribute("fieldtype_id"),
			"asset_id": busstopidnum,
			"value": images[i].getAttribute("imgname"),
			"domainvalue_id": "",
			"enteredby_username":username				
		};
		busstopData.data.push(newobj);				
		//alert( JSON.stringify(newobj));
				
	}	
}