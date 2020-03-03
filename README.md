# CakePHP Application Skeleton

[![Build Status](https://img.shields.io/travis/cakephp/app/master.svg?style=flat-square)](https://travis-ci.org/cakephp/app)
[![Total Downloads](https://img.shields.io/packagist/dt/cakephp/app.svg?style=flat-square)](https://packagist.org/packages/cakephp/app)

A skeleton for creating applications with [CakePHP](https://cakephp.org) 3.8.*

The framework source code can be found here: [cakephp/cakephp](https://github.com/cakephp/cakephp).
* Noted : I used this plugin to rest that token.
    * composer require admad/cakephp-jwt-auth
    * bin/cake plugin load ADmad/JwtAuth

## Installation

1. Download [Composer](https://getcomposer.org/doc/00-intro.md) or update `composer self-update`.
2. Run `php composer.phar create-project --prefer-dist cakephp/app [app_name]`.
3. Running project has two option
    - Running with your server application such as xampp, warm, mamp ..ect.
    - Running with cakephp server by using command line.
      * your-project-directory/bin/cake server
      than you will see the display port that your project running.
## Setting up this project testing
1. Clone this project repository by using git clone commandline.
2. Setting up database for your project. You will one database backup in this project repository after you done clone.
    * your-project-directory/config/schema/jwt.sql
    You will need to restore this into you database. for me I used phpmyadmin for testing this project.
    You can used any database you like by changing application database driver in app.php but by default cakephp will chose mysql.
3. Setting up your database connecting in app.php
4. When you done seting your project, Now you can testing it.
5. Testin it with Postman.
  * Header
    * Cache-Control:no-cache
    * Content-Type: application/x-www-form-urlencoded
    
    Image reference: https://github.com/NaraTouch/cakephp3.8-jwt-token/blob/master/1.jpg
    
  * For request body I used x-www-form-urlencoded
    * email: root@nomail.cyborg
    * password: rootroot
    
    Image reference: https://github.com/NaraTouch/cakephp3.8-jwt-token/blob/master/2.jpg

Thank you guid for explore my repository. 
If you have any question please leave the comment I will try to caught up with you as soon as posible.
Or you can contact me by my twitter : https://twitter.com/sophonaratouch


