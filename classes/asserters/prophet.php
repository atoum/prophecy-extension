<?php

namespace mageekguy\atoum\prophecy\asserters;

use mageekguy\atoum;
use mageekguy\atoum\asserter;
use mageekguy\atoum\exceptions;
use mageekguy\atoum\asserters;
use mageekguy\atoum\locale;
use mageekguy\atoum\observable;
use mageekguy\atoum\test;
use mageekguy\atoum\tools\variable;
use Prophecy\Exception\Prediction\PredictionException;

class prophet extends atoum\asserter
{
	private $prophet;

	public function __construct(asserter\generator $generator = null, variable\analyzer $analyzer = null, locale $locale = null, \Prophecy\Prophet $prophet = null)
	{
		parent::__construct($generator, $analyzer, $locale);

		$this->setProphet($prophet);
	}

	public function __get($property)
	{
		switch ($property)
		{
			case 'checkPredictions':
				return $this->checkPredictions();

			default:
				return parent::__get($property);
		}
	}

	public function prophesize($classOrInterface = null)
	{
		return new atoum\prophecy\asserters\prophet\object($this->prophet->prophesize($classOrInterface), $this->getGenerator());
	}

	public function checkPredictions()
	{
		try
		{
			$this->prophet->checkPredictions();

			$this->pass();
		}
		catch (PredictionException $exception)
		{
			$this->fail($exception->getMessage());
		}

		return $this;
	}

	public function handleEvent($event, observable $observable)
	{
		if ($event === test::afterTestMethod)
		{
			$this->checkPredictions();
		}

		return $this;
	}

	protected function setProphet(\Prophecy\Prophet $prophet = null)
	{
		$this->prophet = $prophet ?: new \Prophecy\Prophet();
	}
}
