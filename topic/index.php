<?php
$title = "View topic";
include_once ("../includes/header.inc.php");
$result = $sqlconn -> query('SELECT *, DATE_FORMAT(DateCreated,"%b %e, %Y") FROM `topics` WHERE `ID`=' . $_GET['id']);
$row = $result -> fetch_assoc();
$result2 = $sqlconn -> query("SELECT * FROM `users` WHERE `ID`=" . $row['UserCreated']);
$row2 = $result2 -> fetch_assoc();
$result3 = $sqlconn -> query('SELECT *, DATE_FORMAT(DateCreated,"%b %e, %Y") FROM `comments` WHERE `TopicID`=' . $_GET['id'] . ' ORDER BY `DateCreated` DESC');
$result4 = $sqlconn -> query("SELECT * FROM `statuses` WHERE `ID`=" . $row['Status']);
$row4 = $result4 -> fetch_assoc();
$labelcolor = $row4['Color'];
$rating = (int)$row['Likes'] - (int)$row['Dislikes'];
$ratingcolor;
if ($rating < 0)
	$ratingcolor = "label-danger";
if ($rating == 0)
	$ratingcolor = "label-default";
if ($rating > 0)
	$ratingcolor = "label-success";
if ($rating < 0)
	$rating = "-" . $rating;
if ($rating > 0)
	$rating = "+" . $rating;
?>

<div class="panel panel-default border-info">
	<div class="panel-body">
		<ol class="breadcrumb">
			<li>
				<a href="<?php echo $root; ?>/">Home</a>
			</li>
			<li class="active">
				<?php echo $row['Name']; ?>
			</li>
		</ol>
		
		<div class="media">
			<div class="media-left">
				<a href="<?php echo $root; ?>/user?id=<?php echo $row['UserCreated']; ?>"> <img class="media-object img-circle" src="<?php echo $row2['Avatar']; ?>"> </a>
			</div>
			<div class="media-body">
				<h4 class="media-heading"> <?php echo $row['Name']; ?> <span class="label <?php echo $ratingcolor; ?> pull-right"><?php echo $rating; ?></span><span class="label <?php echo $labelcolor; ?> pull-right"><?php echo $row4['Name']; ?></span></h4>
				<small><b><a href="<?php echo $root; ?>/user?id=<?php echo $row['UserCreated']; ?>"><?php echo $row2['Username']; ?></a></b> on <?php echo $row['DATE_FORMAT(DateCreated,"%b %e, %Y")']; ?> • <b><span class="glyphicon glyphicon-comment"></span> <?php echo $result3 -> num_rows; ?></b></small>
				<br><?php echo $row['Content']; ?>
			</div>
		</div>
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-body">
	<h4 style="margin-top:0">Comments</h4>
	<?php
		while($row = $result3->fetch_assoc()) {
			$result5 = $sqlconn -> query("SELECT * FROM `users` WHERE `ID`=" . $row['UserCreated']);
			$row2 = $result5->fetch_assoc();
			echo <<<DOC
<div class="media">
  <div class="media-left">
    <a href="{$root}/user?id={$row['UserCreated']}">
      <img class="media-object" src="{$row2['Avatar']}">
    </a>
  </div>
  <div class="media-body">
    <small><b class="media-heading"><a href="{$root}/user?id={$row['UserCreated']}">{$row2['Username']}</a></b> {$row['DATE_FORMAT(DateCreated,"%b %e, %Y")']}</small>
    <p>{$row['Content']}</p>
  </div>
</div>		
DOC;
		}
	?>
</div>
</div>	
</div>
<div class="col-lg-3 col-md-4 col-sm-4">
	<div class="panel panel-default hidden-xs border-info">
		<div class="panel-body">
			<img src="<?php echo $root; ?>/img/biglogo.png" style="width:100%" />
		</div>
	</div>
	<div class="panel panel-default border-info">
		<div class="panel-body">
			<h4>Topic stats</h4>
			<ul id="stats">
				<li>
					<span class="badge pull-right"><?php echo(int)$row['Likes']; ?></span>
					Votes
				</li>

				<li>
					<span class="badge pull-right"><?php echo $result3 -> num_rows; ?></span>
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
