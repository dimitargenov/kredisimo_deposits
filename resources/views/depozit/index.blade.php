<!doctype html>
<html lang="en">
	<head>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	  <meta name="csrf-token" content="{{ csrf_token() }}">
	  <title>Add depozit</title>
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
	  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>  
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
	  <style>
	   .error{ color:red; } 
	  </style> 
	</head>
 
	<body>
		<div class="container">
		<form id="form">
			<div class="row">
			    <h1>Add Depozit</h1>
			</div>

			<div class="row">		    
		    	<div class="form-group">
		    		<label>Client</label>
					<select class="form-control" name="client_id">
					        @foreach($clients as $client)
					            <option value="{{ $client['id'] }}" {{ $defaultClientId == $client['id'] ? 'selected="selected"' : '' }}>{{ $client['name'] }}</option>
					        @endforeach
					</select>    
		        </div>
		    </div>

		    <div class="row">
		        <div class="form-group">
		        	<label>Account</label>
					<select class="form-control" name="account_id">
					        @foreach($accounts as $account)
					            <option value="{{ $account['id'] }}">{{ $account['name'] }}</option>
					        @endforeach
					</select>    
		        </div>
		    </div>

		    <div class="row">
		        <div class="form-group">
		        	<label>Sum</label>
					<input class="form-control" type="text" name="sum" />  
		        </div>
		    </div>

		    <div class="row">
		        <div class="form-group">
			      <button class="btn btn-default" type="submit">Add</button>
			    </div>
			</div>  

			<div class="row">
		        <span id="result"></span>
			</div>    
		</form>	
		</div>
	</body>

	<script type="text/javascript">
	  $("select[name='client_id']").change(function(){
	      var client_id = $(this).val();
	      var token = $('meta[name="csrf-token"]').attr('content');
	      $.ajax({
	          url: "<?php echo route('select-client') ?>",
	          method: 'POST',
	          data: {client_id:client_id, _token:token},
	          success: function(data) {
	            $("select[name='account_id'").html('');
	            $("select[name='account_id'").html(data.options);
	          }
	      });
	  });

	  $("#form").submit(function(){
	  	  $("#result").html('');	
	      var account_id = $('select[name="account_id"]').val();
	      var sum = $('input[name="sum"]').val();
	      var token = $('meta[name="csrf-token"]').attr('content');
	      $.ajax({
	          url: "<?php echo route('add-depozit') ?>",
	          method: 'POST',
	          data: {account_id: account_id, sum: sum, _token:token},
	          success: function(data) {
	            $("#result").html('The depozit has been added');
	          }
	      });

	      return false;
	  });
	</script>

	<script type="text/javascript">
		jQuery.validator.addMethod("dollarsscents", function(value, element) {
	        return this.optional(element) || /^\d{0,4}(\.\d{0,2})?$/i.test(value);
	    }, "You must include two decimal places");


	   if ($("#form").length > 0) {
	    $("#form").validate({  
		    rules: {
		       sum: {
		            required: true,
		            minlength: 1,
		            dollarsscents:true,
		        },    
		    },
		    messages: {
		      sum: {
		        required: "Please enter sum",
		        minlength: "The sum should be decimal"
		      },   
		    },
		})
	  }
	</script>
</html>