<?php

	$msg1 = "";
    $msg2 = "";
    $msg3 = "";

	use PHPMailer\PHPMailer\PHPMailer;

	if (isset($_POST['submit'])) {
		
		
        $fileExistsFlag = 0;
        $fileName = $_FILES['Filename']['name'];

		
		$link = mysqli_connect('localhost:3306', 'svsl_mano', 'MR100%pro','svsl_ieeeSLSYWC');
		
		
		$query = "SELECT filename FROM delegates WHERE filename='$fileName'";
        $result = $link->query($query) or die("Error : ".mysqli_error($link));
        while($row = mysqli_fetch_array($result)) {
        if($row['filename'] == $fileName) {
        $fileExistsFlag = 1;
                  }
           }
		
		
		if($fileExistsFlag == 0){
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
	       
			$track = mysqli_real_escape_string($link, $_POST["track"]);
			
	
			$ieeeTime = mysqli_real_escape_string($link, $_POST["ieeeTime"]);
			$ieeeExperience = mysqli_real_escape_string($link, $_POST["ieeeExperience"]);	
			$slsywcParticipation = mysqli_real_escape_string($link, $_POST["slsywcParticipation"]);	
//			$slsywcYears = mysqli_real_escape_string($link, $_POST["slsywcYears"]);	
			$feedback = mysqli_real_escape_string($link, $_POST["feedback"]);

			$target = "profilePictures/";
			$ext = end(explode('.', $_FILES['Filename']['name']));
			$fileName = md5(rand()) . '.' . $ext;
			$fileTarget = $target.$fileName;
			$tempFileName = $_FILES["Filename"]["tmp_name"];

			$result = move_uploaded_file($tempFileName,$fileTarget);			
			
			

     if($result){
			
		if ($email == "")
			$msg = "Please check your inputs!";
		else {
			$sql = $link->query("SELECT id FROM delegates WHERE email='$email'");
			if ($sql->num_rows > 0) {
				$msg1 = "Your E-Mail address is already exists in our platform!";
			} else {
				$token = 'qwertzuiopasdfghjklyxcvbnmQWERTZUIOPASDFGHJKLYXCVBNM0123456789!$/()*';
				$token = str_shuffle($token);
				$token = substr($token, 0, 10);

				$link->query("INSERT INTO delegates (filepath,filename,firstname,lastname,gender,nic,university,otheruni,faculty,email,phone,food,tshirt,os,membership,ieeeID,track,ieeeTime,ieeeExperience,slsywcParticipation,feedback,isEmailConfirmed,token)
					VALUES ('$fileTarget','$fileName','$firstname','$lastname','$gender','$nic','$university','$otheruni','$faculty','$email','$phone','$food','$tshirt','$os','$membership','$ieeeID','$track','$ieeeTime','$ieeeExperience','$slsywcParticipation','$feedback', '0', '$token');
				");
				

                include_once "PHPMailer/PHPMailer.php";

                $mail = new PHPMailer();
                $mail->setFrom('noreply@sywc.ieee.lk', 'IEEE SLSYWC Team');
                $mail->addAddress($email, $firstname);
                $mail->Subject = "[Important] Verify Your Registration | IEEE Sri Lanka Section SYW Congress";
                $mail->isHTML(true);
                $mail->Body = "
				
				<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html style='width:100%;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0;'>
	
 <head> 
  <meta charset='UTF-8'> 
  <meta content='width=device-width, initial-scale=1' name='viewport'> 
  <meta name='x-apple-disable-message-reformatting'> 
  <meta http-equiv='X-UA-Compatible' content='IE=edge'> 
  <meta content='telephone=no' name='format-detection'> 
   
  <!--[if (mso 16)]>
    <style type='text/css'>
    a {text-decoration: none;}
    </style>
    <![endif]--> 
  <!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]--> 
  <!--[if !mso]><!-- --> 
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i' rel='stylesheet'> 
  <!--<![endif]--> 
	 
  <style type='text/css'>
@media only screen and (max-width:600px) {p, ul li, ol li, a { font-size:16px!important } h1 { font-size:32px!important; text-align:center } h2 { font-size:26px!important; text-align:center } h3 { font-size:20px!important; text-align:center } h1 a { font-size:32px!important } h2 a { font-size:26px!important } h3 a { font-size:20px!important } .es-menu td a { font-size:16px!important } .es-header-body p, .es-header-body ul li, .es-header-body ol li, .es-header-body a { font-size:16px!important } .es-footer-body p, .es-footer-body ul li, .es-footer-body ol li, .es-footer-body a { font-size:16px!important } .es-infoblock p, .es-infoblock ul li, .es-infoblock ol li, .es-infoblock a { font-size:12px!important } *[class='gmail-fix'] { display:none!important } .es-m-txt-c, .es-m-txt-c h1, .es-m-txt-c h2, .es-m-txt-c h3 { text-align:center!important } .es-m-txt-r, .es-m-txt-r h1, .es-m-txt-r h2, .es-m-txt-r h3 { text-align:right!important } .es-m-txt-l, .es-m-txt-l h1, .es-m-txt-l h2, .es-m-txt-l h3 { text-align:left!important } .es-m-txt-r img, .es-m-txt-c img, .es-m-txt-l img { display:inline!important } .es-button-border { display:inline-block!important } .es-button { font-size:16px!important; display:inline-block!important; border-width:15px 30px 15px 30px!important } .es-btn-fw { border-width:10px 0px!important; text-align:center!important } .es-adaptive table, .es-btn-fw, .es-btn-fw-brdr, .es-left, .es-right { width:100%!important } .es-content table, .es-header table, .es-footer table, .es-content, .es-footer, .es-header { width:100%!important; max-width:600px!important } .es-adapt-td { display:block!important; width:100%!important } .adapt-img { width:100%!important; height:auto!important } .es-m-p0 { padding:0px!important } .es-m-p0r { padding-right:0px!important } .es-m-p0l { padding-left:0px!important } .es-m-p0t { padding-top:0px!important } .es-m-p0b { padding-bottom:0!important } .es-m-p20b { padding-bottom:20px!important } .es-mobile-hidden, .es-hidden { display:none!important } .es-desk-hidden { display:table-row!important; width:auto!important; overflow:visible!important; float:none!important; max-height:inherit!important; line-height:inherit!important } .es-desk-menu-hidden { display:table-cell!important } table.es-table-not-adapt, .esd-block-html table { width:auto!important } table.es-social { display:inline-block!important } table.es-social td { display:inline-block!important } }
#outlook a {
	padding:0;
}
.ExternalClass {
	width:100%;
}
.ExternalClass,
.ExternalClass p,
.ExternalClass span,
.ExternalClass font,
.ExternalClass td,
.ExternalClass div {
	line-height:100%;
}
.es-button {
	mso-style-priority:100!important;
	text-decoration:none!important;
}
a[x-apple-data-detectors] {
	color:inherit!important;
	text-decoration:none!important;
	font-size:inherit!important;
	font-family:inherit!important;
	font-weight:inherit!important;
	line-height:inherit!important;
}
.es-desk-hidden {
	display:none;
	float:left;
	overflow:hidden;
	width:0;
	max-height:0;
	line-height:0;
	mso-hide:all;
}
</style> 
 </head> 
 <body style='width:100%;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0;'> 
  <div class='es-wrapper-color' style='background-color:#EEEEEE;'> 
   <!--[if gte mso 9]>
			<v:background xmlns:v='urn:schemas-microsoft-com:vml' fill='t'>
				<v:fill type='tile' color='#eeeeee'></v:fill>
			</v:background>
		<![endif]--> 
   <table class='es-wrapper' width='100%' cellspacing='0' cellpadding='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top;'> 
     <tr style='border-collapse:collapse;'> 
      <td valign='top' style='padding:0;Margin:0;'> 
       <table class='es-content' cellspacing='0' cellpadding='0' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;'> 
         <tr style='border-collapse:collapse;'> 
         </tr> 
         <tr style='border-collapse:collapse;'> 
          <td align='center' style='padding:0;Margin:0;'> 
           <table class='es-content-body' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;' width='600' cellspacing='0' cellpadding='0' align='center'> 
             <tr style='border-collapse:collapse;'> 
              <td align='left' style='Margin:0;padding-left:10px;padding-right:10px;padding-top:15px;padding-bottom:15px;'> 
               <!--[if mso]><table width='580' cellpadding='0' cellspacing='0'><tr><td width='282' valign='top'><![endif]--> 
               <table class='es-left' cellspacing='0' cellpadding='0' align='left' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left;'> 
                 <tr style='border-collapse:collapse;'> 
                  <td width='282' align='left' style='padding:0;Margin:0;'> 
                   <table width='100%' cellspacing='0' cellpadding='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;'> 
                     <tr style='border-collapse:collapse;'> 
                      <td class='es-infoblock es-m-txt-c' align='left' style='padding:0;Margin:0;line-height:90%;font-size:18px;color:#CCCCCC;'> <p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:12px;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:80%;color:#CCCCCC;'><small>IEEE SLSYWC Registration Verification</small></p> </td> 
                     </tr> 
                   </table> </td> 
                 </tr> 
               </table> 
               <!--[if mso]></td><td width='20'></td><td width='278' valign='top'><![endif]--> 
               <table class='es-right' cellspacing='0' cellpadding='0' align='right' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right;'> 
                 <tr style='border-collapse:collapse;'> 
                  <td width='278' align='left' style='padding:0;Margin:0;'> 
                   <table width='100%' cellspacing='0' cellpadding='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;'> 
                     <tr style='border-collapse:collapse;'> 
                      <td align='center' style='padding:0;Margin:0;display:none;'></td> 
                     </tr> 
                   </table> </td> 
                 </tr> 
               </table> 
               <!--[if mso]></td></tr></table><![endif]--> </td> 
             </tr> 
           </table> </td> 
         </tr> 
       </table> 
       <table class='es-content' cellspacing='0' cellpadding='0' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;'> 
         <tr style='border-collapse:collapse;'> 
         </tr> 
         <tr style='border-collapse:collapse;'> 
          <td align='center' style='padding:0;Margin:0;'> 
           <table class='es-header-body' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#044767;' width='600' cellspacing='0' cellpadding='0' bgcolor='#044767' align='center'> 
             <tr style='border-collapse:collapse;'> 
              <td align='left' style='Margin:0;padding-top:35px;padding-bottom:35px;padding-left:35px;padding-right:35px;'> 
               <!--[if mso]><table width='530' cellpadding='0' cellspacing='0'><tr><td width='340' valign='top'><![endif]--> 
               <table class='es-left' cellspacing='0' cellpadding='0' align='left' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left;'> 
                 <tr style='border-collapse:collapse;'> 
                  <td class='es-m-p0r es-m-p20b' width='340' valign='top' align='center' style='padding:0;Margin:0;'> 
                   <table width='100%' cellspacing='0' cellpadding='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;'> 
                     <tr style='border-collapse:collapse;'> 
                      <td class='es-m-txt-c' align='left' style='padding:0;Margin:0;'> <h1 style='Margin:0;line-height:80%;mso-line-height-rule:exactly;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;font-size:36px;font-style:normal;font-weight:bold;color:#FFFFFF;'><font color='#F1F1F1' size='6'>IEEE SLSYWC 2018</font></h1> </td> 
                     </tr> 
                   </table> </td> 
                 </tr> 
               </table> 
               <!--[if mso]></td><td width='20'></td><td width='170' valign='top'><![endif]--> 
               <table cellspacing='0' cellpadding='0' align='right' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;'> 
                 <tr class='es-hidden' style='border-collapse:collapse;'> 
                  <td class='es-m-p20b' width='170' align='left' style='padding:0;Margin:0;'> 
                   <table width='100%' cellspacing='0' cellpadding='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;'> 
                     <tr style='border-collapse:collapse;'> 
                      <td align='center' style='padding:0;Margin:0;padding-bottom:5px;'> 
                       <table width='100%' height='100%' cellspacing='0' cellpadding='0' border='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;'> 
                         <tr style='border-collapse:collapse;'> 
                          <td style='padding:0;Margin:0px;border-bottom:1px solid #044767;background:rgba(0, 0, 0, 0) none repeat scroll 0% 0%;height:1px;width:100%;margin:0px;'></td> 
                         </tr> 
                       </table> </td> 
                     </tr> 
                     <tr style='border-collapse:collapse;'> 
                      <td style='padding:0;Margin:0;'> 
                       <table cellspacing='0' cellpadding='0' align='right' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;'> 
                       </table> </td> 
                     </tr> 
                   </table> </td> 
                 </tr> 
               </table> 
               <!--[if mso]></td></tr></table><![endif]--> </td> 
             </tr> 
           </table> </td> 
         </tr> 
       </table> 
       <table class='es-content' cellspacing='0' cellpadding='0' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;'> 
         <tr style='border-collapse:collapse;'> 
          <td align='center' style='padding:0;Margin:0;'> 
           <table class='es-content-body' width='600' cellspacing='0' cellpadding='0' bgcolor='#ffffff' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;'> 
             <tr style='border-collapse:collapse;'> 
              <td style='Margin:0;padding-bottom:35px;padding-left:35px;padding-right:35px;padding-top:40px;background-color:#FFFFFF;' bgcolor='#ffffff' align='left'> 
               <table width='100%' cellspacing='0' cellpadding='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;'> 
                 <tr style='border-collapse:collapse;'> 
                  <td width='530' valign='top' align='center' style='padding:0;Margin:0;'> 
                   <table width='100%' cellspacing='0' cellpadding='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;'> 
                     <tr style='border-collapse:collapse;'> 
                      <td align='center' style='padding:0;Margin:0;'> <img class='adapt-img' src='https://ifocf.stripocdn.email/content/guids/CABINET_c2866961aa4dd8aa5cbd1b3b8d563213/images/97631539315742082.jpg' alt='' style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;' width='451'></td> 
                     </tr> 
                     
                     <tr style='border-collapse:collapse;'> 
                      <td align='left' style='padding:0;Margin:0;padding-bottom:10px;padding-top:15px;'> 
						  <h2 style='Margin:0;line-height:120%;mso-line-height-rule:exactly;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;font-size:30px;font-style:normal;font-weight:bold;color:#333333;'><font size='6'><br>Hello $firstname,</font></h2>
						  
						  <p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:16px;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;line-height:150%;color:#777777;'><font color='#4D4D4D' size='3'>You are one step away from verifying your identity to complete the registration process for IEEE Student | Young Professional | Women In Engineering Congress 2018 organized by IEEE Sri Lanka Section.</font></p> </td> 
                     </tr> 
                     <tr style='border-collapse:collapse;'> 
                      <td align='center' style='padding:20px;Margin:0;'> 
                       <table border='0' width='100%' height='100%' cellpadding='0' cellspacing='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;'> 
                         <tr style='border-collapse:collapse;'> 
                          <td style='padding:0;Margin:0px 0px 0px 0px;border-bottom:1px solid #CCCCCC;background:none;height:1px;width:100%;margin:0px;'></td> 
                         </tr> 
                       </table> </td> 
                     </tr> 
                     
					   
                     <tr style='border-collapse:collapse;'> 
                      <td align='center' style='padding:0;Margin:0;padding-bottom:10px;padding-top:15px;'> 
						  <h2 style='Margin:0;line-height:120%;mso-line-height-rule:exactly;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;font-size:30px;font-style:normal;font-weight:bold;color:#333333;'><font size='6'><strong>LAST STEP</strong></font></h2>
						  
						  <p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:16px;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;line-height:150%;color:#777777;'><font color='#989898'>Your privacy is very important to us, so please click 'Verify Me' below to ensure your registration is securely verified.</font></p> </td> 
                     </tr> 
					   
                     <tr style='border-collapse:collapse;'> 
                      <td align='center' style='Margin:0;padding-left:10px;padding-right:10px;padding-bottom:10px;padding-top:10px;'> <span class='es-button-border' style='border-style:solid;border-color:transparent;background:#F11E32;border-width:0px;display:inline-block;border-radius:5px;width:auto;'> 
						
						<a href=' https://sywc.ieee.lk/test_reg/confirm.php?email=$email&token=$token'> <img class='adapt-img' src='https://sywc.ieee.lk/images/verifyme.png' alt='' style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;' width='200'></a> </span> </td> 
                     </tr> 
                   </table> </td> 
                 </tr> 
               </table> </td> 
             </tr> 
           </table> </td> 
         </tr> 
       </table> 
       <table class='es-content' cellspacing='0' cellpadding='0' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;'> 
         <tr style='border-collapse:collapse;'> 
         </tr> 
         <tr style='border-collapse:collapse;'> 
          <td align='center' style='padding:0;Margin:0;'> 
           <table class='es-content-body' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#1B9BA3;' width='600' cellspacing='0' cellpadding='0' bgcolor='#1b9ba3' align='center'> 
             <tr style='border-collapse:collapse;'> 
              <td align='left' style='Margin:0;padding-top:35px;padding-bottom:35px;padding-left:35px;padding-right:35px;'> 
               <table width='100%' cellspacing='0' cellpadding='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;'> 
                 <tr style='border-collapse:collapse;'> 
                  <td width='530' valign='top' align='center' style='padding:0;Margin:0;'> 
                   <table width='100%' cellspacing='0' cellpadding='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;'> 
                     <tr style='border-collapse:collapse;'> 
                      <td align='center' style='padding:0;Margin:0;padding-top:30px;'> <h2 style='Margin:0;line-height:80%;mso-line-height-rule:exactly;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;font-size:24px;font-style:normal;font-weight:bold;color:#FFFFFF;'><font color='#F8F8F8'><font size='6'>Sri Lanka's Largest Congress in Engineering</font></h2> </td> <br>
						 
						
                     </tr> 
                     <tr style='border-collapse:collapse;'> 
                       <td align='center' style='Margin:0;padding-left:10px;padding-right:10px;padding-bottom:15px;padding-top:30px;'> <span class='es-button-border' style='border-style:solid;border-color:transparent;background:none 0% 0% repeat scroll #66B3B7;border-width:0px;display:inline-block;border-radius:5px;width:auto;'> 
						
						  <a href=' https://sywc.ieee.lk'> <img class='adapt-img' src='https://sywc.ieee.lk/images/visitnow.png' alt='' style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;' width='170'></a>
						  
						  
						  
						 </span> </td> 
                     </tr> 
					   
                   </table> </td> 
                 </tr> 
               </table> </td> 
             </tr> 
           </table> </td> 
         </tr> 
       </table> 
       <table class='es-footer' cellspacing='0' cellpadding='0' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top;'> 
         <tr style='border-collapse:collapse;'> 
          <td align='center' style='padding:0;Margin:0;'> 
           <table class='es-footer-body' width='600' cellspacing='0' cellpadding='0' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;'> 
             <tr style='border-collapse:collapse;'> 
              <td align='left' style='Margin:0;padding-top:35px;padding-left:35px;padding-right:35px;padding-bottom:40px;'> 
               <table width='100%' cellspacing='0' cellpadding='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;'> 
                 <tr style='border-collapse:collapse;'> 
                  <td width='530' valign='top' align='center' style='padding:0;Margin:0;'> 
                   <table width='100%' cellspacing='0' cellpadding='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;'> 
                     <tr style='border-collapse:collapse;'> 
                      <td align='center' style='padding:0;Margin:0;padding-bottom:35px;'> <p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;line-height:150%;color:#333333;'><font size='4' color='#313131'><strong>IEEE SLSYW Congress<br>Colombo, Sri Lanka</strong></font></p> </td> 
                     </tr> 
                     <tr style='border-collapse:collapse;'> 
                      <td class='es-m-txt-c' esdev-links-color='#777777' align='center' style='padding:0;Margin:0;padding-bottom:5px;'> <p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:11px;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;line-height:150%;color:#777777;'><font color='#8C8C8C'>Need help? Visit our <a target='_blank' style='-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;font-size:11px;text-decoration:none;color:#333333;' href='https://sywc.ieee.lk/contact'>Support Desk</a> or report bug to <a target='_blank' style='-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;font-size:11px;text-decoration:none;color:#333333;' href='mailto:manoranjana@ieee.org'>Webmaster</a>. <br>Copyright (c) 2018 IEEE YWC., Sri Lanka Section. | Developed by<a target='_blank' style='-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;font-size:11px;text-decoration:none;color:#333333;' href='http://fb.com/mrfbonline'> MR</a> in <a target='_blank' style='-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;font-size:11px;text-decoration:none;color:#333333;' href='http://smartvalley.lk'>Smart Valley</a>.</font></p>
						  
						  
						  
						 </td> 
                     </tr> 
                   </table> </td> 
                 </tr> 
               </table> </td> 
             </tr> 
           </table> </td> 
         </tr> 
       </table> 
       <table class='es-content' cellspacing='0' cellpadding='0' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;'> 
         <tr style='border-collapse:collapse;'> 
          <td align='center' style='padding:0;Margin:0;'> 
           <table class='es-content-body' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;' width='600' cellspacing='0' cellpadding='0' align='center'> 
             <tr style='border-collapse:collapse;'> 
              <td align='left' style='Margin:0;padding-left:20px;padding-right:20px;padding-top:30px;padding-bottom:30px;'> 
               <table width='100%' cellspacing='0' cellpadding='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;'> 
                 <tr style='border-collapse:collapse;'> 
                  <td width='560' valign='top' align='center' style='padding:0;Margin:0;'> 
                   <table width='100%' cellspacing='0' cellpadding='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;'> 
                     <tr style='border-collapse:collapse;'> 
                      <td align='center' style='padding:0;Margin:0;'> <p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:10px;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;line-height:150%;color:#908F8F;'><small><font color='#858585'>You were sent this message because you have registered to IEEE SLSYWC recently. If you don't do this, ignore this email (action not required) or <a target='_blank' style='-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:'open sans', 'helvetica neue', helvetica, arial, sans-serif;font-size:10px;text-decoration:none;color:#53514F;' href='http://sywc.ieee.lk/contact'>Contact us</a> for further clarifications.</font></small></p> </td> 
                     </tr> 
                   </table> </td> 
                 </tr> 
               </table> </td> 
             </tr> 
           </table> </td> 
         </tr> 
       </table> </td> 
     </tr> 
   </table> 
  </div>  
 </body>
</html>

                
                ";

                if ($mail->send())
                 header('Location: verification_sent');
					
                else
                    $msg3 = "Something wrong happened! Please try again!";
			}
		}
     }		
  }
	}
