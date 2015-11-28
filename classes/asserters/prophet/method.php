<?php

namespace mageekguy\atoum\prophecy\asserters\prophet;

use Prophecy\Prophecy\MethodProphecy;

class method
{
    private $prophecy;

    public function __construct(MethodProphecy $prophecy, object $object)
    {
        $this->prophecy = $prophecy;
        $this->object = $object;
    }

    public function __call($method, $arguments)
    {
        switch (true)
        {
            case method_exists('Prophecy\Prophecy\MethodProphecy', $method):
                call_user_func_array(array($this->prophecy, $method), $arguments);

                return $this;

            default:
                return call_user_func_array(array($this->object, $method), $arguments);
        }
    }

    public function __get($property)
    {
        switch (strtolower($property))
        {
            case 'willreturn':
            case 'willreturnargument':
            case 'shouldbecalled':
            case 'shouldnotbecalled':
            case 'shouldhavebeencalled':
            case 'shouldnothavebeencalled':
            case 'shouldnotbeencalled':
            case 'checkprediction':
                return $this->__call($property, array());

            default:
                return $this->object->{$property};
        }
    }
}
