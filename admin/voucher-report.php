<?php
include('head.php');
if ($stmt = $conn->prepare("SELECT * FROM vouchers WHERE Voucher_Status=1 order by Date_Used DESC")) 
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
                  <li class="active"><a href="#">Voucher Transactions <span class="badge"><?php echo $total_customers?></span></a></li>
                </ul>          
              </div>
            </div>
          </div>
		  
          <div class="row">
            <div class="col-md-12">
              
              <div class="table-responsive">
                <h4 class="margin-bottom-15">VOUCHER TRANSACTIONS</h4>
				
                <table id='transtab' class="table table-striped table-hover table-bordered">
                  <thead>
                    <tr class=danger>
                         
                      <th>Station Code</th>                                
                      <th>Voucher Code</th>                                
                      <th>Vehicle Reg. Number</th>
                      <th>Amount</th>
					  <th>Date</th>
					  <th>Fuel Type</th>                                 
                    </tr>
                  </thead>
                  <tbody>
				  
	<?php 
	while($getinfo = array_shift( $RESULT ))
	{
		$AppUser_UniqueID=$getinfo['AppUser_UniqueID'];
		$vouchercode=$getinfo['Voucher_Code'];
		$vehreg=$getinfo['Vehicle_ID'];
		$amount=$getinfo['Voucher_Amount'];
		$date=$getinfo['Date_Used'];
		$fueltype=$getinfo['Fuel_Type'];
		
		if($stmt = $conn->prepare("SELECT * FROM application_users where AppUser_UniqueID=?")){
		$stmt->bind_param("s", $AppUser_UniqueID);	
		$stmt->execute();
		$RESULT2 = get_result($stmt); 		
		$getfrom = array_shift( $RESULT2);
		$station = $getfrom['AppUser_Station'];				
		}
			
			
	?>
					
                    <tr class=success>
                
                      <td><?php echo $AppUser_UniqueID."-".$station;?></td>	            
                      <td><?php echo $vouchercode?></td>
                      <td><?php echo $vehreg?></td>
                      <td>GHC<?php echo $amount?></td>	            
					  <td><?php echo $date?></td>	            
					  <td><?php echo $fueltype?></td>	
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
<?php include ("footer.php");?>