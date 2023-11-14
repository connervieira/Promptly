<?php
$force_login_redirect = true;
include("../dropauth/authentication.php");
include("./config.php");

if ($_POST["theme"] == "light" or $_POST["theme"] == "dark" or $_POST["theme"] == "red" or $_POST["theme"] == "green" or $_POST["theme"] == "blue") {
    $promptly_config["theme"] = $_POST["theme"];
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo htmlspecialchars($promptly_config["branding"]["instance_name"]); ?> - Configure</title>
        <link rel="stylesheet" type="text/css" href="./styles/main.css">
        <link rel="stylesheet" type="text/css" href="./styles/<?php echo $promptly_config["theme"]; ?>.css">
    </head>

    <body>
        <?php
        if ($username !== $promptly_config["auth"]["admin_account"] and $promptly_config["auth"]["admin_account"] !== "") { // Check to see if the current user has permission to edit the configuration. Alternatively, if no administrator user is configured at all, then allow any user to edit the configuration so an administrator can be set.
            echo "<p>Error: You do not have permission to configure " . htmlspecialchars($promptly_config["branding"]["instance_name"]) . ". Please make sure you are signed in with the correct account.</p>";
            exit(); // Stop loading the page if the user isn't signed in with an account that allows them to post.
        }

        ?>

        <div style="text-align:left;">
            <a class="button" href='./index.php'>Back</a>
        </div>
        <h1 class="title">Configure</h1> 
        <h3 class="subtitle">Manage the <?php echo htmlspecialchars($promptly_config["branding"]["instance_name"]); ?> configuration</h3>
        <?php
        $config_valid = true; // This value will be changed to false in the event that an invalid configuration value is encountered.
        if (isset($_POST["theme"])) {
            if ($_POST["theme"] == "light" or $_POST["theme"] == "dark" or $_POST["theme"] == "red" or $_POST["theme"] == "green" or $_POST["theme"] == "blue") {
                $promptly_config["theme"] = $_POST["theme"];
            } else {
                echo "<p>The specified 'theme' configuration value is invalid.</p>";
                $config_valid = false;
            }

            $promptly_config["branding"]["instance_name"]; $_POST["branding>instance_name"];
            $promptly_config["branding"]["instance_tagline"]; $_POST["branding>instance_tagline"];

            $promptly_config["auth"]["pages"]["signin"] = $_POST["auth>pages>signin"];
            $promptly_config["auth"]["pages"]["signup"] = $_POST["auth>pages>signup"];
            $promptly_config["auth"]["pages"]["signout"] = $_POST["auth>pages>signout"];
            $promptly_config["auth"]["admin_account"] = $_POST["auth>admin_account"];

            $promptly_config["auth"]["admin_account"] = $_POST["auth>admin_account"];
            $promptly_config["auth"]["authorized_authors"] = array();
            if (strlen($_POST["auth>authorized_authors"]) > 0) { // Check to see if the 'auth>authorized_authors' is at least one character long.
                foreach (explode(",", $_POST["auth>authorized_authors"]) as $author) { // Iterate through each element entered by the user, separated by commas.
                    if (strlen($author) > 0) { // Make sure this element is at least one character long before adding it to the configuration.
                        array_push($promptly_config["auth"]["authorized_authors"], trim($author)); // Add this element to the configuration with any leading or trailing whitespaces removed.
                    }
                }
            }


            if ($config_valid == true) { // Make sure the configuration is valid before saving it to disk.
                file_put_contents($promptly_config_database_name, serialize($promptly_config)); // Save the updated configuration to disk.
                echo "<p>Successfully updated configuration.</p>";
            } else {
                echo "<p>The configuration was not updated.</p>"; // Inform the user that the configuration was not saved to disk. Relevant errors should be displayed during the validation process above.
            }
        }
        ?>
        <form action="./configure.php" method="post">
            <hr><h3>Theming</h3>
            <label for="theme">Theme: </label>
            <select name="theme" id="theme">
                <option value="light" <?php if ($promptly_config["theme"] == "light") { echo "selected"; } ?>>Light</option>
                <option value="dark" <?php if ($promptly_config["theme"] == "dark") { echo "selected"; } ?>>Dark</option>
                <option value="red" <?php if ($promptly_config["theme"] == "red") { echo "selected"; } ?>>Red</option>
                <option value="green" <?php if ($promptly_config["theme"] == "green") { echo "selected"; } ?>>Green</option>
                <option value="blue" <?php if ($promptly_config["theme"] == "blue") { echo "selected"; } ?>>Blue</option>
            </select><br><br>


            <hr><h3>Branding</h3>
            <label for="branding>instance_name">Instance Name:</label> <input autocomplete="off" value="<?php echo $promptly_config["branding"]["instance_name"]; ?>" type="text" maxlength="30" placeholder="Promptly" id="branding>instance_name" name="branding>instance_name"><br>
            <label for="branding>instance_tagline">Instance Tagline:</label> <input autocomplete="off" value="<?php echo $promptly_config["branding"]["instance_tagline"]; ?>" type="text" maxlength="70" placeholder="A quick, no-nonsense blogging platform." id="branding>instance_tagline" name="branding>instance_tagline"><br><br>


            <hr><h3>Authentication</h3>
            <h4>Pages</h4>
            <label for="auth>pages>signin">Sign In:</label> <input autocomplete="off" value="<?php echo $promptly_config["auth"]["pages"]["signin"]; ?>" type="text" maxlength="100" placeholder="../login.php" id="auth>pages>signin" name="auth>pages>signin"><br>
            <label for="auth>pages>signup">Sign Up:</label> <input autocomplete="off" value="<?php echo $promptly_config["auth"]["pages"]["signup"]; ?>" type="text" maxlength="100" placeholder="../signup.php" id="auth>pages>signup" name="auth>pages>signup"><br>
            <label for="auth>pages>signout">Sign Out:</label> <input autocomplete="off" value="<?php echo $promptly_config["auth"]["pages"]["signout"]; ?>" type="text" maxlength="100" placeholder="../signout.php" id="auth>pages>signout" name="auth>pages>signout"><br><br>

            <label for="auth>admin_account">Admin:</label> <input autocomplete="off" value="<?php echo $promptly_config["auth"]["admin_account"]; ?>" type="text" maxlength="100" placeholder="admin" id="auth>admin_account" name="auth>admin_account"><br>
            <label for="auth>authorized_authors">Authors:</label> <input autocomplete="off" value="<?php $authors = ""; foreach ($promptly_config["auth"]["authorized_authors"] as $author) { $authors = $authors . $author . ","; } echo substr($authors, 0, strlen($authors)-1); ?>" type="text" maxlength="100" placeholder="admin" id="auth>authorized_authors" name="auth>authorized_authors"><br><br>


            <hr><input class="button" value="Submit" type="submit">
        </form>
    </body>
</html>
