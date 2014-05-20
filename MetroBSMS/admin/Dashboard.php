<!DOCTYPE>
<html>
<head>
<title>BSMS Admin</title>

<link rel="stylesheet" href="/css/jquery-ui.css">
<link rel="stylesheet" href="/css/styles.css">
<link rel="stylesheet" href="/css/styles-test.css">
<link href="../css/mbExtruder.css" media="all" rel="stylesheet" type="text/css">
<link href="../css/mbExtruder-custom.css" media="all" rel="stylesheet" type="text/css">

<script src="/scripts/jquery.js"></script> 
<script src="/scripts/jquery-ui.js"></script>

<script type="text/javascript" src="../scripts/panel/jquery.hoverIntent.min.js"></script>
<script type="text/javascript" src="../scripts/panel/jquery.mb.flipText.js"></script>
<script type="text/javascript" src="../scripts/panel/mbExtruder.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=geometry&sensor=false"></script>

<script type="text/javascript" src="/scripts/radius.js"></script>
<script type="text/javascript" src="/scripts/admin.js"></script>
<script type="text/javascript" src="/scripts/report.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	$("#extruderRight").buildMbExtruder({
		position:"right",
		width:500,
		positionFixed:false,
		top:0,
		extruderOpacity:.8,
		textOrientation:"tb",
		closeOnExternalClick:false,
		onExtOpen:function(){},
		onExtContentLoad:function(){},
		onExtClose:function(){}
	});
	 $("#extruderRight1").buildMbExtruder({
		position:"right",
		width:500,
		positionFixed:false,
		top:0,
		extruderOpacity:.8,
		textOrientation:"tb",
		closeOnExternalClick:false,
		onExtOpen:function(){},
		onExtContentLoad:function(){},
		onExtClose:function(){}
	});
	$("#extruderRight2").buildMbExtruder({
		position:"right",
		width:500,
		positionFixed:false,
		top:0,
		extruderOpacity:.8,
		textOrientation:"tb",
		closeOnExternalClick:false,
		onExtOpen:function(){},
		onExtContentLoad:function(){},
		onExtClose:function(){}
	});
	$.fn.changeLabel=function(text){
		$(this).find(".flapLabel").html(text);
		$(this).find(".flapLabel").mbFlipText();
	};
});
</script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body onLoad="ClearFields()">
<div id="tabs">
	<div style="float:left; width:50%; height:70px;"><img src="../img/site/logo.png"></div>
	<div style="float:right; width:50%; font-weight:bold; text-align:right; padding:15px 15px 0;">Admin Dashboard</div>
    <div style="clear:both;"></div>
  <ul>
	<li><a href="#tabs-1">Add a User</a></li>
	<li><a href="#tabs-2">Add a Crew</a></li>
	<li><a href="#tabs-3">Assign User to Crew</a></li>
	<li><a href="#tabs-4">Assign Stop to User</a></li>
	<li><a href="#tabs-5">Assign Line to Crew</a></li>
	<li><a href="#tabs-6">Radius Report</a></li>
	<li><a href="#tabs-7">Radius Report for Unique Stops</a></li>
  </ul>
  <div id="tabs-1" class="gradient">	
  <div class="tabs-inner">	
	<p>		
		<label for="firstname">First Name </label> 
		<input type="text" id="firstname" name="firstname">	
	</p>
	<p>
		<label for="lastname">Last Name</label>
		<input id="lastname" name="lastname" type="text">
	</p>
	<p>
		<label for="username">Username</label><label class="required">*</label>
		<input id="username" name="username" type="text">
		<button class="btn-primary" onClick="checkUserAvailability()" >Check Availability</button>
		<label id="userAvailable" class="message"></label>
	</p>
	<p>
		<label for="password">Password</label><label class="required">*</label>
		<input id="password" name="password" type="password">
	</p>
	<p class="required">
		* = Required Fields
	</p>
	<button class="btn-primary" onClick="addUser()" >Submit</button>
	<label id="userConfirmation" class="message"></label>
    </div>
  </div>
  
  <div id="tabs-2" class="gradient">
  <div class="tabs-inner">		
	<p>
		<label for="crewname">Crew Name</label><label class="required">*</label>
		<input id="crewname" name="crewname" type="text">
		<button class="btn-primary" onClick="checkCrewAvailability()" >Check Availability</button>
		<label id="crewAvailable" class="message"></label>
	</p>
	<p class="required">
		* = Required Fields
	</p>
	<button class="btn-primary" onClick="addCrew()" >Submit</button>
	<label id="crewConfirmation" class="message"></label>
    </div>
  </div>
  
  <div id="tabs-3" class="gradient">
  <div class="tabs-inner">
  	<p>
  		<label for="selectuser">Select User</label><label class="required">*</label>
		<select id="selectuser">
			<option value="0">[Select]</option>
		</select>
  	</p>
  	<p>
  		<label for="selectcrew">Select Crew</label><label class="required">*</label>
		<select id="selectcrew">
			<option value="0">[Select]</option>
		</select>
  	</p>
  	<p class="required">
		* = Required Fields
	</p>
  	<button class="btn-primary" onClick="assignCrew()" >Submit</button>
	<label id="assignCrewConfirmation" class="message"></label>
    </div>
  </div>
  
  <div id="tabs-4" class="gradient">
  <div class="tabs-inner">
  	<div style="width:30%;">
	  	<p>
	  		<label for="selectcrew1">Select Crew</label><label class="required">*</label>
			<select id="selectcrew1">
				<option value="0">[Select]</option>
			</select>
	  	</p>
	  	<p>
	  		<label for="selectuserfromcrew">Select User</label><label class="required">*</label>
			<select id="selectuserfromcrew">
				<option value="0">[Select]</option>
			</select>
	  	</p>  	
	  	<p>		
			<label for="selectstop">Select Stop from Map </label><label class="required">*</label>
			<input type="text" id="selectstop" name="selectstop">	
		</p>
	  	<p class="required">
			* = Required Fields
		</p>
	  	<button class="btn-primary" onClick="assignStop(4)" >Submit</button>
		<label id="assignStopConfirmation" class="message"></label>
    </div>
    <br /><br />  
  </div>
  
  
    <div class="extruder-container" style="position:relative;">
