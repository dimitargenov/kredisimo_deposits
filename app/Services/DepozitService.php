<?php

namespace App\Services;

use App\Models\Depozit;
use App\Models\Account;

class DepozitService 
{
	/**
	 * Add new depozit			
	 */
	public function add(int $account_id, $amount)
	{
		$depozit = new Depozit;
		$depozit->account_id = $account_id;
		$depozit->amount = $amount;

        if ($depozit->save()) {
        	$this->addToAccount($account_id, $amount);
        }
	}

	/**
	 * Add the new depozit amount to account			
	 */
	public function addToAccount($account_id, $amount)
	{
		$account = Account::where('id', $account_id)->first();
		$new_amount = $account->amount + $amount;

		$account = Account::where('id', $account_id)->update(['amount' => $new_amount]);
	}
}