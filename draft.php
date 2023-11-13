<?php
include("./config.php");

// Check to see if the user is signed in.
session_start();
if (isset($_SESSION['loggedin'])) {
	$username = $_SESSION['username'];
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Blog - Draft</title>
        <link rel="stylesheet" type="text/css" href="./styles/main.css">
        <link rel="stylesheet" type="text/css" href="./styles/<?php echo $promptly_config["theme"]; ?>.css">
    </head>

    <body>
        <?php
        if ($username !== $promptly_config["admin_account"] and $promptly_config["admin_only_posting"] == true) { // Check to see if the current user actually has permission to be making posts.
            echo "<p>Error: You do not have permission to make posts. Please make sure you are signed in with the correct account.</p>";
            exit(); // Stop loading the page if the user isn't signed in with an account that allows them to post.
        }
        ?>
        <div class="button-container">
            <a class="button" href='./index.php'>Back</a>
        </div>
        <h1 class="title">Blog Draft</h1> 
        <h3 class="subtitle">Create new blog post</h3>
        <form action="./createpost.php" method="post">
            <label for="posttitle">Post title: </label><input autocomplete="off" type="text" maxlength="<?php echo $promptly_config["max_post_title_length"]; ?>" placeholder="Post title" name="posttitle"><br><br>
            <label for="posttext">Post text: </label><input autocomplete="off" type="text" maxlength="<?php echo $promptly_config["max_post_body_length"]; ?>" placeholder="Post text" name="posttext"><br><br>
            <input class="button" value="Post" type="submit">
        </form>
    </body>
</html>