?>



<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link rel="apple-touch-icon" sizes="76x76" href="https://sywc.ieee.lk/images/favicon.png" />
	<link rel="icon" type="image/png" href="https://sywc.ieee.lk/images/favicon.png" />
	<title>Registration | IEEE SLSYWC 2018</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

	<!-- CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
	<link href="assets/css/paper-bootstrap-wizard.css" rel="stylesheet" />

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link href="assets/css/demo.css" rel="stylesheet" />

	<!-- Fonts and Icons -->
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.css" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
	<link href="assets/css/themify-icons.css" rel="stylesheet">
	
			
	
		
	
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-116916933-4"></script>
  <script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-116916933-4');
  </script>
	
</head>

<body>
	<div class="image-container" style="background-image: url('assets/img/paper-1.jpeg')">
		<!--  SLSYWC Branding   -->
		

		<!--  Developed by Smart Valley  -->
	<!--	<a href="https:?//sywc.ieee.lk" class="made-with-pk">
			<div class="brand">SV</div>
			<div class="made-with">Powered <strong>by Smart Valley</strong></div>
		</a> -->

	    <!--   Big container   -->
	    <div class="container">
			
			
	        <div class="row">
				
			
				
			
		        <div class="col-sm-8 col-sm-offset-2">
				
				
		            <!--      Wizard container        -->
		            <div class="wizard-container">
												<br><br>
	    <a href="http://sywc.ieee.lk">
	                  <center><img src="assets/img/logo.png" width="50%" class="img-rounded"></center> 
	        
	    </a>
  
	  
		                <div class="card wizard-card" data-color="red" id="wizardProfile">
							  <!--        You can switch " data-color="orange" "  with one of the next bright colors: "blue", "green", "orange", "red", "azure"          -->
							
		
				
							
							
		                    <form action="" method="post" enctype="multipart/form-data">
		              

		                    	<div class="wizard-header text-center">
		                        	<h3 class="wizard-title"><strong>Application for Delegate Registration</strong></h3>
									<p class="category">These information will let us understand you better and invite you to the event upon selection.</p>
									<br>
									
									<font color="red" size="3"><strong><b> <?php if ($msg1 != "") echo $msg1 ."<br><br>" ?></b> </strong> </font>
									
									<font color="green" size="3"><strong><b> <?php if ($msg2 != "") echo $msg2 ."<br><br>" ?></b> </strong> </font>
									
									<font color="red" size="3"><strong><b> <?php if ($msg3 != "") echo $msg3 ."<br><br>" ?></b> </strong> </font>

		                    	</div>

								<div class="wizard-navigation">
									<div class="progress-with-circle">
									     <div class="progress-bar" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="3" style="width: 21%;"></div>
									</div>
									<ul>
			                            <li>
											<a href="#about" data-toggle="tab">
												<div class="icon-circle">
													<i class="ti-user"></i>
												</div>
												About
											</a>
										</li>
			                           
			                            <li>
											<a href="#preferences" data-toggle="tab">
												<div class="icon-circle">
													<i class="ti-map"></i>
												</div>
												Preferences
											</a>
										</li>
										
										
										 <li>
											<a href="#account" data-toggle="tab">
												<div class="icon-circle">
													<i class="ti-settings"></i>
												</div>
												My IEEE
											</a>
										</li>
										
										 <li>
											<a href="#sex" data-toggle="tab">
												<div class="icon-circle">
													<i class="ti-cloud"></i>
												</div>
												Submit
											</a>
										</li>
										
										
								<!--		  <li>
											<a href="#address" data-toggle="tab">
												<div class="icon-circle">
													<i class="ti-flag"></i>
												</div>
												Finish
											</a>
										</li> -->
			                        </ul>
								</div>
								
								
		                        <div class="tab-content">
		                            <div class="tab-pane" id="about">
		                            	<div class="row">
											<h5 class="info-text"> Please tell us more about yourself.</h5>
											<div class="col-sm-4 col-sm-offset-1">
												<div class="picture-container">
													<div class="picture">
														<img src="assets/img/default-avatar.jpg" class="picture-src" id="wizardPicturePreview" title="" />
														<input type="file" name="Filename" id="wizard-picture" required >
													</div>
													<font size="2"><b>CHOOSE PROFILE PICTURE</b></font> <small><font color="#9D9D9D">(*required)</font></small></h7>
													<small>(Make sure to upload 4x4, < 1MB clear photo of you. Do not upload selfies.)</small>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label>First Name </label> <small><font color="#9D9D9D">(*required)</font></small>
													<input pattern="[A-Za-z]{3}" name="firstname" type="text" class="form-control" placeholder="John...">
												</div>
												<div class="form-group">
													<label>Last Name </label> <small><font color="#9D9D9D">(*required)</font></small>
													<input pattern="[A-Za-z]{3}" name="lastname" type="text" class="form-control" placeholder="Smith..." >
												</div>
												<br>	<br>
											</div>
													
											
											<div class="col-sm-10 col-sm-offset-1">
												
												 <div class="form-group">
		                                            <label>Gender</label> <small><font color="#9D9D9D">(*required)</font></small>
		                                            <select name="gender" class="form-control" required>
		                                                <option value="Male">Male </option>
		                                                <option value="Female"> Female </option>
		                                                
		                                            </select>
		                                        </div>
												
												<div class="form-group">
													<label>NIC Number </label> <small><font color="#9D9D9D">(*required)</font></small>
													<input name="nic" type="text" class="form-control" placeholder="19941234567 or 941234567V" maxlength="12" required>
												</div>
												
													<div class="form-group">
		                                            <label>University / Institution</label> <small><font color="#9D9D9D">(*required)</font></small>
		                        <select name="university" class="form-control" onchange="yesnoCheck(this);" required>
    <option disabled selected value>Select your university / institution </option>
		                                                <option value="UoP">University of Peradeniya (UoP) </option>
		                                                <option value="UoM"> University of Moratuwa (UoM) </option>
													   <option value="UCSC">University of Colombo School of Computing (UCSC) </option>
		                                                <option value="SLIIT">Sri Lanka Institute of Information Technology (SLIIT) </option>
													     <option value="UoR"> University of Ruhuna (UoR) </option>
													   <option value="UWU">Uva Wellassa University (UWU)</option>
													   
													   <option value="IIT">Informatics Institute of Technology (IIT)</option>
													      <option value="WUSL"> Wayamba University of Sri Lanka (WUSL) </option>
													  
		                                                <option value="KDU"> General Sir John Kotelawala Defence University (KDU) </option>
													   <option value="SUSL">Sabaragamuwa University of Sri Lanka (SUSL) </option>
		                                                <option value="OUSL"> Open University of Sri Lanka (OUSL) </option>
													  
		                                                <option value="UoK">University of Kelaniya (UoK) </option>
													    <option value="NSBM"> National School of Business Management (NSBM) </option>
		                                                <option value="USJP"> University of Sri Jayawardenapura (USJP) </option>
													   
													 <option value="SLTC">Sri Lanka Technological Campus (SLTC)</option>
													  
													   <option value="RUSL">Rajarata University of Sri Lanka (RUSL) </option>
		                      
													    <option value="VCUJ"> Vavuniya Campus of the University of Jaffna (VCUJ) </option>
													    <option value="UNIVOTEC"> University of Vocational Technology (UNIVOTEC) </option>
		                                                
													   <option value="UoJ"> University of Jaffna (UoJ) </option>
													  
													    <option value="Other"> Other </option>
