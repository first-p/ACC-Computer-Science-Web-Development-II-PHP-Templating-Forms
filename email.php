<?php

//this will load the mustache template library
require_once 'mustache/mustache/src/Mustache/Autoloader.php';
Mustache_Autoloader::register();



function successpage() {
    $options =  array('extension' => '.html');

    // create our mustache engine, and let it know about our views
    $mustache = new Mustache_Engine(array(
        'loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__) . '/templates/views', $options)
    ));
    $success_template_data = [
        "pagetitle" => "Success Page",
        "localtime" => date('l jS \of F Y h:i:s A'),
        "footertitle" => "Success!!!!!"
    ];
    echo $mustache->render('success', $success_template_data).PHP_EOL;
}

function failurepage() {
    $options =  array('extension' => '.html');

    // create our mustache engine, and let it know about our views
    $mustache = new Mustache_Engine(array(
        'loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__) . '/templates/views', $options)
    ));
    $failure_template_data = [
        "pagetitle" => "Failure Page",
        "localtime" => date('l jS \of F Y h:i:s A'),
        "footertitle" => "Failure!!!!!"
    ];

    echo $mustache->render('failure', $failure_template_data).PHP_EOL;
}

function main() {

   /* ********************************************
    * TODO (erase this comment when you are done)
    * ********************************************
    * these two lines are for debugging purposes to get started.
    * erase them both when you are ready to complete this processing
    */
//    var_dump($_POST);
//    exit();


    /* This will test to make sure we have a non-empty $_POST from
     * the form submission. */
    if (!empty($_POST)) {
        /* ********************************************
         * TODO (erase this comment when you are done)
         * ********************************************
         * Do your validation and cleaning here. You need to extract FOUR
         * things from the $_POST array...
           $name --> trim it, strip HTML tags, and sub-string it to 64
           $subject --> trim it, strip HTML tags, and sub-string it to 64
           $message --> trim it, strip HTML tags, and sub-string it to 1000
           $from --> look up and use the PHP filter_var() with FILTER_VALIDATE_EMAIL
           https://www.php.net/manual/en/function.filter-var.php
         * 
         */
        $name = $_POST['name'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        $from = $_POST['email'];
//        $from = filter_var($from, FILTER_VALIDATE_EMAIL);

        $name = substr(trim(strip_tags($name)), 0 , 64);
        $subject = substr(trim(strip_tags($subject)), 0 , 64);
        $message = substr(trim(strip_tags($message)), 0 , 64);
        $from = substr(trim(strip_tags($from)), 0 , 64);


        /* The cleaning routines above may leave any variable empty. If we
         * find an empty variable, we stop processing because that means
         * someone tried to send us something malicious and/or incorrect. */
        if (!empty($name) && !empty($from) && !empty($subject) && !empty($message)) {

            /* this forms the correct email headers to send an email */
            $headers = "From: $from\r\n";
            $headers .= "Reply-To: $from\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";

            /* Now attempt to send the email. This uses a REAL email function
             * and will send an email. Make sure you only sned it to yourself.
             * server, you would use just "mail" instead of "mymail" and
             * it will be sent normally. Read about the PHP mail() function
             * https://www.php.net/manual/en/function.mail.php
             * then it's up to you to fill out the paramters correctly.
             */
            if (mail($from, $subject, $message, $headers)){
                $json_result = array('result'=>'okay');
                echo json_encode($json_result).PHP_EOL;
            } else {
                $json_result = array('result'=>'error');
                echo json_encode($json_result).PHP_EOL;
            }
        } else {
            $json_result = array('result'=>'error');
            echo json_encode($json_result).PHP_EOL;
        }
    } else {
        $json_result = array('result'=>'error');
        echo json_encode($json_result).PHP_EOL;
    }
}

// this kicks off the script
main();
