<!DOCTYPE html>
<html>
<head>
	<title>Hotel api</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

</head>
<body>
	
	<form action="" method="post" id="hotel_booking" data-url="result.php">
		<input type="hidden" name="hotel_code" value="hkBm1h">
		<div class="col-sm-4">
			<div class="form-group">
				<label for="hotel_check_in">Check In</label>
				<input type="text" class="form-control" name="hotel_check_in" id="hotel_check_in" placeholder="Check In">
			</div>
			<div class="form-group">
				<label for="hotel_check_out">Check Out</label>
				<input type="text" class="form-control" name="hotel_check_out" id="hotel_check_out" placeholder="Check Out">
			</div>

			<button type="submit" class="btn btn-default" id="hotel_submit">Submit</button>
		</div>
	</form>

	<!-- Scripts -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="https://ajax.aspnetcdn.com/ajax/jquery.ui/1.11.4/jquery-ui.min.js"></script>
	<!-- Custom Script -->
	<script src="js/script.js"></script>
</body>
</html>