</select>
														
													
														
		                                        </div>
												
												
												<div  id="ifYes" style="display: none;" >
	
	<div class="form-group">
    <label for="otheruni"><font color="#00378B">Then, what's your University or Institution?</font></label> <small><font color="#9D9D9D">(*required)</font></small>
		<input list="suggestions" id="otheruni" name="otheruni" class="form-control" placeholder="Type it here..." required />
	</div>
	<datalist id="suggestions">
	     	<option value="South Eastern University of Sri Lanka (SEUSL)">
		    <option value="Colombo International Nautical and Engineering College (CINEC)">
            <option value="National Institute of Business Management (NIBM)">
		    <option value="Eastern University of Sri Lanka (EUSL)">
			<option value="Sri Lanka Institute of Advanced Technological Education">
	        <option value="Sri Lanka Institute of
Nanotechnology (SLINTEC)">
		    <option value="Asia Pacific Institute Of Information Technology (APIIT)">
			<option value="Horizon Campus">
			<option value="Sanasa Campus">
			<option value="Institute of Technological Studies (ITS)">
            <option value="KAATSU International University (KIU)">
		    <option value="IESL College of Engineering">
		    <option value="South Asian Institute of
Technology and Medicine (SAITM)">
		    <option value="ESOFT Metro Campus">
			<option value="ANC Education">
			<option value="Australian College of Business and Technology">
			<option value="Institute of Engineering Technology (IET)">
			<option value="Northshore College">
			<option value="IDM Nations Campus">
			<option value="Hardy University College Ampara">
			<option value="Aquinas College of Higher Studies">	
			
    </datalist>
		
