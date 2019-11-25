<?php

namespace App\Services;

use App\Models\Depozit;
use App\Models\Report;
use GuzzleHttp\Client;

class ReportService 
{
	/**
	 * Create new report			
	 */
	public function create(array $accounts)
	{
		$interests = 0;
		$calculation_date = date('Y-m-d');
		$day_deposit_count = 0;
		$total_deposit_count = count($accounts);

		foreach($accounts as $account) {
			$interests += $this->calculateCompoundInterest(
				$account['amount'], $account['investment_period']);

		}

		$this->record(
			$interests,
			$day_deposit_count,
			$total_deposit_count,
			$calculation_date
		);
	}

	public function record(
		$interests,
		$day_deposit_count,
		$total_deposit_count,
		$calculation_date
	) {

		$report = new Report;
		$report->interests = $interests;
		$report->day_depozits_count = $day_deposit_count;
		$report->total_depozits_count = $total_deposit_count;
		$report->calculation_date = $calculation_date;
	
		$report->save();
	}

	/**
	 * Show all reports
	 * return array
	 */
	public function getAll(): array
	{
		$usd_rate = $this->getUSDRate();
		$reports = Report::all()->toArray();

		return $this->attachInterestsInUsd($reports, $usd_rate);
	}

	public function getUSDRate(): float
	{
		$external_api = 'http://data.fixer.io/api/latest?access_key=0d52da9f2090212bec148d7cd9d858b1';
		$json = json_decode(file_get_contents($external_api), true);

		return ($json['rates']['USD']);
	}

	/**
	 * Attach to reports
	 * return array
	 */
	public function attachInterestsInUsd($reports, $usd_rate): array
	{
		return array_map(function($report) use ($usd_rate) {
			$interestsUsd = number_format($report['interests'] / $usd_rate, 2);
			$report['interests_usd'] = $interestsUsd;

			return $report;
		}, $reports);
	}

	public function calculateCompoundInterest($principal, int $investment_period)
	{
		$daily_interest_rate = 0.01;
		$number_of_calculations_rate = 365;

		$new_value = $principal*pow(
			(1+$daily_interest_rate/$number_of_calculations_rate), 
			$number_of_calculations_rate*$investment_period
		);

		return $new_value - $principal;
	}
}