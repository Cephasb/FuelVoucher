<?php 
include("head.php");
$unique_ID=$_GET['unid'];

if ($stmt = $conn->prepare("SELECT * FROM uploads WHERE Property_UniqueID=?")) 
{
$stmt->bind_param("s", $unique_ID);	
$stmt->execute();  
$RESULT = get_result($stmt); 	
$total = $stmt->num_rows;
}	

	if($total=='1' || $total==1){
	$show='Photo succesfully uploaded';	
	}else{
	$show=''.$total.' Photos successfully uploaded';
	}

 if(isset($_POST['add-property'])){

$maxsize=2097152;
	 if($_FILES['docs']['size']>=$maxsize){
		
			 		   	echo  '
<script type="text/javascript">';
echo 'setTimeout(function(){
	swal("FILE SIZE EXCEEDED!","No files exceeding 2M.","error");';
	echo'}, 1000);
		
</script>';
		
	 }
	 elseif ($total==4 || $total=='4'){
		 
	 		   	echo  '
<script type="text/javascript">';
echo 'setTimeout(function(){
	swal("UPLOAD LIMIT EXCEEDED!","You have uploaded a maximum of 4 photos. ","error");';
	echo'}, 1000);
		
</script>';
	 
	 }else{
		 
	$image_name =rand(123456789,987654321);
	$targetDir = "images/";
	$fileName = $_FILES['docs']['name'];
	$targetFile = $targetDir.$image_name.$fileName; 
	move_uploaded_file($_FILES['docs']['tmp_name'],$targetFile);	
	
   mysqli_query($conn, "INSERT INTO uploads (Property_UniqueID, Photo_Upload)
					values('$unique_ID', '$targetFile')") or die(mysqli_error());
	
	echo'
<script type="text/javascript">';

echo 'setTimeout(function(){
swal({
  title: "SUCCESS!",
  text: "Photo for property, ID:'.$unique_ID.' successfully added.",
  type: "success",
  confirmButtonText: "OK"
},
function(){
  window.location.href="uploadphotos.php?unid='.$unique_ID.'";
});
';
	echo'}, 1000);
	
</script>';	
		
	} 
 }
?>
      <div class="templatemo-content-wrapper">
        <div class="templatemo-content">
          <ol class="breadcrumb">
			<li><a href="index.php">Properties</a></li>
			<li><a href="index.php">Add New Property</a></li>
            <li class="active">Upload Photos</li>
          </ol>
          <h1>ADD PHOTOS</h1>
          <p class="margin-bottom-15">Please enter the details of the property below..</p>
          <div class="row">
            <div class="col-md-12">
              <form role="form" enctype="multipart/form-data" method="post" action="" id="templatemo-preferences-form">
			 <div class="row">
                <div class="col-md-12 margin-bottom-30">
                  <label for="exampleInputFile">PHOTO </label>
                  <input required name='docs' type="file" id="exampleInputFile">
                  <p class="help-block">You can upload photos here.</p>  
                </div>                  
              </div>
              <div class="row templatemo-form-buttons">
                <div class="col-md-12">
                  <button name="add-property" type="submit" class="btn btn-primary">ADD</button>
                  <button type="reset" class="btn btn-default">CLEAR</button>    
                </div>
              </div>
            </form>
          </div>
                           <div class="content col-md-8">
                           <div class="post-padding">
						   <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive job-table">
                                            <table id="newtab" class="table table-bordred table-striped">

                                                <thead>
												<tr>
													<th>Photo</th>
                                                    <th>Link</th>
													<th>Delete</th>
												</tr>
                                                </thead>						   
						   <tbody>						   
						    <?php 
							while($getinfo = array_shift( $RESULT ))
							{ 
							?>
							 <tr>
                               <td>
						 
						   <img src='<?php echo $getinfo['Photo_Upload'];?>' height='50' width='50'/>
					
							</td>
							<td>
							<a target="_blank" href="<?php echo $getinfo['Photo_Upload'];?>"> <i class="fa fa-download" aria-hidden="true"> Download</i></a>
							</td>
							<td>
							<span data-placement="top" data-toggle="tooltip" title="Remove"><button uploadid="<?php echo $getinfo["uploadid"]?>" class="deletedocs btn btn-danger btn-xs"><i class="fa fa-trash">X</i></button></span>
							</td>
							</tr>
						   <?php 
							}
						   ?>
						   </tbody>
						   
						    </table>
                                        </div><!-- end table -->
                                    </div><!-- end col -->
                                </div><!-- end row -->
							</div>
							</div>		  
        </div>
      </div>
    </div>
	
<?php include ("footer.php");?>
</body>
</html>