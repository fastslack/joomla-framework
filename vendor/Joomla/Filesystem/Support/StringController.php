<?php
/**
 * @package    Joomla\Framework
 * @copyright  Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Joomla\Filesystem\Support;

/**
 * String Controller
 *
 * @package  Joomla\Framework
 * @since    11.1
 */
class StringController
{
	/**
	 * Defines a variable as an array
	 *
	 * @return  array
	 *
	 * @since   11.1
	 */
	public function _getArray()
	{
		static $strings = array();

		return $strings;
	}

	/**
	 * Create a reference
	 *
	 * @param   string  $reference  The key
	 * @param   string  &$string    The value
	 *
	 * @return  void
	 *
	 * @since   11.1
	 */
	public function createRef($reference, &$string)
	{
		$ref = &self::_getArray();
		$ref[$reference] = & $string;
	}

	/**
	 * Get reference
	 *
	 * @param   string  $reference  The key for the reference.
	 *
	 * @return  mixed  False if not set, reference if it it exists
	 *
	 * @since   11.1
	 */
	public function getRef($reference)
	{
		$ref = &self::_getArray();

		if (isset($ref[$reference]))
		{
			return $ref[$reference];
		}
		else
		{
			return false;
		}
	}
}
