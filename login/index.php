<?php
session_start();
include_once ($_SERVER['DOCUMENT_ROOT'] . "/includes/variables.php");
$error;
if (!isset($_POST['email']) && !isset($_POST['pass'])) {
} else {
	if (!isset($_POST['email']) || !isset($_POST['pass']))
		error("You forgot to fill something...");
	$sqlconn = new mysqli($sqlurl, $sqluser, $sqlpass, $sqldb);
	$sqlconn -> set_charset("utf8");
	$result = $sqlconn -> query("SELECT * FROM `users` WHERE `Email`='" . $sqlconn -> real_escape_string($_POST['email']) . "' AND `Password`='" . $sqlconn -> real_escape_string($_POST['pass']) . "'");
	if($result->num_rows < 1)
		error("Incorrecy username or password");
	$hashresult = password_hash("thisisasuperpuperhashthatworksonlyonserver", PASSWORD_DEFAULT);
	if (!$hashresult)
		error("Can't generate hash.");
	$_SESSION['hash'] = $hashresult;
	$_SESSION['user'] = $result->fetch_assoc()['Username'];
	header("Location: " . $_SERVER['DOCUMENT_ROOT'] . "/");
	exit();
}
function error($errorText) {
	$error = $errorText;
}
?>