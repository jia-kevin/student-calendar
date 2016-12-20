<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Student Calendar</title>
	<link rel='stylesheet' href='css/fullcalendar.css' />
	<link rel='stylesheet' type='text/css' href='css/jquery-ui.css' />
	<link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/vex.css" />
    <link rel="stylesheet" href="css/vex-theme-os.css" />

    <script src="js/vex.combined.min.js"></script>
    <script> vex.defaultOptions.className = 'vex-theme-os'</script>

	<script type="text/javascript" src='js/jquery-3.1.1.js'></script>
	<script type="text/javascript" src='js/moment.js'></script>
	<script type="text/javascript" src='js/fullcalendar.js'></script>
	<script type="text/javascript" src = 'js/student-calendar.js'></script>
</head>

<body>
<nav class="navbar navbar-default">
	<div class="navbar-header">
		<h2>student-calendar</h2>
	</div>
	<form class="navbar-form navbar-right" action="/login.php" method="POST">
    <div class="input-group">
        <input type="text" class="form-control" name="uid" placeholder="Username">
    </div>
	<div class="input-group">
        <input type="password" class="form-control" name="pwd" placeholder="Password">
    </div>
    	<button type="submit" class="btn btn-default">Log in</button>
        <input class="btn btn-default" type="button" onclick="document.location='/register.php'" value="Register"/>
        <input class="btn btn-default" type="button" onclick="document.location='/logout.php'" value="Logout"/>
    </form>
</nav>
<?php
	if (isset($_SESSION['id'])) { //isset tells you if the session has been activated
		include("userinfo.php");
		$firstname = getUserInfo('firstname');
		echo "You are logged in! User: $firstname";
	} else {
		echo "You are not logged in";
	}
?>
	<div class="container">
	<div id="calendar"></div>
	</div>
</body>
</html>
