<?php 
include("head.php");
if(isset($_GET['stmt'])){
	$where=$_GET['stmt'];
	$query="SELECT * FROM vouchers JOIN application_users ON vouchers.AppUser_UniqueID=application_users.AppUser_UniqueID".$where." order by Date_Used DESC";
	$TABLE=mysqli_query($conn,$query); 
	
if($stmt = $conn->prepare("SELECT SUM(Voucher_Amount) FROM vouchers ".$where." order by Date_Used DESC"))
{
$stmt->execute();
$stmt->bind_result($reportsum);
$stmt->fetch();

if ($reportsum==""){
    $reportsum=0;
}else{
    $reportsum=$reportsum;
}
$stmt->close();
}
}
?>
      <div class="templatemo-content-wrapper">
        <div class="templatemo-content">
          <ol class="breadcrumb">
			<li><a href="index.php">Dashboard</a></li>
            <li class="active">Reports</li>
          </ol>
          <h1>REPORTS</h1>
          <p class="margin-bottom-15">Please select from metrics below..</p>
          <div class="row">
            <div class="col-md-12">
              <form role="form" name="row" id="templatemo-preferences-form">
                <div class="row">
                    <div class="col-md-6 margin-bottom-15">
                    <label for="start_date">Start Date</label>
                    <input type="date" class="form-control" id="start_date" placeholder="Start Date">
					<span id='errorname1'style="color:red;display:none"><i class="fa fa-exclamation-triangle"></i> Please fill out this field.</span>
                    </div>   
                    <div class="col-md-6 margin-bottom-15">
                <label for="tic_ini_date2">End Date</label>
            <input type="date" class="form-control" id="end_date" placeholder="End Date">
				<span id='errorname2'style="color:red;display:none"><i class="fa fa-exclamation-triangle"></i> Please fill out this field.</span>
                    </div>									              
                </div>
              <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="singleSelect" class="control-label">Station </label>
                            <select class="form-control margin-bottom-15" name="singleSelect" id="singleSelect">
                                    <option value="">Choose...</option>
									<?php
									//populate value using php
									$query = "SELECT * FROM application_users where AppUser_Role !=3 ";
									$results=mysqli_query($conn, $query);
									//loop
									foreach ($results as $agent){
									?>
									<option value="<?php echo $agent["AppUser_UniqueID"];?>"><?php echo
									    $agent["AppUser_UniqueID"]."-".$agent["AppUser_Station"];?></option>
												<?php
													}
												?>											
                                        </select>
					<span id='errorname3'style="color:red;display:none"> This field is required</span>	
                  </div> 
              </div>            
              <div class="row templatemo-form-buttons">
                <div class="col-md-12">
                  <button id="signup" type="submit" class="btn btn-primary">GENERATE</button>
                  <button type="reset" class="btn btn-default">CLEAR</button>    
                </div>
              </div>
              <div class="row templatemo-form-buttons">
                <div class="col-md-12"><hr> 
                <div class="table-responsive">
                  <div class="panel panel-primary">
                  <div class="panel-heading">TOTAL AMOUNT: <strong>GH₵<?php echo number_format(@$reportsum,2)?></strong></div>
                  <div class="panel-body"></div>
                 <table class="table table-striped" id="transtab">
                  <thead>
                    <tr>
                      <th>Station</th>
                      <th>Voucher Amount (GH₵)</th>
                      <th>Vehicle ID</th>  
                      <th>Fuel Type</th> 
                      <th>Date Used</th>
                    </tr>
                  </thead>
        <tbody>
				
				  <?php 
					while(@$getinfo = mysqli_fetch_array($TABLE))
	{
		$AppUser_ID=$getinfo['AppUser_UniqueID'];
		$AppUser_Station=$getinfo['AppUser_Station'];
		$amount=$getinfo['Voucher_Amount'];
		$vdate=$getinfo['Date_Used'];
		$effectiveDate = strtotime("+5 hours", strtotime($vdate));
		$vehid = $getinfo['Vehicle_ID'];
		$vfuel = $getinfo['Fuel_Type'];
	?>
					
                    <tr class=success>

                      <td><?php echo $AppUser_Station?></td>
                      <td><?php echo number_format($amount,2)?></td>	       
                      <td><?php echo $vehid?></td>
					  <td><?php echo $vfuel?></td>
					  <td><?php echo date("Y-m-d h:i:s A",$effectiveDate);?></td>	
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
		
		var start_date=$("#start_date").val();
		var end_date=$("#end_date").val();
		var appuser_id=$("#singleSelect").val();
		var errr="";
/**		
		$("#start_date").keyup(function(){
			$(this).css("border", " 1px solid green");
			$("#errorname1").hide();
		})
		$("#end_date").keyup(function(){
			$(this).css("border", " 1px solid green");
			$("#errorname2").hide();
		})


		if(start_date==''){
			errr="Start is required";
			$("#start_date").css("border", " 1px solid red");
			$("#errorname1").show();
		}
		if(end_date==''){
			errr+="End is required";
			$("#end_date").css("border", " 1px solid red");
			$("#errorname2").show();
		}
**/	
		
if(errr==""){
		$.ajax({ 
			type:'POST',
			data:{start_date,end_date,appuser_id},
			url: "posts/reports.php",
  			success: function(text){
					if(text){
					location.href="reports.php?stmt="+text;
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