<?php

namespace App\Services;

use App\Models\Account;

class AccountService 
{
	/**
	 * @param {number} $clientId
	 * @return {array}			
	 */
	public function getAllByClientId(int $clientId)
	{
		return Account::where('client_id', $clientId)->get()->toArray();
	}

	/**
	 * @return {array}			
	 */
	public function getAll(): array
	{
		return Account::all()->toArray();
	}

	/**
	 * @param int $account_id
	 * @return bool
	 */
	public function isBlocked(int $account_id): bool
	{
		$account = Account::where('id', $account_id)->first();
		
		return $account->blocked;
	}	

	public function blockAll():void 
	{
		Account::where('blocked', false)->update(['blocked' => true]);
	}

	public function unblockAll():void 
	{
		Account::where('blocked', true)->update(['blocked' => false]);
	}
}