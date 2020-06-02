<?php
$title = "Admin Panel";
include_once ("../includes/header.inc.php");
$incorrect;
$hash;
if(isset($_POST['adminsubmit'])) {
	if($_POST['pass'] === $adminpass) {
		$_SESSION['adminpass'] = password_hash($adminpass, PASSWORD_DEFAULT);
		$incorrect = false;
	} else {
		$incorrect = true;
	}
} 
if($_GET['action'] === "logout") {
	unset($_SESSION['adminpass']);
	setcookie(session_name(),"",time()-86400,"/");
	header("Location: /");
	exit();
}
?>

<div class="panel panel-default border-info">
	<div class="panel-body">
		<ol class="breadcrumb">
			<li>
				<a href="/">Home</a>
			</li>
			<li class="pull-right">
				<a href="/admin?action=logout">Exit</a>
			</li>
			<li class="active">
				Admin Panel
			</li>
		</ol>

		<h4>Manage your support system</h4>
	</div>
</div>
<?php
if(password_verify($adminpass,$_SESSION['adminpass'])) {
?>
<div class="panel panel-default border-info" id="adminpanel">
	<div class="panel-body">
		<a href="#" class="thumbnail"> <img src="/img/img1.png">
		<center>
			Organize topics
		</center> </a>
		<a href="#" class="thumbnail"> <img src="/img/img2.png">
		<center>
			Organize users
		</center> </a>
		<a href="#" class="thumbnail"> <img src="/img/img3.png">
		<center>
			Organize statuses
		</center> </a>
	</div>
</div>
</div>

<div class="col-lg-3 col-md-4 col-sm-4">

</div>
</div>
<?php
} else {
?>
<div class="panel panel-default border-info">
	<div class="panel-body">
		<form action="." method="post">
			<?php if($incorrect) echo '<div class="alert alert-danger">Password is incorrect.</div>'; ?>
			<div class="form-group">
				<label for="exampleInputPassword1">Admin Password</label>
				<input type="password" class="form-control" name="pass" id="exampleInputPassword1" placeholder="Password">
			</div>
			<a href="/" class="btn btn-link"> &lt;&lt; Back </a>
			<button type="submit" name="adminsubmit" class="btn btn-primary">
				Enter Panel
			</button>
		</form>
	</div>
</div>
<?php } ?>
<div class="col-xs-12">

	<div class="text-center">
		Customer support service by <a href="http://github.com/ruslang02/fuel">FUEL</a>
	</div>
	<br>
</div>
</div>

<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>
</html>
