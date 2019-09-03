<?php
include 'lib/mail-message.php';
$phpSelf = htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES, "UTF-8");

$path_parts = pathinfo($phpSelf);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Hot Take</title>
        <meta charset="utf-8">
        <meta name="author" content="Noah M. Coccoluto, Bryan D. Thibault">
        <meta name="description" content="Purchasing clothes online"> 

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="../css/custom.css" type="text/css" media="Screen">

    <?php
    $debug = false;
    // This if statement allows us in the classroom to see what our variables are
    // This is NEVER done on a live site 
    if (isset($_GET["debug"])) {
        $debug = true;
    }
// %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// PATH SETUP
//
    $domain = '//';
    $server = htmlentities($_SERVER['SERVER_NAME'], ENT_QUOTES, 'UTF-8');
    $domain .= $server;
    if ($debug) {
        print '<p>php Self: ' . $phpSelf;
        print '<p>Path Parts<pre>';
        print_r($path_parts);
        print '</pre></p>';
    }
// %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// inlcude all libraries. 
// 
// Common mistake: not have the lib folder with these files.
// Google the difference between require and include
//
    print PHP_EOL . '<!-- include libraries -->' . PHP_EOL;
    require_once('lib/security.php');
    include "lib/validation-functions.php";
    print PHP_EOL . '<!-- finished including libraries -->' . PHP_EOL;
    ?>	
 </head>

    <?php
    print '<body id="' . $path_parts['filename'] . '">';

    print "<!-- ################ Start of Body ################ --!>";
    include ('header.php');
    include ('nav.php');
    ?>
   