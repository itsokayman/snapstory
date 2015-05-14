<?php
require_once("../src/snapchat.php");

//////////// CONFIG ///////////
$username = 'USERNAME'; // Your snapchat username
$password = 'PASSWORD'; // Your snapchat password
$gEmail   = 'GMAIL@GMAIL.COM'; // Gmail account
$gPasswd  = 'APP_PASSWORD'; // Gmail account password
$debug = true; // Set this to true if you want to see all outgoing requests and responses from server
$addback = true;
////////////////////////////////

// Login
$tmpPath = '/tmp/';
$snapchat = new Snapchat($username, $gEmail, $gPasswd, $debug);
$snapchat->login($password);

if($addback == true) 
{
    $unconfirmed = $snapchat->getUnconfirmedFriends();
    if (!is_null($unconfirmed))
  {
    print_r($unconfirmed);
    foreach($unconfirmed as $friend)
    $snapchat->addFriendBack($friend);
  }
}

$snaps = $snapchat->getSnaps();

if (!is_null($snaps))
{
    foreach($snaps as $snap) 
    {
        echo "Processing SNAP ID [" . $snap->id . "]<br />";
        $tmpFilePath = $tmpPath . $snap->id;
        file_put_contents($tmpFilePath, $snapchat->getMedia($snap->id));
        $snapchat->setStory($tmpFilePath, $snap->time);
        $snapchat->markSnapViewed($snap->id);
        unlink($tmpFilePath);
        $snapchat->sendMessage($snap->sender, "Your snap has been processed, and it should appear on this account's story. Thank you for submitting!");
        echo "Processed!<br /><br />";
    }
}

$snapchat->closeAppEvent();
?>
