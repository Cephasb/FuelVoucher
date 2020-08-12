<?php
include('head.php');
if ($stmt = $conn->prepare("SELECT * FROM transactions")) 
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
                  <li class="active"><a href="#">Transactions <span class="badge"><?php echo $total_trans?></span></a></li>
                </ul>          
              </div>
            </div>
          </div>
		  
          <div class="row">
            <div class="col-md-12">
              
              <div class="table-responsive">
                <h4 class="margin-bottom-15">TRANSACTIONS</h4>
				
                <table id='newtable' class="table table-striped table-hover table-bordered">
                  <thead>
                    <tr class=danger>
                         
                      <th>Name</th>                                
                      <th>Amount (GHC)</th>                                
                      <th>For (Property ID)</th>                                
					  <th>Date</th>
					  <th>Status</th>                                 
                    </tr>
                  </thead>
                  <tbody>
				  
	<?php 
	while($getinfo = array_shift( $RESULT ))
	{
		$AppUser_ID=$getinfo['AppUser_ID'];
		$amount=$getinfo['Amount'];
		$date=$getinfo['Transaction_Date'];
		$Property_ID=$getinfo['Property_ID'];
		
		$getstat=$getinfo['status'];
		if($getstat == 1 ){
			$status= "<a>Payment Initiated</a>";
		}else if($getstat == 2){
			$status= "<a style='color:green;font-weight:bold'>PAYMENT SUCCESSFUL</a>";
		}else{
			$status= "<a style='color:red'>Payment Failed</a>";
		}
		
		if($stmt = $conn->prepare("SELECT * FROM application_users where AppUser_ID=?")){
		$stmt->bind_param("i", $AppUser_ID);	
		$stmt->execute();
		$RESULT2 = get_result($stmt); 		
		$getfrom = array_shift( $RESULT2);
		$firstname = $getfrom['AppUser_Firstname'];				
		$lastname = $getfrom['AppUser_Lastname'];				
		}
			
			
	?>
					
                    <tr class=success>
                
                      <td><?php echo $firstname." ".$lastname?></td>	            
                      <td>GHC<?php echo $amount?></td>	            
                      <td><?php echo $title?></td>	            
					  <td><?php echo $date?></td>	            
					  <td><?php echo $status?></td>	
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
$('#newtable').dataTable({
		ordering:false
	});
})
	</script>