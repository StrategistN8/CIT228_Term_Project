<?php
function doDB() {
	global $mysqli;

	//connect to server and select database; you may need it
	//$mysqli = mysqli_connect("localhost", "root", "", "forumDB");
	$mysqli = mysqli_connect("localhost", "lisabalbach_lyons41", "CIT190135", "lisabalbach_Lyons");

	//if connection fails, stop script execution
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
}
?>