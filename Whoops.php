<?php

// Autoloader onii san
require_once __DIR__ . '/../vendor/autoload.php';

// Whoops nastavení
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

// chyba
throw new Exception("Něco se strašlivě pokazilo!");

