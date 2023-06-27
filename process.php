<?php

require_once 'mustache/mustache/src/Mustache/Autoloader.php';
Mustache_Autoloader::register();

// tell mustache we are using the html file extension
$options =  array('extension' => '.html');

// create our mustache engine, and let it know about our views
$mustache = new Mustache_Engine(array(
    'loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__) . '/templates/views', $options),
));

// get the request method, either "GET" or "POST" and act accordingly
$request_method = $_SERVER['REQUEST_METHOD'];

// if post get the data
if ($request_method === 'POST') {
    try {
        $title = $_POST['title'];
        $fave_drink = $_POST['fave_drink'];
        $pet_name = $_POST['pet_name'];
        $fave_fictional_place = $_POST['fave_fictional_place'];
        $fave_real_place = $_POST['fave_real_place'];
        $email = $_POST['email'];

        if (!empty($title)
            && !empty($fave_drink)
            && !empty($pet_name)
            && !empty($fave_fictional_place)
            && !empty($fave_real_place)) {
            $title_result = "You are " . $title . " " . $fave_drink . " " . $pet_name . " of " . $fave_fictional_place . " and " . $fave_real_place;
            $title_length_json = json_encode(array('length'=> strlen($title_result)));
            echo $title_length_json.PHP_EOL;
        } else {
            echo "error".PHP_EOL;
        }
    } catch (Exception $e) {
        echo "error".PHP_EOL;
    }


// if GET display error page
} else if ($request_method === 'GET') {
    $args = [
        'error' => 'Get request is not allowed.',
        "pagetitle" => "Error Page",
        "localtime" => date('l jS \of F Y h:i:s A'),
        "footertitle" => "Error Page"];

    // render the error page located at templates/views/error.html passing in $args above
    echo $mustache->render('error', $args).PHP_EOL;;
}
