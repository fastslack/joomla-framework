<?php
/**
 * @package    Joomla\Framework
 * @copyright  Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Joomla\Github;

use DomainException;

/**
 * GitHub API Forks class for the Joomla Platform.
 *
 * @package  Joomla\Framework
 * @since    11.3
 */
class Forks extends Object
{
	/**
	 * Method to fork a repository.
	 *
	 * @param   string  $user  The name of the owner of the GitHub repository.
	 * @param   string  $repo  The name of the GitHub repository.
	 * @param   string  $org   The organization to fork the repo into. By default it is forked to the current user.
	 *
	 * @return  object
	 *
	 * @since   11.4
	 * @throws  DomainException
	 */
	public function create($user, $repo, $org = '')
	{
		// Build the request path.
		$path = '/repos/' . $user . '/' . $repo . '/forks';

		if (strlen($org) > 0)
		{
			$data = json_encode(
				array('org' => $org)
			);
		}
		else
		{
			$data = json_encode(array());
		}

		// Send the request.
		$response = $this->client->post($this->fetchUrl($path), $data);

		// Validate the response code.
		if ($response->code != 202)
		{
			// Decode the error response and throw an exception.
			$error = json_decode($response->body);
			throw new DomainException($error->message, $response->code);
		}

		return json_decode($response->body);
	}

	/**
	 * Method to list forks for a repository.
	 *
	 * @param   string   $user   The name of the owner of the GitHub repository.
	 * @param   string   $repo   The name of the GitHub repository.
	 * @param   integer  $page   Page to request
	 * @param   integer  $limit  Number of results to return per page
	 *
	 * @return  array
	 *
	 * @since   11.4
	 * @throws  DomainException
	 */
	public function getList($user, $repo, $page = 0, $limit = 0)
	{
		// Build the request path.
		$path = '/repos/' . $user . '/' . $repo . '/forks';

		// Send the request.
		$response = $this->client->get($this->fetchUrl($path, $page, $limit));

		// Validate the response code.
		if ($response->code != 200)
		{
			// Decode the error response and throw an exception.
			$error = json_decode($response->body);
			throw new DomainException($error->message, $response->code);
		}

		return json_decode($response->body);
	}
}
