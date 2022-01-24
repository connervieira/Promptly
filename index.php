<?php
include("./config.php");

// Check to see if the user is signed in.
session_start();
if (isset($_SESSION['loggedin'])) {
	$username = $_SESSION['username'];
}


// Load the posts database from disk.
$post_database = unserialize(file_get_contents('./blogpostdatabase.txt'));
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Blog</title>
        <link rel="stylesheet" type="text/css" href="./styles/styles.css">
    </head>

    <body>
        <div class="button-container">
            <?php
            if ($username == $admin_account) {
                echo "<div class='button'><a href='./draft.php'>Create Post</a></div>";
            }
            if ($username !== null) {
                echo "<div class='button'><a href='./auth/signout.php'>Sign Out</a></div>";
            }
            ?>
        </div>
        <h1 class="title"><?php echo $instance_name; ?></h1> 
        <h3 class="subtitle"><?php echo $instance_tagline; ?></h3>
        <hr>
        <div class="posts-view">
            <?php
            if (sizeof($post_database) > 0 ) {
                foreach (array_reverse($post_database) as $post) {
                    echo "<div class='individual-post'>";
                    echo "<h1>" . $post[2] . "</h1>"; // Show the post title.
                    echo "<p class='post-date'>" . $post[5] . "</p>"; // Show the post body text.
                    echo "<p class='post-text'>" . $post[1] . "</p>"; // Show the post body text.
                    if ($username == $admin_account) {
                        echo "<a href='deletepost.php?post_to_delete=" . $post[0] . "'>Delete post</a>";
                    }
                    echo "</div>";
                }
            } else {
                echo "<p>There are currently no posts!</p>";
            }
            
            ?>
        </div>
    </body>
</html>
