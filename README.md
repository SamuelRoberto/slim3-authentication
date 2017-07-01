# Slim3 Session-Based Authentication

This project is a start point if you need to connect Slim3 with a secure Session-Based authentication.
In this codebase you will find a complete skeleton that contains: Slim3 Framework, Twig View, MySQL Database(for users), both Bootstrap3 and FontAwesome implemented.

<b>Why I created this project?</b>

I had to create an application with Slim and a skeleton whitch includes a secure authentication was really helpfull: I didn't find nothing good.
So I decided to create and share this simple skeleton. Hope it will help you!

## Table of Content
- [Getting Started](#getting-started)
- [Run Project](#run-project)
- [What's included](#whats-included)
- [Mind Mapping](#mind-mapping)
- [Documentation](#documentation)
- [Contributing](#contributing)
- [Licenses](#licenses)

## Getting Started
Navigate into your folder and issuing this command into a command line (you MUST have installed Composer!)

    $ composer create-project --no-interaction samuelr/slim3-auth myapp-name

### Run Project

1. `$ cd myapp-name`
2. `$ php -S 0.0.0.0:8888 -t public public/index.php`
3. Browse to http://localhost:8888

## What is included
In this project you will find a Slim3-Based Project with:
1. Secure Session-Based authentication
2. Twig-View Template engine
3. MySQL Integration
4. Bootstrap 3 and FontAwesome already loaded
5. Integrated Monolog logger
6. Clean and easily editable code

## Mind Mapping
You can find a full mind mapping for this project here.

## Documentation

###

## Key directories

* `app`: Application code
* `app/src`: All class files within the `App` namespace
* `app/templates`: Twig template files
* `cache/twig`: Twig's Autocreated cache files
* `log`: Log files
* `public`: Webserver root
* `vendor`: Composer dependencies

## Contributing


## Licenses
* `Slim3-Session-Base-Authentication`: Code released under MIT License
* `Slim3-Skeleton`: Added into LICENSE file