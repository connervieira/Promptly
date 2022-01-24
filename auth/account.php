<!DOCTYPE html>
<?php
include("../config.php"); // Import Promptly configuration.
include("./authentication.php"); // Import DropAuth authentication.
?>
<html lang="en">
    <head>
        <title><?php echo $instance_name; ?> - Account</title>
        <link href="./stylesheets/styles.css" rel="stylesheet">

        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <?php
        if ($enabled_integrated_authentication == false) { // Check to see if the integrated authentication system has been disabled.
            echo "<p>The integrated authentication system has been disabled.</p>";
            exit();
        }
        ?>
        <h1>Account</h1>
        <a class="button" href="./signout.php">Sign Out</a>
    </body>
</html>
