# WebinCMS Application Starter

## Installation & updates

Download or clone files, and extract to you directory

## Setup

Create database and update `.env` file.
Open terminal, and write this commang `php spark migrate` and then `php spark db:seed DefaultUser`

## Start the app/website

`php spark server` or open in browser `http://localhost/yourproject/public`.

**Please** read the user guide for a better explanation of how CI4 works!
The user guide updating and deployment is a bit awkward at the moment, but we are working on it!

## Server Requirements

PHP version 7.2 or higher is required, with the following extensions installed: 

- [intl](http://php.net/manual/en/intl.requirements.php)
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php)
- xml (enabled by default - don't turn it off)
