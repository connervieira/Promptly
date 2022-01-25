<?php
include("./config.php");
?>
<html lang="en">
    <head>
        <title>Blog - Create Post</title>
        <link rel="stylesheet" type="text/css" href="./styles/<?php echo $theme; ?>.css">
    </head>
    <body>
        <?php
        // Check to see if the user is signed in. Otherwise, redirect them to the login page.
        session_start();
        if (isset($_SESSION['loggedin'])) {
            $username = $_SESSION['username'];
        } else {
            header("Location: ./auth/signin.php");
            exit();
        }

        if ($username !== $admin_account and $admin_only_posting) { // Make sure the user is signed in with an account that allows them to make posts.
            echo "<p>Error: You do not have permission to create posts. Please make sure you are signed in with the correct account.</p>";
            exit();
        }



        // Load the posts database from disk.
        $post_database = unserialize(file_get_contents('./blogpostdatabase.txt'));


        // Get required information from the POST data.
        $post_text = $_POST['posttext'];
        $post_title = $_POST['posttitle'];



        // Make sure the post text is below the limit.
        if (strlen($post_text) >= $max_post_body_length) {
            echo "Error: The post text exceeds the maximum length.";
            echo "<br><a href='./draft.php" . "'>Back</a>";
            exit();
        }



        // Make sure the post title is below the limit.
        if (strlen($post_title) >= $max_post_title_length) {
            echo "Error: The post title exceeds the maximum length.";
            echo "<br><a href='./draft.php" . "'>Back</a>";
            exit();
        }



        // Sanitze the post text
        $post_text = str_replace("<br>", "&&br", $post_text);
        $post_text = str_replace("<", "&lt;", $post_text);
        $post_text = str_replace(">", "&gt;", $post_text);



        // Iterate through the entire post and remove any characters not in the approved list.
        $allowed_characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!?.,'\"_-+=/\\~@#$%^&*()[]}{;:©£¢¥®±¿Ø÷×ºµ¦₿ "; // Note: The space at end of string is intentional.

        $input_string_array = str_split($post_text); // Convert the post text string into an array of characters.
        $post_text = ""; // Set the post text to a blank string so we can add each character back one-by-one as we validate them.
        foreach ($input_string_array as $input_string_character) {
            if (strpos ($allowed_characters, $input_string_character) !== false) {
                $post_text = $post_text . $input_string_character;
            }
        }


        // Fix custom formatting that was broken by the sanitzation process.
        $post_text = str_replace("&&br", "<br>", $post_text);


        // Find the last post in the array.
        $latestpost = end($post_database);

        
        array_push($post_database, array($latestpost[0] + 1, $post_text, $post_title, $username, 0, date('Y-m-d H:i:s'), array())); // Add the post to the post database.


        file_put_contents("./blogpostdatabase.txt", serialize($post_database)); // Write array changes to disk
        $redirect_location = "./index.php"; // Set redirect to the main page
        header('Location: '.$redirect_location); // Execute redirect
        ?>
    </body>
</html>
