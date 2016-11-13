# atoum/prophecy-extension [![Build Status](https://travis-ci.org/atoum/prophecy-extension.svg?branch=master)](https://travis-ci.org/atoum/prophecy-extension)

atoum has great [stubbing/mocking system](http://docs.atoum.org/en/latest/mocking_systems.html). If you prefer using [prophecy](https://github.com/phpspec/prophecy), you can do it using this extension.

## Example

Here is an example of how to create and use a stub using prophecy, in atoum :

```php
<?php

namespace
{
  class foo
  {
    public function bar()
    {
      return '1';
    }
  }
}

namespace tests\units
{
  use mageekguy\atoum;

  class foo extends atoum\test
  {
    public function testBar()
    {
      $this
          ->given(
              $foo = $this
                  ->prophet
                  ->prophesize('foo')
                  ->bar()->willReturn('2')
                  ->reveal()
          )
          ->string($foo->bar())
            ->isEqualTo('2')
      ;
    }
  }
}
```

## Install it

Install extension using [composer](https://getcomposer.org):

```
composer config minimum-stability dev
composer config prefer-stable true
composer config repositories.atoumProphecy vcs https://github.com/atoum/prophecy-extension
composer require --dev atoum/prophecy-extension
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

## Documentation

The `Prophecy\Prophet` object will be available in your tests via the `prophet` attribute.

For usage on how to use it, you can read [Prophecy's documentation](https://github.com/phpspec/prophecy).

## Links

* [atoum](http://atoum.org)
* [atoum's documentation](http://docs.atoum.org)
* [Prophecy](https://github.com/phpspec/prophecy)


## License

atoum prophecy-extension is released under the BSD-3-Clause License. See the bundled LICENSE file for details.


![atoum](http://atoum.org/images/logo/atoum.png)
