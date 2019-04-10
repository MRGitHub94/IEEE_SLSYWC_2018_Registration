<?php

if (isset($_REQUEST['submit'])) {
			$link = mysqli_connect('localhost:3306', 'svsl_mano', 'MR100%pro','svsl_ieeeSLSYWC');
		
			$track = ($_REQUEST["track"]);
	        $b =implode(",",$track);
	echo $b;
	
	$link->query("INSERT INTO test (track)
					VALUES ('$b');
				");
			
}

?>





<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
<form action="" method="post" enctype="multipart/form-data">
	
	<input type="checkbox" name="track[]" value="student">Student
	<input type="checkbox" name="track[]" value="yp">YP
	<input type="checkbox" name="track[]" value="wie">WIE
	
	<input type="submit" name="submit" value="submit">
	
	
	</form>
<body>
</body>
</html>