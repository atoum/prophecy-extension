<?php

namespace mageekguy\atoum\prophecy\tests;

use mageekguy\atoum;

atoum\autoloader::get()
	->addDirectory(__NAMESPACE__, __DIR__)
;

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
