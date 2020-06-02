<?php
	if(!empty($_POST)) {
		$vars = <<<DOC
<?php
\$sqluser = '{$_POST['user']}';
\$sqlpass = '{$_POST['pass']}';
\$sqldb = '{$_POST['db']}';
\$sqlurl = '{$_POST['server']}';
\$adminpass = '{$_POST['apass']}';
\$installed = true;
\$root = '{$_POST['root']}'
?>		
DOC;
		$conn = new mysqli($_POST['server'],$_POST['user'],$_POST['pass'],$_POST['db']);
		if(!$conn) die("Sorry, but we can't connect to database, try changing something");
		$sql = file_get_contents("sql.sql");
		$arr = explode("; ",$sql);
		foreach($arr as &$value) {
			$qresult = $conn->query($value);	
			if(!$qresult) die($conn->error);
		}
		$result2 = file_put_contents($_POST['root'] . "/includes/variables.php",$vars);
		if(!$result2) die("Sorry, we can't write to includes/variables.php. Try writing manually.");
		header("Location: " . $_POST['root'] . "/");
		exit();
	}
?>
<!DOCTYPE html>
<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
<div class="container">
	<h1>Congratulations!</h1>
	<p class="lead">
		You have almost installed FUEL - an open-source alternative of UserEcho service. You just need to write your data to connect to MySQL database.
	</p>
	<form class="form-horizontal" action="." method="post">
		<div class="form-group">
			<label for="server" class="col-sm-2 control-label">Server</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" required id="server" name="server" placeholder="localhost">
			</div>
		</div>
		<div class="form-group">
			<label for="user" class="col-sm-2 control-label">Username</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" required id="user" name="user" placeholder="root">
			</div>
		</div>
		<div class="form-group">
			<label for="pass" class="col-sm-2 control-label">Password</label>
			<div class="col-sm-10">
				<input type="pass" class="form-control" id="pass" name="pass" placeholder="">
			</div>
		</div>
		<div class="form-group">
			<label for="db" class="col-sm-2 control-label">Database</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" required id="db" name="db" placeholder="fuel_db">
			</div>
		</div>
		<div class="form-group">
			<label for="apass" class="col-sm-2 control-label">Admin Panel Password</label>
			<div class="col-sm-10">
				<input type="password" class="form-control" required id="apass" name="apass" placeholder="With this password you can login to admin panel">
			</div>
		</div>
		<div class="form-group">
			<label for="root" class="col-sm-2 control-label">FUEL Root Directory</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" disabled id="root" placeholder="in root" name="root" value="<?php echo substr($_SERVER['SCRIPT_NAME'],0,strripos($_SERVER['SCRIPT_NAME'],'install') - 1);?>">
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-primary">
					Install
				</button>
			</div>
		</div>
	</form>
</div>
