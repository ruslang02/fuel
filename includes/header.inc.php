<?php
	session_start();
	error_reporting(E_ERROR);
	include_once("../includes/variables.php");
	$sqlconn = new mysqli($sqlurl,$sqluser,$sqlpass,$sqldb);
	if(!$sqlconn) {
		echo "We can't connect to MySQL Database. <br>";
		echo "Resetting data for connection... <br>";
		$res = file_put_contents($root . "/includes/variables.php",'<?php $installed = false; ?>');
		if(!$res) echo "We can't also reset data for connection... Try yourself. <br>And don't forget: ";
		echo "You will need to re-install FUEL from <a href='" . $root . "/install'>here</a>.";
	}
	$sqlconn->set_charset("utf8");
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title><?php echo $title; ?>
			- FUEL Support Page</title>
		<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="<?php echo $root; ?>/dist/style.css" />
	</head>

	<body>
		<nav class="navbar navbar-default">
			<div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="/"><span class="glyphicon glyphicon-home"></span> Demo</a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Login <span class="caret"></span></a>
							<div style="padding: 1em; width: 400px;" class="dropdown-menu">
								<form class="form-horizontal" action="<?php echo $root; ?>/login" method="post">

									<div class="form-group">
										<label class="col-sm-3 control-label" for="inputEmail3">Email</label>
										<div class="col-sm-9">
											<input class="form-control" id="inputEmail3" name="email" placeholder="Email" type="email">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label" for="inputPassword3">Password</label>
										<div class="col-sm-9">
											<input class="form-control" id="inputPassword3" name="pass" placeholder="Password" type="password">
										</div>
									</div>
									<?php if(password_verify("thisisasuperpuperhashthatworksonlyonserver"))?><p class="navbar-text">Signed in as </p>
									<div class="form-group">
										<div class="col-sm-offset-3 col-sm-9 text-right">
											<button type="submit" class="btn btn-default btn-block">
												Sign in
											</button>
										</div>
									</div>
								</form>
							</div>
						</li>
						<li>
							<a href="#">Register</a>
						</li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>
		<div class="container">
			<div class="row">
				<div class="col-lg-9 col-md-8 col-sm-8">
