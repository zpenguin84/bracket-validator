<?php

namespace BracketValidator;

use Stringy\Stringy as S;

class BracketValidator
{
	public static function process(string $expression): bool
	{
		self::_checkExpression($expression);
		$brackets = 0;
		foreach (S::create($expression) as $char)
		{
			if ($char == '(')
				$brackets++;
			elseif ($char == ')')
				$brackets--;
			if ($brackets < 0)
				return false;
		}
		return $brackets == 0;
	}

	private static function _checkExpression(string $expression): void
	{
		$pos = 0;
		foreach (S::create($expression) as $char)
		{
			$pos++;
			if (!in_array($char, ["\n", "\r", "\t", " ", "(", ")"]))
				throw new \InvalidArgumentException($pos);
		}
	}
}
