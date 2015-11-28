# atoum Prophecy extension [![Build Status](https://travis-ci.org/atoum/prophecy-extension.svg?branch=master)](https://travis-ci.org/atoum/prophecy-extension)

![atoum](http://downloads.atoum.org/images/logo.png)

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

$runner->addExtension(new prophecy\extension($script));
```

## Use it
