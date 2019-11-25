<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use App\Services\ReportService;
use App\Services\AccountService;

class ReportController extends Controller
{
    private $reportService;
    private $accountService;

    /**
     * @param {ReportService} $reportService
     * @param {AccountService} $accountService
     */
    public function  __construct(
        ReportService $reportService,
        AccountService $accountService
    ) {
        $this->reportService = $reportService;
        $this->accountService = $accountService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reports = $this->reportService->getAll();

        return view('depozit.reports', [
            'reports' => $reports
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $accounts = $this->accountService->getAll();
        $this->accountService->blockAll();
        $this->reportService->create($accounts);
        $this->accountService->unblockAll();
        die('The report has been generated for yesterday: ' . date('Y-m-d'));
    }
}
