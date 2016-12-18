<!DOCTYPE html>
<html>
<head>
	<title>register</title>
</head>
<body>
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
					$location.url('/calendar.php');
				}
			</script>
			<a href="/calendar.php">Calendar</a>

		</div>
	</div>
</form>
</div>
</body>
</html>