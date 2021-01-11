<?php


// This line makes PHP behave in a more strict way
declare(strict_types=1);

    // ini_set('display_errors', '1');
    // ini_set('display_startup_errors', '1');
    // error_reporting(E_ALL);

// This file is your starting point (= since it's the index)
// It will contain most of the logic, to prevent making a messy mix in the html



// We are going to use session variables so we need to enable sessions
session_start();

// Use this function when you need to need an overview of these variables
function whatIsHappening() {
    
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    echo "<pre>";
    var_dump($_POST);
    echo "</pre>";
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}



// TODO: provide some products (you may overwrite the example)

require 'variables.php';
require 'form-view.php';


?>