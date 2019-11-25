<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Client;
use App\Models\Account;

class AccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$clients = [
            ['id' => 1, 'name' => 'Ivan Ivanov'],
            ['id' => 2, 'name' => 'Petar Petrov'],
        ];

        $accounts = [
            [
	            'name' => 'AC100001',
	            'client_id' => 1,
	            'amount' => 50.55,
	            'blocked' => false,
	            'last_calculation' => '2019-11-24',
	            'investment_period' => 4
	        ],
	        [
	            'name' => 'AC100002',
	            'client_id' => 1,
	            'amount' => 10.00,
	            'blocked' => false,
	            'last_calculation' => '2019-11-24',
	            'investment_period' => 1
	        ],
	        [
	            'name' => 'AC100003',
	            'client_id' => 2,
	            'amount' => 0,
	            'blocked' => false,
	            'last_calculation' => '2019-11-24',
	            'investment_period' => 10
	        ],
	        [
	            'name' => 'AC100004',
	            'client_id' => 2,
	            'amount' => 100.00,
	            'blocked' => false,
	            'last_calculation' => '2019-11-24',
	            'investment_period' => 2
	        ]
        ];

        Client::insert($clients);
        Account::insert($accounts);
    }
}