</div>
							
												<div class="form-group">
													<label>Faculty / School </label> <small><font color="#9D9D9D">(*required)</font></small>
													<input list="facs" name="faculty" type="text" class="form-control" placeholder="ex: Engineering">
												</div>	
												<datalist id="facs">
	     	                                     <option value="Engineering">
		                                        <option value="Computing">
                                                <option value="Technology">
		                                        <option value="Applied Science">
												<option value="Management">
												</datalist>
												
										<div class="form-group">
													<label>Email </label> <small><font color="#9D9D9D">(*required)</font></small>
													<input name="email" type="email" class="form-control" placeholder="ex: delegate@ieee.org">
												</div>
												
												
												<div class="form-group">
													<label>Phone Number</label> <small><font color="#9D9D9D">(*required)</font></small>
													<input name="phone" type="tel" class="form-control" placeholder="ex: 0711234567" maxlength="10"  required>
												</div><br><br>
											
											</div>
											
											
											
										</div>
		                            </div>
										
									
						  <div class="tab-pane" id="preferences">
		                                <div class="row">
		                                    <div class="col-sm-12">
		                                        <h5 class="info-text"> Preferences </h5>
		                                    </div>
		                                    <div class="col-sm-5 col-sm-offset-1">
		                                    	  <div class="form-group">
		                                            <label>Food Preferences</label> <small><font color="#9D9D9D">(*required)</font></small><br>
		                                            <select name="food" class="form-control" required>
														<option disabled selected value> Select food type </option>
		                                                <option value="Non-Veg"> Non-Veg </option>
		                                                <option value="Veg"> Veg </option>
		                                                
		                                            </select>
		                                        </div>
		                                    </div>
											
											
		                                    <div class="col-sm-5">
												
		                                         <div class="form-group">
		                                            <label>T-Shirt Size </label> <small><font color="#9D9D9D">(*required)</font></small> 
													
