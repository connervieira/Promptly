<?php
include("./config.php"); // Load the Promptly configuration information.
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Blog - Delete Post</title>
        <link rel="stylesheet" type="text/css" href="./styles/<?php echo $theme; ?>.css">
    </head>
    <body>
        <?php
        // Check to see if the current user is signed in. If not, redirect them to the login page.
        session_start();
        if (isset($_SESSION['loggedin'])) {
            $username = $_SESSION['username'];
        } else {
            header("Location: .auth/signin.php");
            exit();
        }

        if ($username !== $admin_account) { // Make sure the user is signed in with the admin account.
            echo "<p>Error: You do not have permission to remove posts. Please make sure you are signed in with the correct account.</p>";
            exit();
        }

        $post_database = unserialize(file_get_contents('./blogpostdatabase.txt')); // Load the post database from the disk.


        $id_to_delete = (int)$_GET['post_to_delete']; // Get the ID number of the post to delete from the GET data.

        unset($post_database[$id_to_delete - 1]); // Delete the specified post.

        file_put_contents('./blogpostdatabase.txt', serialize($post_database)); // Save the post database to disk.

        $redirect_location = "index.php"; // Set the redirect location to the main page.
        header('Location: ' . $redirect_location); // Execute the redirect.
        ?>
    </body>
</html>
