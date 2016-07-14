# Cube Summation Challenge

This repository contains solve of Cube Summation with Laravel from challenge in [Hacker Rank](https://www.hackerrank.com/challenges/cube-summation).

## Architecture

### Client Layer
Client layer executed in the browser is responsible for serving a graphical user interface, where the load is done a file with predefined commands and a text box where you can still modify those commands. and other small validations performed by the server are made.

**This layer is composed of:**

 - Bootstrap used to build the UI.
 - jQuery used to make request to server and select DOM elements
 - app.js is the file used with Javascript code used for loading the file and make the request to the server to resolve the commands.

### Presentation Layer
Laravel Blade is used as template engine to serve the views.

### Logic Layer

It is responsible for handling the information layer that sends the user a POST request medianta to resolve commands.

 - **Matrix.php:** It is responsible for carrying out all logic to manage 3D matrices
 - **Operator.php:** It is responsible for manipulating the text class that sends the user and make each of the parameters it needs to operate Matrix.php
 - **MatrixController.php:** It is the controller responsible for processing user requests, creating an instance of the Operator class and passing it the parameters of the user.


## Tests

In order to run the test completely there's a shell script, just run: `vendor/bin/phpunit`.

------
Created with :heart: by [yoelfme](http://github.com/yoelfme)