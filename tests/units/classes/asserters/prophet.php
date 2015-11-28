<?php

namespace mageekguy\atoum\prophecy\tests\units\asserters;

use
	mageekguy\atoum,
	Prophecy\Exception\Prediction\AggregateException
;

class prophet extends atoum
{
	public function testClass()
	{
		$this->testedClass->extends('mageekguy\atoum\asserter');
	}

	public function testCheckPredictions()
	{
		$this
			->given(
				$prophet = $this->prophet('Prophecy\Prophet')
					->checkPredictions()->shouldBeCalled
					->reveal
			)
			->when($this->newTestedInstance(null, null, null, $prophet))
			->then
				->object($this->testedInstance->checkPredictions())->isTestedInstance
			->and
				->prophet->checkPredictions
		;
	}

	public function testCheckPredictionsWithError()
	{
		$this
			->given(
				$prophet = $this->prophet('Prophecy\Prophet')
					->checkPredictions()->willThrow(new AggregateException($message = uniqid()))->shouldBeCalled
					->reveal()
			)
			->when($this->newTestedInstance(null, null, null, $prophet))
			->then
				->exception(function(atoum\test $test) {
						$test->testedInstance->checkPredictions();
					}
				)
					->isInstanceOf('mageekguy\atoum\asserter\exception')
					->hasMessage($message)
			->and
				->prophet->checkPredictions
		;
	}

	public function testProphesize()
	{
		$this->skip('Waiting for this issue to be fixed: https://github.com/phpspec/prophecy/issues/233');

		$this
			->given(
				$prophecy = $this->prophet('Prophecy\Prophecy\ObjectProphecy')->reveal(),
				$prophet = $this->prophet('Prophecy\Prophet'),
				$prophet->prophesize($class = uniqid())->willReturn($prophecy)->shouldBeCalled,

				$p = new \Prophecy\Prophet(),
				$prophetProphecy = $p->prophesize('Prophecy\Prophet'),
				$objectProphecy = $p->prophesize('Prophecy\Prophecy\ObjectProphecy'),

				$prophetProphecy->prophesize($class)->willReturn($objectProphecy->reveal())
			)
			->dump($prophetProphecy->reveal()->prophesize($class))
			->when($this->newTestedInstance(null, null, null, $prophet))
			->then
				->object($this->testedInstance->prophesize($class))->isInstanceOf('mageekguy\atoum\prophecy\asserters\prophet\object')
			->and
				->prophet->checkPredictions
		;
	}
}
