<?php

use Base\Application;

include '../src/config.php';

include '../vendor/autoload.php';

/*$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader); 
echo $twig->render('blog.phtml', array('text' => 'Hello world!')); 
var_dump($loader);
die;*/

$app = new Application();
$app->run();