# atoum Prophecy extension [![Build Status](https://travis-ci.org/atoum/prophecy-extension.svg?branch=master)](https://travis-ci.org/atoum/prophecy-extension)

![atoum](http://atoum.org/images/logo/atoum.png)

## Install it

Install extension using [composer](https://getcomposer.org):

```json
{
    "require-dev": {
        "atoum/prophecy-extension": "~1.0"
    }
}

```

Enable the extension using atoum configuration file:

```php
<?php

// .atoum.php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

use mageekguy\atoum\prophecy;

$extension = new prophecy\extension($script);

$extension->addToRunner($runner);
```

## Use it

## License

atoum prophecy-extension is released under the BSD-3-Clause License. See the bundled LICENSE file for details.
