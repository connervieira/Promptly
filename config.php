<?php

$promptly_config["branding"]["instance_name"] = "Promptly"; // This setting specifies the name of the instance. It can usually be left as "Promptly", but can also be changed to better integrate with your website.
$promptly_config["branding"]["instance_tagline"] = "A quick, no-nonsense blogging system."; // This is the tagline that is shown on the front page of your blog.

$promptly_config["theme"] = "dark"; // This setting determines which stylesheet Promptly will use. Currently, this can be set to "light", "dark", "red", "blue", or "green".

$promptly_config["auth"]["login_page"] = "../dropauth/login.php"; // This setting determines the login page for Promptly.
$promptly_config["auth"]["signup_page"] = "../dropauth/signup.php"; // This setting determines the signup page for Promptly.
$promptly_config["auth"]["signout_page"] = "../dropauth/signout.php"; // This setting determines the signout page for Promptly.
$promptly_config["auth"]["admin_account"] = "test"; // This setting determines a username that is permitted to create and delete all posts.
$promptly_config["auth"]["authorized_authors"] = array(); // This setting is an array of usernames that are permitted to make posts.

$promptly_config["max_post_title_length"] = 200; // This value sets the maximum amount of characters that are allowed in the title of a post.
$promptly_config["max_post_body_length"] = 10000; // This value sets the maximum amount of characters that are allowed in the body of the post.
$promptly_config["post_summary_length"] = 200; // This value sets how many characters long the post summary on the main page will be before the user fully opens the article.

?>
