<?php
$title = "View user profile";
include_once ("../includes/header.inc.php");
$result = $sqlconn->query("SELECT * FROM `users` WHERE `ID`=" . $_GET['id']);
$row = $result->fetch_assoc();
$result2 = $sqlconn->query("SELECT * FROM `comments` WHERE `UserCreated`=" . $_GET['id']);
$numComments = $result2->num_rows;
$result3 = $sqlconn->query('SELECT * FROM `topics` WHERE `UserCreated`=' . $_GET['id']);
$numTopics = $result3->num_rows;

?>

<div class="panel panel-default border-info">
	<div class="panel-body">
		<ol class="breadcrumb">
			<li>
				<a href="<?php echo $root; ?>/">Home</a>
			</li>
			<li class="active">
				<?php echo $row['Username']; ?>
			</li>
		</ol>
		
		<h4>Your requests by status</h4>
	</div>
</div>
<div class="panel panel-default border-info" id="topics">
	<div class="panel-body">
		<br>
		<center>Section is not ready yet.</center>
		<br>
	</div>
</div>
</div>

<div class="col-lg-3 col-md-4 col-sm-4">
	<div class="panel panel-default hidden-xs border-info">
		<div class="panel-body">
			<img src="<?php echo $row['Avatar']; ?>" class="img-circle" style="width:100%" />
			<div class="text-center"><b><?php echo $row['Username']; ?></b></div>
		</div>
	</div>
	<div class="panel panel-default border-info">
		<div class="panel-body">
			<h4>User stats</h4>
			<ul id="stats">
				<li>
					<span class="badge pull-right"><?php echo $numTopics; ?></span>
					Topics
				</li>

				<li>
					<span class="badge pull-right"><?php echo $numComments; ?></span>
					Comments
				</li>
			</ul>
		</div>
	</div>
</div>
</div>
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
