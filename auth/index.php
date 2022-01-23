<?php
include("../config.php"); // Import Promptly configuration.
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo $instance_name; ?> - Account</title>
        <link href="./stylesheets/styles.css" rel="stylesheet">

        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <h1><?php echo $instance_name; ?> - Authentication</h1>
        <a class="button" href="./signup.php">Sign Up</a>
        <a class="button" href="./signin.php">Sign In</a>
    </body>
</html>
