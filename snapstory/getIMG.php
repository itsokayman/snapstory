<?php
require_once("../src/snapchat.php");

//////////// CONFIG ///////////
$username = ""; // Your snapchat username
$password = ""; // Your snapchat password
$gEmail   = ""; // Gmail account
$gPasswd  = ""; // Gmail account password
$debug = false; // Set this to true if you want to see all outgoing requests and responses from server
////////////////////////////////

$snapchat = new Snapchat($username, $gEmail, $gPasswd, $debug);
$snapchat->login($password);

$snapchat->getSnaps(true);

?>