<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Monitoring</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="icon" href="<?php echo base_url('/assets/dist/images/logo.png'); ?>">
	<link href="<?php echo base_url('/assets/bawaan/plugins/fontawesome-free/css/all.min.css')?>" rel="stylesheet">
	<link href="<?php echo base_url('/assets/bawaan/dist/css/adminlte.css')?>" rel="stylesheet">
	<link href="<?php echo base_url('/assets/dist/css/jquery.dataTables.min.css')?>" rel="stylesheet">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.1.5/css/fixedHeader.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
	<style>
	table, th, td {
	border: 1px solid black;
	border-collapse: collapse;
	}

	table.center {
	margin-left: auto; 
	margin-right: auto;
	}
	</style>
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  

  <?php $this->load->view('layout/navbar'); ?>
  <?php $this->load->view('layout/sidebar'); ?>
 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
			<h5 class="breadcrumb-item"><?php $vdate = date("Y/m/d"); echo date('d F Y', strtotime( $vdate)); ; ?></h5>
              <!-- <li class="breadcrumb-item"><a href="#">HOME</a></li>
              <li class="breadcrumb-item active">DASHBOARD</li> -->
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
		
	  	<div class="row">

          <div class="col-md-4 col-sm-6 col-12">
		  	<div class="bg-white">
			  <span class="newsDate"><strong>&emsp;Lahat</strong></span> 
			  <div style="float:right;">
			    <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i> &emsp;</a> -->
			  </div>
       
        
			  <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
				<div class="info-box">
					<span class="info-box-icon bg-success"><i class="fas fa-truck "></i></span>

					<div class="info-box-content border-right">
						<span align="center" style="color:black" class="info-box-text">IN</span>
						<span align="center" style="color:black" class="info-box-number" id="count_lahat_in">
							<p onClick="click_detail_lahat_in()" >
								<?php echo $count_lahat_in['FCOUNT']  ?>
							</p>	
						</span>
					</div>
					<div class="info-box-content">
						<span align="center" style="color:black" class="info-box-text">OUT</span>
						<span align="center" style="color:black" class="info-box-number" id="count_lahat_out">
							<p onClick="click_detail_lahat_out()" >
								<?php echo $count_lahat_out['FCOUNT']  ?>
							</p>
						</span>
					</div>
					<!-- /.info-box-content -->
				</div>
			</div>
            <!-- /.info-box -->
          </div>

		  <div class="col-md-4 col-sm-6 col-12">
		  	<div class="bg-white">
			  <span class="newsDate"><strong>&emsp;Sukacinta</strong></span> 
			  <div style="float:right;">
			    <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i> &emsp;</a> -->
			  </div>
       
        
			  <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
				<div class="info-box">
					<span class="info-box-icon bg-success"><i class="fas fa-truck "></i></span>

					<div class="info-box-content border-right">
						<span align="center" style="color:black" class="info-box-text">IN</span>
						<span align="center" style="color:black" class="info-box-number" id="count_sucin_in">
							<p onClick="click_detail_sucin_in()" >
								<?php echo $count_sucin_in['FCOUNT']  ?>
							</p>
						</span>
					</div>
					<div class="info-box-content">
						<span align="center" style="color:black" class="info-box-text">OUT</span>
						<span align="center" style="color:black" class="info-box-number" id="count_sucin_out">
							<p onClick="click_detail_sucin_out()" >
								<?php echo $count_sucin_out['FCOUNT']  ?>
							</p>
						</span>
					</div>
					<!-- /.info-box-content -->
				</div>
			</div>
            <!-- /.info-box -->
          </div>

		  <div class="col-md-4 col-sm-6 col-12">
		  	<div class="bg-white">
			  <span class="newsDate"><strong>&emsp;Jalan Hauling</strong></span> 
			  <div style="float:right;">
			    <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i> &emsp;</a> -->
			  </div>
       
        
			  <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
				<div class="info-box">
					<span class="info-box-icon bg-success"><i class="fas fa-truck "></i></span>

					<!-- <div class="info-box-content border-right">
						<span align="center" style="color:black" class="info-box-text">IN / OUT</span>
						<span align="center" style="color:black" class="info-box-number"><?php echo $count_lahat_in['FCOUNT']  ?></span>
					</div> -->
					<div class="info-box-content">
						<span align="center" style="color:black" class="info-box-text">IN / OUT</span>
						<span align="center" style="color:black" class="info-box-number" id="count_hauling_inout">
							<p onClick="click_detail_hauling_inout()" >
								<?php echo $count_hauling_inout['FCOUNT']  ?>
							</p>
						</span>
					</div>
					<!-- /.info-box-content -->
				</div>
			</div>
            <!-- /.info-box -->
          </div>

        </div>

		<div class="row">
			<div class="col-md-12 col-sm-6 col-12">
				<canvas id="ChartRitase"></canvas>
				<table class="center" border = 1>
					<tr>
						<td style="background-color:#497f9e; width:30%;"> <p style="color:white;" align="center">RITASE</p></td>
						<td style="background-color:#497f9e; width:30%;"> <p style="color:white;" align="center" id="total_ritase_today"><?php echo $get_total_all_ritase_today['ftotal_ritase'] ?></p></td>
						<td style="background-color:#497f9e; width:30%;"> <p style="color:white;" align="center">RIT</p></td>
					</tr>
					<tr>
						<td style="background-color:#497f9e; width:30%;"> <p style="color:white;" align="center">HAULER</p></td>
						<td style="background-color:#497f9e; width:30%;"> <p style="color:white;" align="center" id="total_hauler_ritase_today"><?php echo $get_total_hauler_ritase_today['fhauler'] ?></p></td>
						<td style="background-color:#497f9e; width:30%;"> <p style="color:white;" align="center">UNIT</p></td>
					</tr>
					
				</table>
			</div>
			<!-- <div class="col-md-6 col-sm-6 col-12">
				<canvas id="ChartTonase"></canvas>
				<table class="center" border = 1>
					<tr>
						<td style="background-color:#497f9e; width:30%;"> <p style="color:white;" align="center">TONASE</p></td>
						<td style="background-color:#497f9e; width:30%;"> <p style="color:white;" align="center" id="total_tonase_today"><?php echo $get_total_all_tonase_today['ftotal_tonase'] ?></p></td>
						<td style="background-color:#497f9e; width:30%;"> <p style="color:white;" align="center">MT</p></td>
					</tr>
					<tr>
						<td style="background-color:#497f9e; width:30%;"> <p style="color:white;" align="center">HAULER</p></td>
						<td style="background-color:#497f9e; width:30%;"> <p style="color:white;" align="center" id="total_hauler_tonase_today"><?php echo $get_total_hauler_tonase_today['fhauler'] ?></p></td>
						<td style="background-color:#497f9e; width:30%;"> <p style="color:white;" align="center">UNIT</p></td>
					</tr>
					
				</table>
			</div> -->
			
			
		</div>
		

      </div>
      <!-- /.timeline -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- modal -->

  <!-- The Modal Lahat in -->
  <div class="modal" id="modal_lahat_in">
    <div class="modal-dialog " >
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">DETAIL LAHAT IN TODAY</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
		<div class="modal-body">
			<table id="table_detail_lahat_in" class="table table-striped table-bordered" style="width:100%">
				<thead>
					<tr>
						<th>NO</th>
						<th>LICENSE PLAT</th>
						<th>WEIGHT</th>
						<th>DATE</th>
						<th>TIME</th>
					</tr>
				</thead>
				<tbody>
				</tbody>

				<tfoot>
					<tr>
						<th>NO</th>
						<th>LICENSE PLAT</th>
						<th>WEIGHT</th>
						<th>DATE</th>
						<th>TIME</th>
					</tr>
				</tfoot>
			</table>
		</div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  
  <!-- The Modal lahat out -->
  <div class="modal" id="modal_lahat_out">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">DETAIL LAHAT OUT TODAY</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
		<div class="modal-body">
			<table id="table_detail_lahat_out" class="table table-striped table-bordered" style="width:100%">
				<thead>
					<tr>
						<th>NO</th>
						<th>LICENSE PLAT</th>
						<th>WEIGHT</th>
						<th>DATE</th>
						<th>TIME</th>
					</tr>
				</thead>
				<tbody>
				</tbody>

				<tfoot>
					<tr>
						<th>NO</th>
						<th>LICENSE PLAT</th>
						<th>WEIGHT</th>
						<th>DATE</th>
						<th>TIME</th>
					</tr>
				</tfoot>
			</table>
		</div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- The Modal sucin in -->
  <div class="modal" id="modal_sucin_in">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">DETAIL SUKACINTA IN TODAY</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
		<div class="modal-body">
			<table id="table_detail_sucin_in" class="table table-striped table-bordered" style="width:100%">
				<thead>
					<tr>
						<th>NO</th>
						<th>LICENSE PLAT</th>
						<th>WEIGHT</th>
						<th>DATE</th>
						<th>TIME</th>
					</tr>
				</thead>
				<tbody>
				</tbody>

				<tfoot>
					<tr>
						<th>NO</th>
						<th>LICENSE PLAT</th>
						<th>WEIGHT</th>
						<th>DATE</th>
						<th>TIME</th>
					</tr>
				</tfoot>
			</table>
		</div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- The Modal sucin out -->
  <div class="modal" id="modal_sucin_out">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">DETAIL SUKACINTA OUT TODAY</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
		<div class="modal-body">
			<table id="table_detail_sucin_out" class="table table-striped table-bordered" style="width:100%">
				<thead>
					<tr>
						<th>NO</th>
						<th>LICENSE PLAT</th>
						<th>WEIGHT</th>
						<th>DATE</th>
						<th>TIME</th>
					</tr>
				</thead>
				<tbody>
				</tbody>

				<tfoot>
					<tr>
						<th>NO</th>
						<th>LICENSE PLAT</th>
						<th>WEIGHT</th>
						<th>DATE</th>
						<th>TIME</th>
					</tr>
				</tfoot>
			</table>
		</div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- The Modal hauling inout -->
  <div class="modal" id="modal_hauling_inout">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">DETAIL HAULING IN/OUT TODAY</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
		<div class="modal-body">
			<table id="table_detail_hauling_inout" class="table table-striped table-bordered" style="width:100%">
				<thead>
					<tr>
						<th>NO</th>
						<th>LICENSE PLAT</th>
						<th>WEIGHT</th>
						<th>DATE</th>
						<th>TIME</th>
					</tr>
				</thead>
				<tbody>
				</tbody>

				<tfoot>
					<tr>
						<th>NO</th>
						<th>LICENSE PLAT</th>
						<th>WEIGHT</th>
						<th>DATE</th>
						<th>TIME</th>
					</tr>
				</tfoot>
			</table>
		</div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


  <?php $this->load->view('layout/footer'); ?>
  
