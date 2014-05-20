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
    <script src="scripts/jquery.validate.js"></script>
    <script src="scripts/additional-methods.js"></script>
    <script src='http://crg:5000/socket.io/socket.io.js'></script>
    <script src="scripts/location.js"></script>
    
</head>

<body>
  <div class="header">
    <a href="/BaseMap.php" class="logo"><img src="img/site/logo.png" /></a>
    <div class="util">
      <h1 class="title">Bus Stop Managment System</h1>
      <div class="welcome">Welcome, Patrick! | <a href="/Login.php">Logout</a></div>
    </div>
  </div>
    <div id="stop" class="stoptitle">
        <label id="stopname"></label>
    </div>
    <div id="map-small" class="smallmap"></div>
    
    <button type="button" title="Get Location" class="btn-primary" style="margin-top: 500px;position: absolute" onclick="GetLocation()">Get Current Location</button>
	
    <div id="info">
        <form id="myform">
            <div id="wizard">
                <h2>Identification/Location</h2>
                <div id="section1">
                    <p>
                        <label for="busstopid">Bus Stop ID</label>
                        <input id="busstopid" name="busstopid" type="text" class="digitsReq">
                    </p>
                    <p>
                        <label for="latitude">Latitude</label>
                        <input id="latitude" name="Latitude" type="text" class="location" fieldtype_id="61">
                    </p>
                    <p>
                        <label for="longitude">Longitude</label>
                        <input id="longitude" name="Longitude" type="text" class="location" fieldtype_id="62">
                    </p>
                    <p>
                        <label for="altitude">Altitude</label>
                        <input id="altitude" name="Altitude" type="text" class="altitude" fieldtype_id="63">
                    </p>
                    <p>
                        <label for="direction">Street Direction</label>
                        <input id="direction" name="Street Direction" type="text" class="notnumber" fieldtype_id="64">
                    </p>
                    <p>
                        <label for="onstreet">On Street</label>
                        <input id="onstreet" name="On Street" type="text" fieldtype_id="65">
                    </p>
                    <p>
                        <label for="crossstreet">Cross Street</label>
                        <input id="crossstreet" name="Cross Street" type="text" fieldtype_id="66">
                    </p>
                    <p>
                        <label for="atorbetween">At, Between or Opposite</label>
                        <select id="atorbetween" name="At, Between or Opposite" fieldtype_id="67">
                            <option value="0">[Select]</option>
                            <option value="61">At</option>
                            <option value="62">Between</option>
                            <option value="63">Opposite</option>
                        </select>
                    </p>
                    <p>
                        <label for="betweenstreet">Between Street</label>
                        <input id="betweenstreet" name="Between Street" type="text" fieldtype_id="68">
                    </p>
                    <p>
                        <label for="nearfarmid">Near, Far or Mid-block</label>
                        <select id="nearfarmid" name="Near, Far or Mid-block" fieldtype_id="69">
                            <option value="0">[Select]</option>
                            <option value="64">Near</option>
                            <option value="65">Far</option>
                            <option value="66">Mid-block</option>
                            <!--  New values-->
                            <option value="72">Not near an intersection</option>
                            <option value="73">Freeway bus pad</option> <!-- End NEW -->
                        </select>
                    </p>
                    <p>
                        <label for="jurisdiction">Jurisdiction</label>
                        <input id="jurisdiction" name="Jurisdiction" type="text" fieldtype_id="70">
                    </p>

                    <!-- New Fields Start -->
                    <p>
                        <label for="purposeofstop">What is the purpose of the stop?</label>
                        <select id="purposeofstop" name="What is the purpose of the stop" fieldtype_id="72">
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
                        <label for="distancetocurb">Distance from the bus stop to curb of cross street(e.g 5 feet 2 inches is 5'2")</label>
                        <input id="distancetocurb" name="Distance from the bus stop to curb of cross street" type="text" class="mesaurements" fieldtype_id="73">
                    </p>
                    <p>
                        <label for="adjacentproperty">What type of property is adjacent to the bus stop?</label><br />
                        <table>
                            <tr>
                                <td><input type="checkbox" name="What type of property is adjacent to the bus stop" value="82" fieldtype_id="74">Apartment Building</td>
                                <td><input type="checkbox" name="What type of property is adjacent to the bus stop" value="83" fieldtype_id="74">Day Care</td>
                                <td><input type="checkbox" name="What type of property is adjacent to the bus stop" value="84" fieldtype_id="74">Government Building</td>
                            </tr>

                            <tr>
                                <td><input type="checkbox" name="What type of property is adjacent to the bus stop" value="85" fieldtype_id="74">Hospital</td>
                                <td><input type="checkbox" name="What type of property is adjacent to the bus stop" value="86" fieldtype_id="74">Human Service Agency</td>
                                <td><input type="checkbox" name="What type of property is adjacent to the bus stop" value="87" fieldtype_id="74">Industrial Site/Bldg.</td>
                            </tr>

                            <tr>
                                <td><input type="checkbox" name="What type of property is adjacent to the bus stop" value="88" fieldtype_id="74">Library</td>
                                <td><input type="checkbox" name="What type of property is adjacent to the bus stop" value="89" fieldtype_id="74">Mall/Shopping Center</td>
                                <td><input type="checkbox" name="What type of property is adjacent to the bus stop" value="90" fieldtype_id="74">Nursing Home</td>
                            </tr>

                            <tr>
                                <td><input type="checkbox" name="What type of property is adjacent to the bus stop" value="91" fieldtype_id="74">Office Building</td>
                                <td><input type="checkbox" name="What type of property is adjacent to the bus stop" value="92" fieldtype_id="74">Park</td>
                                <td><input type="checkbox" name="What type of property is adjacent to the bus stop" value="93" fieldtype_id="74">Park and Ride</td>
                            </tr>

                            <tr>
                                <td><input type="checkbox" name="What type of property is adjacent to the bus stop" value="94" fieldtype_id="74">Place of Worship</td>
                                <td><input type="checkbox" name="What type of property is adjacent to the bus stop" value="95" fieldtype_id="74">Residence-townhouse</td>
                                <td><input type="checkbox" name="What type of property is adjacent to the bus stop" value="96" fieldtype_id="74">Residence-detached</td>
                            </tr>

                            <tr>
                                <td><input type="checkbox" name="What type of property is adjacent to the bus stop" value="97" fieldtype_id="74">Retail Store</td>
                                <td><input type="checkbox" name="What type of property is adjacent to the bus stop" value="98" fieldtype_id="74">School</td>
                                <td><input type="checkbox" name="What type of property is adjacent to the bus stop" value="99" fieldtype_id="74">Supermarket</td>
                            </tr>

                            <tr>
                                <td><input type="checkbox" name="adjacentproperty" value="100" fieldtype_id="74">Transit station/center</td>
                                <td><input type="checkbox" name="adjacentproperty" value="101" fieldtype_id="74">Vacant lot</td>
                            </tr>
                        </table>
                    </p>
                    <p>
                        <label for="distancefrompreviousbusstop">Distance from previous bus stop (e.g 5 feet 2 inches is 5'2")</label>
                        <input id="distancefrompreviousbusstop" name="Distance from previous bus stop" type="text" class="mesaurements" fieldtype_id="75">
                    </p>

                    <!-- New Fields End  -->
                </div>

                <h2>Boarding & Alighting</h2>
                <div id="section2">
                    <p>
                        <label for="surfacetype">What is the Surface Type?</label>
                        <select id="surfacetype" name="What is the Surface Type" fieldtype_id="1">
                            <option value="0">[Select]</option>
                            <option value="15">Asphalt</option>
                            <option value="16">Concrete</option>
                            <option value="17">Grass</option>
                            <option value="18">Dirt</option>
                        </select>
                    </p>
                    <p>
                        <label for="surfacefirm">Is the surface firm?</label>
                        <input type="radio" id="surfacefirm1" name="Is the surface firm" value="12" fieldtype_id="2">Yes
                        <input type="radio" name="Is the surface firm" value="13" fieldtype_id="2">No
                        <input type="radio" name="Is the surface firm" value="14" fieldtype_id="2">Not Applicable
                    </p>
                    <p>
                        <label for="arealevel">Parallel to the roadway, is the slope of the bus stop boarding and alighting area the same as the roadway?</label><br/>
                        <input type="radio" id="arealevel" name="Parallel to the roadway, is the slope of the bus stop boarding and alighting area the same as the roadway" value="12" fieldtype_id="3">Yes
                        <input type="radio" name="Parallel to the roadway, is the slope of the bus stop boarding and alighting area the same as the roadway" value="13" fieldtype_id="3">No
                        <input type="radio" name="Parallel to the roadway, is the slope of the bus stop boarding and alighting area the same as the roadway" value="14" fieldtype_id="3">Not Applicable
                    </p>
                    <p>
                        <label for="arealevel">Perpendicular to the roadway, is the slope of the bus stop boarding and alighting area <= 2.0%? </label><br/>
                        <input type="radio" id="arealevel" name="Perpendicular to the roadway, is the slope of the bus stop boarding and alighting area <= 2.0%" value="12" fieldtype_id="5">Yes
                        <input type="radio" name="Perpendicular to the roadway, is the slope of the bus stop boarding and alighting area <= 2.0%" value="13" fieldtype_id="5">No
                        <input type="radio" name="Perpendicular to the roadway, is the slope of the bus stop boarding and alighting area <= 2.0%" value="14" fieldtype_id="5">Not Applicable
                    </p>
                    <p>
                        <label for="dedicatedpad">Is there a dedicated pad?</label>
                        <input type="radio" id="dedicatedpad" name="Is there a dedicated pad" value="12" fieldtype_id="4">Yes
                        <input type="radio" name="Is there a dedicated pad" value="13" fieldtype_id="4">No
                        <input type="radio" name="Is there a dedicated pad" value="14" fieldtype_id="4">Not Applicable
                    </p>
                    <p>
                        <label for="padwidth">What is the Bus Stop Width?(e.g 5 feet 2 inches is 5'2")</label>
                        <input id="padwidth" name="What is the Bus Stop Width" type="text" class="mesaurements" fieldtype_id="6">
                    </p>
                    <p>
                        <label for="paddepth">What is the Bus Stop Depth?(e.g 5 feet 2 inches is 5'2")</label>
                        <input id="paddepth" name="What is the Bus Stop Depth" type="text" class="mesaurements" fieldtype_id="7">
                    </p>
                    <p>
                        <label for="freeobstruction">Is it free of Obstructions?</label>
                        <input type="radio" id="freeobstruction" name="Is it free of Obstructions" value="12" fieldtype_id="8">Yes
                        <input type="radio" name="Is it free of Obstructions" value="13" fieldtype_id="8">No
                        <input type="radio" name="Is it free of Obstructions" value="14" fieldtype_id="8">Not Applicable
                    </p>
                    <p>
                        <label for="adacompliant">Is it ADA Compliant?</label>
                        <input type="radio" id="adacompliant" name="Is it ADA Compliant" value="30" fieldtype_id="19">Yes
                        <input type="radio" name="Is it ADA Compliant" value="31" fieldtype_id="19">No, Needs Correction
                        <input type="radio" name="Is it ADA Compliant" value="32" fieldtype_id="19">No, Pre-dates ADA
                    </p>
                    <p>
                        <label for="comments">Any Comments</label>
                        <textarea id="comments" name="Any Comments" fieldtype_id="20" rows="5" cols="50"></textarea>
                    </p>
                    <p>
                        <label for="otherinfo">Other Information</label>
                        <textarea id="otherinfo" name="Other Information" fieldtype_id="23" rows="5" cols="50"></textarea>
                    </p>
                    <p>
                        <label for="fileInput">Upload Photos</label>
                        <input type="file" id="fileInput" name="Image" fieldtype_id="71" accept="image/*" capture="camera" multiple />
                        <label id="fileError" class="error"></label>
                    </p>
                </div>

                <h2>Shelter</h2>
                <div id="section3">
                    <p>
                        <label for="shelterpresent">Is a Shelter present?</label>
                        <input type="radio" id="shelterpresent" name="Is a Shelter present" value="12" fieldtype_id="24">Yes
                        <input type="radio" name="Is a Shelter present" value="13" fieldtype_id="24">No
                        <input type="radio" name="Is a Shelter present" value="14" fieldtype_id="24">Not Applicable
                    </p>
                    <p>
                        <label for="sheltertype">Which type of Shelter</label>
                        <select id="sheltertype" name = "Which type of Shelter" fieldtype_id="28">
                            <option value="0">[Select]</option>
                            <option value="38">Metro Type 1</option>
                            <option value="39">Metro Type 2</option>
                            <option value="40">Metro Type 3</option>
                            <option value="41">Other</option>
                        </select>
                    </p>
                    <p>
                        <label for="wcspacelocated">Is a Wheelchair Space located within the shelter?</label>
                        <input type="radio" id="wcspacelocated" name="Is a Wheelchair Space located within the shelter" value="12" fieldtype_id="29">Yes
                        <input type="radio" name="Is a Wheelchair Space located within the shelter" value="13" fieldtype_id="29">No
                        <input type="radio" name="Is a Wheelchair Space located within the shelter" value="14" fieldtype_id="29">Not Applicable
                    </p>
                    <p>
                        <label for="wcspacepermit">Is the Wheelchair Space located so as to permit a wheelchair or mobility aid user to enter from the public way? </label><br/>
                        <input type="radio" id="wcspacepermit" name="Is the Wheelchair Space located so as to permit a wheelchair or mobility aid user to enter from the public way" value="12" fieldtype_id="30">Yes
                        <input type="radio" name="Is the Wheelchair Space located so as to permit a wheelchair or mobility aid user to enter from the public way" value="13" fieldtype_id="30">No
                        <input type="radio" name="Is the Wheelchair Space located so as to permit a wheelchair or mobility aid user to enter from the public way" value="14" fieldtype_id="30">Not Applicable
                    </p>
                    <p>
                        <label for="surfacetype">What is the Surface Type?</label>
                        <select id="surfacetype" name="What is the Surface Type" fieldtype_id="1">
                            <option value="0">[Select]</option>
                            <option value="15">Asphalt</option>
                            <option value="16">Concrete</option>
                            <option value="17">Grass</option>
                            <option value="18">Dirt</option>
                        </select>
                    </p>
                    <p>
                        <label for="surfacefirm">Is the surface firm?</label>
                        <input type="radio" id="surfacefirm2" name="Is the surface firm" value="12" fieldtype_id="2">Yes
                        <input type="radio" name="Is the surface firm" value="13" fieldtype_id="2">No
                        <input type="radio" name="Is the surface firm" value="14" fieldtype_id="2">Not Applicable
                    </p>
                    <p>
                        <label for="freeobstruction">Is entry into the Shelter free of Obstructions?</label>
                        <input type="radio" id="freeobstruction" name="Is entry into the Shelter free of Obstructions" value="12" fieldtype_id="18">Yes
                        <input type="radio" name="Is entry into the Shelter free of Obstructions" value="13" fieldtype_id="18">No
                        <input type="radio" name="Is entry into the Shelter free of Obstructions" value="14" fieldtype_id="18">Not Applicable
                    </p>
                    <!-- New Fields -->
                    <p>
                        <label for="distancefromsheltertocurb">Whats is the disance from shelter to curb?(e.g 5 feet 2 inches is 5'2")</label>
                        <input type="text" class="mesaurements" id="distancefromsheltertocurb" name="Whats is the disance from shelter to curb" fieldtype_id="76">
                    </p>
                    <p>
                        <label for="clearspacemeasurements">Clear Space Measurements for Wheelchair Space, entirely within the perimeter of the shelter</label><br/>
                        <input type="text" id="clearspacemeasurements" name="Clear Space Measurements for Wheelchair Space, entirely within the perimeter of the shelter" fieldtype_id="77">
                    </p>
                    <p>
                        <label for="comments">Any Comments</label>
                        <textarea id="comments" name="Any Comments" fieldtype_id="20" rows="5" cols="50"></textarea>
                    </p>
                    <p>
                        <label for="otherinfo">Other Information</label>
                        <textarea id="otherinfo" name="Other Information" fieldtype_id="23" rows="5" cols="50"></textarea>
                    </p>
                    <p>
                        <label for="fileInput">Upload Photos</label>
                        <input type="file" id="fileInput" name="Image" fieldtype_id="71" accept="image/*" capture="camera" multiple />
                        <label id="fileError" class="error"></label>
                    </p>
                </div>

                <h2>Path of travel #1</h2>
                <div id="section4">
                    <p>
                        <label for="intersectiontype">What is the type of Intersection?</label>
                        <select id="intersectiontype" name="What is the type of Intersection" fieldtype_id="37">
                            <option value="0">[Select]</option>
                            <option value="51">4-way Intersection</option>
                            <option value="52">T-Intersection</option>
                            <option value="53">Other</option>
                        </select>
                    </p>
                    <p>
                        <label for="roadparallel">Road Parallel to the Bus Stop?</label>
                        <input id="roadparallel" name="Road Parallel to the Bus Stop" type="text" fieldtype_id="38">
                    </p>
                    <p>
                        <label for="roadperpendicular">Road Perpendicular to the Bus Stop?</label>
                        <input id="roadperpendicular" name="Road Perpendicular to the Bus Stop" type="text" fieldtype_id="39">
                    </p>
                    <p>
                        <label for="description">Description</label>
                        <textarea id="description" name="Description" fieldtype_id="40" rows="5" cols="50"></textarea>
                    </p>
                    <p>
                        <label for="pathwaytype">What is the type of Pathway?</label>
                        <select id="pathwaytype" name="What is the type of Pathway" fieldtype_id="41">
                            <option value="0">[Select]</option>
                            <option value="19">Sidewalk</option>
                            <option value="20">Berm of Road</option>
                            <option value="21">None</option>
                        </select>
                    </p>
                    <p>
                        <label for="pathfunctional">Is access to the Path functional?</label>
                        <input type="radio" id="pathfunctional" name="Is access to the Path functional" value="12" fieldtype_id="42">Yes
                        <input type="radio" name="Is access to the Path functional" value="13" fieldtype_id="42">No
                        <input type="radio" name="Is access to the Path functional" value="14" fieldtype_id="42">Not Applicable
                    </p>
                    <p>
                        <label for="lightcontrolled">Is the traffic light controlled?</label>
                        <input type="radio" id="lightcontrolled" name="Is the traffic light controlled" value="12" fieldtype_id="43">Yes
                        <input type="radio" name="Is the traffic light controlled" value="13" fieldtype_id="43">No
                        <input type="radio" name="Is the traffic light controlled" value="14" fieldtype_id="43">Not Applicable
                    </p>
                    <p>
                        <label for="pedcontrols">Are there any pedestrian controls?</label>
                        <input type="radio" id="pedcontrols" name="Are there any pedestrian controls" value="12" fieldtype_id="44">Yes
                        <input type="radio" name="Are there any pedestrian controls" value="13" fieldtype_id="44">No
                        <input type="radio" name="Are there any pedestrian controls" value="14" fieldtype_id="44">Not Applicable
                    </p>
                    <p>
                        <label for="functionalcurbramps">Are the curb ramps functional?</label>
                        <input type="radio" id="functionalcurbramps" name="Are the curb ramps functional" value="12" fieldtype_id="45">Yes
                        <input type="radio" name="Are the curb ramps functional" value="13" fieldtype_id="45">No
                        <input type="radio" name="Are the curb ramps functional" value="14" fieldtype_id="45">Not Applicable
                    </p>
                    <p>
                        <label for="midcrossingislands">Are the mid crossing islands present?</label>
                        <input type="radio" id="midcrossingislands" name="Are the mid crossing islands present" value="12" fieldtype_id="48">Yes
                        <input type="radio" name="Are the mid crossing islands present" value="13" fieldtype_id="48">No
                        <input type="radio" name="Are the mid crossing islands present" value="14" fieldtype_id="48">Not Applicable
                    </p>
                    <p>
                        <label for="cutthroughs">Are there any cut throughs provided?</label>
                        <input type="radio" id="cutthroughs" name="Are there any cut throughs provided" value="12" fieldtype_id="49">Yes
                        <input type="radio" name="Are there any cut throughs provided" value="13" fieldtype_id="49">No
                        <input type="radio" name="Are there any cut throughs provided" value="14" fieldtype_id="49">Not Applicable
                    </p>
                    <p>
                        <label for="functionalaccess">Is the access to intersection functional?</label>
                        <input type="radio" id="functionalaccess" name="Is the access to intersection functional" value="12" fieldtype_id="50">Yes
                        <input type="radio" name="Is the access to intersection functional" value="13" fieldtype_id="50">No
                        <input type="radio" name="Is the access to intersection functional" value="14" fieldtype_id="50">Not Applicable
                    </p>
                    <p>
                        <label for="sidewalkwidth">What is sidewalk's width at narrowest point?(e.g 5 feet 2 inches is 5'2")</label>
                        <input type="text" class="mesaurements" id="sidewalkwidth" name="What is sidewalk's width at narrowest point" fieldtype_id="93">
                    </p>
                    <p>
                        <label for="sidewalkslopepl">What is sidewalk's slope, measured parallel to the vehicle roadway?(in %)</label>
                        <input type="text" class="slope" id="sidewalkslopep1" name="What is sidewalk's slope, measured parallel to the vehicle roadway" fieldtype_id="94">
                    </p>
                    <p>
                        <label for="roadwayslope">What is adjacent roadway slope, measured along curb or gutter?(in %)</label>
                        <input type="text" class="slope" id="roadwayslope" name="What is adjacent roadway slope, measured along curb or gutter" fieldtype_id="104">
                    </p>
                    <p>
                        <label for="sidewalkslopepp">What is sidewalk's slope, measured perpendicular to the vehicle roadway?(in %)</label>
                        <input type="text" class="slope" id="sidewalkslopep" name="What is sidewalk's slope, measured perpendicular to the vehicle roadway" fieldtype_id="105">
                    </p>
                    <p>
                        <label for="obstacles">Obstacle type</label>
                        <select id="obstacles1" name="Obstacle type" fieldtype_id="97">
                            <option value="0">[Select]</option>
                            <option value="112">PO Box</option>
                            <option value="113">Newspaper</option>
                            <option value="114">Light Pole</option>
                            <option value="115">Trash</option>
                            <option value="116">Utility Box</option>
                        </select>
                        <button id="buttonObst1" type="button" onclick="obstBut1()">Add</button>
                    </p>

                    <p id="obstaclesm1">
                    </p>
                    <p>
                        <label for="connectsidestop">Is sidewalk seemlessly connected to bus stop area?</label>
                        <input type="radio" id="connectsidestop" name="Is sidewalk seemlessly connected to bus stop area" value="12" fieldtype_id="96">Yes
                        <input type="radio" name="Is sidewalk seemlessly connected to bus stop area" value="13" fieldtype_id="96">No
                        <input type="radio" name="Is sidewalk seemlessly connected to bus stop area" value="14" fieldtype_id="96">Not Applicable
                    </p>
                    <p>
                        <label for="conditionofsidewalk">Condition of sidewalk</label>
                        <select id="conditionofsidewalk" name="Condition of sidewalk" fieldtype_id="95">
                            <option value="0">[Select]</option>
                            <option value="67">1</option>
                            <option value="68">2</option>
                            <option value="69">3</option>
                            <option value="70">4</option>
                            <option value="71">5</option>
                        </select>
                    </p>
                    <p>
                        <label for="iscurbramp">Is there a Curb Ramp at the intersection?</label>
                        <input type="radio" id="iscurbramp" name="Is there a Curb Ramp at the intersection" value="12" fieldtype_id="98">Yes
                        <input type="radio" name="Is there a Curb Ramp at the intersection" value="13" fieldtype_id="98">No
                        <input type="radio" name="Is there a Curb Ramp at the intersection" value="14" fieldtype_id="98">Not Applicable
                    </p>
                    <p>
                        <label for="turncateddomespresents">Are Curb Ramp turncated domes present?</label>
                        <input type="radio" id="turncateddomespresents" name="Are Curb Ramp turncated domes present" value="12" fieldtype_id="99">Yes
                        <input type="radio" name="Are Curb Ramp turncated domes present" value="13" fieldtype_id="99">No
                        <input type="radio" name="Are Curb Ramp turncated domes present" value="14" fieldtype_id="99">Not Applicable
                    </p>
                    <p>
                        <label for="curbrampwidth">Curb Ramp width, measured between flares(e.g 5 feet 2 inches is 5'2")</label>
                        <input type="text" class="mesaurements" id="curbrampwidth" name="Curb Ramp width, measured between flares" fieldtype_id="100">
                    </p>
                    <p>
                        <label for="curbrampslope">Curb Ramp Running Slope(in %)</label>
                        <input type="text" class="slope" id="curbrampslope" name="Curb Ramp Running Slope" fieldtype_id="101">
                    </p>
                    <p>
                        <label for="curbrampcrossslope">Curb Ramp Cross Slope(in %)</label>
                        <input type="text" class="slope" id="curbrampcrossslope" name="Curb Ramp Cross Slope" fieldtype_id="106">
                    </p>
                    <p>
                        <label for="oppcornerobserve">Opposite corner observations</label>
                        <select id="oppcornerobserve" name="Opposite corner observations" fieldtype_id="102">
                            <option value="0">[Select]</option>
                            <option value="119">Curb Ramp</option>
                            <option value="120">Truncated Domes</option>
                        </select>
                    </p>
                    <p>
                        <label for="crosswalkobserve">Crosswalk observations</label>
                        <select id="crosswalkobserve" name="Crosswalk observations" fieldtype_id="103">
                            <option value="0">[Select]</option>
                            <option value="119">Curb Ramp</option>
                            <option value="120">Truncated Domes</option>
                        </select>
                    </p>
                    <p>
                        <label for="comments">Any Comments</label>
                        <textarea id="comments" name="Any Comments" fieldtype_id="20" rows="5" cols="50"></textarea>
                    </p>
                    <p>
                        <label for="otherinfo">Other Information</label>
                        <textarea id="otherinfo" name="Other Information" fieldtype_id="23" rows="5" cols="50"></textarea>
                    </p>
                    <p>
                        <label for="fileInput">Upload Photos</label>
                        <input type="file" id="fileInput" name="Image" fieldtype_id="71" accept="image/*" capture="camera" multiple />
                        <label id="fileError" class="error"></label>
                    </p>
                </div>

                <h2>Path of travel #2</h2>
                <div id="section5">
                    <p>
                        <label for="intersectiontype">What is the type of Intersection?</label>
                        <select id="intersectiontype" name="What is the type of Intersection" fieldtype_id="37">
                            <option value="0">[Select]</option>
                            <option value="51">4-way Intersection</option>
                            <option value="52">T-Intersection</option>
                            <option value="53">Other</option>
                        </select>
                    </p>
                    <p>
                        <label for="roadparallel">Road Parallel to the Bus Stop?</label>
                        <input id="roadparallel" name="Road Parallel to the Bus Stop" type="text" fieldtype_id="38">
                    </p>
                    <p>
                        <label for="roadperpendicular">Road Perpendicular to the Bus Stop?</label>
                        <input id="roadperpendicular" name="Road Perpendicular to the Bus Stop" type="text" fieldtype_id="39">
                    </p>
                    <p>
                        <label for="description">Description</label>
                        <textarea id="description" name="Description" fieldtype_id="40" rows="5" cols="50"></textarea>
                    </p>
                    <p>
                        <label for="pathwaytype">What is the type of Pathway?</label>
                        <select id="pathwaytype" name="What is the type of Pathway" fieldtype_id="41">
                            <option value="0">[Select]</option>
                            <option value="19">Sidewalk</option>
                            <option value="20">Berm of Road</option>
                            <option value="21">None</option>
                        </select>
                    </p>
                    <p>
                        <label for="pathfunctional">Is access to the Path functional?</label>
                        <input type="radio" id="pathfunctional" name="Is access to the Path functional" value="12" fieldtype_id="42">Yes
                        <input type="radio" name="Is access to the Path functional" value="13" fieldtype_id="42">No
                        <input type="radio" name="Is access to the Path functional" value="14" fieldtype_id="42">Not Applicable
                    </p>
                    <p>
                        <label for="lightcontrolled">Is the traffic light controlled?</label>
                        <input type="radio" id="lightcontrolled" name="Is the traffic light controlled" value="12" fieldtype_id="43">Yes
                        <input type="radio" name="Is the traffic light controlled" value="13" fieldtype_id="43">No
                        <input type="radio" name="Is the traffic light controlled" value="14" fieldtype_id="43">Not Applicable
                    </p>
                    <p>
                        <label for="pedcontrols">Are there any pedestrian controls?</label>
                        <input type="radio" id="pedcontrols" name="Are there any pedestrian controls" value="12" fieldtype_id="44">Yes
                        <input type="radio" name="Are there any pedestrian controls" value="13" fieldtype_id="44">No
                        <input type="radio" name="Are there any pedestrian controls" value="14" fieldtype_id="44">Not Applicable
                    </p>
                    <p>
                        <label for="functionalcurbramps">Are the curb ramps functional?</label>
                        <input type="radio" id="functionalcurbramps" name="Are the curb ramps functional" value="12" fieldtype_id="45">Yes
                        <input type="radio" name="Are the curb ramps functional" value="13" fieldtype_id="45">No
                        <input type="radio" name="Are the curb ramps functional" value="14" fieldtype_id="45">Not Applicable
                    </p>
                    <p>
                        <label for="midcrossingislands">Are the mid crossing islands present?</label>
                        <input type="radio" id="midcrossingislands" name="Are the mid crossing islands present" value="12" fieldtype_id="48">Yes
                        <input type="radio" name="Are the mid crossing islands present" value="13" fieldtype_id="48">No
                        <input type="radio" name="Are the mid crossing islands present" value="14" fieldtype_id="48">Not Applicable
                    </p>
                    <p>
                        <label for="cutthroughs">Are there any cut throughs provided?</label>
                        <input type="radio" id="cutthroughs" name="Are there any cut throughs provided" value="12" fieldtype_id="49">Yes
                        <input type="radio" name="Are there any cut throughs provided" value="13" fieldtype_id="49">No
                        <input type="radio" name="Are there any cut throughs provided" value="14" fieldtype_id="49">Not Applicable
                    </p>
                    <p>
                        <label for="functionalaccess">Is the access to intersection functional?</label>
                        <input type="radio" id="functionalaccess" name="Is the access to intersection functional" value="12" fieldtype_id="50">Yes
                        <input type="radio" name="Is the access to intersection functional" value="13" fieldtype_id="50">No
                        <input type="radio" name="Is the access to intersection functional" value="14" fieldtype_id="50">Not Applicable
                    </p>
                    <p>
                        <label for="sidewalkwidth">What is sidewalk's width at narrowest point?(e.g 5 feet 2 inches is 5'2")</label>
                        <input type="text" class="mesaurements" id="sidewalkwidth" name="What is sidewalk's width at narrowest point" fieldtype_id="93">
                    </p>
                    <p>
                        <label for="sidewalkslopepl">What is sidewalk's slope, measured parallel to the vehicle roadway?(in %)</label>
                        <input type="text" class="slope" id="sidewalkslope" name="What is sidewalk's slope, measured parallel to the vehicle roadway" fieldtype_id="94">
                    </p>
                    <p>
                        <label for="roadwayslope">What is adjacent roadway slope, measured along curb or gutter?(in %)</label>
                        <input type="text" class="slope" id="roadwayslope" name="What is adjacent roadway slope, measured along curb or gutter" fieldtype_id="104">
                    </p>
                    <p>
                        <label for="sidewalkslopepp">What is sidewalk's slope, measured perpendicular to the vehicle roadway?(in %)</label>
                        <input type="text" class="slope" id="sidewalkslope" name="What is sidewalk's slope, measured perpendicular to the vehicle roadway" fieldtype_id="105">
                    </p>
                    <p>
                        <label for="obstacles">Obstacle type</label>
                        <select id="obstacles2" name="Obstacle type" fieldtype_id=" 97">
                            <option value="0">[Select]</option>
                            <option value="112">PO Box</option>
                            <option value="113">Newspaper</option>
                            <option value="114">Light Pole</option>
                            <option value="115">Trash</option>
                            <option value="116">Utility Box</option>
                        </select>
                        <button id="buttonObst2" type="button" onclick="obstBut2()">Add</button>
                    </p>

                    <p id="obstaclesm2">
                    </p>

                    <p>
                        <label for="connectsidestop">Is sidewalk seemlessly connected to bus stop area?</label>
                        <input type="radio" id="connectsidestop" name="Is sidewalk seemlessly connected to bus stop area" value="12" fieldtype_id="96">Yes
                        <input type="radio" name="Is sidewalk seemlessly connected to bus stop area" value="13" fieldtype_id="96">No
                        <input type="radio" name="Is sidewalk seemlessly connected to bus stop area" value="14" fieldtype_id="96">Not Applicable
                    </p>
                    <p>
                        <label for="conditionofsidewalk">Condition of sidewalk</label>
                        <select id="conditionofsidewalk" name="Condition of sidewalk" fieldtype_id="95">
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
                        <select id="oppcornerobserve" name="Opposite corner observations" fieldtype_id="102">
                            <option value="0">[Select]</option>
                            <option value="119">Curb Ramp</option>
                            <option value="120">Truncated Domes</option>
                        </select>
                    </p>
                    <p>
                        <label for="crosswalkobserve">Crosswalk observations</label>
                        <select id="crosswalkobserve" name="Crosswalk observations" fieldtype_id="103">
                            <option value="0">[Select]</option>
                            <option value="119">Curb Ramp</option>
                            <option value="120">Truncated Domes</option>
                        </select>
                    </p>
                    <p>
                        <label for="comments">Any Comments</label>
                        <textarea id="comments" name="Any Comments" fieldtype_id="20" rows="5" cols="50"></textarea>
                    </p>
                    <p>
                        <label for="otherinfo">Other Information</label>
                        <textarea id="otherinfo" name="Other Information" fieldtype_id="23" rows="5" cols="50"></textarea>
                    </p>
                    <p>
                        <label for="fileInput">Upload Photos</label>
                        <input type="file" id="fileInput" name="Image" fieldtype_id="71" accept="image/*" capture="camera" multiple />
                        <label id="fileError" class="error"></label>
                    </p>
                </div>

                <h2>Bus Stop Sign</h2>
                <div id="section6">
                    <p>
                        <label for="signpresent">Is the sign present?</label>
                        <input type="radio" id="signpresent" name="Is the sign present" value="12" fieldtype_id="51">Yes
                        <input type="radio" name="Is the sign present" value="13" fieldtype_id="51">No
                        <input type="radio" name="Is the sign present" value="14" fieldtype_id="51">Not Applicable
                    </p>
                    <p>
                        <label for="mountingheight">What is the mounting height?</label>
                        <select id="mountingheight" name="What is the mounting height" fieldtype_id="52">
                            <option value="0">[Select]</option>
                            <option value="54"><= 70"</option>
                            <option value="55">> 70" but <= 120"</option>
                            <option value="56">> 120"</option>
                        </select>
                    </p>
                    <p>
                        <label for="mountingheightped">Where located along a pedestrian pathway, what is the mounting height, measured to bottom of the sign?</label><br/>
                        <select id="mountingheightped" name="Where located along a pedestrian pathway, what is the mounting height, measured to bottom of the sign" fieldtype_id="107">
                            <option value="0">[Select]</option>
                            <option value="54"><= 70"</option>
                            <option value="55">> 70" but <= 120"</option>
                            <option value="56">> 120"</option>
                        </select>
                    </p>
                    <!-- New Fields Start -->
                    <p>
                        <label for="providername">What is the provider name on the bus stop?</label>
                        <input type="text" id="providername" name="What is the provider name on the bus stop" fieldtype_id="78">
                    </p>
                    <p>
                        <label for="conditionofsignage">Condition of signage</label>
                        <select id="conditionofsignage" name="Condition of signage" fieldtype_id="79">
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
                        <select id="buszonedelinaited" name="Bus zone clearly delineated by" fieldtype_id="80">
                            <option value="0">[Select]</option>
                            <option value="102">Red Curb</option>
                            <option value="103">Sign</option>
                            <option value="104">Nothing</option>
                        </select>
                    </p>
                    <!-- New Fields End -->
                    <p>
                        <label for="otherinfo">Other Information</label>
                        <textarea id="otherinfo" name="Other Information" fieldtype_id="23" rows="5" cols="50"></textarea>
                    </p>
                    <p>
                        <label for="fileInput">Upload Photos</label>
                        <input type="file" id="fileInput" name="Image" fieldtype_id="71" accept="image/*" capture="camera" multiple />
                        <label id="fileError" class="error"></label>
                    </p>

                </div>

                <h2>Lighting</h2>
                <div id="section7">
                    <p>
                        <label for="lightpresent">Is there any light present?</label>
                        <input type="radio" id="lightpresent" name="Is there any light present" value="12" fieldtype_id="53">Yes
                        <input type="radio" name="Is there any light present" value="13" fieldtype_id="53">No
                        <input type="radio" name="Is there any light present" value="14" fieldtype_id="53">Not Applicable
                    </p>
                    <p>
                        <label for="streetlightobserve">Street light observation</label>
                        <select id="streetlightobserve" name="Street light observation" fieldtype_id="81">
                            <option value="0">[Select]</option>
                            <option value="105">In bus zone</option>
                            <option value="106">Within 50"</option>
                            <option value="107">None</option>
                        </select>
                    </p>
                    <p>
                        <label for="comments">Any Comments</label>
                        <textarea id="comments" name="Any Comments" fieldtype_id="20" rows="5" cols="50"></textarea>
                    </p>
                    <p>
                        <label for="otherinfo">Other Information</label>
                        <textarea id="otherinfo" name="Other Information" fieldtype_id="23" rows="5" cols="50"></textarea>
                    </p>
                    <p>
                        <label for="fileInput">Upload Photos</label>
                        <input type="file" id="fileInput" name="Image" fieldtype_id="71" accept="image/*" capture="camera" multiple />
                        <label id="fileError" class="error"></label>
                    </p>
                </div>

                <h2>Landscaping</h2>
                <div id="section8">
                    <p>
                        <label for="landscapingissues">Are there any landscaping issues?</label>
                        <input type="radio" id="landscapingissues" name="Are there any landscaping issues" value="12" fieldtype_id="54">Yes
                        <input type="radio" name="Are there any landscaping issues" value="13" fieldtype_id="54">No
                        <input type="radio" name="Are there any landscaping issues" value="14" fieldtype_id="54">Not Applicable
                    </p>
                    <p>
                        <label for="comments">Any Comments</label>
                        <textarea id="comments" name="Any Comments" fieldtype_id="20" rows="5" cols="50"></textarea>
                    </p>
                    <p>
                        <label for="otherinfo">Other Information</label>
                        <textarea id="otherinfo" name="Other Information" fieldtype_id="23" rows="5" cols="50"></textarea>
                    </p>
                    <p>
                        <label for="fileInput">Upload Photos</label>
                        <input type="file" id="fileInput" name="Image" fieldtype_id="71" accept="image/*" capture="camera" multiple />
                        <label id="fileError" class="error"></label>
                    </p>
                </div>

                <h2>Other Amenities</h2>
                <div id="section9">
                    <p>
                        <label for="transitinfopresent">Is the Transit Information present?</label>
                        <input type="radio" id="transitinfopresent" name="Is the Transit Information present" value="12" fieldtype_id="55">Yes
                        <input type="radio" name="Is the Transit Information present" value="13" fieldtype_id="55">No
                        <input type="radio" name="Is the Transit Information present" value="14" fieldtype_id="55">Not Applicable
                    </p>
                    <p>
                        <label for="trashcanpresent">Is there a Trash Can present?</label>
                        <input type="radio" id="trashcanpresent" name="Is there a Trash Can present" value="12" fieldtype_id="57">Yes
                        <input type="radio" name="Is there a Trash Can present" value="13" fieldtype_id="57">No
                        <input type="radio" name="Is there a Trash Can present" value="14" fieldtype_id="57">Not Applicable
                    </p>
                    <p>
                        <label for="trashcondition">What is the Condition of trash can(If Present)</label>
                        <select id="trashcondition" name="What is the Condition of trash can(If Present)" fieldtype_id="84">
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
                        <input type="radio" id="bikerackpresent" name="Is there a Bike Rack present" value="12" fieldtype_id="58">Yes
                        <input type="radio" name="Is there a Bike Rack present" value="13" fieldtype_id="58">No
                        <input type="radio" name="Is there a Bike Rack present" value="14" fieldtype_id="58">Not Applicable
                    </p>
                    <p>
                        <label for="telephone">Is there a Telephone?</label>
                        <input type="radio" id="telephone" name="Is there a Telephone" value="12" fieldtype_id="59">Yes
                        <input type="radio" name="Is there a Telephone" value="13" fieldtype_id="59">No
                        <input type="radio" name="Is there a Telephone" value="14" fieldtype_id="59">Not Applicable
                    </p>
                    <p>
                        <label for="sidewalkpresent">Is there any Sidewalk present?</label>
                        <input type="radio" id="sidewalkpresent" name="Is there any Sidewalk present" value="12" fieldtype_id="60">Yes
                        <input type="radio" name="Is there any Sidewalk present" value="13" fieldtype_id="60">No
                        <input type="radio" name="Is there any Sidewalk present" value="14" fieldtype_id="60">Not Applicable
                    </p>

                    <p>
                        <label for="seattype">What is Seating type?</label>
                        <input type="text" id="seattype" name="What is Seating type" fieldtype_id="82">
                    </p>
                    <p>
                        <label for="benchpresent">Is there any Bench present?</label>
                        <input type="radio" id="benchpresent" name="Is there any Bench present" value="12" fieldtype_id="56">Yes
                        <input type="radio" name="Is there any Bench present" value="13" fieldtype_id="56">No
                        <input type="radio" name="Is there any Bench present" value="14" fieldtype_id="56">Not Applicable
                    </p>
                    <p>
                        <label for="seatcondition">Condition of seating(If Present)</label>
                        <select id="seatcondition" name="Condition of seating(If Present)" fieldtype_id="83">
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
                        <input type="text" id="otherammenities" name="Any other amenities present" fieldtype_id="9">
                    </p>
                    <!--<p>
                        <label for="obstacletype">What is the type of obstacle?</label>
                        <input type="text" id="obstacletype" name="obstcaletype" fieldtype_id="85">
                    </p>-->
                    <p>
                        <label for="obstacles">Obstacles type</label><br />
                        <input type="checkbox" id="obstacles1" name="Obstacle type" fieldtype_id="97" value="112">PO Box<br />
                        <input type="checkbox" name="Obstacle type" fieldtype_id="97" value="113">Newspaper<br />
                        <input type="checkbox" name="Obstacle type" fieldtype_id="97" value="114">Light Pole<br />
                        <input type="checkbox" name="Obstacle type" fieldtype_id="97" value="115">Trash<br />
                        <input type="checkbox" name="Obstacle type" fieldtype_id="97" value="116">Utility Box<br />
                    </p>
                    <p>
                        <label for="comments">Any Comments</label>
                        <textarea id="comments" name="Any Comments" fieldtype_id="20" rows="5" cols="50"></textarea>
                    </p>
                    <p>
                        <label for="fileInput">Upload Photos</label>
                        <input type="file" id="fileInput" name="Image" fieldtype_id="71" accept="image/*" capture="camera" multiple />
                        <label id="fileError" class="error"></label>
                    </p>

                </div>
                <!-- New Sections -->
                <h2>Landing Area</h2>
                <div id="section10">
                    <p>
                        <label for="landingareawidth">What is landing area width, measured parallel to the vehicle roadway?(e.g 5 feet 2 inches is 5'2")</label>
                        <input type="text" class="mesaurements" id="landingareawidth" name="What is landing area width, measured parallel to the vehicle roadway" fieldtype_id="86">
                    </p>
                    <p>
                        <label for="landingarealength">What is landing area length, measured perpendicular to the curb or vehicle roadway edge?(e.g 5 feet 2 inches is 5'2")</label>
                        <input type="text" class="mesaurements" id="landingarealength" name="What is landing area length, measured perpendicular to the curb or vehicle roadway edge" fieldtype_id="87">
                    </p>
                    <p>
                        <label for="landingareaslope">What is landing area slope, measured parallel to the roadway?(in %)</label>
                        <input type="text" class="slope" id="landingareaslope" name="What is landing area slope, measured parallel to the roadway" fieldtype_id="88">
                    </p>
                    <p>
                        <label for="landingareaslopepp">What is landing area slope, measured perpendicular to the roadway?(in %)</label>
                        <input type="text" class="slope" id="landingareaslopepp" name="What is landing area slope, measured perpendicular to the roadway" fieldtype_id="108">
                    </p>
                    <p>
                        <label for="landingareapositioning">Landing area positioning is</label>
                        <select id="landingareapositioning" name="Landing area positioning is" fieldtype_id="89">
                            <option value="0">[Select]</option>
                            <option value="108">Back from sign pole</option>
                            <option value="109">Forward from sign pole</option>
                        </select>
                    </p>
                    <p>
                        <label for="materialoflanding">Material of landing area is</label>
                        <select id="materialoflanding" name="Material of landing area is" fieldtype_id="90">
                            <option value="0">[Select]</option>
                            <option value="110">Paved</option>
                            <option value="111">Unpaved</option>
                        </select>
                    </p>
                    <p>
                        <label for="landingareaobservations">Landing area surface observations</label>
                        <input type="text" id="landingareaobservations" name="Landing area surface observations" fieldtype_id="91">
                    </p>
                    <p>
                        <label for="landingpadconnecttosidewalk">Does landing pad connect to sidwealk?</label>
                        <input type="radio" id="landingpadconnecttosidewalk" name="Does landing pad connect to sidwealk" value="12" fieldtype_id="92">Yes
                        <input type="radio" name="Does landing pad connect to sidwealk" value="13" fieldtype_id="92">No
                        <input type="radio" name="Does landing pad connect to sidwealk" value="14" fieldtype_id="92">Not Applicable
                    </p>
                    <p>
                        <label for="padcurb">Is the pad adjacent to the curb? </label>
                        <input type="radio" id="padcurb" name="Is the pad adjacent to the curb" value="12" fieldtype_id="109">Yes
                        <input type="radio" name="Is the pad adjacent to the curb" value="13" fieldtype_id="109">No
                        <input type="radio" name="Is the pad adjacent to the curb" value="14" fieldtype_id="109">Not Applicable
                    </p>
                    <p>
                        <label for="squarecurb">Is there a square curb transition between the pad and roadway elevations?</label>
                        <input type="radio" id="squarecurb" name="Is there a square curb transition between the pad and roadway elevations" value="12" fieldtype_id="110">Yes
                        <input type="radio" name="Is there a square curb transition between the pad and roadway elevations" value="13" fieldtype_id="110">No
                        <input type="radio" name="Is there a square curb transition between the pad and roadway elevations" value="14" fieldtype_id="110">Not Applicable
                    </p>
                    
                    <p>
                        <label for="comments">Any Comments</label>
                        <textarea id="comments" name="Any Comments" fieldtype_id="20" rows="5" cols="50"></textarea>
                    </p>
                    <p>
                        <label for="otherinfo">Other Information</label>
                        <textarea id="otherinfo" name="Other Information" fieldtype_id="23" rows="5" cols="50"></textarea>
                    </p>
                    <p>
                        <label for="fileInput">Upload Photos</label>
                        <input type="file" id="fileInput" name="Image" fieldtype_id="71" accept="image/*" capture="camera" multiple />
                        <label id="fileError" class="error"></label>
                    </p>
                </div>
                <h2>Sidewalk</h2>
                <div id="section11">
                    <p>
                        <label for="sidewalkwidth">What is sidewalk's width at narrowest point?(e.g 5 feet 2 inches is 5'2")</label>
                        <input type="text" class="mesaurements" id="sidewalkwidth" name="What is sidewalk's width at narrowest point" fieldtype_id="93">
                    </p>
                    <p>
                        <label for="sidewalkslope2">What is sidewalk's slope, measured parallel to the vehicle roadway?(in %)</label>
                        <input type="text" class="slope" id="sidewalkslope2" name="What is sidewalk's slope, measured parallel to the vehicle roadway" fieldtype_id="94">
                    </p>
                    <p>
                        <label for="roadwayslope1">What is adjacent roadway slope, measured along curb or gutter?(in %)</label>
                        <input type="text" class="slope" id="roadwayslope1" name="What is adjacent roadway slope, measured along curb or gutter" fieldtype_id="104">
                    </p>
                    <p>
                        <label for="sidewalkslopep3">What is sidewalk's slope, measured perpendicular to the vehicle roadway?(in %)</label>
                        <input type="text" class="slope" id="sidewalkslope3" name="What is sidewalk's slope, measured perpendicular to the vehicle roadway" fieldtype_id="105">
                    </p>
                    <p>
                        <label for="changelevel">Are changes in level without edge treatment <= 1/4 inch vertical?</label>
                        <input type="radio" id="changelevel" name="Are changes in level without edge treatment <= ¼ inch vertical" value="12" fieldtype_id="111">Yes
                        <input type="radio" name="Are changes in level without edge treatment <= ¼ inch vertical" value="13" fieldtype_id="111">No
                        <input type="radio" name="Are changes in level without edge treatment <= ¼ inch vertical" value="14" fieldtype_id="111">Not Applicable
                    </p>
                    <p>
                        <label for="changelevelbeveled">Are changes in level between 1/4 inch and 1/2 inch beveled with a slope <= 1V:2H?</label><br/>
                        <input type="radio" id="changelevelbeveled" name="Are changes  in  level  between  ¼  inch  and  ½  inch  beveled  with  a  slope <= 1V:2H" value="12" fieldtype_id="112">Yes
                        <input type="radio" name="Are changes  in  level  between  ¼  inch  and  ½  inch  beveled  with  a  slope <= 1V:2H" value="13" fieldtype_id="112">No
                        <input type="radio" name="Are changes  in  level  between  ¼  inch  and  ½  inch  beveled  with  a  slope <= 1V:2H" value="14" fieldtype_id="112">Not Applicable
                    </p>
                    <p>
                        <label for="conditionofsidewalk">Condition of sidewalk</label>
                        <select id="conditionofsidewalk" name="Condition of sidewalk" fieldtype_id="95">
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
                        <textarea id="comments" name="Any Comments" fieldtype_id="20" rows="5" cols="50"></textarea>
                    </p>
                    <p>
                        <label for="otherinfo">Other Information</label>
                        <textarea id="otherinfo" name="Other Information" fieldtype_id="23" rows="5" cols="50"></textarea>
                    </p>
                    <p>
                        <label for="fileInput">Upload Photos</label>
                        <input type="file" id="fileInput" name="Image" fieldtype_id="71" accept="image/*" capture="camera" multiple />
                        <label id="fileError" class="error"></label>
                    </p>
                </div>
            </div>
            <input type="hidden" name="busstopData" id="busstopData" />
        </form>
    </div>
    <script src="scripts/parse.js"></script>
    <script src="scripts/mainpage.js"></script>
    <script type="text/javascript">

        $("#myform").validate();
        $.validator.addClassRules({
            mesaurements: {
            	pattern: /^\d?\d+'(\d|1[01])("|'')$/
            },
            slope: {
                number: true,
                max: 100,
                min: 0
            },
            location: {
                number: true,
                required: true
            },
            altitude: {
                number: true
            },
            digitsReq: {
                required: true,
                digits: true
            },
            notnumber: {
                pattern: /[a-zA-Z]/
            }

        });
    </script>
</body>
