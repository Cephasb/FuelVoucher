<?php include("head.php");
if ($stmt = $conn->prepare("SELECT * FROM customer ORDER BY Customer_ID DESC")) 
{	
$stmt->execute();  
$RESULT = get_result($stmt); 	
}
?>
      <div class="templatemo-content-wrapper">
        <div class="templatemo-content">		  
          <div class="margin-bottom-30">
            <div class="row">
              <div class="col-md-12">
                <ul class="nav nav-pills">
                  <li class="active"><a href="users.php">Customer List <span class="badge"><?php echo $total_users?></span></a></li>
                </ul>          
              </div>
            </div>
          </div>
		  
          <div class="row">
            <div class="col-md-12">
              <div class="table-responsive">
                <table id='newtab' class="table table-striped table-hover table-bordered">
                  <thead>
                    <tr class=danger> 
					  <th>Avatar</th>
					  <th>Card ID</th>
                      <th>Name</th>
                      <th>Phone</th>
					  <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>				  
	<?php 
	while($getinfo = array_shift( $RESULT ))
	{
		$avatar=$getinfo['Customer_Photo'];
		$CardID=$getinfo['Customer_CardID'];
		$firstname=$getinfo['Customer_Firstname'];
		$lastname=$getinfo['Customer_Lastname'];
		$phone=$getinfo['Customer_Phone'];
			
			
	?>					
      <tr class=success>
        <td><img  src="<?php echo $avatar;?>" onerror="this.src='images/avatar.gif'" height="50" width="50" class="avatar"></td>
        <td><?php echo $CardID;?></a></td>
        <td><?php echo $firstname." ".$lastname;?></a></td>
        <td><?php echo $phone;?></a></td>
        <td><a href='#'>Delete</a></td> 
	  </tr>					
					<?php
					}
					?>                                      
                  </tbody>
                </table>
              </div>                  
            </div>
          </div>
		  
        </div>
      </div>
<?php include ("footer.php");?>
  <script>
$("document").ready(function(){
	
	$('#newtab').on('click', '.action', function(){		
		var userid=$(this).attr('userid');

				$.ajax({
				type: "POST",
				url: "user-lock.php",
				data:{userid:userid},
				success: function(text){
					if(text==1){
					alert("SUCCESS! User Status Successfully Updated");	
					window.location.reload();
					}else{
					alert("ERROR! User Status NOT Updated");	
					}
				}
				});

	});
})
</script>
</body>
</html>