<?php
//header( "refresh:5;url = ../successful" );

$fileExistsFlag = 0;
$fileName = $_FILES['Filename']['name'];

$link = mysqli_connect('localhost:3306', 'svsl_mano', 'MR100%pro','svsl_ieeeSLSYWC');
 
//$link = mysqli_connect('localhost', 'root', '','slsywc');
 
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
$firstname = mysqli_real_escape_string($link, $_POST["firstname"]);
$lastname = mysqli_real_escape_string($link, $_POST["lastname"]);
$gender = mysqli_real_escape_string($link, $_POST["gender"]);	
$nic = mysqli_real_escape_string($link, $_POST["nic"]);
$university = mysqli_real_escape_string($link, $_POST["university"]);	
$otheruni = mysqli_real_escape_string($link, $_POST["otheruni"]);
$faculty = mysqli_real_escape_string($link, $_POST["faculty"]);
$email = mysqli_real_escape_string($link, $_POST["email"]);	
$phone = mysqli_real_escape_string($link, $_POST["phone"]);	
$food = mysqli_real_escape_string($link, $_POST["food"]);	
$tshirt = mysqli_real_escape_string($link, $_POST["tshirt"]);	
$os = mysqli_real_escape_string($link, $_POST["os"]);	
$membership = mysqli_real_escape_string($link, $_POST["membership"]);	
$ieeeID = mysqli_real_escape_string($link, $_POST["ieeeID"]);	
$trackStudent = mysqli_real_escape_string($link, $_POST["trackStudent"]);	
$trackYP = mysqli_real_escape_string($link, $_POST["trackYP"]);
$trackWIE = mysqli_real_escape_string($link, $_POST["trackWIE"]);
$ieeeTime = mysqli_real_escape_string($link, $_POST["ieeeTime"]);
$ieeeExperience = mysqli_real_escape_string($link, $_POST["ieeeExperience"]);	
$slsywcParticipation = mysqli_real_escape_string($link, $_POST["slsywcParticipation"]);	
$slsywcYears = mysqli_real_escape_string($link, $_POST["slsywcYears"]);	
$feedback = mysqli_real_escape_string($link, $_POST["feedback"]);	

$target = "../profilePictures/";
$fileTarget = $target.$fileName;
$tempFileName = $_FILES["Filename"]["tmp_name"];

$result = move_uploaded_file($tempFileName,$fileTarget);
/*
*	If file was successfully uploaded in the destination folder
*/
if($result) {
    header( "refresh:0;url = ../successful" );
$query = "INSERT INTO delegates(filepath,filename,firstname,lastname,gender,nic,university,otheruni,faculty,email,phone,food,tshirt,os,membership,ieeeID,trackStudent,trackYP,trackWIE,ieeeTime,ieeeExperience,slsywcParticipation,slsywcYears,feedback) VALUES ('$fileTarget','$fileName','$firstname','$lastname','$gender','$nic','$university','$otheruni','$faculty','$email','$phone','$food','$tshirt','$os','$membership','$ieeeID','$trackStudent','$trackYP','$trackWIE','$ieeeTime','$ieeeExperience','$slsywcParticipation','$slsywcYears','$feedback')";
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