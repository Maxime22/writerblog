<?php
const DEFAULT_APP = 'Frontend';

// If the app is not valid we load the Frontend which will call the error 404
if (!isset($_GET['app']) || !file_exists(__DIR__.'/../App/'.$_GET['app'])) $_GET['app'] = DEFAULT_APP;

// We include the autoload class
require __DIR__.'/../lib/MiniFram/SplClassLoader.php';

// Then we register all the autoloads that we need
$MiniFramLoader = new SplClassLoader('MiniFram', __DIR__.'/../lib');
$MiniFramLoader->register();

$appLoader = new SplClassLoader('App', __DIR__.'/..');
$appLoader->register();

$modelLoader = new SplClassLoader('Model', __DIR__.'/../lib/vendors');
$modelLoader->register();

$entityLoader = new SplClassLoader('Entity', __DIR__.'/../lib/vendors');
$entityLoader->register();

// Finally we deduce the app we need and run this one dynamically calling the function run (example : the run function of FrontendApplication.php)
$appClass = 'App\\'.$_GET['app'].'\\'.$_GET['app'].'Application';

$app = new $appClass;
$app->run();

