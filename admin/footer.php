      <!-- Modal -->
      <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="myModalLabel">Are you sure you want to sign out?</h4>
            </div>
            <div class="modal-footer">
              <a href="logout.php" class="btn btn-primary">Yes</a>
              <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            </div>
          </div>
        </div>
      </div>
	  
      <footer class="templatemo-footer">
        <div class="templatemo-copyright">
          <p>Copyright Perltechnologies&copy; 2020</p>
        </div>
      </footer>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/Chart.min.js"></script>
    <script src="js/templatemo_script.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
    <script type="text/javascript">
      // Line chart
      var smon = "<?php echo $super_mon?>";
      var dmon = "<?php echo $diesel_mon?>";
      var stue = "<?php echo $super_tue?>";
      var dtue = "<?php echo $diesel_tue?>";      
      var swed = "<?php echo $super_wed?>";
      var dwed = "<?php echo $diesel_wed?>";
      var sthu = "<?php echo $super_thu?>";
      var dthu = "<?php echo $diesel_thu?>";
      var sfri = "<?php echo $super_fri?>";
      var dfri = "<?php echo $diesel_fri?>";
      var ssat = "<?php echo $super_sat?>";
      var dsat = "<?php echo $diesel_sat?>";
      var ssun = "<?php echo $super_sun?>";
      var dsun = "<?php echo $diesel_sun?>";
      
      var lineChartData = {
        labels : ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"],
        datasets : [
        {
          label: "Super",
          fillColor : "rgba(220,220,220,0.2)",
          strokeColor : "rgba(220,220,220,1)",
          pointColor : "rgba(220,220,220,1)",
          pointStrokeColor : "#fff",
          pointHighlightFill : "#fff",
          pointHighlightStroke : "rgba(220,220,220,1)",
          data : [smon,stue,swed,sthu,sfri,ssat,ssun]
        },
        {
          label: "Diesel",
          fillColor : "rgba(151,187,205,0.2)",
          strokeColor : "rgba(151,187,205,1)",
          pointColor : "rgba(151,187,205,1)",
          pointStrokeColor : "#fff",
          pointHighlightFill : "#fff",
          pointHighlightStroke : "rgba(151,187,205,1)",
          data : [dmon,dtue,dwed,dthu,dfri,dsat,dsun]
        }
        ]
      } // lineChartData
      
      var pieChartData = [
      {
        value: <?php echo $total_super?>,
        color:"#F7464A",
        highlight: "#FF5A5E",
        label: "SUPER SALES"
      },
      {
        value: <?php echo $total_diesel?>,
        color: "#46BFBD",
        highlight: "#5AD3D1",
        label: "DIESEL SALES"
      },
      ] // pie chart data

      window.onload = function(){
          
        var ctx_line = document.getElementById("templatemo-line-chart").getContext("2d");
        var ctx_pie = document.getElementById("templatemo-pie-chart").getContext("2d");

        window.myLine = new Chart(ctx_line).Line(lineChartData, {
          responsive: true
        });
        window.myPieChart = new Chart(ctx_pie).Pie(pieChartData,{
          responsive: true
        });

      }

$("document").ready(function(){
$('#newtab').dataTable({
		ordering:false

	});
	
$('#newtab2').dataTable({
		ordering:false

	});	
	
$('#transtab').dataTable({
		ordering:false,
		dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
	});
	})	
</script>