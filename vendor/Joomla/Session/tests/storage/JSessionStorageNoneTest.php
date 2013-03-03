<?php
/**
 * @package    Joomla\Framework\Test
 * @copyright  Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

use Joomla\Session\Storage;

/**
 * Test class for JSessionStorageNone.
 * Generated by PHPUnit on 2011-10-26 at 19:36:08.
 *
 * @package  Joomla\Framework\Test
 * @since    11.1
 */
class JSessionStorageNoneTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @var JSessionStorageNone
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 *
	 * @return void
	 */
	protected function setUp()
	{
		parent::setUp();

		$this->object = Storage::getInstance('None');
	}

	/**
	 * Test JSessionStorageNone::Register().
	 *
	 * @return void
	 */
	public function testRegister()
	{
		$this->assertThat(
			$this->object->register(),
			$this->equalTo(null)
		);
	}
}
