<?php

namespace mageekguy\atoum\prophecy\tests\units;

use
	mageekguy\atoum,
	Prophecy\Argument
;

class extension extends atoum
{
	public function testClass()
	{
		$this->testedClass->implements('mageekguy\atoum\extension');
	}

	public function test_construct()
	{
		$this
			->given(
				$parserProphecy = $this->prophet('mageekguy\atoum\script\arguments\parser'),
				$parser = $parserProphecy
					->addHandler(Argument::type('closure'), array('--test-ext'))->willReturn($parserProphecy->reveal())->shouldBeCalled
					->addHandler(Argument::type('closure'), array('--test-ext'))->willReturn($parserProphecy->reveal())->shouldBeCalled
					->addHandler(Argument::type('closure'), array('--test-it'))->willReturn($parserProphecy->reveal())->shouldBeCalled
					->reveal,
				$script = $this->prophet('mageekguy\atoum\scripts\runner')
					->getArgumentsParser()->willReturn($parser)
					->reveal,
				$configurator = $this->prophet('mageekguy\atoum\configurator')
					->getScript()->willReturn($script)
					->reveal
			)
			->when($this->newTestedInstance($configurator))
			->then
				->prophet->checkPredictions
		;
	}

	public function testGetSetRunner()
	{
		$this
			->given($runner = new atoum\runner())
			->when($this->newTestedInstance)
			->then
				->variable($this->testedInstance->getRunner())->isNull
				->object($this->testedInstance->setRunner($runner))->isTestedInstance
				->object($this->testedInstance->getRunner())->isIdenticalTo($runner)
		;
	}

	public function testGetSetTest()
	{
		$this
			->given(
				$assertionManagerProphecy = $this->prophet('mageekguy\atoum\test\assertion\manager'),
				$assertionManager = $assertionManagerProphecy
					->setHandler('prophet', Argument::type('closure'))->willReturn($assertionManagerProphecy->reveal())->shouldBeCalled
					->reveal,
				$test = $this->prophet('mageekguy\atoum\test')
					->getAssertionManager()->willReturn($assertionManager)
					->reveal
			)
			->when($this->newTestedInstance)
			->then
				->variable($this->testedInstance->getTest())->isNull
				->object($this->testedInstance->setTest($test))->isTestedInstance
				->object($this->testedInstance->getTest())->isIdenticalTo($test)
			->and
				->prophet->checkPredictions
		;
	}

	public function testHandleEvent()
	{
		$this
			->when($this->newTestedInstance)
			->then
				->object($this->testedInstance->handleEvent(uniqid(), $this->prophet('mageekguy\atoum\observable')->reveal))->isTestedInstance
		;
	}
}
