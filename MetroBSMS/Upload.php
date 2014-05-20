<!DOCTYPE html>
<html>
<head>
<title>Bus Stop Information</title>

<meta charset="utf-8">
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<style>

@font-face{
	font-family: Instruction;
	src: url(/fonts/Instruction.ttf) format('embedded-opentype');
}
@font-face{
	font-family: onuava;
	src:url(/fonts/onuava.ttf) format('embedded-opentype');
}
#page-wrapper {
  position:fixed;
  width: 600px;
  background: linear-gradient(to right, white, #fdfdfd);
  padding: 1em;
  margin: 1em auto;
  min-height: 300px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.8);
  border-radius:5px;
  height: 500px;
  overflow:auto;
  left:300px;
  right:300px;
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
#headertext {
 	border-radius:5px;
 	background: linear-gradient(to right, orange, #f85);
 	min-height: 40px;
 	text-align: center;
 	font-size: 20pt;
 	color:white;
 	font-family: Helvetica;
 	
}
 body {
	background-color: lightblue;

}
#buttons {
	margin-top: 30px;	
}
#button1, #button2  {
	margin: 10px;
	float:left;

	
}
#files{
	margin-top:15px;
	border-bottom:solid 1px #ddd;
	border-width: 1px;
	padding-left: 10px;
}
#choose, #Upload{
	background: linear-gradient(to right, orange, #f85);
	font-family: Helvetica;
	border-radius:5px;
	border-style: solid;  
	font-size: 17pt;
	margin: 10px;
	color: white;
	padding: 10px;
	cursor:pointer;
}
#bb{
	margin: 100px;
	margin-top:100px;
}
#fileInput {
visibility: hidden;
}
#fileNames {
	
	height:200px;
	overflow:auto;
	width:590px;
}
li {
	border-bottom:solid 1px #ddd;
	border-width: 1px;
	margin-bottom:10px;
	padding-bottom:5px;
	list-style-type:none;
	font-weight:bold;
	color:#777;
	}
.del {
	float:right;
	width:15px;
	height:15px;
	cursor:pointer;
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
var isSet=false;
$(function() {
    $("#choose").click( function(){
    	isSet=true;
		$("#fileInput").click();
        });
    
});

$(function() {
	$("#fileInput").change(function(){
		console.log($(this).get(0).files);
		$("#files").text($(this).get(0).files.length + " file(s) chosen");
		
		if($(this).get(0).files.length!=0)
		{	
			$("#files").append('<img onclick="form.reset();" class="del" src="/img/list_remove.png" alt="">');
			$("#choose").css("background","linear-gradient(to right, lightblue, #9bf) ");
			$("#fileNames > ul").children().remove();
			var i = 0;
			for(i = 0; i<$(this).get(0).files.length; i++)
			{
				$("#fileNames > ul").append("<li>"+$(this).get(0).files[i].name + '</li>');
			}
		}	
		else
		{
			$("#choose").css("background","linear-gradient(to right, orange, #f85)");
			$("#fileNames > ul").children().remove();
		}
		$(".del").click( function() {
			//console.log("WORK");
			var ua = window.navigator.userAgent;
            var msie = ua.indexOf("MSIE ");
            if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))
			{
				window.location.reload();
				console.log("WORKS");
			}
			else {
				var f = document.getElementById("Myform").reset();
			
			//$("#form")[0].reset();
			
			console.log($("#fileInput").get(0).files);
			if($("#fileInput").get(0).files.length==0)
			{
				$("#choose").css("background","linear-gradient(to right, orange, #f85)");
				$("#fileNames > ul").children().remove();
				$("#files").text("0 file(s) chosen");
			}
			}
		});
		
		});	
});



</script>

</head>

<body>
	<form action="/php/UploadImages.php" method="post" enctype="multipart/form-data" id="Myform" >
	  <div id="page-wrapper">
	    <div id="headertext">Upload Image</div>
	    <div id="buttons">
		  <div id="files">	
			No files chosen 
		  </div>
		  <div id="fileNames">
		  	<ul id="list">
		  	</ul>	
		  </div>
		  <div id="bb">
			<div id="button1">    
			  <input type="button" value="Choose Images" id="choose">
			</div>
			<div id="button2">
			  <input type="submit" id="Upload" value="Upload"/>
			</div>
		
		  </div>
		</div>
	  </div>
	  <input type="file" id="fileInput" name="fileInput[]" accept="image/*" capture="camera" multiple/>
	  <input type="hidden" name="username" id="username"/>
	</form>
	
</body>