<?php 
include("head.php");
?>

      <div class="templatemo-content-wrapper">
        <div class="templatemo-content">		  
		  
          <div class="row">
            <div class="col-md-12">
<div id="pass"> 
	<form name="row">
	<p class="pull-left "style="color:red">**Change Password</p>
		   <br><br><br>
		   <div class="row">
               <div class="col-md-6 col-sm-6">
                    <label class="field-label">Current Password </label>
                    <input name="currentpassword" id="currentpassword" type="password" class="form-control form_control_2" placeholder="Confirm Current passord">
					<span id='errorname1'style="color:red;display:none"><i class="fa fa-exclamation-triangle"></i> This field is required.</span>
                    <br>
                    <label class="field-label">New Password </label>
                    <input name="newpassword" id="newpassword" type="password" class="form-control form_control_2" placeholder="8 chars [at least one symbol, number and Upper-case letter]">
					<span id='errorname2'style="color:red;display:none"><i class="fa fa-exclamation-triangle"></i> This field is required.</span>
					<span id='match1'style="color:red;display:none"><i class="fa fa-exclamation-triangle"></i> Passwords do not match.</span>
					<span id='weak'style="color:red;display:none"><i class="fa fa-exclamation-triangle"></i> Password should be at least 8 characters long.</span>
                    <br>
                    <label class="field-label">Confirm New Password</label>
                    <input name="confirmnewpassword" id="confirmpassword" type="password" class="form-control form_control_2" placeholder="Re-enter new password">
					<span id='errorname3'style="color:red;display:none"><i class="fa fa-exclamation-triangle"></i> This field is required.</span>
					<span id='match2'style="color:red;display:none"><i class="fa fa-exclamation-triangle"></i> Passwords do not match.</span>
					<span id='weak'style="color:red;display:none"><i class="fa fa-exclamation-triangle"></i> Password should be at least 8 characters long.</span>
                    <br>
					<div class="submit-wrap submit-wrap_1">
					<button id="password-form" class="btn btn-primary btn-lg btn-block" type="submit">SUBMIT</button>
					</div>
                </div>
           </div>
	</form>
</div>                  
            </div>
          </div>
		  
        </div>
      </div>
<?php include ("footer.php");?>
<script type="text/javascript">
$("document").ready(function(){	

	$('#newpassword').keyup(function() {
	$('#result').html(checkStrength($('#newpassword').val()))
	})
	
	function checkStrength(password) {
var strength = 0
if (password.length < 6) {
$('#result').removeClass()
$('#result').addClass('short')
return 'Too short <i class="fa fa-times"></i>'
}
if (password.length > 7) strength += 1
// If password contains both lower and uppercase characters, increase strength value.
if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) strength += 1
// If it has numbers and characters, increase strength value.
if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) strength += 1
// If it has one special character, increase strength value.
if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
// If it has two special characters, increase strength value.
if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
// Calculated strength value, we can return messages
// If value is less than 2
if (strength < 2) {
$('#result').removeClass()
$('#result').addClass('weak')
return 'Weak'
} else if (strength == 2) {
$('#result').removeClass()
$('#result').addClass('good')
return 'Good <i class="fa fa-check" aria-hidden="true"></i>'
} else {
$('#result').removeClass()
$('#result').addClass('strong')
return 'Strong <i class="fa fa-check-circle-o" aria-hidden="true"></i>'
}
}
	
	$("#password-form").click(function(){
		/*variables*/
		var currentpassword=$("#currentpassword").val();
		var newpassword=$("#newpassword").val();
		var confirmpassword=$("#confirmpassword").val();
		var password_len = newpassword.length;
		var errr="";
		
		$("#currentpassword").keyup(function(){
			$(this).css("border", " 1px solid green");
			$("#errorname1").hide();
		})
		$("#newpassword").keyup(function(){
			$(this).css("border", " 1px solid green");
			$("#errorname2").hide();
			$("#match1").hide();
		})
		$("#confirmpassword").keyup(function(){
			$(this).css("border", " 1px solid green");
			$("#errorname3").hide();
			$("#match2").hide();
		})	
		
		
		if(currentpassword==''){
			errr="Current Password required";
			$("#currentpassword").css("border", " 1px solid red");
			$("#errorname1").show();
		}
		if(newpassword==''){
			errr+="New Password required";
			$("#newpassword").css("border", " 1px solid red");
			$("#errorname2").show();
		}
		if(confirmpassword==""){
			errr+="Confirm Password required";
			$("#confirmpassword").css("border", " 1px solid red");
			$("#errorname3").show();
		}
		
		if(newpassword != confirmpassword){
			errr+="Password";
			$("#password").css("border", " 1px solid red");
			$("#match1").show();
			$("#match2").show();
		}	
		
	 if (password_len == 0 || password_len <= 7)
		{
			errr="Password required";
			$("#password").css("border", " 1px solid red");
			$("#weak").show();
		}		
		
		
if(errr==""){		
		/*ajax call*/
		$.ajax({ 
			type:'POST',
			data:{currentpassword:currentpassword,newpassword:newpassword},
			url: 'updatepassword.php',
  			success: function(text){
					if(text==1){
						alert("PASSWORD SUCCESSFULLY CHANGED!\n");
						window.location.href="index.php";
					}
					else{
						alert("ERROR!\n CURRENT PASSWORD IS WRONG");
						location.reload();
					}
				}
				});
			}else{
				
			}
			
return false;
	});
})
	
</script>
</body>
</html>