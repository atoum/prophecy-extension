<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'autoloader.php';

use mageekguy\atoum\prophecy;

$runner->addExtension(new prophecy\extension($script));
