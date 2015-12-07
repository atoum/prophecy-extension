<?php

namespace mageekguy\atoum\prophecy\tests\units\asserters\prophet;

use mageekguy\atoum;

class method extends atoum
{
	public function testMethodProphecyMethods($calledMethod, $callArgument)
	{
		$this
			->given(
				$object = $this->prophet('mageekguy\atoum\prophecy\asserters\prophet\object')->reveal,
				$method = $this->prophet('Prophecy\Prophecy\MethodProphecy')
					->{$calledMethod}($callArgument)->shouldBeCalled
					->reveal,
				$this->newTestedInstance($method, $object)
			)
			->then
				->object($this->testedInstance->{$calledMethod}($callArgument))->isTestedInstance
			->and
				->prophet->checkPredictions
		;
	}

	protected function testMethodProphecyMethodsDataProvider()
	{
		return array(
			array('willReturn', null),
			array('willReturn', uniqid()),
			array('willReturnArgument', null),
			array('willReturnArgument', rand(0, PHP_INT_MAX)),
			array('shouldBeCalled', null),
			array('shouldNotBeCalled', null),
			array('shouldHaveBeenCalled', null),
			array('shouldNotHaveBeenCalled', null),
			array('shouldNotBeenCalled', null),
			array('checkPrediction', null)
		);
	}
}
