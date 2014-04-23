<!DOCTYPE html>
<html>
<head>
<title>Bus Stop Information</title>

<meta charset="utf-8">
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">

<link rel="stylesheet" href="css/normalize.css">
<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" href="css/jquery.steps.css">
<link rel="stylesheet" href="css/jquery-ui.css">
<link rel="stylesheet" href="css/styles.css">

<script src="scripts/modernizr-2.6.2.min.js"></script>                
<script src="scripts/jquery.js"></script> 
<script src="scripts/jquery.steps.js"></script>
<script src="scripts/jquery.steps.min.js"></script>
<script src="scripts/jquery.cookie-1.3.1.js"></script>
<script src="scripts/jquery-ui.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
</head>

<body>

<div id="stop" class="stoptitle">
	<label id="stopname"></label>
</div>
<div id="map-small" class="smallmap"></div>
<div id="info">
<form id="myform">
	<div id="wizard" >
		<h2>General</h2>
		<div id="section9">
			<p>
				<label for="busstopid">Bus Stop ID</label>
				<input id="busstopid" name="busstopid" type="text">
			</p>
			<p>
				<label for="latitude">Latitude</label>
				<input id="latitude" name="latitude" type="text" fieldtype_id = "61">
			</p>
			<p>
				<label for="longitude">Longitude</label>
				<input id="longitude" name="longitude" type="text" fieldtype_id = "62">
			</p>
			<p>
				<label for="altitude">Altitude</label>
				<input id="altitude" name="altitude" type="text" fieldtype_id = "63">
			</p>
			<p>
				<label for="direction">Street Direction</label>
				<input id="direction" name="direction" type="text" fieldtype_id = "64">
			</p>	
			<p>
				<label for="onstreet">On Street</label>
				<input id="onstreet" name="onstreet" type="text" fieldtype_id = "65">
			</p>	
			<p>
				<label for="crossstreet">Cross Street</label>
				<input id="crossstreet" name="crossstreet" type="text" fieldtype_id = "66">
			</p>	
			<p>
				<label for="atorbetween">At, Between or Opposite</label>
				<select id="atorbetween" fieldtype_id = "67">
					<option value="0">[Select]</option>
					<option value="61">At</option>
					<option value="62">Between</option>
					<option value="63">Opposite</option>				
				</select>
			</p>		
			<p>
				<label for="betweenstreet">Between Street</label>
				<input id="betweenstreet" name="betweenstreet" type="text" fieldtype_id = "68">
			</p>	
			<p>
				<label for="nearfarmid">Near, Far or Mid-block</label>
				<select id="nearfarmid" fieldtype_id = "69">
					<option value="0">[Select]</option>
					<option value="64">Near</option>
					<option value="65">Far</option>
					<option value="66">Mid-block</option>
				</select>
			</p>
			<p>
				<label for="jurisdiction">Jurisdiction</label>
				<input id="jurisdiction" name="jurisdiction" type="text" fieldtype_id = "70">
			</p>				
		</div>

		<h2>Boarding & Alighting</h2>
		<div id="section1">
			<p>
				<label for="surfacetype">What is the Surface Type?</label>
				<select id="surfacetype" fieldtype_id = "1">
					<option value="0">[Select]</option>
					<option value="15">Asphalt</option>
					<option value="16">Concrete</option>
					<option value="17">Grass</option>
					<option value="18">Dirt</option>						
				</select>
			</p>
			<p>
				<label for="surfacefirm">Is the surface firm?</label>
				<input type="radio" id="surfacefirm" name="surfacefirm" value="12" fieldtype_id = "2">Yes
				<input type="radio" name="surfacefirm" value="13" fieldtype_id = "2">No
				<input type="radio" name="surfacefirm" value="14" fieldtype_id = "2">Not Applicable
			</p>
			<p>
				<label for="arealevel">Is the Area at level?</label>
				<input type="radio" id="arealevel" name="arealevel" value="12" fieldtype_id = "3">Yes
				<input type="radio" name="arealevel" value="13" fieldtype_id = "3">No
				<input type="radio" name="arealevel" value="14" fieldtype_id = "3">Not Applicable
			</p>
			<p>
				<label for="dedicatedpad">Is there a dedicated pad?</label>
				<input type="radio" id="dedicatedpad" name="dedicatedpad" value="12" fieldtype_id = "4">Yes
				<input type="radio" name="dedicatedpad" value="13" fieldtype_id = "4">No
				<input type="radio" name="dedicatedpad" value="14" fieldtype_id = "4">Not Applicable
			</p>
			<p>
				<label for="dateconstructed">When was it constructed?</label>
				<input id="dateconstructed" name="dateconstructed" type="date" fieldtype_id = "5">
			</p>
			<p>
				<label for="padwidth">What is the Pad Width?</label>
				<input id="padwidth" name="padwidth" type="text" fieldtype_id = "6">
			</p>
			<p>
				<label for="paddepth">What is the Pad Depth?</label>
				<input id="paddepth" name="paddepth" type="text" fieldtype_id = "7">
			</p>
			<p>
				<label for="slopetype">Which type of Slope?</label>
				<select id="slopetype" fieldtype_id = "8">
					<option value="0">[Select]</option>
					<option value="57">Same as Roadway</option>
					<option value="58">Not Same as Roadway</option>													
				</select>
			</p>
			<p>
				<label for="pedpath">What kind of Pedestrian Path?</label>
				<select id="pedpath" fieldtype_id = "9">
					<option value="0">[Select]</option>
					<option value="19">Sidewalk</option>
					<option value="20">Berm of Road</option>													
					<option value="21">None</option>
				</select>
			</p>
			<p>
				<label for="boarding">Is there boarding?</label>
				<input type="radio" id="boarding" name="boarding" value="12" fieldtype_id = "10">Yes
				<input type="radio" name="boarding" value="13" fieldtype_id = "10">No
				<input type="radio" name="boarding" value="14" fieldtype_id = "10">Not Applicable
			</p>
			<p>
				<label for="connectionwidth">What is the Connection Width?</label>
				<select id="connectionwidth" fieldtype_id = "11">
					<option value="0">[Select]</option>
					<option value="22">>= 36 inches</option>
					<option value="23">< 36 inches</option>							
				</select>
			</p>
			<p>
				<label for="60x96">Is it 60x96?</label>
				<input type="radio" id="60x96" name="60x96" value="12" fieldtype_id = "12">Yes
				<input type="radio" name="60x96" value="13" fieldtype_id = "12">No
				<input type="radio" name="60x96" value="14" fieldtype_id = "12">Not Applicable
			</p>
			<p>
				<label for="60x100">Is it 60x100?</label>
				<input type="radio" id="60x100" name="60x100" value="12" fieldtype_id = "13">Yes
				<input type="radio" name="60x100" value="13" fieldtype_id = "13">No
				<input type="radio" name="60x100" value="14" fieldtype_id = "13">Not Applicable
			</p>
			<p>
				<label for="runningslope">What is the gradient of the Running Slope?</label>
				<select id="runningslope" fieldtype_id = "14">
					<option value="0">[Select]</option>
					<option value="24"><= 5%</option>
					<option value="25">> 5%</option>							
				</select>
			</p>
			<p>
				<label for="crossslope">What is the gradient of the Cross Slope?</label>
				<select id="crossslope" fieldtype_id = "15">
					<option value="0">[Select]</option>
					<option value="26"><= 2%</option>
					<option value="27">> 2%</option>							
				</select>
			</p>
			<p>
				<label for="crossslope">How much is the Vertical Transition?</label>
				<select id="crossslope" fieldtype_id = "16">
					<option value="0">[Select]</option>
					<option value="28"><= 1/2%</option>
					<option value="29">> 1/2%</option>							
				</select>
			</p>
			<p>
				<label for="crossslope">How much is the Horizontal Gap?</label>
				<select id="crossslope" fieldtype_id = "17">
					<option value="0">[Select]</option>
					<option value="28"><= 1/2%</option>
					<option value="29">> 1/2%</option>							
				</select>
			</p>
			<p>
				<label for="freeobstruction">Is it free of Obstruction?</label>
				<input type="radio" id="freeobstruction" name="freeobstruction" value="12" fieldtype_id = "18">Yes
				<input type="radio" name="freeobstruction" value="13" fieldtype_id = "18">No
				<input type="radio" name="freeobstruction" value="14" fieldtype_id = "18">Not Applicable
			</p>
			<p>
				<label for="adacompliant">Is it ADA Compliant?</label>
				<input type="radio" id="adacompliant" name="adacompliant" value="30" fieldtype_id = "19">Yes
				<input type="radio" name="adacompliant" value="31" fieldtype_id = "19">No, Needs Correction
				<input type="radio" name="adacompliant" value="32" fieldtype_id = "19">No, Pre-dates ADA
			</p>
			<p>
				<label for="cbccompliant">Is it CBC Compliant?</label>
				<input type="radio" id="cbccompliant" name="cbccompliant" value="33" fieldtype_id = "22">Yes
				<input type="radio" name="cbccompliant" value="34" fieldtype_id = "22">No, Needs Correction
				<input type="radio" name="cbccompliant" value="35" fieldtype_id = "22">No, Pre-dates 2013 CBC
			</p>
			<p>
				<label for="comments">Any Comments</label>						
				<textarea id="comments" name="comments" fieldtype_id="20" rows="5" cols="50"></textarea>
			</p>
			<p>
				<label for="otherinfo">Other Information</label>						
				<textarea id="otherinfo" name="otherinfo" fieldtype_id="23" rows="5" cols="50"></textarea>
			</p>
			<p>
				<label for="fileInput">Upload Photos</label>
				<input type="file" id="fileInput" name="fileInput" fieldtype_id="71" accept="image/*" capture="camera" multiple/>				
			</p>
		</div>

		<h2>Shelter</h2>
		<div id="section2">
			<p>
				<label for="shelterpresent">Is a Shelter present?</label>
				<input type="radio" id="shelterpresent" name="shelterpresent" value="12" fieldtype_id = "24">Yes
				<input type="radio" name="shelterpresent" value="13" fieldtype_id = "24">No
				<input type="radio" name="shelterpresent" value="14" fieldtype_id = "24">Not Applicable
			</p>
			<p>
				<label for="dateinstalled">When was it installed?</label>
				<input id="dateinstalled" name="dateinstalled" type="date" fieldtype_id = "25">
			</p>
			<p>
				<label for="owner">Who is the Owner?</label>
				<select id="owner" fieldtype_id = "26">
					<option value="0">[Select]</option>
					<option value="36">Metro</option>
					<option value="37">Other</option>							
				</select>
			</p>
			<p>
				<label for="ownername">What is the Owner Name?</label>
				<input id="ownername" name="ownername" type="text" fieldtype_id = "27">
			</p>
			<p>
				<label for="sheltertype">Which type of Shelter</label>
				<select id="sheltertype" fieldtype_id = "28">
					<option value="0">[Select]</option>
					<option value="38">Metro Type 1</option>
					<option value="39">Metro Type 2</option>							
					<option value="40">Metro Type 3</option>
					<option value="41">Other</option>
				</select>
			</p>
			<p>
				<label for="30x48">Is it 30x48?</label>
				<input type="radio" id="30x48" name="30x48" value="12" fieldtype_id = "30">Yes
				<input type="radio" name="30x48" value="13" fieldtype_id = "30">No
				<input type="radio" name="30x48" value="14" fieldtype_id = "30">Not Applicable
			</p>
			<p>
				<label for="30x52">Is it 30x52?</label>
				<input type="radio" id="30x52" name="30x52" value="12" fieldtype_id = "36">Yes
				<input type="radio" name="30x52" value="13" fieldtype_id = "36">No
				<input type="radio" name="30x52" value="14" fieldtype_id = "36">Not Applicable
			</p>
			<p>
				<label for="forwardfacing">What is the Forward Facing size?</label>
				<select id="forwardfacing" fieldtype_id = "31">
					<option value="0">[Select]</option>
					<option value="45">>= 36"x48"</option>
					<option value="46">< 36"x48"</option>							
				</select>
			</p>
			<p>
				<label for="sideways">What is the Sideways size?</label>
				<select id="sideways" fieldtype_id = "31">
					<option value="0">[Select]</option>
					<option value="47">>= 30"x60"</option>
					<option value="48">< 30"x60"</option>							
				</select>
			</p>
			<p>
				<label for="wcfloorareaconfined">Is the Wheel Chair Floor Area confined?</label>
				<input type="radio" id="wcfloorarea" name="wcfloorarea" value="12" fieldtype_id = "29">Yes
				<input type="radio" name="wcfloorarea" value="13" fieldtype_id = "29">No
				<input type="radio" name="wcfloorarea" value="14" fieldtype_id = "29">Not Applicable
			</p>
			<p>
				<label for="wcfloorareshelter">Is the Wheel Chair Floor Area in shelter?</label>
				<input type="radio" id="wcfloorareshelter" name="wcfloorareshelter" value="12" fieldtype_id = "33">Yes
				<input type="radio" name="wcfloorareshelter" value="13" fieldtype_id = "33">No
				<input type="radio" name="wcfloorareshelter" value="14" fieldtype_id = "33">Not Applicable
			</p>
			<p>
				<label for="wcfloorareaadjoin">Is the Wheel Chair Floor Area adjoined?</label>
				<input type="radio" id="wcfloorareaadjoin" name="wcfloorareaadjoin" value="12" fieldtype_id = "34">Yes
				<input type="radio" name="wcfloorareaadjoin" value="13" fieldtype_id = "34">No
				<input type="radio" name="wcfloorareaadjoin" value="14" fieldtype_id = "34">Not Applicable
			</p>
			<p>
				<label for="wcfloorareaconnect">Is the Wheel Chair Floor Area connected to the Board?</label>
				<input type="radio" id="wcfloorareaconnect" name="wcfloorareaconnect" value="12" fieldtype_id = "35">Yes
				<input type="radio" name="wcfloorareaconnect" value="13" fieldtype_id = "35">No
				<input type="radio" name="wcfloorareaconnect" value="14" fieldtype_id = "35">Not Applicable
			</p>
			<p>
				<label for="connectionwidth">What is the Connection Width?</label>
				<select id="connectionwidth" fieldtype_id = "11">
					<option value="0">[Select]</option>
					<option value="22">>= 36 inches</option>
					<option value="23">< 36 inches</option>							
				</select>
			</p>
			<p>
				<label for="runningslope">What is the gradient of the Running Slope?</label>
				<select id="runningslope" fieldtype_id = "14">
					<option value="0">[Select]</option>
					<option value="24"><= 5%</option>
					<option value="25">> 5%</option>							
				</select>
			</p>
			<p>
				<label for="crossslope">What is the gradient of the Cross Slope?</label>
				<select id="crossslope" fieldtype_id = "15">
					<option value="0">[Select]</option>
					<option value="26"><= 2%</option>
					<option value="27">> 2%</option>							
				</select>
			</p>
			<p>
				<label for="crossslope">How much is the Vertical Transition?</label>
				<select id="crossslope" fieldtype_id = "16">
					<option value="0">[Select]</option>
					<option value="28"><= 1/2%</option>
					<option value="29">> 1/2%</option>							
				</select>
			</p>
			<p>
				<label for="crossslope">How much is the Horizontal Gap?</label>
				<select id="crossslope" fieldtype_id = "17">
					<option value="0">[Select]</option>
					<option value="28"><= 1/2%</option>
					<option value="29">> 1/2%</option>							
				</select>
			</p>
			<p>
				<label for="surfacetype">What is the Surface Type?</label>
				<select id="surfacetype" fieldtype_id = "1">
					<option value="0">[Select]</option>
					<option value="15">Asphalt</option>
					<option value="16">Concrete</option>
					<option value="17">Grass</option>
					<option value="18">Dirt</option>						
				</select>
			</p>
			<p>
				<label for="surfacefirm">Is the surface firm?</label>
				<input type="radio" id="surfacefirm" name="surfacefirm" value="12" fieldtype_id = "2">Yes
				<input type="radio" name="surfacefirm" value="13" fieldtype_id = "2">No
				<input type="radio" name="surfacefirm" value="14" fieldtype_id = "2">Not Applicable
			</p>
			<p>
				<label for="freeobstruction">Is it free of Obstruction?</label>
				<input type="radio" id="freeobstruction" name="freeobstruction" value="12" fieldtype_id = "18">Yes
				<input type="radio" name="freeobstruction" value="13" fieldtype_id = "18">No
				<input type="radio" name="freeobstruction" value="14" fieldtype_id = "18">Not Applicable
			</p>
			<p>
				<label for="adacompliant">Is it ADA Compliant?</label>
				<input type="radio" id="adacompliant" name="adacompliant" value="30" fieldtype_id = "19">Yes
				<input type="radio" name="adacompliant" value="31" fieldtype_id = "19">No, Needs Correction
				<input type="radio" name="adacompliant" value="32" fieldtype_id = "19">No, Pre-dates ADA
			</p>
			<p>
				<label for="cbccompliant">Is it CBC Compliant?</label>
				<input type="radio" id="cbccompliant" name="cbccompliant" value="33" fieldtype_id = "22">Yes
				<input type="radio" name="cbccompliant" value="34" fieldtype_id = "22">No, Needs Correction
				<input type="radio" name="cbccompliant" value="35" fieldtype_id = "22">No, Pre-dates 2013 CBC
			</p>
			<p>
				<label for="comments">Any Comments</label>						
				<textarea id="comments" name="comments" fieldtype_id="20" rows="5" cols="50"></textarea>
			</p>
			<p>
				<label for="otherinfo">Other Information</label>						
				<textarea id="otherinfo" name="otherinfo" fieldtype_id="23" rows="5" cols="50"></textarea>
			</p>
			<p>
				<label for="fileInput">Upload Photos</label>
				<input type="file" id="fileInput" name="fileInput" fieldtype_id="71" accept="image/*" capture="camera" multiple/>				
			</p>
		</div>

		<h2>Intersection 1</h2>
		<div id="section3">
			<p>
				<label for="intersectiontype">What is the type of Intersection?</label>
				<select id="intersectiontype" fieldtype_id = "37">
					<option value="0">[Select]</option>
					<option value="51">4-way Intersection</option>
					<option value="52">T-Intersection</option>
					<option value="53">Other</option>													
				</select>
			</p>
			<p>
				<label for="roadparallel">Road Parallel to the Bus Stop?</label>
				<input id="roadparallel" name="roadparallel" type="text" fieldtype_id = "38">
			</p>
			<p>
				<label for="roadperpendicular">Road Perpendicular to the Bus Stop?</label>
				<input id="roadperpendicular" name="roadperpendicular" type="text" fieldtype_id = "39">
			</p>
			<p>
				<label for="description">Description</label>						
				<textarea id="description" name="description" fieldtype_id="40" rows="5" cols="50"></textarea>
			</p>
			<p>
				<label for="pathwaytype">What is the type of Pathway?</label>
				<select id="pathwaytype" fieldtype_id = "41">
					<option value="0">[Select]</option>
					<option value="19">Sidewalk</option>
					<option value="20">Berm of Road</option>													
					<option value="21">None</option>
				</select>
			</p>
			<p>
				<label for="pathfunctional">Is access to the Path functional?</label>
				<input type="radio" id="pathfunctional" name="pathfunctional" value="12" fieldtype_id = "42">Yes
				<input type="radio" name="pathfunctional" value="13" fieldtype_id = "42">No
				<input type="radio" name="pathfunctional" value="14" fieldtype_id = "42">Not Applicable
			</p>
			<p>
				<label for="lightcontrolled">Is the traffic light controlled?</label>
				<input type="radio" id="lightcontrolled" name="lightcontrolled" value="12" fieldtype_id = "43">Yes
				<input type="radio" name="lightcontrolled" value="13" fieldtype_id = "43">No
				<input type="radio" name="lightcontrolled" value="14" fieldtype_id = "43">Not Applicable
			</p>
			<p>
				<label for="pedcontrols">Are there any pedestrian controls?</label>
				<input type="radio" id="pedcontrols" name="pedcontrols" value="12" fieldtype_id = "44">Yes
				<input type="radio" name="pedcontrols" value="13" fieldtype_id = "44">No
				<input type="radio" name="pedcontrols" value="14" fieldtype_id = "44">Not Applicable
			</p>
			<p>
				<label for="functionalcurbramps">Are the curb ramps functional?</label>
				<input type="radio" id="functionalcurbramps" name="functionalcurbramps" value="12" fieldtype_id = "45">Yes
				<input type="radio" name="functionalcurbramps" value="13" fieldtype_id = "45">No
				<input type="radio" name="functionalcurbramps" value="14" fieldtype_id = "45">Not Applicable
			</p>
			<p>
				<label for="numcurbramps">How many curb ramps are needed?</label>
				<input id="numcurbramps" name="numcurbramps" type="text" fieldtype_id = "46">
			</p>
			<p>
				<label for="missingcurbramps">Describe the missing curb ramps (If any)</label>
				<input id="missingcurbramps" name="missingcurbramps" type="text" fieldtype_id = "47">
			</p>
			<p>
				<label for="midcrossingislands">Are the mid crossing islands present?</label>
				<input type="radio" id="midcrossingislands" name="midcrossingislands" value="12" fieldtype_id = "48">Yes
				<input type="radio" name="midcrossingislands" value="13" fieldtype_id = "48">No
				<input type="radio" name="midcrossingislands" value="14" fieldtype_id = "48">Not Applicable
			</p>
			<p>
				<label for="cutthroughs">Are there any cut throughs provided?</label>
				<input type="radio" id="cutthroughs" name="cutthroughs" value="12" fieldtype_id = "49">Yes
				<input type="radio" name="cutthroughs" value="13" fieldtype_id = "49">No
				<input type="radio" name="cutthroughs" value="14" fieldtype_id = "49">Not Applicable
			</p>
			<p>
				<label for="functionalaccess">Is the access to intersection functional?</label>
				<input type="radio" id="functionalaccess" name="functionalaccess" value="12" fieldtype_id = "50">Yes
				<input type="radio" name="functionalaccess" value="13" fieldtype_id = "50">No
				<input type="radio" name="functionalaccess" value="14" fieldtype_id = "50">Not Applicable
			</p>
			<p>
				<label for="comments">Any Comments</label>						
				<textarea id="comments" name="comments" fieldtype_id="20" rows="5" cols="50"></textarea>
			</p>
			<p>
				<label for="otherinfo">Other Information</label>						
				<textarea id="otherinfo" name="otherinfo" fieldtype_id="23" rows="5" cols="50"></textarea>
			</p>
			<p>
				<label for="fileInput">Upload Photos</label>
				<input type="file" id="fileInput" name="fileInput" fieldtype_id="71" accept="image/*" capture="camera" multiple/>				
			</p>
		</div>
		
		<h2>Intersection 2</h2>
		<div id="section4">
			<p>
				<label for="intersectiontype">What is the type of Intersection?</label>
				<select id="intersectiontype" fieldtype_id = "37">
					<option value="0">[Select]</option>
					<option value="51">4-way Intersection</option>
					<option value="52">T-Intersection</option>
					<option value="53">Other</option>													
				</select>
			</p>
			<p>
				<label for="roadparallel">Road Parallel to the Bus Stop?</label>
				<input id="roadparallel" name="roadparallel" type="text" fieldtype_id = "38">
			</p>
			<p>
				<label for="roadperpendicular">Road Perpendicular to the Bus Stop?</label>
				<input id="roadperpendicular" name="roadperpendicular" type="text" fieldtype_id = "39">
			</p>
			<p>
				<label for="description">Description</label>						
				<textarea id="description" name="description" fieldtype_id="40" rows="5" cols="50"></textarea>
			</p>
			<p>
				<label for="pathwaytype">What is the type of Pathway?</label>
				<select id="pathwaytype" fieldtype_id = "41">
					<option value="0">[Select]</option>
					<option value="19">Sidewalk</option>
					<option value="20">Berm of Road</option>													
					<option value="21">None</option>
				</select>
			</p>
			<p>
				<label for="pathfunctional">Is access to the Path functional?</label>
				<input type="radio" id="pathfunctional" name="pathfunctional" value="12" fieldtype_id = "42">Yes
				<input type="radio" name="pathfunctional" value="13" fieldtype_id = "42">No
				<input type="radio" name="pathfunctional" value="14" fieldtype_id = "42">Not Applicable
			</p>
			<p>
				<label for="lightcontrolled">Is the traffic light controlled?</label>
				<input type="radio" id="lightcontrolled" name="lightcontrolled" value="12" fieldtype_id = "43">Yes
				<input type="radio" name="lightcontrolled" value="13" fieldtype_id = "43">No
				<input type="radio" name="lightcontrolled" value="14" fieldtype_id = "43">Not Applicable
			</p>
			<p>
				<label for="pedcontrols">Are there any pedestrian controls?</label>
				<input type="radio" id="pedcontrols" name="pedcontrols" value="12" fieldtype_id = "44">Yes
				<input type="radio" name="pedcontrols" value="13" fieldtype_id = "44">No
				<input type="radio" name="pedcontrols" value="14" fieldtype_id = "44">Not Applicable
			</p>
			<p>
				<label for="functionalcurbramps">Are the curb ramps functional?</label>
				<input type="radio" id="functionalcurbramps" name="functionalcurbramps" value="12" fieldtype_id = "45">Yes
				<input type="radio" name="functionalcurbramps" value="13" fieldtype_id = "45">No
				<input type="radio" name="functionalcurbramps" value="14" fieldtype_id = "45">Not Applicable
			</p>
			<p>
				<label for="numcurbramps">How many curb ramps are needed?</label>
				<input id="numcurbramps" name="numcurbramps" type="text" fieldtype_id = "46">
			</p>
			<p>
				<label for="missingcurbramps">Describe the missing curb ramps (If any)</label>
				<input id="missingcurbramps" name="missingcurbramps" type="text" fieldtype_id = "47">
			</p>
			<p>
				<label for="midcrossingislands">Are the mid crossing islands present?</label>
				<input type="radio" id="midcrossingislands" name="midcrossingislands" value="12" fieldtype_id = "48">Yes
				<input type="radio" name="midcrossingislands" value="13" fieldtype_id = "48">No
				<input type="radio" name="midcrossingislands" value="14" fieldtype_id = "48">Not Applicable
			</p>
			<p>
				<label for="cutthroughs">Are there any cut throughs provided?</label>
				<input type="radio" id="cutthroughs" name="cutthroughs" value="12" fieldtype_id = "49">Yes
				<input type="radio" name="cutthroughs" value="13" fieldtype_id = "49">No
				<input type="radio" name="cutthroughs" value="14" fieldtype_id = "49">Not Applicable
			</p>
			<p>
				<label for="functionalaccess">Is the access to intersection functional?</label>
				<input type="radio" id="functionalaccess" name="functionalaccess" value="12" fieldtype_id = "50">Yes
				<input type="radio" name="functionalaccess" value="13" fieldtype_id = "50">No
				<input type="radio" name="functionalaccess" value="14" fieldtype_id = "50">Not Applicable
			</p>
			<p>
				<label for="comments">Any Comments</label>						
				<textarea id="comments" name="comments" fieldtype_id="20" rows="5" cols="50"></textarea>
			</p>
			<p>
				<label for="otherinfo">Other Information</label>						
				<textarea id="otherinfo" name="otherinfo" fieldtype_id="23" rows="5" cols="50"></textarea>
			</p>
			<p>
				<label for="fileInput">Upload Photos</label>
				<input type="file" id="fileInput" name="fileInput" fieldtype_id="71" accept="image/*" capture="camera" multiple/>				
			</p>
		</div>
		
		<h2>Bus Stop Sign</h2>
		<div id="section5">
			<p>
				<label for="signpresent">Is the sign present?</label>
				<input type="radio" id="signpresent" name="signpresent" value="12" fieldtype_id = "51">Yes
				<input type="radio" name="signpresent" value="13" fieldtype_id = "51">No
				<input type="radio" name="signpresent" value="14" fieldtype_id = "51">Not Applicable
			</p>
			<p>
				<label for="mountingheight">What is the mounting height?</label>
				<select id="mountingheight" fieldtype_id = "52">
					<option value="0">[Select]</option>
					<option value="54"><= 70"</option>
					<option value="55">> 70" but <= 120"</option>													
					<option value="56">> 120"</option>
				</select>
			</p>
			<p>
				<label for="adacompliant">Is it ADA Compliant?</label>
				<input type="radio" id="adacompliant" name="adacompliant" value="30" fieldtype_id = "19">Yes
				<input type="radio" name="adacompliant" value="31" fieldtype_id = "19">No, Needs Correction
				<input type="radio" name="adacompliant" value="32" fieldtype_id = "19">No, Pre-dates ADA
			</p>
			<p>
				<label for="cbccompliant">Is it CBC Compliant?</label>
				<input type="radio" id="cbccompliant" name="cbccompliant" value="33" fieldtype_id = "22">Yes
				<input type="radio" name="cbccompliant" value="34" fieldtype_id = "22">No, Needs Correction
				<input type="radio" name="cbccompliant" value="35" fieldtype_id = "22">No, Pre-dates 2013 CBC
			</p>					
			<p>
				<label for="otherinfo">Other Information</label>						
				<textarea id="otherinfo" name="otherinfo" fieldtype_id="23" rows="5" cols="50"></textarea>
			</p>
			<p>
				<label for="fileInput">Upload Photos</label>
				<input type="file" id="fileInput" name="fileInput" fieldtype_id="71" accept="image/*" capture="camera" multiple/>				
			</p>
		</div>
		
		<h2>Lighting</h2>
		<div id="section6">
			<p>
				<label for="lightpresent">Is there any light present?</label>
				<input type="radio" id="lightpresent" name="lightpresent" value="12" fieldtype_id = "53">Yes
				<input type="radio" name="lightpresent" value="13" fieldtype_id = "53">No
				<input type="radio" name="lightpresent" value="14" fieldtype_id = "53">Not Applicable
			</p>
			<p>
				<label for="comments">Any Comments</label>						
				<textarea id="comments" name="comments" fieldtype_id="20" rows="5" cols="50"></textarea>
			</p>
			<p>
				<label for="otherinfo">Other Information</label>						
				<textarea id="otherinfo" name="otherinfo" fieldtype_id="23" rows="5" cols="50"></textarea>
			</p>
			<p>
				<label for="fileInput">Upload Photos</label>
				<input type="file" id="fileInput" name="fileInput" fieldtype_id="71" accept="image/*" capture="camera" multiple/>				
			</p>
		</div>
		
		<h2>Landscaping</h2>
		<div id="section7">
			<p>
				<label for="landscapingissues">Are there any landscaping issues?</label>
				<input type="radio" id="landscapingissues" name="landscapingissues" value="12" fieldtype_id = "54">Yes
				<input type="radio" name="landscapingissues" value="13" fieldtype_id = "54">No
				<input type="radio" name="landscapingissues" value="14" fieldtype_id = "54">Not Applicable
			</p>
			<p>
				<label for="comments">Any Comments</label>						
				<textarea id="comments" name="comments" fieldtype_id="20" rows="5" cols="50"></textarea>
			</p>
			<p>
				<label for="otherinfo">Other Information</label>						
				<textarea id="otherinfo" name="otherinfo" fieldtype_id="23" rows="5" cols="50"></textarea>
			</p>
			<p>
				<label for="fileInput">Upload Photos</label>
				<input type="file" id="fileInput" name="fileInput" fieldtype_id="71" accept="image/*" capture="camera" multiple/>				
			</p>
		</div>				
		
		<h2>Other Amenities</h2>
		<div id="section8">
			<p>
				<label for="transitinfopresent">Is the Transit Information present?</label>
				<input type="radio" id="transitinfopresent" name="transitinfopresent" value="12" fieldtype_id = "55">Yes
				<input type="radio" name="transitinfopresent" value="13" fieldtype_id = "55">No
				<input type="radio" name="transitinfopresent" value="14" fieldtype_id = "55">Not Applicable
			</p>
			<p>
				<label for="benchpresent">Is there any Bench present?</label>
				<input type="radio" id="benchpresent" name="benchpresent" value="12" fieldtype_id = "56">Yes
				<input type="radio" name="benchpresent" value="13" fieldtype_id = "56">No
				<input type="radio" name="benchpresent" value="14" fieldtype_id = "56">Not Applicable
			</p>
			<p>
				<label for="trashcanpresent">Is there a Trash Can present?</label>
				<input type="radio" id="trashcanpresent" name="trashcanpresent" value="12" fieldtype_id = "57">Yes
				<input type="radio" name="trashcanpresent" value="13" fieldtype_id = "57">No
				<input type="radio" name="trashcanpresent" value="14" fieldtype_id = "57">Not Applicable
			</p>
			<p>
				<label for="bikerackpresent">Is there a Bike Rack present?</label>
				<input type="radio" id="bikerackpresent" name="bikerackpresent" value="12" fieldtype_id = "58">Yes
				<input type="radio" name="bikerackpresent" value="13" fieldtype_id = "58">No
				<input type="radio" name="bikerackpresent" value="14" fieldtype_id = "58">Not Applicable
			</p>
			<p>
				<label for="telephone">Is there a Telephone?</label>
				<input type="radio" id="telephone" name="telephone" value="12" fieldtype_id = "59">Yes
				<input type="radio" name="telephone" value="13" fieldtype_id = "59">No
				<input type="radio" name="telephone" value="14" fieldtype_id = "59">Not Applicable
			</p>
			<p>
				<label for="sidewalkpresent">Is there any Sidewalk present?</label>
				<input type="radio" id="sidewalkpresent" name="sidewalkpresent" value="12" fieldtype_id = "60">Yes
				<input type="radio" name="sidewalkpresent" value="13" fieldtype_id = "60">No
				<input type="radio" name="sidewalkpresent" value="14" fieldtype_id = "60">Not Applicable
			</p>
			<p>
				<label for="comments">Any Comments</label>						
				<textarea id="comments" name="comments" fieldtype_id="20" rows="5" cols="50"></textarea>
			</p>
			<p>
				<label for="otherinfo">Other Information</label>						
				<textarea id="otherinfo" name="otherinfo" fieldtype_id="23" rows="5" cols="50"></textarea>
			</p>
			<p>
				<label for="fileInput">Upload Photos</label>
				<input type="file" id="fileInput" name="fileInput" fieldtype_id="71" accept="image/*" capture="camera" multiple/>				
			</p>
		</div>
	</div>
</div>
<input type="hidden" name="busstopData" id="busstopData"/>
</form>
<script src="scripts/parse.js"></script>
<script src="scripts/mainpage.js"></script>

</body>
</html>