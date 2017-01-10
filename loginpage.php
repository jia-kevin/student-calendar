<!DOCTYPE html>
<html>
<head>
	<title>login</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container" style="margin-top: 50px;">
<form class="form-horizontal" action="login.php" method="POST">
	<div class="form-group">
		<label class="col-sm-2 control-label">username</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="uid" placeholder="Username">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2 control-label">password</label>
		<div class="col-sm-8">
			<input type="password" class="form-control" name="pwd" placeholder="Password">
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-2">
			<button type="submit" class="btn btn-default">Login</button>
			<button type="submit" class="btn btn-default" onclick="window.location = '/register.php'" >Sign Up</button>
		</div>
	</div>
</form>

</div>
</body>
</html>