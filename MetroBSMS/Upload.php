<!DOCTYPE html>
<html>
<head>
<title>Bus Stop Information</title>

<meta charset="utf-8">
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<style>

#page-wrapper {
  width: 600px;
  background: #FFF;
  padding: 1em;
  margin: 1em auto;
  min-height: 300px;
  border-top: 5px solid #69c773;
  box-shadow: 0 2px 10px rgba(0,0,0,0.8);
}

h1 {
	margin-top: 0;
}

img {
  max-width: 100%;
}

#fileDisplayArea {
  margin-top: 2em;
  width: 100%;
  overflow-x: auto;
}

</style>
<script src="scripts/jquery.js"></script> 
<script>

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

$(function() {	
	var qs = getQueryStrings();
	user = qs["username"];
	document.getElementById("username").value = user;
});
</script>
</head>

<body>

<form id="form1" action="/php/UploadImages.php" method="post" enctype="multipart/form-data">
	<div id="page-wrapper">
		<h1>Upload Images</h1>
		<div>					
			<input type="file" id="fileInput" name="fileInput[]" accept="image/*" capture="camera" multiple/>
		</div> <br />
		<input type="submit" id="Upload" value="Upload"/>
	</div>
<input type="hidden" name="username" id="username"/>
</form>
	
</body>