</div>
<!-- ./wrapper -->

<script src="<?php echo base_url('/assets/bawaan/plugins/jquery/jquery.min.js')?>"></script>
<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assets/bawaan/plugins/bootstrap/js/bootstrap.bundle.min.js"')?>"></script>
<script src="<?php echo base_url('/assets/bawaan/dist/js/adminlte.min.js')?>"></script>
<script src="<?php echo base_url('/assets/bawaan/dist/js/demo.js')?>"></script>
<script src="<?php echo base_url('/assets/chartjs/Chart.js')?>"></script>

<script src="<?php echo base_url('server/node_modules/socket.io/node_modules/socket.io-client/socket.io.js');?>"></script>

<script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>

<script type="text/javascript">
	var suara_success = document.getElementById("notif_audio_success"); 
	var suara_failed = document.getElementById("notif_audio_failed"); 
	var table_capture;
	$(document).ready(function () {
		table_capture = $('#table_capture').DataTable({
			responsive: true,
			// "paging": true,
			// "searching": false,
			"processing": true, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"order": [], //Initial no order.
			
			"ajax": {
				"url": "<?php echo site_url('Admin/Capture_controller/get_capture_all')?>",
				"type": "POST",
				"data": function ( data ) {
					// console.log(data)
				}
			},
			"columnDefs": [{
				"targets": [0,1],
				"visible": false,
				"searchable": false
			}]
			});
			new $.fn.dataTable.FixedHeader( table_capture );

			$('#btn-reset').click(function(){ 
			window.location.href = "<?php  echo site_url('Admin/Master_controller/mtdepartement_index' ); ?>"
		});
		

	});

	var socket1 = io.connect( 'http://188.88.15.134:3001' ); 

	var dt = new Date();
	var datetime = dt.getFullYear().toString().padStart(4, '0') +'-'+ 
					(dt.getMonth()+1).toString().padStart(2, '0') +'-'+
					dt.getDate().toString().padStart(2, '0') +' '+
					dt.getHours().toString().padStart(2, '0') +':'+
					dt.getMinutes().toString().padStart(2, '0') +':'+
					dt.getSeconds().toString().padStart(2, '0');

	var setdate = dt.getDate().toString().padStart(2, '0') +' '+
					(dt.getMonth()+1).toString().padStart(2, '0') +' '+
					dt.getFullYear().toString().padStart(4, '0') ;

	var settime = dt.getHours().toString().padStart(2, '0') +':'+
                dt.getMinutes().toString().padStart(2, '0') +':'+
                dt.getSeconds().toString().padStart(2, '0');
  
	socket1.on( 'emit_from_server', function( data ) {
		$( "#message-tbody" ).prepend('<tr><td>99</td><td>'+data.VIPCAM+'</td><td>'+data.VIPCAM+'</td><td>'+data.VLICENSEPLAT+'</td><td>'+setdate+'</td><td>'+settime+'</td></tr>');
		table_capture.ajax.reload();
	});

	socket1.on( 'emit_push_weight', function( data ) {
		
		for(var i in data)
		{
			for(var j in data[i])
			{
	
				switch (data[i][j].VLOCATION_NAME) {
					case "LAHAT IN ":
						var VCOUNT =data[i][j].FCOUNT ; 
						$( "#count_lahat_in" ).html("<p onClick='click_detail_lahat_in()' >" +VCOUNT+ "</p>");
						break;
					case "LAHAT OUT":
						var VCOUNT =data[i][j].FCOUNT; 
						$( "#count_lahat_out" ).html("<p onClick='click_detail_lahat_out()' >" +VCOUNT+ "</p>");
						realtime_chart_ritase()
						break;
					case "SUKACINTA IN":
						var VCOUNT =data[i][j].FCOUNT; 
						$( "#count_sucin_in" ).html("<p onClick='click_detail_sucin_in()'>" +VCOUNT+ "</p>");
						realtime_chart_tonase()
						break;
					case "SUKACINTA OUT":
						var VCOUNT =data[i][j].FCOUNT; 
						$( "#count_sucin_out" ).html("<p onClick='click_detail_sucin_out()'>" +VCOUNT+ "</p>");
						break;
					case "JALAN HAULING":
						var VCOUNT =data[i][j].FCOUNT; 
						$( "#count_hauling_inout" ).html("<p onClick='click_detail_hauling_inout()'>" +VCOUNT+ "</p>");
						break;
				
					default:
						break;
				}
			}
			
		}
		// realtime_chart(); 
	});

	socket1.on( 'emit_total_all_ritase_today', function( data ) {
		for(var i in data)
		{
			
			for(var j in data[i])
			{
				console.log("data_total ritase", data[i][j].ftotal_ritase)
				var VTOTAL =data[i][j].ftotal_ritase ; 
				$( "#total_ritase_today" ).html("<p>" +VTOTAL+ "</p>");
		}
			
		}
		// realtime_chart(); 
	});

	socket1.on( 'emit_total_all_hauler_ritase_today', function( data ) {
		for(var i in data)
		{
			
			for(var j in data[i])
			{
				console.log("data_total ritase", data[i][j].ftotal_ritase)
				var VTOTAL =data[i][j].ftotal_ritase ; 
				$( "#total_hauler_ritase_today" ).html("<p>" +VTOTAL+ "</p>");
		}
			
		}
		// realtime_chart(); 
	});

	socket1.on( 'emit_total_all_tonase_today', function( data ) {
		for(var i in data)
		{
			
			for(var j in data[i])
			{
				// console.log("data_total ritase", data[i][j].ftotal_tonase)
				var VTOTAL =data[i][j].ftotal_tonase ; 
				$( "#total_tonase_today" ).html("<p>" +VTOTAL+ "</p>");
		}
			
		}
		// realtime_chart(); 
	});

	$(document).ready(function() {
		//chart ritase
		$.ajax({
			type : "POST",
			url  : "http://188.88.15.134:8888/hikvision/Admin/Capture_controller/get_data_ritase_today",
			dataType : "JSON",
			success: function(data) {
				console.log(data)
				var ctx = document.getElementById("ChartRitase").getContext("2d");
				var departments = [];
				var times = [];

				for (var department in data) {
					
				if (data.hasOwnProperty(department)) {
					var departmentData = data[department];
					
					getYears(departmentData);
				}
				}

				times.sort();

				for (var department in data) {
				if (data.hasOwnProperty(department)) {
					var departmentData = data[department]; //getDataForDepartment(i);
					
					var fvalueData = getFvalueDataForDep(departmentData);

					var departmentObject = prepareDepartmentDetails(
					department,
					fvalueData
					);
					// console.log(departmentObject)  hasilnya sudah komplit
					departments.push(departmentObject);
				}
				}

				var chartData = {
				labels: times,
				datasets: departments
				};
				// console.log(chartData)  hasil full dataset multiple

				var chart = new Chart(ctx, {
				type: "bar",
				data: chartData,
				options: {}
				});

				// function getDataForDepartment(index) {
				// 	console.log(index);
				// return data[i][Object.keys(data[i])[0]];
				// }

				function getYears(departmentData) {
				for (var j = 0; j < departmentData.length; j++) {
					if (!times.includes(departmentData[j].time)) {
						// console.log(departmentData[j].time); Hasil nya jadi buat yang bawah atau time
					times.push(departmentData[j].time);
					}
				}
				}

				function getFvalueDataForDep(departmentData) {
				var fvalueData = [];
				for (var j = 0; j < times.length; j++) {
					var currentTime = times[j];
					
					var currentFvalue = null;
					for (var k = 0; k < departmentData.length; k++) {
						
						if (departmentData[k].time === currentTime) {
							currentFvalue = departmentData[k].fvalue;
							// console.log(currentTotalNaissance); Hasil nya jadi buat value
							break;
						}
					}
					fvalueData.push(currentFvalue); 
				}
				return fvalueData;
				}

				function prepareDepartmentDetails(departmentName, fvalueData) {
					var dataColor = getRandomColor();
					return {
						label: departmentName,
						data: fvalueData,
						backgroundColor: 'rgb(37, 150, 190)',
						borderColor: dataColor, //"#3e95cd", dataColor
						borderWidth: 1
						// pointBackgroundColor: dataColor,
						// fill: false,
						// lineTension: 0,
						// pointRadius: 5
					};
				}

				function getRandomColor() {
				var letters = "0123456789ABCDEF".split("");
				var color = "#";
				for (var i = 0; i < 6; i++) {
					color += letters[Math.floor(Math.random() * 16)];
				}
				return color;
				}
			}
		});

		//chart tonase
		$.ajax({
			type : "POST",
			url  : "http://188.88.15.134:8888/hikvision/Admin/Capture_controller/get_data_tonase_today",
			dataType : "JSON",
			success: function(data) {
				console.log(data)
				var ctx = document.getElementById("ChartTonase").getContext("2d");
				var departments = [];
				var times = [];

				for (var department in data) {
					
				if (data.hasOwnProperty(department)) {
					var departmentData = data[department];
					
					getYears(departmentData);
				}
				}

				times.sort();

				for (var department in data) {
				if (data.hasOwnProperty(department)) {
					var departmentData = data[department]; //getDataForDepartment(i);
					
					var fvalueData = getFvalueDataForDep(departmentData);

					var departmentObject = prepareDepartmentDetails(
					department,
					fvalueData
					);
					// console.log(departmentObject)  hasilnya sudah komplit
					departments.push(departmentObject);
				}
				}

				var chartData = {
				labels: times,
				datasets: departments
				};
				// console.log(chartData)  hasil full dataset multiple

				var chart = new Chart(ctx, {
				type: "bar",
				data: chartData,
				options: {}
				});

				// function getDataForDepartment(index) {
				// 	console.log(index);
				// return data[i][Object.keys(data[i])[0]];
				// }

				function getYears(departmentData) {
				for (var j = 0; j < departmentData.length; j++) {
					if (!times.includes(departmentData[j].time)) {
						// console.log(departmentData[j].time); Hasil nya jadi buat yang bawah atau time
					times.push(departmentData[j].time);
					}
				}
				}

				function getFvalueDataForDep(departmentData) {
				var fvalueData = [];
				for (var j = 0; j < times.length; j++) {
					var currentTime = times[j];
					
					var currentFvalue = null;
					for (var k = 0; k < departmentData.length; k++) {
						
						if (departmentData[k].time === currentTime) {
							currentFvalue = departmentData[k].fvalue;
							// console.log(currentTotalNaissance); Hasil nya jadi buat value
							break;
						}
					}
					fvalueData.push(currentFvalue); 
				}
				return fvalueData;
				}

				function prepareDepartmentDetails(departmentName, fvalueData) {
					var dataColor = getRandomColor();
					return {
						label: departmentName,
						data: fvalueData,
						backgroundColor: 'rgb(37, 150, 190)',
						borderColor: dataColor, //"#3e95cd",
						borderWidth: 1
						// pointBackgroundColor: dataColor,
						// fill: false,
						// lineTension: 0,
						// pointRadius: 5
					};
				}

				function getRandomColor() {
				var letters = "0123456789ABCDEF".split("");
				var color = "#";
				for (var i = 0; i < 6; i++) {
					color += letters[Math.floor(Math.random() * 16)];
				}
				return color;
				}
			}
		});
	});

	function realtime_chart_ritase()
	{
		console.log('dapet loh realtime');
		$.ajax({
			type : "POST",
			url  : "http://188.88.15.134:8888/hikvision/Admin/Capture_controller/get_data_ritase_today",
			dataType : "JSON",
			success: function(data) {
				console.log(data)
				var ctx = document.getElementById("ChartRitase").getContext("2d");
				var departments = [];
				var times = [];

				for (var department in data) {
					
				if (data.hasOwnProperty(department)) {
					var departmentData = data[department];
					
					getYears(departmentData);
				}
				}

				times.sort();

				for (var department in data) {
				if (data.hasOwnProperty(department)) {
					var departmentData = data[department]; //getDataForDepartment(i);
					
					var fvalueData = getFvalueDataForDep(departmentData);

					var departmentObject = prepareDepartmentDetails(
					department,
					fvalueData
					);
					// console.log(departmentObject)  hasilnya sudah komplit
					departments.push(departmentObject);
				}
				}

				var chartData = {
				labels: times,
				datasets: departments
				};
				// console.log(chartData)  hasil full dataset multiple

				var chart = new Chart(ctx, {
				type: "bar",
				data: chartData,
				options: {}
				});

				// function getDataForDepartment(index) {
				// 	console.log(index);
				// return data[i][Object.keys(data[i])[0]];
				// }

				function getYears(departmentData) {
				for (var j = 0; j < departmentData.length; j++) {
					if (!times.includes(departmentData[j].time)) {
						// console.log(departmentData[j].time); Hasil nya jadi buat yang bawah atau time
					times.push(departmentData[j].time);
					}
				}
				}

				function getFvalueDataForDep(departmentData) {
				var fvalueData = [];
				for (var j = 0; j < times.length; j++) {
					var currentTime = times[j];
					
					var currentFvalue = null;
					for (var k = 0; k < departmentData.length; k++) {
						
						if (departmentData[k].time === currentTime) {
							currentFvalue = departmentData[k].fvalue;
							// console.log(currentTotalNaissance); Hasil nya jadi buat value
							break;
						}
					}
					fvalueData.push(currentFvalue); 
				}
				return fvalueData;
				}

				function prepareDepartmentDetails(departmentName, fvalueData) {
					var dataColor = getRandomColor();
					return {
						label: departmentName,
						data: fvalueData,
						backgroundColor:  'rgb(37, 150, 190)',
						borderColor: dataColor, //"#3e95cd",
						borderWidth: 1
						// pointBackgroundColor: dataColor,
						// fill: false,
						// lineTension: 0,
						// pointRadius: 5
					};
				}

				function getRandomColor() {
				var letters = "0123456789ABCDEF".split("");
				var color = "#";
				for (var i = 0; i < 6; i++) {
					color += letters[Math.floor(Math.random() * 16)];
				}
				return color;
				}
			}
		});
	}

	function realtime_chart_tonase()
	{
		console.log('dapet loh realtime');
		$.ajax({
			type : "POST",
			url  : "http://188.88.15.134:8888/hikvision/Admin/Capture_controller/get_data_tonase_today",
			dataType : "JSON",
			success: function(data) {
				console.log(data)
				var ctx = document.getElementById("ChartTonase").getContext("2d");
				var departments = [];
				var times = [];

				for (var department in data) {
					
				if (data.hasOwnProperty(department)) {
					var departmentData = data[department];
					
					getYears(departmentData);
				}
				}

				times.sort();

				for (var department in data) {
				if (data.hasOwnProperty(department)) {
					var departmentData = data[department]; //getDataForDepartment(i);
					
					var fvalueData = getFvalueDataForDep(departmentData);

					var departmentObject = prepareDepartmentDetails(
					department,
					fvalueData
					);
					// console.log(departmentObject)  hasilnya sudah komplit
					departments.push(departmentObject);
				}
				}

				var chartData = {
				labels: times,
				datasets: departments
				};
				// console.log(chartData)  hasil full dataset multiple

				var chart = new Chart(ctx, {
				type: "bar",
				data: chartData,
				options: {}
				});

				// function getDataForDepartment(index) {
				// 	console.log(index);
				// return data[i][Object.keys(data[i])[0]];
				// }

				function getYears(departmentData) {
				for (var j = 0; j < departmentData.length; j++) {
					if (!times.includes(departmentData[j].time)) {
						// console.log(departmentData[j].time); Hasil nya jadi buat yang bawah atau time
					times.push(departmentData[j].time);
					}
				}
				}

				function getFvalueDataForDep(departmentData) {
				var fvalueData = [];
				for (var j = 0; j < times.length; j++) {
					var currentTime = times[j];
					
					var currentFvalue = null;
					for (var k = 0; k < departmentData.length; k++) {
						
						if (departmentData[k].time === currentTime) {
							currentFvalue = departmentData[k].fvalue;
							// console.log(currentTotalNaissance); Hasil nya jadi buat value
							break;
						}
					}
					fvalueData.push(currentFvalue); 
				}
				return fvalueData;
				}

				function prepareDepartmentDetails(departmentName, fvalueData) {
					var dataColor = getRandomColor();
					return {
						label: departmentName,
						data: fvalueData,
						backgroundColor: 'rgb(37, 150, 190)',
						borderColor: dataColor, //"#3e95cd",
						borderWidth: 1
						// pointBackgroundColor: dataColor,
						// fill: false,
						// lineTension: 0,
						// pointRadius: 5
					};
				}

				function getRandomColor() {
				var letters = "0123456789ABCDEF".split("");
				var color = "#";
				for (var i = 0; i < 6; i++) {
					color += letters[Math.floor(Math.random() * 16)];
				}
				return color;
				}
			}
		});
	}

	function click_detail_lahat_in()
	{
		var temp = 1;
		var modal_name = '#modal_lahat_in';
		var tabel_name = 'table_detail_lahat_in';
		get_all_detail_today_by_location(temp, modal_name, tabel_name)
	}

	function click_detail_lahat_out()
	{
		var temp = 2;
		var modal_name = '#modal_lahat_out';
		var tabel_name = 'table_detail_lahat_out';
		get_all_detail_today_by_location(temp, modal_name, tabel_name)
	}

	function click_detail_sucin_in()
	{
		var temp = 3;
		var modal_name = '#modal_sucin_in';
		var tabel_name = 'table_detail_sucin_in';
		get_all_detail_today_by_location(temp, modal_name, tabel_name)
	}

	function click_detail_sucin_out()
	{
		var temp = 4;
		var modal_name = '#modal_sucin_out';
		var tabel_name = 'table_detail_sucin_out';
		get_all_detail_today_by_location(temp, modal_name, tabel_name)
	}

	function click_detail_hauling_inout()
	{
		var temp = 5;
		var modal_name = '#modal_hauling_inout';
		var tabel_name = 'table_detail_hauling_inout';
		get_all_detail_today_by_location(temp, modal_name, tabel_name)
	}

	function get_all_detail_today_by_location (a,b,c)
	{
		var selector_tabel = '#'+c;
		console.log(a,b,c,selector_tabel)

		$(selector_tabel).DataTable().clear().destroy();
		c = $(selector_tabel).DataTable({
			"processing": true,
			"serverSide": true,
			"order": [],
			searching: false, 
			paging: false, 
			info: false,

			"ajax": {
				"url": "<?php echo site_url('Admin/Capture_controller/get_all_detail_today_by_location')?>/"+a,
				"type": "POST"
			},
			"columnDefs": [{
				"targets": [], 
				"visible": false,
				"searchable": true
			}],
			
		});

		$(b).modal({backdrop: 'static',keyboard: false}, 'show');
	}

</script>

</body>
</html>