<!-- Links --><small>
                                             (  <a data-toggle="modal" href="#tshirtChart"> <i class="fa fa-external-link"> </i><font color="#EB0003"> <b>View Chart</b></font> </a> ) </small>
													 
													  

													 
													 
												
													
													 
													 
												<!--	  <small><a href="../resources/chart.png" target="_blank">( <i class="fa fa-external-link"> </i> View Chart ) </a>
												
													 
													 </small> -->
													 
													 
													 
													 
													 
													 
													 
													 
													 
													 <br>
		                                            <select name="tshirt" class="form-control" required>
														<option disabled selected value> Select T-Shirt size </option>
														<option value="xxs"> XXS </option>
		                                                <option value="xs"> XS </option>
		                                                <option value="s"> S </option>
														<option value="m"> M </option>
														<option value="l"> L </option>
		                                                <option value="xl"> XL </option>
													    <option value="xxl"> XXL </option>
		                                            </select>
		                                        </div>
										
		                                    </div>
											
										  <div class="col-sm-5 col-sm-offset-1">
		                                    	  <div class="form-group">
		                                            <label>Your Smart Phone's OS type</label> <small><font color="#9D9D9D">(*required)</font></small><br>
		                                            <select name="os" class="form-control" required>
														<option disabled selected value> Select an OS </option>
		                                                <option value="Android"> Android </option>
		                                                <option value="IOS"> IOS </option>
														<option value="Windows"> Windows </option>
														<option value="Others"> Other  </option>
														<option value="Generic"> Generic Phone (Not a Smart Phone)  </option>
		                                                
		                                            </select>
		                                        </div><br><br>
		                                    </div>
											
											
		                                </div>
		                            </div>
									
							
		                            <div class="tab-pane" id="account">
										
										
										
		                            	<div class="row">
											
											 <div class="col-sm-8 col-sm-offset-2" >
											<h5 class="info-text">Your IEEE Information</h5>
										
									 
											<div class="col-sm-14">
										  
												<div class="form-group">
		                                            <label>Are you an IEEE Member?</label> <small><font color="#9D9D9D">(*required)</font></small>
		                        <select name="membership" class="form-control" onchange="myIEEE(this);" required>
                                                <option value="No"> No </option>
											    <option value="Yes"> Yes </option>
                                </select>			
		                                        </div>
												
												 </div>
												 
												<div  id="ifTrue" style="display: none;" >
	
	                        <div class="form-group">
    <label for="ieeeID"><font color="#00378B">IEEE Membership ID</font></label> <small><font color="#9D9D9D">(*required)</font></small>
		<input type="text" id="" name="ieeeID" class="form-control" placeholder="ex: 94152027" maxlength="8" required />
	                        </div>
													
													
							<br>
													
													
											
												
		                                      <div class="form-group">
												  <label><font color="#00378B">Your IEEE Category</font> </label> <small><font color="#9D9D9D">(*required)</font></small> 
													 <small></small>
													 
													 <br>
													 <div  data-toggle="wizard-checkbox">
		                                            <select name="track" class="form-control" required>
														<option disabled selected value> Select your membership </option>
														<option value="student"> Student </option>
		                                                <option value="yp"> YP </option>
		                                                <option value="wie"> WIE </option>
														
		                                            </select>
													 </div>
		                                        </div> 
										
		                                
													
													
									<!--	<div class="form-group">
													<label for=""><font color="#00378B">Your IEEE Category</font></label> <small><font color="#9D9D9D">(*optional)</font></small><br>
		                                        <div class="col-sm-4">
		                                            <div  data-toggle="wizard-checkbox">
		                                                <input type="checkbox" name="track[]" value="Student">
		                                                <div class="card card-checkboxes card-hover-effect">
		                                                    <i class="ti-pencil-alt"></i>
															<p>Student</p>
		                                                </div>
		                                            </div>
		                                        </div>
		                                        <div class="col-sm-4">
		                                            <div  data-toggle="wizard-checkbox">
		                                                <input type="checkbox" name="track[]" value="YP">
		                                                <div class="card card-checkboxes card-hover-effect">
		                                                    <i class="ti-pencil-alt"></i>
															<p>Young Professional</p>
		                                                </div>
		                                            </div>
		                                        </div>
		                                        <div class="col-sm-4">
		                                            <div  data-toggle="wizard-checkbox">
		                                                <input type="checkbox" name="track[]" value="WIE">
		                                                <div class="card card-checkboxes card-hover-effect">
		                                                    <i class="ti-pencil-alt"></i>
															<p><b>WIE</b></p>
		                                                </div>
		                                            </div>
		                                        </div>
												</div> -->
										
											
										<div class="form-group">
													<label><font color="#00378B">How long have you been in IEEE (years) ? </font></label> <small><font color="#9D9D9D">(*required)</font></small>
													<input name="ieeeTime" type="number" class="form-control" placeholder="ex: 1" maxlength="2" required>
												</div>
											
											 
		                                        <div class="form-group">
		                               <label><font color="#00378B">What are your IEEE Experiences?</font></label> <small><font color="#9D9D9D">(*required)</font></small>
		                                            <textarea class="form-control" rows="5" name="ieeeExperience" id="" placeholder="Describe in your words... (Word limit: 2000)" maxlength="2000" required ></textarea>
		                                        </div>
		                  
												
												</div>

						</div>
		                            
										
											</div>
		
		                              
		                                <div class="row">
		                                    
										
												
										  <div class="col-sm-8 col-sm-offset-2">
												<div class="form-group">
		                                            <label>Have you ever participated in an IEEE SL SYW Congress before?</label> <small><font color="#9D9D9D">(*required)</font></small>
		                        <select name="slsywcParticipation" class="form-control" onchange="slsywcIEEE(this);" required>
                                                <option value="No"> No </option>
											    <option value="Yes"> Yes </option>
                                </select>			
		                                        </div>
											</div>
												
												<div  id="ifok" style="display: none;" >
	
	                      
							  <br> <br>
		                                    <div class="col-sm-8 col-sm-offset-2">
													<label for="slsywcYears"><font color="#00378B">In which years did you participate?  </font></label> <small><font color="#9D9D9D">(*optional)</font></small><br>
												 
		                                        <div class="col-sm-4">
		                                            <div class="choice" data-toggle="wizard-checkbox">
		                                                <input type="radio" name="slsywcYears" value="2017">
		                                                <div class="card card-checkboxes card-hover-effect">
		                                                    <i class="ti-pin"></i>
															<p>2017</p>
		                                                </div>
		                                            </div>
		                                        </div>
		                                        <div class="col-sm-4">
		                                            <div class="choice" data-toggle="wizard-checkbox">
		                                                <input type="radio" name="slsywcYears" value="2016">
		                                                <div class="card card-checkboxes card-hover-effect">
		                                                    <i class="ti-pin"></i>
															<p>2016</p>
		                                                </div>
		                                            </div>
		                                        </div>
		                                        <div class="col-sm-4">
		                                            <div class="choice" data-toggle="wizard-checkbox">
		                                                <input type="radio" name="slsywcYears" value="2015">
		                                                <div class="card card-checkboxes card-hover-effect">
		                                                    <i class="ti-pin"></i>
															<p><b>2015</b></p>
		                                                </div>
		                                            </div>
		                                        </div>
												 <div class="col-sm-4">
		                                            <div class="choice" data-toggle="wizard-checkbox">
		                                                <input type="radio" name="slsywcYears" value="2014">
		                                                <div class="card card-checkboxes card-hover-effect">
		                                                    <i class="ti-pin"></i>
															<p><b>2014</b></p>
		                                                </div>
		                                            </div>
		                                        </div>
												 <div class="col-sm-4">
		                                            <div class="choice" data-toggle="wizard-checkbox">
		                                                <input type="radio" name="slsywcYears" value="2013">
		                                                <div class="card card-checkboxes card-hover-effect">
		                                                    <i class="ti-pin"></i>
															<p><b>2013</b></p>
		                                                </div>
		                                            </div>
		                                        </div>
												 <div class="col-sm-4">
		                                            <div class="choice" data-toggle="wizard-checkbox">
		                                                <input type="radio" name="slsywcYears" value="2012">
		                                                <div class="card card-checkboxes card-hover-effect">
		                                                    <i class="ti-pin"></i>
															<p><b>2012</b></p>
		                                                </div>
		                                            </div>
		                                        </div>
									
												
		                                    </div>
		                              
					
												
												</div>

	
									
											  <div class="col-sm-8 col-sm-offset-2">
		                                        <div class="form-group">
		                                            <label>What do you expect to gain from this year’s congress 2018?</label> <small><font color="#9D9D9D">(*required)</font></small>
		                                            <textarea class="form-control" rows="5" name="feedback" id="" placeholder="What's on your mind..? (word Limit: 2000)" maxlength="2000" required></textarea>
		                                        </div><br><br>
		                                    </div>
		                             
											
		                                </div>
									
										
		                            </div>
									
									
					<div class="tab-pane" id="sex">
						
						
						<style>
							.infoBox {
							
								margin: 20px;
								padding: 20px;
							}
							</style>
						
						
		                            	<div class="row">
											<h5 class="info-text"> You are almost there!</h5>
											
											<div class="col-sm-10 col-sm-offset-1">
												
									
												
												<div  class="bg-danger">	
												<div class="infoBox">
												<font size="3">Three full days of excitement and knowledge packed sessions await you. The following are the pricing information for your ticket if you get a ticket upon short-listing:</font>  <br><br>
													
												<ul>
                                       <li>   <font size="4"><strong>IEEE/ Non-IEEE Students: 2500.00 LKR</strong></font></li> 
                                          <li>  <font size="4"> <strong>IEEE Young Professionals: 3000.00 LKR </strong></font> </li>

													</ul>
													
													<br>
                     <font size="2"> <i>The above pricing plans include accommodation, food and T-shirt for all three days of the event.</i></font>
												
												</div>
												
												
											</div>
											
											
											
											
											
													
								<div class="col-sm-10 col-sm-offset-1">
											  <div class="checkbox">
												  
													  <input type="checkbox" name="optionsCheckboxes" required="required"> 
													 <label> <strong>By submitting my information, I agree to the  <a data-toggle="modal" href="#termsConditions"> <i class="fa fa-external-link"> </i><font color="#EB0003"> <b>Terms & Conditions</b></font> </a>  of IEEE SLSYWC.</strong></label>
													<br>	<br>
												 
											  </div>
										  </div>
											
											
										</div>
		                            </div>
									
									

									
		                        </div>
								
								
		                        <div class="wizard-footer">
		                            <div class="pull-right">
		                                <input type='button' class='btn btn-next btn-fill btn-danger btn-wd' name='next' value='Next' />
		                                <input type='submit' class='btn btn-finish btn-fill btn-danger btn-wd' name='submit' value='Finish' />
		                            </div>

		                            <div class="pull-left">
		                                <input type='button' class='btn btn-previous btn-default btn-wd' name='previous' value='Previous' />
										
										
										
										
		                            </div>
		                            <div class="clearfix"></div>
		                        </div>
		                    </form>
		                </div>
		            </div> <!-- wizard container -->
		        </div>
	    	</div><!-- end row -->
		</div> <!--  big container -->

	    <div class="footer">
	        <div class="container text-center">
				Copyright © 2018 IEEE SLSYWC. All Rights Reserved. | Powered in <a href="https://smartvalley.lk" target="_blank">Smart Valley</a>
	            
	        </div>
	    </div>
	</div>
	
	<br><br><br><br><br><br>
	

	 
