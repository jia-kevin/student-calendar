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
	<script type="text/javascript" src='js/student-calendar.js'></script>
	<script type="text/javascript" src='js/newclass.js'></script>
</head>

<body>
<nav class="navbar navbar-default">
	<div class="navbar-header text-center">
	<?php 
		if (isset($_SESSION['id'])) {
			include("userinfo.php");
			$firstname = getUserInfo('firstname');
			?>
			<h3>Welcome, <?= $firstname; ?></h3>
			<?php
		} else {
			?>
			<h3 id="title">student-calendar</h3>
			<?php
		}
	?>
		
	</div>

	<form class="navbar-form navbar-right" action="/login.php" method="POST">
    <input class="btn btn-default" type="button" value="Join" <?php if (!isset($_SESSION['id'])) { ?> disabled <?php } ?> onclick="joinClassPrompt();" />
    <input class="btn btn-default" type="button" value="Create" <?php if (!isset($_SESSION['id'])) { ?> disabled <?php } ?> onclick="createClassPrompt();" />
	    <div class="input-group">
	        <input type="text" class="form-control" name="uid" placeholder="Username">
	    </div>
		<div class="input-group">
	        <input type="password" class="form-control" name="pwd" placeholder="Password">
	    </div>
		<button type="submit" class="btn btn-primary btn-sm">Log in</button>
	    <input class="btn btn-success btn-sm" type="button" onclick="document.location='/register.php'" value="Register"/>
	    <input class="btn btn-info btn-sm" type="button" onclick="document.location='/logout.php'" value="Logout"/>
	</form>
	</nav>
<?php
	// if (isset($_SESSION['id'])) { //isset tells you if the session has been activated
	// 	include("userinfo.php");
	// 	$firstname = getUserInfo('firstname');
	// 	echo "You are logged in! User: $firstname";
	// } else {
	// 	echo "You are not logged in";
	// }

	// if (!isset($_SESSION))
?>
	<div class="container">
	<div id="calendar"></div>
	</div>
</body>
</html>
