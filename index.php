<!-------------------------------------
Name: Fred Butoma
Assignment 4
File: index.php
Purpose: index.php renders the homepage using mustache
--------------------------------------->
<?php
//this will load the mustache template library
require_once 'mustache/mustache/src/Mustache/Autoloader.php';
Mustache_Autoloader::register();

// use html instead of mustache for template extension
$options =  array('extension' => '.html');

// create our mustache engine, and let it know about our views
$mustache = new Mustache_Engine(array(
    'loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__) . '/templates/views', $options),
));

/*
 * the following three lines of code set up your PAGE SPECIFIC variables
 * these will be different page to page. page specific data is loaded into
 * an associative array where the key is used by Mustache as a {{variable}}
 * and the value is inserted into the page (see the template examples).
 */
$index_template_args = [
    "pagetitle" => "Home Page",
    "localtime" => date('l jS \of F Y h:i:s A'),
    "footertitle" => "Home Page",
    "helloworld" => "Hello World",
    "pi" => 3.14,
    "digits" => "15926535",
];

// render the index page from templates/views/index.html passing in our dict above
echo $mustache->render('index', $index_template_args) . PHP_EOL;