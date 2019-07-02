<?php
declare(strict_types=1);

$app = require_once __DIR__ . "/../bootstrap.php";

$kernel = $app->make(\JournalMedia\Sample\Http\Kernel::class);
$emitter = $app->make(\Zend\Diactoros\Response\SapiEmitter::class);

$response = $kernel->handle(
    \Zend\Diactoros\ServerRequestFactory::fromGlobals()
);

$emitter->emit($response);
