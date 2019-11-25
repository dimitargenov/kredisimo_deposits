<?php

namespace App\Services;

use App\Models\Client;

class ClientService 
{
	/**
	 * @return {array}			
	 */
	public function getAll(): array
	{
		return Client::all()->toArray();
	}

	/**
	 * @return {array}			
	 */
	public function getFirst(): array
	{
		return Client::first()->toArray();
	}
}