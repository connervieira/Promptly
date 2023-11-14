<?php
$force_login_redirect = true;
include("../dropauth/authentication.php");
include("./config.php");
?>
<html lang="en">
    <head>
        <title><?php echo htmlspecialchars($promptly_config["branding"]["instance_name"]); ?> - Create Post</title>
        <link rel="stylesheet" type="text/css" href="./styles/<?php echo $promptly_config["theme"]; ?>.css">
    </head>
    <body>
        <?php
        // Check to see if the user is signed in. Otherwise, redirect them to the login page.

        if ($username == $promptly_config["auth"]["admin_account"] or in_array($username, $promptly_config["auth"]["authorized_authors"])) { // Make sure the user is signed in with an account that allows them to make posts.
            // Load the posts database from disk.
            $post_database = unserialize(file_get_contents('./blogpostdatabase.txt'));
        } else {
            echo "<p>Error: You do not have permission to create posts. Please make sure you are signed in with the correct account.</p>";
            exit();
        }


        // Get required information from the POST data.
        $post_text = $_POST['posttext'];
        $post_title = $_POST['posttitle'];



        // Make sure the post text is below the limit.
        if (strlen($post_text) >= $promptly_config["max_post_body_length"]) {
            echo "Error: The post text exceeds the maximum length.";
            echo "<br><a href='./draft.php" . "'>Back</a>";
            exit();
        }



        // Make sure the post title is below the limit.
        if (strlen($post_title) >= $promptly_config["max_post_title_length"]) {
            echo "Error: The post title exceeds the maximum length.";
            echo "<br><a href='./draft.php" . "'>Back</a>";
            exit();
        }



        // Replace permitted HTML strings with placeholders.
        $post_text = str_replace("<br>", "&&br", $post_text);
        $post_text = str_replace("<b>", "&&b", $post_text);
        $post_text = str_replace("</b>", "&&/b", $post_text);
        $post_text = str_replace("<i>", "&&i", $post_text);
        $post_text = str_replace("</i>", "&&/i", $post_text);
        $post_text = str_replace("<u>", "&&u", $post_text);
        $post_text = str_replace("</u>", "&&/u", $post_text);

        $post_text = str_replace(array("\r\n", "\n\r"), "&&br", $post_text);
        $post_text = str_replace(array("\r", "\n"), "&&br", $post_text);
        $post_text = str_replace("<", "&lt;", $post_text);
        $post_text = str_replace(">", "&gt;", $post_text);

        
        // Iterate through the entire post and remove any characters not in the approved list.
        $allowed_characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!?.,'\"_-+=/\\~@#$%^&*()[]}{;:©£¢¥®±¿Ø÷×ºµ¦₿ ";
        $input_string_array = str_split($post_text); // Convert the post text string into an array of characters.
        $post_text = ""; // Set the post text to a blank string so we can add each character back one-by-one as we validate them.
        foreach ($input_string_array as $input_string_character) {
            if (strpos ($allowed_characters, $input_string_character) !== false) {
                $post_text = $post_text . $input_string_character;
            }
        }

        // Fix custom formatting that was broken by the sanitzation process.
        $post_text = str_replace("&&br", "<br>", $post_text);
        $post_text = str_replace("&&b", "<b>", $post_text);
        $post_text = str_replace("&&/b", "</b>", $post_text);
        $post_text = str_replace("&&i", "<i>", $post_text);
        $post_text = str_replace("&&/i", "</i>", $post_text);
        $post_text = str_replace("&&u", "<u>", $post_text);
        $post_text = str_replace("&&/u", "</u>", $post_text);

        $post_time = time();
        $post_database[$post_time] = array();
        $post_database[$post_time]["title"] = $post_title;
        $post_database[$post_time]["body"] = $post_text;
        $post_database[$post_time]["author"]["primary"] = $username;
        $post_database[$post_time]["time"]["created"] = $post_time;
        $post_database[$post_time]["time"]["edited"] = $post_time;
        $post_database[$post_time]["time"]["edited"] = $post_time;


        file_put_contents("./blogpostdatabase.txt", serialize($post_database)); // Write array changes to disk
        $redirect_location = "./index.php"; // Set redirect to the main page
        header('Location: ' . $redirect_location); // Execute redirect
        ?>
    </body>
</html>
