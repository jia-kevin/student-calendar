<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
<h2>Student Calendar</h2>
<div class="container">
	<form class="form-horizontal" action="login.php" method="POST">
		<div class="form-group">
			<label class="col-sm-2 control-label">Username</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" name="uid" placeholder="Username">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Password</label>
			<div class="col-sm-8">
				<input type="password" class="form-control" name="pwd" placeholder="Password">
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-default">Log in</button>
			</div>
		</div>
	</form>
	</div>
</div>
</div>
<?php
	if (isset($_SESSION['id'])) { //isset tells you if the session has been activated
		echo $_SESSION['id'];
	} else {
		echo "You are not logged in";
	}
?>
<div class="container">
<form class="form-horizontal" action="signup.php" method="POST">
	<div class="form-group">
		<label class="col-sm-2 control-label">First Name</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="first" placeholder="Firstname">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Last Name</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="last" placeholder="Lastname">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Username</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="uid" placeholder="Username">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">Password</label>
		<div class="col-sm-8">
			<input type="password" class="form-control" name="pwd" placeholder="Password">
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-2">
			<button type="submit" class="btn btn-default">Sign up</button>
			<script type="text/javascript">
				$scope.redirect = function() {
					$location.url('/calendar.html');
				}
			</script>
			<a href="/calendar.html">Calendar</a>

		</div>
	</div>
</form>
</div>

</body>
</html>