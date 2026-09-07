<?php

declare(strict_types=1);

require dirname(__DIR__) . '/vendor/autoload.php';

$application = new Mango\Core\Application();
$application->run();