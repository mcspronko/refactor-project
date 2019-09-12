<?php
declare(strict_types=1);

require_once __DIR__ . "/../bootstrap.php";

use JournalMedia\Sample\Application;
use Zend\Diactoros\ServerRequestFactory;

$application = new Application();
$application->run(ServerRequestFactory::fromGlobals());
