<?php
/**
 * Part of the Joomla Framework Google Package
 *
 * @copyright  Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Joomla\Google\Data;

use Joomla\Google\Auth;
use Joomla\Google\Data;
use Joomla\Registry\Registry;

/**
 * Google+ data class for the Joomla Platform.
 *
 * @since  1.0
 */
class Plus extends Data
{
	/**
	* @var    Plus\People  Google+ API object for people.
	* @since  1.0
	*/
	protected $people;

	/**
	* @var    Plus\Activities  Google+ API object for people.
	* @since  1.0
	*/
	protected $activities;

	/**
	* @var    Plus\Comments  Google+ API object for people.
	* @since  1.0
	*/
	protected $comments;

	/**
	 * Constructor.
	 *
	 * @param   Registry  $options  Google options object
	 * @param   Auth      $auth     Google data http client object
	 *
	 * @since   1.0
	 */
	public function __construct(Registry $options = null, Auth $auth = null)
	{
		// Setup the default API url if not already set.
		$options->def('api.url', 'https://www.googleapis.com/plus/v1/');

		parent::__construct($options, $auth);

		if (isset($this->auth) && !$this->auth->getOption('scope'))
		{
			$this->auth->setOption('scope', 'https://www.googleapis.com/auth/plus.me');
		}
	}

	/**
	 * Magic method to lazily create API objects
	 *
	 * @param   string  $name  Name of property to retrieve
	 *
	 * @return  Plus  Google+ API object (people, activities, comments).
	 *
	 * @since   1.0
	 */
	public function __get($name)
	{
		switch (strtolower($name))
		{
			case 'people':
				if ($this->people == null)
				{
					$this->people = new Plus\People($this->options, $this->auth);
				}

				return $this->people;

			case 'activities':
				if ($this->activities == null)
				{
					$this->activities = new Plus\Activities($this->options, $this->auth);
				}

				return $this->activities;

			case 'comments':
				if ($this->comments == null)
				{
					$this->comments = new Plus\Comments($this->options, $this->auth);
				}

				return $this->comments;
		}
	}
}
