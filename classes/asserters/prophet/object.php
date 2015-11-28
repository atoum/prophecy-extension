<?php

namespace mageekguy\atoum\prophecy\asserters\prophet;

use mageekguy\atoum\exceptions\logic\invalidArgument;
use mageekguy\atoum\asserter\generator;
use Prophecy\Exception\Doubler\MethodNotFoundException;
use Prophecy\Prophecy\ObjectProphecy;

class object
{
    private $prophecy;
    private $double;
    private $generator;

    public function __construct(ObjectProphecy $prophecy, generator $generator)
    {
        $this->prophecy = $prophecy;
        $this->generator = $generator;
    }

    public function __call($method, $arguments)
    {
        switch (true)
        {
            case method_exists('Prophecy\Prophecy\ObjectProphecy', $method):
                call_user_func_array(array($this->prophecy, $method), $arguments);

                return $this;

            default:
                try
                {
                    return new method(call_user_func_array(array($this->prophecy, $method), $arguments), $this);
                }
                catch (MethodNotFoundException $prophecyException)
                {
                    try
                    {
                        return $this->generator->__call($method, $arguments);
                    }
                    catch (invalidArgument $exception)
                    {
                        throw $prophecyException;
                    }
                }
        }
    }

    public function __get($property)
    {
        switch (strtolower($property))
        {
            case 'willBeConstructedWith':
                return $this->__call($property, array());

            case 'reveal':
                return $this->reveal();

            default:
                return $this->generator->{$property};
        }
    }

    public function reveal()
    {
        if ($this->double === null)
        {
            $this->double = $this->prophecy->reveal();
        }

        return $this->double;
    }
}
