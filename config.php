<?php
$admin_account = "cvieira"; // This setting determines which account can create and delete posts.

$admin_only_posting = true; // This setting determines whether or not the admin is the only user who can create posts. This should be set to true under normal circumstances to prevent unauthorized users from posting to your blog.

$instance_name = "Promptly"; // This setting specifies the name of the instance. It can usually be left as "Promptly", but can also be changed to better integrated with your website.
$instance_tagline = "A quick, no-nonsense blogging system."; // This is the tagline that gets shown on the front page of your blog.

$theme = "light"; // This setting determines which stylesheet Promptly will use. Currently, this can be set to "light", "dark", "red", "blue", or "green".

$enabled_integrated_authentication = false; // This setting determines whether or not Promptly's integrated authentication system is enabled or disabled. If you already have an existing authentication system, you should disable the integrated one to prevent any conflicts and security issues.
$login_page = "../login.php"; // This setting determines the login page for Promptly. If you're using the integrated authentcation system, set this variable to './auth/signin.php'
$signup_page = "../signup.php"; // This setting determines the signup page for Promptly. If you're using the integrated authentcation system, set this variable to './auth/signup.php'
$signout_page = "../signout.php"; // This setting determines the signout page for Promptly. If you're using the integrated authentcation system, set this variable to './auth/signout.php'

$max_post_title_length = 200;
$max_post_body_length = 10000;

?>
