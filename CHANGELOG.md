# Changelog

This document contains a list of all changes made in each Promptly release.

## Version 1.0

### Initial Release

January 23rd, 2022

- Core functionality


## Version 2.0

*Release date to-be-determined*

- Fixed post deletion bug where instance admins couldn't delete posts.
- Removed the existing authentication system and replaced it with (DropAuth)[https://v0lttech.com/dropauth.php]
- Simplified stylesheets by creating a main stylesheet that all themes have in common.
- Re-designed the configuration back-end.
    - The configuration is now stored in a stand-alone file that can be easily moved and manipulated.
    - Promptly can now be configured from the web interface by the administrator.
- Re-designed the post database back-end to make future expansion much easier.
- Updated the way posts are viewed.
    - A brief summary of each post is now displayed on the main page.
    - Posts can be opened on a separate page to read the full article.
- Authorized authors can now be configured independently of the admin account.
