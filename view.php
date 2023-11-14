<?php
include("../dropauth/authentication.php");
include("./config.php"); // Load the Promptly configuration.

$post_database = unserialize(file_get_contents('./blogpostdatabase.txt')); // Load the posts database from disk.

$post_to_view = $_GET["post"];

if (isset($post_database[$post_to_view]) == true) { // Check to make sure the specified post exists.
    $post = $post_database[$post_to_view];
} else {
    echo "<p>The requested post does not exist!</p>";
    exit();
}

?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo htmlspecialchars($promptly_config["branding"]["instance_name"]); ?> - <?php echo htmlspecialchars($post_database[$post_to_view]["title"]); ?></title>
        <link rel="stylesheet" type="text/css" href="./styles/main.css">
        <link rel="stylesheet" type="text/css" href="./styles/<?php echo $promptly_config["theme"]; ?>.css">
    </head>

    <body>
        <div style="text-align:left;">
            <a class='button' href='./index.php'>Back</a>
        </div>
        <h1 class="title"><?php echo htmlspecialchars($post["title"]); ?></h1> 
        <h3 class="subtitle"><?php echo date("F dS, Y g:i A", $post["time"]["created"]); ?></h3>
        <hr>
        <div style="text-align:left;">
            <p><?php echo $post["body"]; ?></p>
        </div>
    </body>
</html>
