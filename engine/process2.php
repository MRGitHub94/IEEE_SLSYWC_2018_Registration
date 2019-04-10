<?php
//header( "refresh:5;url = ../registration_successful" );

$fileExistsFlag = 0;
$fileName = $_FILES['Filename']['name'];

$link = mysqli_connect('localhost', 'root', '','slsywc');
 
/*
*	Checking whether the file already exists in the destination folder
*/
$query = "SELECT filename FROM delegates WHERE filename='$fileName'";
$result = $link->query($query) or die("Error : ".mysqli_error($link));
while($row = mysqli_fetch_array($result)) {
if($row['filename'] == $fileName) {
$fileExistsFlag = 1;
}
}
/*
* If file is not present in the destination folder
*/
if($fileExistsFlag == 0) {

	
$target = "../profilePictures/";
$fileTarget = $target.$fileName;
$tempFileName = $_FILES["Filename"]["tmp_name"];

$result = move_uploaded_file($tempFileName,$fileTarget);
	
		
	
	
	
$firstname = mysqli_real_escape_string($link, $_POST["firstname"]);
$lastname = mysqli_real_escape_string($link, $_POST["lastname"]);
$gender = mysqli_real_escape_string($link, $_POST["gender"]);	
$nic = mysqli_real_escape_string($link, $_POST["nic"]);
$university = mysqli_real_escape_string($link, $_POST["university"]);	
$email = mysqli_real_escape_string($link, $_POST["email"]);	
$phone = mysqli_real_escape_string($link, $_POST["phone"]);	
$food = mysqli_real_escape_string($link, $_POST["food"]);	
$tshirt = mysqli_real_escape_string($link, $_POST["tshirt"]);	
$os = mysqli_real_escape_string($link, $_POST["os"]);	
$membership = mysqli_real_escape_string($link, $_POST["membership"]);	
$ieeeID = mysqli_real_escape_string($link, $_POST["ieeeID"]);	
$track = mysqli_real_escape_string($link, $_POST["track"]);	
$ieeeTime = mysqli_real_escape_string($link, $_POST["ieeeTime"]);
$ieeeExperience = mysqli_real_escape_string($link, $_POST["ieeeExperience"]);	
$slsywcParticipation = mysqli_real_escape_string($link, $_POST["slsywcParticipation"]);	
$slsywcYears = mysqli_real_escape_string($link, $_POST["slsywcYears"]);	
$feedback = mysqli_real_escape_string($link, $_POST["feedback"]);	
	
	



	
	
	
	
/*
*	If file was successfully uploaded in the destination folder
*/
if($result) {
    header( "refresh:0;url = successful" );
$query = "INSERT INTO delegates(filepath,filename,firstname,lastname,gender,nic,university,email,phone,food,tshirt,os,membership,ieeeID,track,ieeeTime,ieeeExperience,slsywcParticipation,slsywcYears,feedback) VALUES ('$fileTarget','$fileName','$firstname','$lastname','$gender','$nic','$university','$email','$phone','$food','$tshirt','$os','$membership','$ieeeID','$track','$ieeeTime','$ieeeExperience','$slsywcParticipation','$slsywcYears','$feedback')";
$link->query($query) or die("Error : ".mysqli_error($link));
}
else {
header( "refresh:0;url = ../unsuccessful" );
}
mysqli_close($link);
}
/*
* If file is already present in the destination folder
*/
else {
header( "refresh:0;url = ../hold" );
mysqli_close($link);
}
?>