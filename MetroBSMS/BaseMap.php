<!DOCTYPE html>
<html>
<head>
<title>Bus Stop Information</title>
<meta charset="utf-8">
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<link rel="stylesheet" href="css/styles.css">
<link href="css/modal.css" media="all" rel="stylesheet" type="text/css">
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script src="scripts/jquery.js"></script>
<script src="scripts/jquery-ui.js"></script>
<script src="scripts/markerclusterer.js"></script>
<script type="text/javascript" src="scripts/modal.js"></script>
<script src='http://crg:5000/socket.io/socket.io.js'></script>
<script src="scripts/location.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	modalDisplay('show');
});
function modalDisplay(type) {
	$('#submitbox').modal(type);
}
</script>
</head>

<body onload="GetBusStopData()">
<form id="mainform">
  <div class="header">
    <a href="/BaseMap.php" class="logo"><img src="img/site/logo.png" /></a>
    <div class="util">
      <h1 class="title">Bus Stop Managment System</h1>
      <div class="welcome">Welcome, User! | <a href="/Login.php">Logout</a></div>
    </div>
  </div>
  <img src="img/loading.gif"></img>
  <div id="map-full" class="fullmap">
  </div>
  <div class="sidebar">
    <div class="sidebar-row-upper">
      <div class="filter">
        <label for="linenumber form-label">Filter the Stops by Line Number</label>
        <input id="linenumber" name="linenumber" type="text" class="prepopulate" rel="Enter Line Number" />
        <button type="button" title="Filter" value="Filter" class="btn-primary" onclick="FilterStops(false)">Filter</button>
      </div>
      <div class="show-stops">
        <div class="divider">
          <img src="img/site/sidebar-divider.png"/>
        </div>
        <div class="checkbox">
          <label for="MyStops" class="form-label">
            <input type="checkbox" id="MyStops" name="mystops" onclick="ShowMyStops()" class="big-checkbox" />
            Show Only My Stops</label>
        </div>
        <div class="form-clear">
        </div>
        <div class="divider">
          <img src="img/site/sidebar-divider.png"/>
        </div>
      </div>
      <div class="report-stop">
        <button type="button" title="Get Location" class="btn-primary" onclick="GetLocation()">Get Current Location</button>
      </div>
      <div class="report-stop">
        <button type="button" title="Report" class="btn-primary" onclick="ReportNewStop()">Report Missing/New Stop</button>
      </div>
      <div class="report-stop">
        <button type="button" title="Upload" class="btn-primary" onclick="UploadImages()">Upload Images</button>
      </div>
    </div>
    <div class="sidebar-row-lower">
      <div class="legend">
        <div class="legend-title">
          Legend
        </div>
        <span class="legend-item">
          <img src="img/busstoptoday.png" alt="Today's Task" /> Today's Task
        </span>
        <span class="legend-item">
          <img src="img/busstopcompleted.png" alt="Completed" /> Completed
        </span>
        <span class="legend-item">
          <img src="img/busstoppending.png" alt="Pending" /> Pending
        </span>
        <span class="legend-item">
          <img src="img/busstopnotassigned.png" alt="Not Assigned" /> Not Assigned
        </span>
        <span class="legend-item">
          <img src="img/busstopmissing.png" alt="Missing" /> Missing
        </span>
        <span class="legend-item legend-item-long">
          <img src="img/cluster-icons/m2.png" alt="Cluster" /> Cluster (Click to Zoom)
        </span>
      </div>
    </div>
  </div>
  
  <!--Begin Modal Popup Layout-->
  <div class="modal fade" id="submitbox" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" >
      <div class="modal-content">
        <div class="modal-close">
          <a href="#" data-dismiss="modal"><img src="admin/images/popup-image-close.jpg" /></a>
        </div>
        <h1 class="content-header">Using the Metro Bus Management System</h1>
        <div id="contentFeature1">
          <h3 class="content-feature-header"><span>1</span>Explore the Map</h3>
          <div class="content-feature-image">
          </div>
          <p class="content-feature-text">This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet.</p>
        </div>
        <div id="contentFeature2">
          <h3 class="content-feature-header"><span>2</span>Update Information</h3>
          <div class="content-feature-image">
          </div>
          <p class="content-feature-text">This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet.</p>
        </div>
        <div id="contentFeature3">
          <h3 class="content-feature-header"><span>3</span>Use the System</h3>
          <div class="content-feature-image">
          </div>
          <p class="content-feature-text">This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet.</p>
        </div>
        <div class="modal-content-action">
          <button type="button" title="Report" class="btn-primary" onClick="modalDisplay('hide')">Start Using the System</button>
        </div>
        <div class="modal-footer">
          <div class="modal-footer-left">
            <div class="info-link">
              <a href="#">User Training Manual (PDF)</a>
            </div>
            <div class="info-link">
              <a href="#">User Training Manual (PDF)</a>
            </div>
          </div>
          <div class="modal-footer-right">
            <input type="checkbox" id="displayChoice" name="displayChoice" />
            <span>Do not show again.</span>
          </div>
          <div style="clear:both;">
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--End Modal-->
  
</form>

<!--<form id="mainform">

<img src="img/loading.gif"></img>
<div id="map-full" class="fullmap"></div>
<div class="sidebar">
	<p class="filter">
		<label for="linenumber">Filter the Stops by Line Number</label><br/>
		<input id="linenumber" name="linenumber" type="text">
		<br/>
		<input type="button" title="Filter" value="Filter" onclick="FilterStops(false)">	
	</p>
	<br/>
	<p class="mydata">	
		<input id="MyStops" name="mystops" type="checkbox" onclick="ShowMyStops()">Show My Stops only
	</p>
	<br/>
	<br/>
	<p class="index">
		<img src="img/busstopcompleted.png">Completed</img><br/>
		<img src="img/busstoptoday.png">Today's Task</img><br/>
		<img src="img/busstoppending.png">Pending</img><br/>
		<img src="img/busstopnotassigned.png">Not Assigned</img>
	</p>
	<br />
	<br /> 
	<p>
		<input type="button" class="missing" onclick="ReportNewStop()">
		<br/>
		<label> Report Missing/New Stop</label> 
	</p>
</div>
</form>--> 
<script src="scripts/basemap.js"></script>
</body>
</html>