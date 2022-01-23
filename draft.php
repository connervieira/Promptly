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
        <link rel="stylesheet" type="text/css" href="./styles/styles.css">
    </head>

    <body>
        <?php
        if ($username !== $admin_account) {
            echo "<p>Error: You do not have permission to make posts. Please make sure you are signed in with the correct account.</p>";
            exit();
        }
        ?>
        <div class="button-container">
            <div class='button'><a href='./index.php'>Back</a></div>
        </div>
        <h1 class="title">Blog Draft</h1> 
        <h3 class="subtitle">Create new blog post</h3>
        <form action="./createpost.php" method="post">
            <label for="posttitle">Post title: </label><input autocomplete="off" type="text" maxlength="<?php echo $max_post_title_length; ?>" placeholder="Post title" name="posttitle"><br><br>
            <label for="posttext">Post text: </label><input autocomplete="off" type="text" maxlength="<?php echo $max_post_body_length; ?>" placeholder="Post text" name="posttext"><br><br>
            <input type="submit">
        </form>
    </body>
</html>
