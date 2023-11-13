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
    - Example: `chmod 777 /var/www/html/promptly`
2. Make any desired configuration changes.


## Usage
