<?php
include("../dropauth/authentication.php");
include("./config.php"); // Load the Promptly configuration.

if (file_exists('./blogpostdatabase.txt') == true) { // Check to see if the blog post database file exists.
    $post_database = unserialize(file_get_contents('./blogpostdatabase.txt')); // Load the posts database from disk.
} else {
    $post_database = array(); // Set the array of posts to a blank placeholder.
}
?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Blog</title>
        <link rel="stylesheet" type="text/css" href="./styles/main.css">
        <link rel="stylesheet" type="text/css" href="./styles/<?php echo $promptly_config["theme"]; ?>.css">
    </head>

    <body>
        <div class="button-container">
            <?php
            if ($username == $promptly_config["admin_account"]) { // Only show the "Create Post" option if the user is signed in as an admin.
                echo "<a class='button' href='./draft.php'>Create Post</a>";
            }
            if ($username !== null) { // Only show the "Sign Out" button if the user is signed in.
                echo "<a class='button' href='" . $promptly_config["signout_page"] . "'>Sign Out</a>";
            }
            ?>
        </div>
        <h1 class="title"><?php echo $promptly_config["instance_name"]; ?></h1> 
        <h3 class="subtitle"><?php echo $promptly_config["instance_tagline"]; ?></h3>
        <hr>
        <div class="posts-view">
            <?php
            if (sizeof($post_database) > 0) { // Check to see if there are actually any posts in the database.
                //$posts_displayed_count = 0; // This is a counter that will be incremented by one for reach post displayed.
                foreach (array_reverse(array_keys($post_database)) as $post_id) { // Iterate through the post database in reverse so that the post are displayed from the most recent to the oldest.
                    $post_displayed_count++; // Increment the displayed posts counter.
                    echo "<a href='./view.php?post=" . $post_id . "'><div class='individual-post'>";
                    echo "<h1 class='post-title'>" . $post_database[$post_id]["title"] . "</h1>"; // Show the post title.
                    echo "<p class='post-date'>" . date('Y-m-d H:i:s', $post_database[$post_id]["time"]["created"]) . "</p>"; // Show the post date text.
                    if (strlen($post_database[$post_id]["body"]) < $promptly_config["post_summary_length"]) {
                        echo "<p class='post-text'>" . $post_database[$post_id]["body"] . "</p>"; // Show the post body text.
                    } else {
                        echo "<p class='post-text'>" . substr($post_database[$post_id]["body"], 0, $promptly_config["post_summary_length"]) . "...</p>"; // Show a shortened version of the post body text.
                    }
                    if ($username == $promptly_config["admin_account"]) { // Only show the delete button if the user is signed in as the admin account.
                        echo "<a class='button' href='deletepost.php?post_to_delete=" . $post_id . "'>Delete post</a>";
                    }
                    echo "</div></a>";
                }
            } else { // If there are no posts in the database, show the user
                echo "<p>There are currently no posts!</p>";
            }
            
            ?>
        </div>
    </body>
</html>
