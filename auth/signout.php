<?php
include("../config.php"); // Import Promptly configuration.
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo $instance_name; ?> - Sign Out</title>
        <link href="./stylesheets/styles.css" rel="stylesheet">

        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <?php
        if ($enabled_integrated_authentication == false) { // Check to see if the integrated authentication system has been disabled.
            echo "<p>The integrated authentication system has been disabled.</p>";
            exit();
        }

        session_start(); // Start the PHP session
        if (!isset($_SESSION['loggedin'])) { // Check to see if the user is already signed in.
            echo "<p class='error'>You aren't currently signed in!</p>";
            exit();
        }

        session_unset(); // Remove all session variables.

        session_destroy(); // Destroy the session.
        ?>
        <h1>Sign Out</h1>
        <h3>You have signed out of your <?php echo $instance_name; ?> account!</h3>
        <a class="button" href="./signin.php">Sign In</a>
        <a class="button" href="../index.php">Main Page</a>
    </body>
</html>