<div id="extruderRight2" class="a {title:'Radius Search'}">

	<div class="sidebar text">

	  <div class="logo"><img src="../img/site/logo.png" /></div>
		<div class="filter">
			<label for="centerpoint">Select a Point on Map</label>
			<input id="centerpoint" name="centerpoint" type="text" class="prepopulate" rel="Select a Point on Map" >				
	    </div>
	    <div class="filter">
			<label for="radius">Enter Radius (In Meters)</label>
			<input id="radius" name="radius" type="text" class="prepopulate" rel="Enter Radius" >
			<button type="button" title="Filter" value="Filter" class="btn-primary" onClick="FilterStops()">Find</button>
	    </div>	    

	
	<div class="count">
	  	<label id="Count"></label>
	</div>
	<div id="loading">
		<img src="../img/site/loading.gif"></img>
	</div>       		  
  </div>
    
    </div>
<div id="map-canvas" style="width: 100%; height: 100%; position: relative;"></div>
</div>
  
  
  
  </div>
  
  <div id="tabs-5" class="gradient">
  <div class="tabs-inner">
  	<p>
  		<label for="selectcrew0">Select Crew</label><label class="required">*</label>
		<select id="selectcrew0">
			<option value="0">[Select]</option>
		</select>
  	</p>
  	<p>
  		<label for="selectline">Select Line</label><label class="required">*</label>
		<select id="selectline">
			<option value="0">[Select]</option>
		</select>
  	</p>
  	<p class="required">
		* = Required Fields
	</p>
  	<button class="btn-primary" onClick="assignLine()" >Submit</button>
	<label id="assignLineConfirmation" class="message"></label>
  </div>
  </div>
  
  <div id="tabs-6" class="gradient">
  <div class="tabs-inner">
  	<p>
  		<label for="selectcrew6">Select Crew</label><label class="required">*</label>
		<select id="selectcrew6">
			<option value="0">[Select]</option>
		</select>
  	</p>
  	<p>
  		<label for="selectuserfromcrew6">Select User</label><label class="required">*</label>
		<select id="selectuserfromcrew6">
			<option value="0">[Select]</option>
		</select>
  	</p>  	
  	<p>		
		<label for="selectstop6">Select Stop from Map </label><label class="required">*</label>
		<input type="text" id="selectstop6" name="selectstop6">	
	</p>
  	<p class="required">
		* = Required Fields
	</p>
  	<button class="btn-primary" onClick="assignStop(6)" >Submit</button>
	<label id="assignStopConfirmation6" class="message"></label>
	<br /><br />
  </div>  
    <div class="extruder-container" style="position:relative;">
<div id="extruderRight1" class="a {title:'Radius Search'}">

	<div class="sidebar text">
	  <div class="logo"><img src="../img/site/logo.png" /></div>		
	    <div class="filter">
			<label for="radius1">Enter Radius (In Meters)</label>
			<input id="radius1" name="radius1" type="text" class="prepopulate" rel="Enter Radius" >
			<button type="button" title="Filter" value="Filter" class="btn-primary" onClick="GenerateReport()">Generate</button>
	    </div>	    
	  <div class="count">
	  	<label id="Count1"></label>
	  </div>
	  <div id="loading1">
		<img src="../img/site/loading.gif"></img>
	  </div>	  		  
	</div>	
    
    </div>
<div id="map-canvas1" style="width: 100%; height: 100%; position: relative;"></div>
</div>    

  </div>
  
  <div id="tabs-7" class="gradient">
  <div class="tabs-inner">
  	<p>
  		<label for="selectcrew7">Select Crew</label><label class="required">*</label>
		<select id="selectcrew7">
			<option value="0">[Select]</option>
		</select>
  	</p>
  	<p>
  		<label for="selectuserfromcrew7">Select User</label><label class="required">*</label>
		<select id="selectuserfromcrew7">
			<option value="0">[Select]</option>
		</select>
  	</p>  	
  	<p>		
		<label for="selectstop7">Select Stop from Map </label><label class="required">*</label>
		<input type="text" id="selectstop7" name="selectstop7" >	
	</p>
  	<p class="required">
		* = Required Fields
	</p>
  	<button class="btn-primary" onClick="assignStop(7)" >Submit</button>
	<label id="assignStopConfirmation7" class="message"></label>
	<br /><br />
</div>

<div class="extruder-container" style="position:relative;">
<div id="extruderRight" class="a {title:'Radius Search'}">

	<div class="sidebar text">

	  <div class="logo"><img src="../img/site/logo.png" /></div>		
	    <div class="filter">
			<label for="radius2">Enter Radius (In Meters)</label>
			<input id="radius2" name="radius2" type="text" class="prepopulate" rel="Enter Radius" >
			<button type="button" title="Filter" value="Filter" class="btn-primary" onClick="GenerateUniqueReport()">Generate</button>
	    </div>	    
	  
	  <div class="count">
	  	<label id="Count2"></label>
	  </div>
	  <div id="loading2">
		<img src="../img/site/loading.gif"></img>
	  </div>	  		  
	</div>
    
    </div>
<div id="map-canvas2" style="width: 100%; height: 100%; position: relative;"></div>
</div>

  </div>
  
</div>
<input type="hidden" name="RadiusSearchData" id="RadiusSearchData">
</body>
</html>