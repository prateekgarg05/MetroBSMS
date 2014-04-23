
<html>
<head>
<title>Metro BSMS</title>
<link rel="stylesheet" type="text/css" media="screen" href="css/styles.css" />
<script type="text/javascript" src="scripts/jquery.js"></script> 
<script type="text/javascript" src="scripts/jquery-ui.js"></script>
<script type="text/javascript" src="scripts/base.js"></script>
<script type="text/javascript">
function Login()
{	
	$(document).ready(function() {
		var username = document.getElementById("Username").value;
		var password = document.getElementById("Password").value;

		if (username != "" && password != "")
		{
			$.get('./php/Login.php?userName='+username+'&password='+password  , function(data) {						
				if (data == '1')
					window.location.href = "BaseMap.php?username="+username;
				else if (data == '9999')
					window.location.href = "admin/Dashboard.php?username="+username;				
				else if (data == '0')
					alert ("Wrong Username/Password");
			    });
		}	
		

	});	
}

</script>
</head>
<body>
<div align="center" id="main-container" class="container" style="padding-top:10%;">
    <div id="main" style="width:400px; height:329px;">
        <div class="panel-header"><h3>Metro BSMS v1.0</h3></div>
        <div id="login" align="center">
            <form id="LogInForm">
            
            <label for="Username">Username*</label>
            <input type="text" id="Username" name="username" class="prepopulate" rel="Enter User ID">
            <label for="password">Password*</label>
            <input type="password" id="Password" name="Password" class="prepopulate" rel="Enter Password">
            <button type="button" title="Login" class="btn-primary" onclick="Login()">Login</button>
            
            </form>     
        </div>
    </div>
</div>

</body>
</html>
