<?php require_once('../includes/initialize.php');
$aId    =  !empty($_GET['id'])?addslashes($_GET['id']):'';
$getRow = Hotelapi::find_by_code($aId);
if(empty($getRow)) exit;
$indx_data='<!DOCTYPE html>
<html>
<head>
	<title>Hotel api</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

</head>
<body>
	
	<form action="" method="post" id="nepalhotel_booking" data-url="result.php">
		<input type="hidden" name="nepalhotel_code" value="'.$getRow->code.'">
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
	<script src="'.BASE_URL.'js/script.js"></script>
</body>
</html>';

$rslt_data='<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>Online Booking</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
</head>
<body class="common">
	<div id="nepalhotel_result">Loading....</div>
	<script src="'.BASE_URL.'js/result.min.js"></script>
	
</body>
</html>';
$n_file = array($indx_data=>'index.php', $rslt_data=>'result.php');
foreach($n_file as $data=>$file_name) {
	$tempath = SITE_ROOT.'apanel/hotelcode/'.$file_name;
	if(is_writable($tempath)) {
	    if (!$handle = fopen($tempath, 'a')) {
	        echo "Cannot open file ($tempath)";
	        exit;
	    }
	    $file = fopen($tempath,"w");
	      fwrite($file, $data);
	    fclose($file);
	}else {
	   echo "The file $tempath is not available!<br>Contact System Administrator ! <br />";
	}
}

/* creates a compressed zip file */
function create_zip($files = array(), $destination = '', $overwrite = false) {
	//if the zip file already exists and overwrite is false, return false
	if(file_exists($destination) && !$overwrite) { return false; }
	//vars
	$valid_files = array();
	//if files were passed in...
	if(is_array($files)) {
		//cycle through each file
		foreach($files as $file) {
			//make sure the file exists
			if(file_exists($file)) {
				$valid_files[] = $file;
			}
		}
	}
	//if we have good files...
	if(count($valid_files)) {
		//create the archive
		$zip = new ZipArchive();
		if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
			return false;
		}
		//add the files
		foreach($valid_files as $file) {
			$zip->addFile($file,$file);
		}
		//debug
		//echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;
		
		//close the zip -- done!
		$zip->close();
		
		//check to make sure the file exists
		return file_exists($destination);
	}
	else
	{
		return false;
	}
}