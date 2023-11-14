<?php
$force_login_redirect = true;
include("../dropauth/authentication.php");
include("./config.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo htmlspecialchars($promptly_config["branding"]["instance_name"]); ?> - Draft</title>
        <link rel="stylesheet" type="text/css" href="./styles/main.css">
        <link rel="stylesheet" type="text/css" href="./styles/<?php echo $promptly_config["theme"]; ?>.css">
    </head>

    <body>
        <?php
        if ($username !== $promptly_config["auth"]["admin_account"] and in_array($username, $promptly_config["auth"]["authorized_authors"]) == false) { // Check to see if the current user actually has permission to be making posts.
            echo "<p>Error: You do not have permission to make posts. Please make sure you are signed in with the correct account.</p>";
            exit(); // Stop loading the page if the user isn't signed in with an account that allows them to post.
        }
        ?>
        <div style="text-align:left;">
            <a class="button" href='./index.php'>Back</a>
        </div>
        <h1 class="title">Draft</h1> 
        <h3 class="subtitle">Create new post</h3>
        <form action="./createpost.php" method="post">
            <label for="posttitle">Post title: </label><input autocomplete="off" type="text" maxlength="<?php echo intval($promptly_config["max_post_title_length"]); ?>" placeholder="Post title" name="posttitle"><br><br>
            <label for="posttext">Post text: </label><textarea style="width:100%;height:400px;" autocomplete="off" type="text" maxlength="<?php echo intval($promptly_config["max_post_body_length"]); ?>" placeholder="Post text" id="posttext" name="posttext"></textarea><br><br>
            <input class="button" value="Post" type="submit">
        </form>
    </body>
</html>