<!-- Modal 1 -->
<div class="modal fade" id="tshirtChart" tabindex="-1" role="dialog" aria-labelledby="tc" aria-hidden="true">
  <div class="modal-dialog" role="document" style="100%">
    <div class="modal-content">
      <div class="modal-header">
       <center> <h3 class="modal-title" id="tc"><font color="#F2004A"> <strong>T-Shirt Chart for Men/Women</strong></font></h3></center>
        <button type="button" class="close" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
		  
		  <img src="assets/img/tchart.jpg" class="img-responsive" alt="T Shirt Chat">
		  
		  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      
      </div>
    </div>
  </div>
</div> 
	
	
	<!-- Modal 2 -->
<div class="modal fade" id="termsConditions" tabindex="-1" role="dialog" aria-labelledby="tc" aria-hidden="true">
  <div class="modal-dialog" role="document" style="100%">
    <div class="modal-content">
      <div class="modal-header">
       <center> <h3 class="modal-title" id="tc"><font color="#F2004A"> <strong>Terms & Conditions</strong></font></h3></center>
        <button type="button" class="close" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
		  
		<div style="text-align:inherit;border:1px">
		  
		 <font size="3"><strong> Please read and understand these terms and conditions carefully before proceeding:</strong></font>

		  <ul>
			<li>There is only a limited number of seats for the delegates available, and a shortlisting will be carried out by the event organizing committee.</li>
            <li>All IEEE members, and non-IEEE members are eligible to participate at this event.</li>
            <li>All information that you provide on this registration form should be accurate as of the date of submission, and the organizing committee holds the right to use this information as they may see fit.</li>
            <li>If you have been selected to participate at the event you will receive a confirmation email in the near future. Keep in touch with your inbox.</li>
            <li>If you have been selected to participate at the event you are agreeing to pay the delegate fee in order to get qualified to participate.</li>
            <li>The delegate fee includes the cost of three days accommodations, food for three days and the t-shirt.
You can’t change the selected t-shirt size on the event day.</li>
</ul>
			
			
			
			
		  </div>
		  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      
      </div>
    </div>
  </div>
</div> 
		
</body>

	<!--   Core JS Files   -->
	<script src="assets/js/jquery-2.2.4.min.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="assets/js/jquery.bootstrap.wizard.js" type="text/javascript"></script>
	<script src="assets/js/custom.validate.wizard.js" type="text/javascript"></script>

	<!--  Plugin for the Wizard -->
	<script src="assets/js/paper-bootstrap-wizard.js" type="text/javascript"></script>

	<!--  More information about jquery.validate here: http://jqueryvalidation.org/	 -->
	<script src="assets/js/jquery.validate.min.js" type="text/javascript"></script>

</html>
