<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ClientService;
use App\Services\AccountService;
use App\Services\DepozitService;

class DepozitController extends Controller
{
	private $accountService;
	private $clientService;
	private $depozitService;

	/**
	 * @param {AccountService} $accountService
	 * @param {ClientService} $clientService
	 * @param {DepozitService} $depozitService
	 */
	public function __construct(
		AccountService $accountService,
		ClientService $clientService,
		DepozitService $depozitService
	) {
		$this->accountService = $accountService;
		$this->clientService = $clientService;
		$this->depozitService = $depozitService;
	}

    public function index()
    {
    	$defaultClient = $this->clientService->getFirst();
    	$clients = $this->clientService->getAll();
    	$accounts = $this->accountService->getAllByClientId($defaultClient['id']);

    	return view('depozit.index', [
        	'accounts' => $accounts, 
        	'clients' => $clients,
        	'defaultClientId' => $defaultClient['id']
        ]);
    }

    /**
     * Show the application selecClient.
     *
     * @return \Illuminate\Http\Response
     */
	public function selectClient(Request $request)
	{
		if($request->ajax()){
			$client_id = $request->client_id;
			$accounts = $this->accountService->getAllByClientId($client_id);
    		$data = view('depozit.accounts', compact('accounts'))->render();

    		return response()->json(['options'=>$data]);
    	}
	}

	/**
     * Show the application add.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
    	if($request->ajax()){
			$account_id = $request->account_id;
			$sum = $request->sum;
			$result = [];
			if (!$this->accountService->isBlocked($account_id)) {
				$result = $this->depozitService->add($account_id, $sum);
			}

     		return response()->json(['result'=> $result]);
    	}
    }
}
