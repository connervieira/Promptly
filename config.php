<?php
$promptly_config["admin_account"] = "test"; // This setting determines which account can create and delete posts.

$promptly_config["admin_only_posting"] = true; // This setting determines whether or not the admin is the only user who can create posts. This should be set to true under normal circumstances to prevent unauthorized users from posting to your blog.

$promptly_config["instance_name"] = "Promptly"; // This setting specifies the name of the instance. It can usually be left as "Promptly", but can also be changed to better integrated with your website.
$promptly_config["instance_tagline"] = "A quick, no-nonsense blogging system."; // This is the tagline that gets shown on the front page of your blog.

$promptly_config["theme"] = "dark"; // This setting determines which stylesheet Promptly will use. Currently, this can be set to "light", "dark", "red", "blue", or "green".

$promptly_config["enabled_integrated_authentication"] = false; // This setting determines whether or not Promptly's integrated authentication system is enabled or disabled. If you already have an existing authentication system, you should disable the integrated one to prevent any conflicts and security issues.
$promptly_config["login_page"] = "../dropauth/login.php"; // This setting determines the login page for Promptly. If you're using the integrated authentcation system, set this variable to './auth/signin.php'
$promptly_config["signup_page"] = "../dropauth/signup.php"; // This setting determines the signup page for Promptly. If you're using the integrated authentcation system, set this variable to './auth/signup.php'
$promptly_config["signout_page"] = "../dropauth/signout.php"; // This setting determines the signout page for Promptly. If you're using the integrated authentcation system, set this variable to './auth/signout.php'

$promptly_config["max_post_title_length"] = 200;
$promptly_config["max_post_body_length"] = 10000;
$promptly_config["post_summary_length"] = 200;

?>
