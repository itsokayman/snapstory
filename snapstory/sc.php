<?php
// variable declarations //
$archive = "ENTER SAVE AREA PATH";

// enter the dir for the snapchat.php //
require_once("ENTER THE LOCATION OF THE SNAPCHAT.PHP FILE... HINT: its in the src");

//////////// CONFIG ////////////
$username = ""; // Your snapchat username
$password = ""; // Your snapchat password
$gEmail   = ""; // Gmail account
$gPasswd  = ""; // Gmail account password (THE APP PASSWORD)
$debug = true; // Set this to true if you want to see all outgoing requests and responses from server
////////////////////////////////

// a bit scrapy but basically just takes a random file from a pic directry //
$dir = 'ENTER THE DIRECTORY FOR THE SNAPS FOLDER INSIDE THE SRC FOLDER HERE';
$images = glob($dir . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
$randomImage = $images[array_rand($images)];

$img = $randomImage . $directory;

//Login to Snapchat with your username and password
$snapchat = new Snapchat($username, $gEmail, $gPasswd, $debug);
$snapchat->login($password);

// Set a story
$snapchat->setStory($img);
$snapchat->closeAppEvent();

// archive the imges! //
copy($img, $archive);

// deletes the img from snaps folder //
unlink($img);
?>
