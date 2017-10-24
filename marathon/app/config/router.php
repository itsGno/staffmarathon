<?php

$router = $di->getRouter();

// Define your routes here
$router->add( 
   "Emergency/test", 
   [ 
      "controller" => "Emergency", 
      "action"     => "test", 
   ] 
);
$router->handle();
