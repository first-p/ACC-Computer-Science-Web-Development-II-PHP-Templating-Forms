<?php


/***************************************
Name: Fred Butoma
Assignment 4
File: title.php
Purpose: uses mustache library to render contact page
 ****************************************/

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
$title_template_data = [
    "pagetitle" => "Contact Page",
    "localtime" => date('l jS \of F Y h:i:s A'),
    "footertitle" => "Contact Form"
];

// load the title page from 'templates/views/title
// the data from $title_template_args gets passed to the proper partials included in title.html
$template = $mustache->render('contact', $title_template_data);
echo $template.PHP_EOL;
