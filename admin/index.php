<?php 
include("head.php");
?>
      <div class="templatemo-content-wrapper">
        <div class="templatemo-content">
          <div class="margin-bottom-30">
            <div class="row">
              <div class="col-md-12">
                <ul class="nav nav-pills">
                  <li class="active"><a href="users.php">Stations <span class="badge"><?php echo $total_users?></span></a></li>
                  <li class="active"><a href="voucher-report.php">Total Vouchers Used <span class="badge"><?php echo $total_customers?></span></a></li>
                  <li class="active"><a href="reports.php">Reports <span class="badge"></span></a></li>
                  <li class="active"><a><span class="badge">Total Amount of Vouchers Used: GH₵<?php echo $total_cum?></span></a></li>
                </ul>          
              </div>
            </div>
          </div>         
		<div class="templatemo-charts">
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="templatemo-charts">
            <div class="row">
                
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="row templatemo-chart-row">
                  
                  <div class="templatemo-chart-box col-lg-6 col-md-6 col-sm-6 col-xs-12">  
                  <h4>Super vs Deisel (Today in GH₵)</h4>
                    <canvas id="templatemo-pie-chart"></canvas>
                  </div>
				  
                  <div class="templatemo-chart-box col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="panel panel-success">
                  <div class="panel-heading"> FUEL SOLD (Super vs Diesel) </div>
                  <canvas id="templatemo-line-chart"></canvas>                   <div class="panel-heading">TOTAL VOUCHERS USED : <strong>GH₵<?php echo $total_fuelW?></strong>
                  </div>   
              </div>
				  </div>

                </div>                  
              </div>
             </div> 
             

            <div class="row">
              <div class="col-md-6 col-sm-6 margin-bottom-30">
                <div class="panel panel-primary">
                  <div class="panel-heading">Top 10 Stations (Today)</div>
                  <div class="panel-body">
                <table id='transtab' class="table table-striped">
                  <thead>
                    <tr> 
					  <th>Station</th>
					  <th>Amount</th>
                    </tr>
                  </thead>
                  <tbody>				  
	<?php 
	while($getinfo = array_shift( $topstation ))
	{
		$station=$getinfo['AppUser_Station'];
		$code=$getinfo['AppUser_UniqueID'];
		$amount=$getinfo['total'];
			
	?>					
      <tr class=success>
        <td><?php echo $code."-".$station;?></td>
        <td>GH₵<?php echo $amount;?></td>
	  </tr>					
					<?php
					}
					?>                                      
                  </tbody>
                </table>
                  </div>
                </div>
              </div> 
              <div class="col-md-6 col-sm-6 margin-bottom-30">
                <div class="panel panel-primary">
                  <div class="panel-heading">Top 10 Ambulances (Today)</div>
                  <div class="panel-body">
                <table id='newtab2' class="table table-striped">
                  <thead>
                    <tr> 
					  <th>Vehicle ID</th>
					  <th>Amount</th>
                    </tr>
                  </thead>
                  <tbody>				  
	<?php 
	while($getinfo = array_shift( $topcustomer ))
	{
		$vehicleid=$getinfo['Vehicle_ID'];
		$amt=$getinfo['total'];
			
	?>					
      <tr class=success>
        <td><?php echo $vehicleid;?></td>
        <td>GH₵<?php echo $amt?></td>
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
              </div>
            </div>
          </div>   		  
        </div>
      </div>
<?php include ("footer.php");?>
</body>
</html>