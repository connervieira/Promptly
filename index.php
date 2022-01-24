<?php
include("./config.php"); // Load the Promptly configuration.

// Check to see if the user is signed in.
session_start();
if (isset($_SESSION['loggedin'])) {
	$username = $_SESSION['username'];
}


$post_database = unserialize(file_get_contents('./blogpostdatabase.txt')); // Load the posts database from disk.
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Blog</title>
        <link rel="stylesheet" type="text/css" href="./styles/<?php echo $theme; ?>.css">
    </head>

    <body>
        <div class="button-container">
            <?php
            if ($username == $admin_account) { // Only show the "Create Post" option if the user is signed in as an admin.
                echo "<div class='button'><a href='./draft.php'>Create Post</a></div>";
            }
            if ($username !== null) { // Only show the "Sign Out" button if the user is signed in.
                echo "<div class='button'><a href='" . $signout_page . "'>Sign Out</a></div>";
            }
            ?>
        </div>
        <h1 class="title"><?php echo $instance_name; ?></h1> 
        <h3 class="subtitle"><?php echo $instance_tagline; ?></h3>
        <hr>
        <div class="posts-view">
            <?php
            if (sizeof($post_database) > 0 ) { // Check to see if there are actually any posts in the database.
                foreach (array_reverse($post_database) as $post) { // Iterate through the post database in reverse so that the 
                    echo "<div class='individual-post'>";
                    echo "<h1>" . $post[2] . "</h1>"; // Show the post title.
                    echo "<p class='post-date'>" . $post[5] . "</p>"; // Show the post date text.
                    echo "<p class='post-text'>" . $post[1] . "</p>"; // Show the post body text.
                    if ($username == $admin_account) { // Only show the delete button if the user is signed in as the admin account.
                        echo "<a href='deletepost.php?post_to_delete=" . $post[0] . "'>Delete post</a>";
                    }
                    echo "</div>";
                }
            } else { // If there are no posts in the database, show the user
                echo "<p>There are currently no posts!</p>";
            }
            
            ?>
        </div>
    </body>
</html>
