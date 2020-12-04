<?php

/**
 * Modify WordPress admin behavior
 *
 * @package EightshiftBoilerplate\ModifyAdminAppearance
 */

declare(strict_types=1);

namespace EightshiftBoilerplate\ModifyAdminAppearance;

use EightshiftLibs\Services\ServiceInterface;

/**
 * Class that modifies some administrator appearance
 *
 * Example: Change color based on environment, remove dashboard widgets etc.
 */
class ModifyAdminAppearanceExample implements ServiceInterface
{

	/**
	 * List of admin color schemes.
	 *
	 * @var array
	 */
	public const COLOR_SCHEMES = [
		'default' => 'fresh',
		'staging' => 'blue',
		'production' => 'sunrise',
	];

	/**
	 * Register all the hooks
	 *
	 * @return void
	 */
	public function register(): void
	{
		\add_filter('get_user_option_admin_color', [$this, 'adminColor'], 10, 0);
	}

	/**
	 * Method that changes admin colors based on environment variable
	 *
	 * @return string Modified color scheme..
	 */
	public function adminColor(): string
	{
		$env = defined('EB_ENV') ? EB_ENV : 'default';

		$colors = self::COLOR_SCHEMES;

		if (!isset($colors[$env])) {
			return $colors['default'];
		}

		return $colors[$env];
	}
}
