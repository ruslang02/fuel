<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/includes/variables.php");
if(!$installed) {
	header("Location: install");
	exit();
}
$title = "Support";
include_once ($_SERVER['DOCUMENT_ROOT'] . "/includes/header.inc.php");
include_once ($_SERVER['DOCUMENT_ROOT'] . "/includes/promo.inc.php");
?>

<div class="panel panel-default">
	<div class="panel-body">
		<div class="input-group">
			<input type="text" class="form-control" placeholder="Enter the subject or keywords you are looking for...">
			<span class="input-group-btn">
				<button class="btn btn-primary" type="button">
					<span class="glyphicon glyphicon-plus"></span> Add a new one
				</button> </span>
		</div>
	</div>
</div>
<div class="panel panel-default" id="topics">
	<div class="panel-body">
		<?php 
		$result = $sqlconn->query('SELECT *, DATE_FORMAT(DateCreated,"%b %e, %Y") FROM `topics` ORDER BY `DateCreated` DESC LIMIT 0,10');
		if($result->num_rows == 0) echo "<center><small>There are no topics yet.</small></center>"; else {
		while($row = $result->fetch_assoc()) {
			
			$result2 = $sqlconn->query('SELECT * FROM `users` WHERE `ID`=' . $row['UserCreated']);
			$row2 = $result2->fetch_assoc();
			$rating = (int) $row['Likes'] - (int) $row['Dislikes'];
			$ratingcolor;
			if($rating < 0) $ratingcolor = "label-danger";
			if($rating == 0) $ratingcolor = "label-default";
			if($rating > 0) $ratingcolor = "label-success";
			if($rating < 0) $rating = "-" . $rating;
			if($rating > 0) $rating = "+" . $rating;
			$result3 = $sqlconn->query('SELECT * FROM `comments` WHERE `TopicID`=' . $row['ID']);
			$commentsNum = $result3->num_rows;
			$dateCreated = $row['DATE_FORMAT(DateCreated,"%b %e, %Y")'];
			$result4 = $sqlconn->query("SELECT * FROM `statuses` WHERE `ID`=" . $row['Status']);
			$row4 = $result4->fetch_assoc();
			$labelcolor = $row4['Color'];
			echo <<<DOC
		<div class="media">
			<div class="media-left">
				<a href="{$root}/user?id={$row['UserCreated']}"> <img class="media-object img-circle" src="{$row2['Avatar']}"> </a>
			</div>
			<div class="media-body">
				<h5 class="media-heading"><a href="/topic?id={$row['ID']}"> {$row['Name']}</a> <span class="label {$ratingcolor} pull-right">{$rating}</span><span class="label {$labelcolor} pull-right">{$row4['Name']}</span></h5>
				<small><b><a href="{$root}/user?id={$row['UserCreated']}">{$row2['Username']}</a></b> on {$dateCreated} • <b><span class="glyphicon glyphicon-comment"></span> {$commentsNum}</b></small>
			</div>
		</div>	
		<hr>
DOC;
		}
		}
		?>
		
		
	</div>
</div>
</div>

<div class="col-lg-3 col-md-4 col-sm-4">
	<div class="panel panel-default border-warning hidden-xs">
		<div class="panel-body">
			<img src="img/biglogo.png" style="width:100%" />
		</div>
	</div>
	<div class="panel border-primary panel-default">
		<div class="panel-body">
			<h4>Community stats</h4>
			<ul id="stats">

				<li>
					<span class="badge pull-right">593</span>
					<i class="glyphicon glyphicon-user"></i> People
				</li>

				<li>
					<span class="badge pull-right">17</span>
					<i class="glyphicon glyphicon-list-alt"></i> Topics
				</li>

				<li>
					<span class="badge pull-right">51</span>
					<i class="glyphicon glyphicon-comment"></i> Comments
				</li>

				<li>
					<span class="badge pull-right">187</span>
					<i class="glyphicon glyphicon-thumbs-up"></i> Votes
				</li>

				<li>
					<span class="badge pull-right">3</span>
					<i class="glyphicon glyphicon-question-sign"></i> Support agents
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
