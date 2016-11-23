<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>
</head>
<body>

<form action="js/login.php" method="POST">
	<input type="text" name="uid" placeholder="Username"><br>
	<input type="password" name="pwd" placeholder="password"><br>
	<button type="submit">Log in</button>
</form>
<?php
	if (isset($_SESSION['id'])) { //isset tells you if the session has been activated
		echo $_SESSION['id'];
	} else {
		echo "You are not logged in";
	}
?>
<br><br>
<form action="js/signup.php" method="POST">
	<input type="text" name="first" placeholder="Firstname"><br>
	<input type="text" name="last" placeholder="Lastname"><br>
	<input type="text" name="uid" placeholder="Username"><br>
	<input type="password" name="pwd" placeholder="password"><br>
	<button type="submit">Sign up</button>
	<a href="calendar.html">Calendar</a>
</form>

</body>
</html>