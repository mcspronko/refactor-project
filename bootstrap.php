<?php
declare(strict_types=1);

require_once __DIR__ . "/vendor/autoload.php";

spl_autoload_register('autoloader');
function autoloader($class_name)
{
    $parts =  explode('\\', $class_name);

    if ($parts[0] == 'Guzzle') {
        array_shift($parts);
        if (file_exists(__DIR__."/lib/Guzzle/src/Guzzle/".implode("/", $parts).".php")) {
            include_once __DIR__."/lib/Guzzle/src/Guzzle/".implode("/", $parts).".php";
        }
    } elseif ($parts[0] == 'Symfony') {
        if (file_exists(__DIR__."/lib/Symfony/EventDispatcher/".$parts[count($parts)-1].".php")) {
            include_once __DIR__."/lib/Symfony/EventDispatcher/".$parts[count($parts)-1].".php";
        }
    }
}

define('DEMO_RESPONSES', __DIR__ . "/resources/demo-responses");

return new \JournalMedia\Sample\Application\Application;
