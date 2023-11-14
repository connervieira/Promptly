<?php
$force_login_redirect = true;
include("../dropauth/authentication.php");
include("./config.php"); // Load the Promptly configuration information.
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo $promptly_config["branding"]["instance_name"]; ?> - Delete Post</title>
        <link rel="stylesheet" type="text/css" href="./styles/main.css">
        <link rel="stylesheet" type="text/css" href="./styles/<?php echo $promptly_config["theme"]; ?>.css">
    </head>
    <body>
        <?php
        // Check to see if the current user is signed in. If not, redirect them to the login page.
        session_start();
        if (isset($_SESSION['loggedin'])) {
            $username = $_SESSION['username'];
        } else {
            header("Location: ./auth/signin.php");
            exit();
        }
        
        $post_database = unserialize(file_get_contents('./blogpostdatabase.txt')); // Load the post database from the disk.

        $id_to_delete = intval($_GET['post_to_delete']); // Get the ID number of the post to delete from the GET data.

        if (!in_array($id_to_delete, array_keys($post_database))) {
            echo "<div style='text-align:left;'><a class='button' href='./index.php'>Back</a></div>";
            echo "<p>Error: The specified post does not exist. It may have already been deleted.</p>";
            exit(); // Stop loading the page.
        }
        if ($_GET["confirmation"] > time()) { // Check to see if the confirmation timestamp is in the future.
            echo "<div style='text-align:left;'><a class='button' href='./index.php'>Back</a></div>";
            echo "<p>Error: The confirmation timestamp is in the future. If you clicked an external link to get here, it's possible someone is trying to trick you into deleting a post.</p>";
            echo "<p>No posts were deleted.</p>";
            exit(); // Stop loading the page.
        } else if (time() - $_GET["confirmation"] < 30) { // Check to see if the confirmation timestamp is within the past 30 seconds.
            if ($username == $promptly_config["auth"]["admin_account"] or $username == $post_database[$post_id]["author"]["primary"]) { // Only show the delete button if the user is signed in as the admin account.
                unset($post_database[$id_to_delete]); // Remove the specified post from the post database.
            } else {
                echo "<p>Error: You do not have permission to remove this post. Please make sure you are signed in with the correct account.</p>";
                exit(); // Stop loading the page.
            }

            file_put_contents('./blogpostdatabase.txt', serialize($post_database)); // Save the post database to disk.

            $redirect_location = "./index.php"; // Set the redirect location to the main page.
            header('Location: ' . $redirect_location); // Execute the redirect.
        } else {
            echo "<div style='text-align:left;'><a class='button' href='./index.php'>Back</a></div>";
            echo "<p>Are you sure you would like to delete <b>" . $post_database[$id_to_delete]["title"] . "</b>?</p>";
            echo "<a class='button' href='?post_to_delete=" . $id_to_delete . "&confirmation=" . time() . "'>Confirm</a>";
            exit(); // Stop loading the page.
        }
        ?>
    </body>
</html>
