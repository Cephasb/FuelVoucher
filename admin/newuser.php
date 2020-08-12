<?php 
include("head.php");
?>
      <div class="templatemo-content-wrapper">
        <div class="templatemo-content">
          <ol class="breadcrumb">
			<li><a href="index.php">Users</a></li>
            <li class="active">Create New User</li>
          </ol>
          <h1>SIGN UP FORM</h1>
          <p class="margin-bottom-15">Please enter the details of your users below..</p>
          <div class="row">
            <div class="col-md-12">
              <form role="form" name="row" id="templatemo-preferences-form">
                <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">First Name</label>
                    <input type="text" class="form-control" id="firstname" value="">
					<span id='errorname'style="color:red;display:none"> This field is required</span>	
                  </div>
                  <div class="col-md-6 margin-bottom-15">
                    <label for="lastName" class="control-label">Last Name</label>
                    <input type="text" class="form-control" id="lastname" value="">  
					<span id='errorname2'style="color:red;display:none"> This field is required</span>	
                  </div>
                </div>
				<div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">E-mail</label>
                    <input type="email" onblur="ValidateEmail()" class="form-control" id="email" value="">  
					<span id='errorname4' style="color:red;display:none"> This field is required</span>	
                  </div>
                  <div class="col-md-6 margin-bottom-15">
                    <label for="lastName" class="control-label">Phone Number</label>
                    <input type="number" onblur="phonenumber()" class="form-control" id="phone" value="">  
					<span id='errorname3'style="color:red;display:none"> This field is required</span>	
                  </div>
                </div>
				<div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="firstName" class="control-label">Password</label>
                    <input type="text" onblur="passid_validation()" class="form-control" id="password" value="">  
					<span id='errorname6' style="color:red;display:none"> This field is required</span>	
                  </div>
                  <div class="col-md-6 margin-bottom-15">
                    <label for="lastName" class="control-label">Confirm Password</label>
                    <input type="text" onblur="confirmPassword()" class="form-control" id="passconfirm" value="">
					<span id='errorname7'style="color:red;display:none"> This field is required</span>	
                  </div>
                </div>
              <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="station" class="control-label">Station </label>
                    <input type="text" class="form-control" id="station" value="">
					<span id='errorname8'style="color:red;display:none"> This field is required</span>	
                  </div>                  
              </div>
              <div class="row templatemo-form-buttons">
                <div class="col-md-12">
                  <button id="signup" type="submit" class="btn btn-primary">SUBMIT</button>
                  <button type="reset" class="btn btn-default">CLEAR</button>    
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
<?php include ("footer.php");?>
</body>
</html>
<script>
$("document").ready(function(){	
	
	$("#signup").click(function(){
		
		var firstname=$("#firstname").val();
		var lastname=$("#lastname").val();
		var phone=$("#phone").val();
		var email=$("#email").val();
		var confemail=$("#emailconfirm").val();		
		var password=$("#password").val();
		var passconfirm=$("#passconfirm").val();
		var station=$("#station").val();
		var errr="";
		
		$("#firstname").keyup(function(){
			$(this).css("border", " 1px solid green");
			$("#errorname").hide();
		})
		$("#lastname").keyup(function(){
			$(this).css("border", " 1px solid green");
			$("#errorname2").hide();
		})
		$("#phone").keyup(function(){
			$(this).css("border", " 1px solid green");
			$("#errorname3").hide();
		})
		$("#email").keyup(function(){
			$(this).css("border", " 1px solid green");
			$("#errorname4").hide();
		})
		$("#emailconfirm").keyup(function(){
			$(this).css("border", " 1px solid green");
			$("#errorname5").hide();
		})
		$("#password").keyup(function(){
			$(this).css("border", " 1px solid green");
			$("#errorname6").hide();
		})
		$("#passconfirm").keyup(function(){
			$(this).css("border", " 1px solid green");
			$("#errorname7").hide();
		})	
		$('#station').keyup(function(){
			$(this).css("border", " 1px solid green");
			$("#errorname8").hide();
		})		    


		if(firstname==''){
			errr="Name required";
			$("#firstname").css("border", " 1px solid red");
			$("#errorname").show();
		}
		if(lastname==''){
			errr+="Lastname is required";
			$("#lastname").css("border", " 1px solid red");
			$("#errorname2").show();
		}
		if(phone==""){
			errr+="Phone number required";
			$("#phone").css("border", " 1px solid red");
			$("#errorname3").show();
		}
		if(email==""){
			errr+="Email required";
			$("#email").css("border", " 1px solid red");
			$("#errorname4").show();
		}
		if(confemail==""){
			errr+="Confirm Email required";
			$("#emailconfirm").css("border", " 1px solid red");
			$("#errorname5").show();
		}
		if(password==""){
			errr+="Password required";
			$("#password").css("border", " 1px solid red");
			$("#errorname6").show();
		}
		if(passconfirm==""){
			errr+="Confirm Password required";
			$("#passconfirm").css("border", " 1px solid red");
			$("#errorname7").show();
		}
		if(station==''){
			errr+="Station is required";
			$("#station").css("border", " 1px solid red");
			$("#errorname8").show();
		}		
		
if(errr==""){
		$.ajax({ 
			type:'POST',
			data:{firstname:firstname,lastname:lastname,phone:phone,email:email,password:password,station:station},
			url: "posts/newuser.php",

  			success: function(text){
					if(text==1){
						swal("REGISTRATION WAS UNSUCCESFUL!","An account with this E-MAIL ADDRESS already exists.","error");
					}
					else{
	swal({
  title: "SIGN UP WAS SUCCESSFUL!",
  text: "User can login with their ID and password.",
  type: "success",
   confirmButtonText: "OK",
  closeOnConfirm: true,
  showLoaderOnConfirm: true,
},
function(){
window.location.reload();
});

					}
				},
				//complete: function(){$.unblockUI()},
				});	
}else{
	
}				
return false;
	});
})
</script>
<script type="text/javascript">
function agentCheck(){
	if(document.getElementById('agent').checked) {
		document.getElementById('agent').style.color = "red";
		document.getElementById("ifYes").style.display = "block";
}else if(document.getElementById('client').checked) {
		document.getElementById("ifYes").style.display = "none";
}
}

function confirmPassword() {
var password = document.getElementById("password").value
var confpassword = document.getElementById("passconfirm").value
if(password != confpassword) {
			swal({
  title: "Error!",
  text: "Passwords not matching!",
  type: "error",
  confirmButtonText: "OK"
});
								}
	}

function ValidateEmail(){	
var uemail = document.row.email;
var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
if(uemail.value.match(mailformat))
{
return true;
}
else
{
			swal({
  title: "EMAIL REQUIRED!",
  text: "Please enter a valid email address",
  type: "warning",
  confirmButtonText: "OK"
});
uemail.focus();
}
}


function passid_validation(){
var passid = document.row.password;
var passid_len = passid.value.length;
if (passid_len == 0 || passid_len <= 7)
{
			swal({
  title: "WEAK PASSWORD!",
  text: "Password length should be at least 8 characters",
  type: "warning",
  confirmButtonText: "OK"
});
passid.focus();
}
else
{
return true;
}
}


function phonenumber()
{
  var inputtxt = document.row.phone;
  var phoneno = /^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$/g;
  
  if(inputtxt.value.match(phoneno))
        {
      return true;
        }
      else
        {
        swal({
  title: "Valid Phone Number Required!",
  text: "Please enter a valid phone number.",
  type: "warning",
  confirmButtonText: "OK"
});
inputtxt.focus();
}
}
</script>