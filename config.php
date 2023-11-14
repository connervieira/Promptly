<?php
$promptly_config_database_name = "./blogconfig.txt";

if (is_writable(".") == false) { // Check to make sure the current directory is writable.
    echo "<p class=\"error\">The " . getcwd() . " directory is not writable to PHP.</p>";
    exit();
}

// Load and initialize the database.
if (file_exists($promptly_config_database_name) == false) { // Check to see if the database file doesn't exist.
    $promptly_configuration_database_file = fopen($promptly_config_database_name, "w") or die("Unable to create configuration database file."); // Create the file.


    $promptly_config["branding"]["instance_name"] = "Promptly"; // This setting specifies the name of the instance. It can usually be left as "Promptly", but can also be changed to better integrate with your website.
    $promptly_config["branding"]["instance_tagline"] = "A quick, no-nonsense blogging system."; // This is the tagline that is shown on the front page of your blog.

    $promptly_config["theme"] = "dark"; // This setting determines which stylesheet Promptly will use. Currently, this can be set to "light", "dark", "red", "blue", or "green".

    $promptly_config["auth"]["pages"]["signin"] = "../dropauth/login.php"; // This setting determines the login page for Promptly.
    $promptly_config["auth"]["pages"]["signup"] = "../dropauth/signup.php"; // This setting determines the signup page for Promptly.
    $promptly_config["auth"]["pages"]["signout"] = "../dropauth/signout.php"; // This setting determines the signout page for Promptly.
    $promptly_config["auth"]["admin_account"] = ""; // This setting determines a username that is permitted to create and delete all posts.
    $promptly_config["auth"]["authorized_authors"] = array(); // This setting is an array of usernames that are permitted to make posts.

    $promptly_config["post"]["title"]["length"]["max"] = 200; // This value sets the maximum amount of characters that are allowed in the title of a post.
    $promptly_config["post"]["body"]["length"]["max"] = 100000; // This value sets the maximum amount of characters that are allowed in the body of the post.
    $promptly_config["post"]["summary"]["length"] = 200; // This value sets how many characters long the post summary on the main page will be before the user fully opens the article.


    fwrite($promptly_configuration_database_file, serialize($promptly_config)); // Set the contents of the database file to the placeholder configuration.
    fclose($promptly_configuration_database_file); // Close the database file.
}

if (file_exists($promptly_config_database_name) == true) { // Check to see if the item database file exists. The database should have been created in the previous step if it didn't already exists.
    $promptly_config = unserialize(file_get_contents($promptly_config_database_name)); // Load the database from the disk.
} else {
    echo "<p class=\"error\">The configuration database failed to load</p>"; // Inform the user that the database failed to load.
    exit(); // Terminate the script.
}
?>
