<?php
require_once 'flight/Flight.php';

Flight::route('/', function() {
    echo 'Hello, world!';
});

Flight::start();
