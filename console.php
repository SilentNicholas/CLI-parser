<?php

include_once dirname(__FILE__). '/vendor/autoload.php';

use Commands\CommandDirection;

if ($argc > 1) {
    $command = new CommandDirection();
    $command->executeDirection($argv);
}

exit;