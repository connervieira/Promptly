# Documentation

This document explains how to install, set up, and use Promptly.


## Installation

1. Install Apache, or another web-server host.
    - Example: `sudo apt-get install apache2`
2. Install and enable PHP for your web-server.
    - Example: `sudo apt-get install php; sudo a2enmod php*`
3. Restart your web-server host.
    - Example: `sudo apache2ctl restart`
4. Install DropAuth.
    - Promptly uses DropAuth to manage authentication.
    - You can learn more about DropAuth at <https://v0lttech.com/dropauth.php>
5. Install Promptly.
    - After downloading Promptly, move the main directory to the root of your web-server directory.
    - Example: `mv ~/Downloads/promptly /var/www/html/promptly/`


## Setup

1. Make the Promptly directory writable.
    - Example: `chmod 777 /var/www/html/promptly/`
2. Navigate to DropAuth in your web browser.
    - Example: `http://localhost/dropauth/`
3. If you don't already have an account on your DropAuth instance, create one.
4. Log into your DropAuth account.
    - The account you log in with should be the one you plan to use as your Promptly administration account.
5. Navigate to Promptly in your web browser.
    - Example: `http://localhost/promptly/`
6. Press the "Configure" button on the top right of the main Promptly webpage.
7. Under the "Authentication" section, set the "Admin" field to the username of your DropAuth account.
    - This user will become the administrator user, and the configuration interface will be restricted to all other users.
    - Note that after submitting the updated administrator user, the configuration interface will lock out all other users, and only the specified administrator will be able to use Promptly.
        - If you enter the wrong username and accidentally lock yourself out of the configuration interface, you can erase the `blogconfig.txt` file in the Promptly directory to reset the configuration and try again.
8. Make any other configuration changes as desired.
9. After Promptly has been fully configured, you can publish your instance to allow visitors to view and read your posts.


## Usage

### Writing Posts

To create a post, your account needs to be either the administrator, or an authorized author, as set in the configuration. To create a post, make sure you are signed into your account through DropAuth, then click the "Create Post" button on the main Promptly page. From there, you can set a post title as well as the body text of your post. Simple HTML formatting tags including `<b>`, `<i>`, and `<u>` can be used to format your text. Line breaks will be automatically converted into HTML linebreaks. All other HTML characters will be encoded and displayed as plain text.

### Deleting Posts

To delete a post, you either need to be the administrator, or the author of a particular post. To delete a post, simply click the "Delete" button below it on the main Promptly page. Verify that the title of the article you're deleting matches the title of the article you intend to delete, then press the "Confirm" button.

### Viewing Posts

The main Promptly page will show all of the posts created in order from most recent to oldest. These tiles contain the name of the post, the date and time the post was published, as well as a brief preview of the article's body text. To view the complete article, click anywhere in the preview tile to navigate to the full post page.
