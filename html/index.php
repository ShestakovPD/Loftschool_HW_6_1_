<?php

use Base\Application;

include '../src/config.php';

include '../vendor/autoload.php';

require '../src/eloquent.php';

/*use Illuminate\Database\Eloquent\Model;
use App\Model\Eloquent\User;*/
/*
var_dump(App\Model\Eloquent\Posts::getAll());
die;*/

$app = new Application();
$app->run();