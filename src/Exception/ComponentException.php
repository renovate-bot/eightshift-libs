<?php

/**
 * File containing the failure exception class when trying to locate a template that doesn't exist.
 *
 * @package EightshiftLibs\Exception
 */

declare(strict_types=1);

namespace EightshiftLibs\Exception;

/**
 * Class Component_Exception.
 */
final class ComponentException extends \InvalidArgumentException implements GeneralExceptionInterface
{

	/**
	 * Throws exception if ensure_string argument is invalid.
	 *
	 * @param mixed $variable Variable that's of invalid type.
	 *
	 * @return static
	 */
	public static function throwNotStringOrArray($variable)
	{
		if (gettype($variable) !== 'object') {
			$output = sprintf(
				/* translators: %1$s is replaced with the name of the variable, and %2$s with its type. */
				\esc_html__('%1$s variable is not a string or array but rather %2$s', 'eightshift-libs'),
				$variable,
				gettype($variable)
			);
		} else {
			$output = \esc_html__('Object can\'t be converted to string. Please provide only string or array.', 'eightshift-libs');
		}

		return new static($output);
	}

	/**
	 * Throws exception if ensure_string argument is invalid.
	 *
	 * @param string $component Missing component name.
	 * @return static
	 */
	public static function throwUnableToLocateComponent(string $component)
	{
		return new static(
			sprintf(
			/* translators: %s is replaced with the path of the component. */
				\esc_html__('Unable to locate component by path: %s', 'eightshift-libs'),
				$component
			)
		);
	}
}
