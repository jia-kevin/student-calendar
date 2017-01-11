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
			<h3>Welcome, <?= $firstname; ?>.</h3>
			<?php
		} else {
			?>
			<script>
			  window.location.href = "loginpage.php";
			</script>
			<?php
		}
	?>
		
	</div>

	<form class="navbar-form navbar-right" action="/login.php" method="POST">
    <input class="btn btn-default" type="button" value="Join" <?php if (!isset($_SESSION['id'])) { ?> disabled <?php } ?> onclick="joinClassPrompt();" />
    <input class="btn btn-default" type="button" value="Create" <?php if (!isset($_SESSION['id'])) { ?> disabled <?php } ?> onclick="createClassPrompt();" />
	    <input class="btn btn-info btn-sm" type="button" onclick="document.location='/logout.php'" value="Logout"/>
	</form>
	</nav>
	<div class="container">
	<div id="calendar"></div>
	</div>
</body>
</html>
