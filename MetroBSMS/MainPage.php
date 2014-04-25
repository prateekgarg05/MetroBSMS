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
		<h2>Identification/Location</h2>
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
<!--  New values--> <option value="72">Not near an intersection</option>
					<option value="73">Freeway bus pad</option> <!-- End NEW -->
				</select>
			</p>
			<p>
				<label for="jurisdiction">Jurisdiction</label>
				<input id="jurisdiction" name="jurisdiction" type="text" fieldtype_id = "70">
			</p>	
			
			<!-- New Fields Start -->
			<p>
				<label for="purposeofstop">What is the purpose of the stop?</label>
				<select id="purposeofstop" fieldtype_id="72">
					<option value="0">[Select]</option>
					<option value="76">Park and Ride</option>
					<option value="77">Kiss and Ride</option>
					<option value="78">Boarding</option>
					<option value="79">Alighting</option>
					<option value="80">Both Boarding and Alighting</option>
					<option value="81">Transfer</option> 
				</select>
			</p>
			<p>
				<label for="distancetocurb">Distance from the bus stop to curb of cross street(in feet)</label>
				<input id="distancetocurb" name="distancetocurb" type="text" fieldtype_id="73">
			</p>
			<p>
				<label for="adjacentproperty">Adjacent property description</label>
					<input type="checkbox" name="adjacentproperty" value="82" fieldtype_id="74" >Apartment Building
					<input type="checkbox" name="adjacentproperty" value="83" fieldtype_id="74" >Day Care
					<input type="checkbox" name="adjacentproperty" value="84" fieldtype_id="74" >Government Building
					<input type="checkbox" name="adjacentproperty" value="85" fieldtype_id="74" >Hospital
					<input type="checkbox" name="adjacentproperty" value="86" fieldtype_id="74" >Human Service Agency
					<input type="checkbox" name="adjacentproperty" value="87" fieldtype_id="74" >Industrial Site/Bldg.
					<input type="checkbox" name="adjacentproperty" value="88" fieldtype_id="74" >Library
					<input type="checkbox" name="adjacentproperty" value="89" fieldtype_id="74" >Mall/Shopping Center
					<input type="checkbox" name="adjacentproperty" value="90" fieldtype_id="74" >Nursing Home
					<input type="checkbox" name="adjacentproperty" value="91" fieldtype_id="74" >Office Building
					<input type="checkbox" name="adjacentproperty" value="92" fieldtype_id="74" >Park
					<input type="checkbox" name="adjacentproperty" value="93" fieldtype_id="74" >Park and Ride
					<input type="checkbox" name="adjacentproperty" value="94" fieldtype_id="74" >Place of Worship
					<input type="checkbox" name="adjacentproperty" value="95" fieldtype_id="74" >Residence-townhouse
					<input type="checkbox" name="adjacentproperty" value="96" fieldtype_id="74" >Residence-detached
					<input type="checkbox" name="adjacentproperty" value="97" fieldtype_id="74" >Retail Store
					<input type="checkbox" name="adjacentproperty" value="98" fieldtype_id="74" >School
					<input type="checkbox" name="adjacentproperty" value="99" fieldtype_id="74" >Supermarket
					<input type="checkbox" name="adjacentproperty" value="100" fieldtype_id="74" >Transit station/center
					<input type="checkbox" name="adjacentproperty" value="101" fieldtype_id="74" >Vacant lot
			</p>
			<p>
				<label for="distancefrompreviousbusstop">Distance from previous bus stop (in feet)</label>
				<input id="distancefrompreviousbusstop" name="distancefrompreviousbusstop" type="text" fieldtype_id="75">
			</p>

			<!-- New Fields End  -->			
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
				<label for="padwidth">What is the Bus Stop Width?</label>
				<input id="padwidth" name="padwidth" type="text" fieldtype_id = "6">
			</p>
			<p>
				<label for="paddepth">What is the Bus Stop Depth?</label>
				<input id="paddepth" name="paddepth" type="text" fieldtype_id = "7">
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
				<label for="wcfloorareaconfined">Is the Wheel Chair Floor Area confined?</label>
				<input type="radio" id="wcfloorarea" name="wcfloorarea" value="12" fieldtype_id = "29">Yes
				<input type="radio" name="wcfloorarea" value="13" fieldtype_id = "29">No
				<input type="radio" name="wcfloorarea" value="14" fieldtype_id = "29">Not Applicable
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
			<!-- New Fields -->
			<p>
				<label for="distancefromsheltertocurb">Whats is the disance from shelter to curb?</label>
				<input type="text" id="distancefromsheltertocurb" name="distancefromsheltertocurb" fieldtype_id="76">
			</p>
			<p>
				<label for="clearspacemeasurements">Clear Space Measurements for Wheelchairs</label>
				<input type="text" id="clearspacemeasurements" name="clearspacemeasurements" fieldtype_id="77">
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
				<label for="sidewalkwidth">What is sidewalk's width in the narrowest point?</label>
				<input type="text" id="sidewalkwidth" name="sidewalkwidth" fieldtype_id="93">
			</p>
			<p>
				<label for="sidewalkslope">What is sidewalk's slope?</label>
				<input type="text" id="sidewalkslope" name="sidewalkslope" fieldtype_id="94">
			</p>
			<p>
				<label for="obstacles">Obstacles type/measurements</label><br />
				<input type="checkbox" id="obstacles1" name="obstacles" fieldtype_id="97" value="112">PO Box<br />
					<input type="text" name="obstacles" fieldtype_id="97"><br />
				<input type="checkbox" name="obstacles" fieldtype_id="97" value="113">Newspaper<br />
					<input type="text" name="obstacles" fieldtype_id="97"><br />
				<input type="checkbox" name="obstacles" fieldtype_id="97" value="114">Light Pole<br />
					<input type="text" name="obstacles" fieldtype_id="97"><br />
				<input type="checkbox" name="obstacles" fieldtype_id="97" value="115">Trash<br />
					<input type="text" name="obstacles" fieldtype_id="97"><br />
				<input type="checkbox" name="obstacles" fieldtype_id="97" value="116">Utility Box<br />
					<input type="text" name="obstacles" fieldtype_id="97"><br />
			</p>
			<p>
				<label for="connectsidestop">Is sidewalk seemlessly connected to bus stop area?</label>
				<input type="radio" id="connectsidestop" name="connectsidestop" value="12" fieldtype_id = "96">Yes
				<input type="radio" name="connectsidestop" value="13" fieldtype_id = "96">No
				<input type="radio" name="connectsidestop" value="14" fieldtype_id = "96">Not Applicable
			</p>
			<p>
				<label for="conditionofsidewalk">Condition of sidewalk</label>
				<select id="conditionofsidewalk" fieldtype_id="95">
					<option value="0">[Select]</option>
					<option value="67">1</option>
					<option value="68">2</option>
					<option value="69">3</option>
					<option value="70">4</option>
					<option value="71">5</option>
				</select>
			</p>			
			<p>
				<label for="curbcutatint">Is Curb cut at the intersection?</label>
				<input type="radio" id="curbcutatint" name="curbcutatint" value="12" fieldtype_id = "98">Yes
				<input type="radio" name="curbcutatint" value="13" fieldtype_id = "98">No
				<input type="radio" name="curbcutatint" value="14" fieldtype_id = "98">Not Applicable
			</p>
			<p>
				<label for="turncateddomespresents">Are Curb cut turncated domes present?</label>
				<input type="radio" id="turncateddomespresents" name="turncateddomespresents" value="12" fieldtype_id = "99">Yes
				<input type="radio" name="turncateddomespresents" value="13" fieldtype_id = "99">No
				<input type="radio" name="turncateddomespresents" value="14" fieldtype_id = "99">Not Applicable
			</p>
			<p>
				<label for="curbcutwidth">Curb Cut width</label>
				<input type="text" id="curbcutwidth" name="curbcutwidth" fieldtype_id="100">
			</p>
			<p>
				<label for="curbcutslope">Curb Cut Slope</label>
				<input type="text" id="curbcutslope" name="curbcutslope" fieldtype_id="101">
			</p>
			<p>
			<label for="oppcornerobserve">Opposite corner observations</label>
			<select id="oppcornerobserve" fieldtype_id="102">
				<option value="0">[Select]</option>
				<option value="119">Curb Cut</option>
				<option value="120">Truncated Domes</option>
			</select>
			</p>
			<p>
			<label for="crosswalkobserve">Crosswalk observations</label>
			<select id="crosswalkobserve" fieldtype_id="103">
				<option value="0">[Select]</option>
				<option value="119">Curb Cut</option>
				<option value="120">Truncated Domes</option>
			</select>
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
				<label for="sidewalkwidth">What is sidewalk's width in the narrowest point?</label>
				<input type="text" id="sidewalkwidth" name="sidewalkwidth" fieldtype_id="93">
			</p>
			<p>
				<label for="sidewalkslope">What is sidewalk's slope?</label>
				<input type="text" id="sidewalkslope" name="sidewalkslope" fieldtype_id="94">
			</p>
			<p>
				<label for="obstacles">Obstacles type/measurements</label><br />
				<input type="checkbox" id="obstacles1" name="obstacles" fieldtype_id="97" value="112">PO Box<br />
					<input type="text" name="obstacles" fieldtype_id="97"><br />
				<input type="checkbox" name="obstacles" fieldtype_id="97" value="113">Newspaper<br />
					<input type="text" name="obstacles" fieldtype_id="97"><br />
				<input type="checkbox" name="obstacles" fieldtype_id="97" value="114">Light Pole<br />
					<input type="text" name="obstacles" fieldtype_id="97"><br />
				<input type="checkbox" name="obstacles" fieldtype_id="97" value="115">Trash<br />
					<input type="text" name="obstacles" fieldtype_id="97"><br />
				<input type="checkbox" name="obstacles" fieldtype_id="97" value="116">Utility Box<br />
					<input type="text" name="obstacles" fieldtype_id="97"><br />
			</p>
			<p>
				<label for="connectsidestop">Is sidewalk seemlessly connected to bus stop area?</label>
				<input type="radio" id="connectsidestop" name="connectsidestop" value="12" fieldtype_id = "96">Yes
				<input type="radio" name="connectsidestop" value="13" fieldtype_id = "96">No
				<input type="radio" name="connectsidestop" value="14" fieldtype_id = "96">Not Applicable
			</p>
			<p>
				<label for="conditionofsidewalk">Condition of sidewalk</label>
				<select id="conditionofsidewalk" fieldtype_id="95">
					<option value="0">[Select]</option>
					<option value="67">1</option>
					<option value="68">2</option>
					<option value="69">3</option>
					<option value="70">4</option>
					<option value="71">5</option>
				</select>
			</p>			
			<p>
			<label for="oppcornerobserve">Opposite corner observations</label>
			<select id="oppcornerobserve" fieldtype_id="102">
				<option value="0">[Select]</option>
				<option value="119">Curb Cut</option>
				<option value="120">Truncated Domes</option>
			</select>
			</p>
			<p>
			<label for="crosswalkobserve">Crosswalk observations</label>
			<select id="crosswalkobserve" fieldtype_id="103">
				<option value="0">[Select]</option>
				<option value="119">Curb Cut</option>
				<option value="120">Truncated Domes</option>
			</select>
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
			<!-- New Fields Start -->
			<p>
				<label for="providername">What is the provider name on the bus stop?</label>
				<input type="text" id="providername" name="providername" fieldtype_id="78">
			</p>
			<p>
				<label for="conditionofsignage">Condition of signage</label>
				<select id="conditionofsignage" fieldtype_id="79">
					<option value="0">[Select]</option>
					<option value="67">1</option>
					<option value="68">2</option>
					<option value="69">3</option>
					<option value="70">4</option>
					<option value="71">5</option>
				</select>
			</p>
			<p>
				<label for="buszonedelinaited">Bus zone clearly delineated by</label>
				<select id="buszonedelinaited" fieldtype_id="80">
					<option value="0">[Select]</option>
					<option value="102">Red Curb</option>
					<option value="103">Sign</option>
					<option value="104">Nothing</option>
				</select>
			</p>
			<!-- New Fields End -->
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
				<label for="streetlightobserve">Street light observation</label>
				<select id="streetlightobserve" fieldtype_id="81">
					<option value="0">[Select]</option>
					<option value="105">In bus zone</option>
					<option value="106">Within 50"</option>
					<option value="107">None</option>
				</select>
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
				<label for="trashcanpresent">Is there a Trash Can present?</label>
				<input type="radio" id="trashcanpresent" name="trashcanpresent" value="12" fieldtype_id = "57">Yes
				<input type="radio" name="trashcanpresent" value="13" fieldtype_id = "57">No
				<input type="radio" name="trashcanpresent" value="14" fieldtype_id = "57">Not Applicable
			</p>
			<p>
				<label for="trashcondition">What is the Condition of trash(If Present)</label>
				<select id="trashcondition" fieldtype_id="84">
					<option value="0">[Select]</option>
					<option value="67">1</option>
					<option value="68">2</option>
					<option value="69">3</option>
					<option value="70">4</option>
					<option value="71">5</option>
				</select>
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
				<label for="seattype">What is Seating type?</label>
				<input type="text" id="seattype" name="seattype" fieldtype_id="82">
			</p>
			<p>
				<label for="benchpresent">Is there any Bench present?</label>
				<input type="radio" id="benchpresent" name="benchpresent" value="12" fieldtype_id = "56">Yes
				<input type="radio" name="benchpresent" value="13" fieldtype_id = "56">No
				<input type="radio" name="benchpresent" value="14" fieldtype_id = "56">Not Applicable
			</p>
			<p>
				<label for="seatcondition">Condition of seating(If Present)</label>
				<select id="seatcondition" fieldtype_id="83">
					<option value="0">[Select]</option>
					<option value="67">1</option>
					<option value="68">2</option>
					<option value="69">3</option>
					<option value="70">4</option>
					<option value="71">5</option>
				</select>
			</p>					
			<p>
				<label for="otherammenities">Any other amenities present?</label>
				<input type="text" id="otherammenities" name="otherammenities" fieldtype_id="92">
			</p>
			<!--<p>
				<label for="obstacletype">What is the type of obstacle?</label>
				<input type="text" id="obstacletype" name="obstcaletype" fieldtype_id="85">
			</p>-->
			<p>
				<label for="obstacles">Any Obstacles type</label><br />
				<input type="checkbox" id="obstacles1" name="obstacles" fieldtype_id="97" value="112">PO Box<br />					
				<input type="checkbox" name="obstacles" fieldtype_id="97" value="113">Newspaper<br />					
				<input type="checkbox" name="obstacles" fieldtype_id="97" value="114">Light Pole<br />					
				<input type="checkbox" name="obstacles" fieldtype_id="97" value="115">Trash<br />					
				<input type="checkbox" name="obstacles" fieldtype_id="97" value="116">Utility Box<br />					
			</p>
			<p>
				<label for="comments">Any Comments</label>						
				<textarea id="comments" name="comments" fieldtype_id="20" rows="5" cols="50"></textarea>
			</p>
			
		</div>
		<!-- New Sections -->
		<h2>Landing Area</h2>
		<div id="section10">
			<p>
				<label for="landingareawidth">What is landing area width?</label>
				<input type="text" id="landingareawidth" name="landingareawidth" fieldtype_id="86">
			</p>
			<p>
				<label for="landingarealength">What is landing area length?</label>
				<input type="text" id="landingarealength" name="landingarealength" fieldtype_id="87">
			</p>
			<p>
				<label for="landingareaslope">What is landing area slope?</label>
				<input type="text" id="landingareaslope" name="landingareaslope" fieldtype_id="88">
			</p>
			<p>
				<label for="landingareapositioning">Landing area positioning is</label>
				<select id="landingareapositioning" fieldtype_id="89">
					<option value="0">[Select]</option>
					<option value="108">Back from sign pole</option>
					<option value="109">Forward from sign pole</option>
				</select>
			</p>
			<p>
				<label for="materialoflanding">Material of landing area is</label>
				<select id="materialoflanding" fieldtype_id="90">
					<option value="0">[Select]</option>
					<option value="110">Paved</option>
					<option value="111">Unpaved</option>
				</select>
			</p>
			<p>
				<label for="landingareaobservations">Landing area surface observations</label>
				<input type="text" id="landingareaobservations" name="landingareaobservations" fieldtype_id="91">
			</p>
			<p>
				<label for="landingpadconnecttosidewalk">Does landing pad connect to sidwealk?</label>
				<input type="radio" id="landingpadconnecttosidewalk" name="landingpadconnecttosidewalk" value="12" fieldtype_id = "92">Yes
				<input type="radio" name="landingpadconnecttosidewalk" value="13" fieldtype_id = "92">No
				<input type="radio" name="landingpadconnecttosidewalk" value="14" fieldtype_id = "92">Not Applicable
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
		<h2>Sidewalk</h2>
		<div id="section11">
			<p>
				<label for="sidewalkwidth">What is sidewalk's width in the narrowest point?</label>
				<input type="text" id="sidewalkwidth" name="sidewalkwidth" fieldtype_id="93">
			</p>
			<p>
				<label for="sidewalkslope">What is sidewalk's slope?</label>
				<input type="text" id="sidewalkslope" name="sidewalkslope" fieldtype_id="94">
			</p>
			<p>
				<label for="conditionofsidewalk">Condition of sidewalk</label>
				<select id="conditionofsidewalk" fieldtype_id="95">
					<option value="0">[Select]</option>
					<option value="67">1</option>
					<option value="68">2</option>
					<option value="69">3</option>
					<option value="70">4</option>
					<option value="71">5</option>
				</select>
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
	<input type="hidden" name="busstopData" id="busstopData"/>
</form>
<script src="scripts/parse.js"></script>
<script src="scripts/mainpage.js"></script>

</body>
</html>