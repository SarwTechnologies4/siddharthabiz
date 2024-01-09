<!DOCTYPE html>
<html>
<head>
	<title>Hotel api</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

</head>
<body>
	
	<form action="" method="post" id="nepalhotel_booking" data-url="result.php">
		<input type="hidden" name="nepalhotel_code" value="n4LuGa">
		<div class="col-sm-4">
			<div class="form-group">
				<label for="nepalhotel_check_in">Check In</label>
				<input type="text" class="form-control" name="nepalhotel_check_in" id="nepalhotel_check_in" placeholder="Check In">
			</div>
			<div class="form-group">
				<label for="nepalhotel_check_out">Check Out</label>
				<input type="text" class="form-control" name="nepalhotel_check_out" id="nepalhotel_check_out" placeholder="Check Out">
			</div>

			<button type="submit" class="btn btn-default" id="nepalhotel_submit">Submit</button>
		</div>
	</form>

	<!-- Scripts -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.11.4/jquery-ui.min.js"></script>
	<!-- Custom Script -->
	<script src="https://www.rojai.com/js/script.js"></script>
</body>
</html>