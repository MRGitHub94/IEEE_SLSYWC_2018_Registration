

    function yesnoCheck(that) {
        if (that.value == "Other") {
          
            document.getElementById("ifYes").style.display = "block";
        } else {
            document.getElementById("ifYes").style.display = "none";
        }
    }

	

    function myIEEE(that) {
        if (that.value == "Yes") {
          
            document.getElementById("ifTrue").style.display = "block";
        } else {
            document.getElementById("ifTrue").style.display = "none";
        }
    }

	
	
	
	
	function slsywcIEEE(that) {
        if (that.value == "Yes") {
          
            document.getElementById("ifok").style.display = "block";
        } else {
            document.getElementById("ifok").style.display = "none";
        }
    }


function validateNIC() 
{
    var nicNumber = document.getElementById('nicNumber').value;
    var mesg = document.getElementById('message1');

     if (nicNumber.length === 10 && !isNaN(nicNumber.substr(0, 9)) && isNaN(nicNumber.substr(9, 1).toLowerCase()) && ['x', 'v'].includes(nicNumber.substr(9, 1).toLowerCase())) {
        valNic.innerHTML="<font color='green'>Your old NIC number accepted</font>";
    } else if (nicNumber.length === 12 && !isNaN(nicNumber)) {
       valNic.innerHTML="<font color='green'>Your new NIC number accepted</font>";
    } else {
         valNic.innerHTML="<font color='red'>Please enter a valid Sri Lankan NIC Number";
    }
    return result;
} 
	



	function validateIEEE() 
{
    var ieeeNumber = document.getElementById('ieeeNumber').value;
    var mesg = document.getElementById('message1');

     if (ieeeNumber.length === 8 && !isNaN(ieeeNumber.substr(0, 9))) {
        valieee.innerHTML="<font color='green'>Your IEEE Membership ID accepted</font>";
    } else if (ieeeNumber.length === 8 && !isNaN(ieeeNumber)) {
       valieee.innerHTML="<font color='green'>Your new ieee number accepted</font>";
    } else {
         valieee.innerHTML="<font color='red'>Please enter a valid IEEE membership ID";
    }
    return result;
} 
	