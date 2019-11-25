<!doctype html>
<html lang="en">
	<head>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	  <meta name="csrf-token" content="{{ csrf_token() }}">
	  <title>All reports</title>
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" /> 
	</head>
	<body>
		<div class="container">
		<form id="form">
			<div class="row">
			    <h1>Reports</h1>
			</div>

			<div class="row">	
				<div class="table-responsive">
				  <table class="table">
				  	<tr>
				  		<th>Id</th>
				  		<th>Day</th>
				  		<th>Depozits for the day</th>
				  		<th>Total depozits</th>
				  		<th>Interests (BGN)</th>
				  		<th>Interests (USD)</th>
				  	</tr>
				  	@foreach($reports as $report)
				  		<tr>
				  			<th>{{$report['id']}}</th>
					  		<th>{{$report['calculation_date']}}</th>
					  		<th>{{$report['day_depozits_count']}}</th>
					  		<th>{{$report['total_depozits_count']}}</th>
					  		<th>{{$report['interests']}}</th>
					  		<th>{{$report['interests_usd']}}</th>
				  		</tr>
				  	@endforeach	
				  </table>
				</div>
		    </div>
		</div>
	</body>
</html>