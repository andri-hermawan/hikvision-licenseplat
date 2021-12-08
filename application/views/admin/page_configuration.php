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
            <h1>DASHBOARD</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">HOME</a></li>
              <li class="breadcrumb-item active">DASHBOARD</li>
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
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="far fa-calendar"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">DATE</span>
                <span class="info-box-number"><?php $vdate = date("Y/m/d"); echo date('d F Y', strtotime( $vdate)); ; ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="fas fa-truck "></i></span>

              <div class="info-box-content">
                <span class="info-box-text">TRUCK</span>
                <span class="info-box-number"><?php echo $get_total_truck['TOTAL_TRUCK']  ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="fas fa-map-marker"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">LOCATION</span>
                <span class="info-box-number"><?php echo $get_total_location['TOTAL_LOCATION']  ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
        </div>
        <!-- /.row -->

        <!-- Timelime example  -->
        <!-- <div class="row">
			<div class="col-md-12">
				<div class="card card-default">
					<div class="card-body">
						<div class="callout callout-success">
							<h5><strong>TRUCK DENGAN PLAT NOMOR B6338STF</strong></h5>
							<p>
							SEDANG MASUK KELOKASI LAHAT UNTUK MEMUAT BATUBARA
							<br>
							TGL & WAKTU
							</p>
						</div>
					</div>

					<div class="card-body">
						<div class="callout callout-success">
							<h5><strong>TRUCK DENGAN PLAT NOMOR B6338STF</strong></h5>
							<p>
							SEDANG MASUK KELOKASI LAHAT UNTUK MEMUAT BATUBARA
							<br>
							TGL & WAKTU
							</p>
						</div>
					</div>

					<div class="card-body">
						<div class="callout callout-success">
							<h5><strong>TRUCK DENGAN PLAT NOMOR B6338STF</strong></h5>
							<p>
							SEDANG MASUK KELOKASI LAHAT UNTUK MEMUAT BATUBARA
							<br>
							TGL & WAKTU
							</p>
						</div>
					</div>

					<div class="card-body">
						<div class="callout callout-success">
							<h5><strong>TRUCK DENGAN PLAT NOMOR B6338STF</strong></h5>
							<p>
							SEDANG MASUK KELOKASI LAHAT UNTUK MEMUAT BATUBARA
							<br>
							TGL & WAKTU
							</p>
						</div>
					</div>
				</div>
			</div>
        </div> -->

		<div class="container">
			<table id="table_capture" class="display nowrap table-striped table-bordered table" style="width:100%">
				<thead>
					<tr style="background-color:#3bb44a; color:white;   ">
						<!-- <th>NO</th> -->
						<th>ID</th>
						<th>IP CAM</th>
						<th>LOCATION</th>
						<th>LICENSE PLAT</th>
						<th>DATE</th>
						<th>TIME</th>
					</tr>
				</thead>
				<tbody id="message-tbody">
				</tbody>

				<tfoot>
					<tr style="background-color:#3bb44a; color:white;   ">
						<!-- <th>NO</th> -->
						<th>ID</th>
						<th>IP CAM</th>
						<th>LOCATION</th>
						<th>LICENSE PLAT</th>
						<th>DATE</th>
						<th>TIME</th>
					</tr>
				</tfoot>
			</table>
		</div>

      </div>
      <!-- /.timeline -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <?php $this->load->view('layout/footer'); ?>
  
</div>
<!-- ./wrapper -->

<script src="<?php echo base_url('/assets/bawaan/plugins/jquery/jquery.min.js')?>"></script>
<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assets/bawaan/plugins/bootstrap/js/bootstrap.bundle.min.js"')?>"></script>
<script src="<?php echo base_url('/assets/bawaan/dist/js/adminlte.min.js')?>"></script>
<script src="<?php echo base_url('/assets/bawaan/dist/js/demo.js')?>"></script>

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

	var socket = io.connect( 'http://'+window.location.hostname+':3001' );

	socket.on( 'emit_from_server', function( data ) {
		
		var dt = new Date();
		var datetime = dt.getFullYear().toString().padStart(4, '0') +'-'+ 
		(dt.getMonth()+1).toString().padStart(2, '0') +'-'+
		dt.getDate().toString().padStart(2, '0') +' '+
		dt.getHours().toString().padStart(2, '0') +':'+
		dt.getMinutes().toString().padStart(2, '0') +':'+
		dt.getSeconds().toString().padStart(2, '0')
		;

		if (data.VLICENSEPLAT == 'unknown') {
			suara_failed.play();
			toastr.warning('Plat Nomor Tidak Tercapture .')
			$( "#message-tbody" ).prepend('<tr><td>99</td><td>'+data.VIPCAM+'</td><td>'+data.VLICENSEPLAT+'</td><td>'+datetime+'</td></tr>');
			table_capture.ajax.reload();
		} else {
			suara_success.play();
			// console.log("ELSE",data.VLICENSEPLAT);
			toastr.success('Plat Nomor Sudah Tercapture dan Tersimpan ke Database.')
			$( "#message-tbody" ).prepend('<tr><td>99</td><td>'+data.VIPCAM+'</td><td>'+data.VLICENSEPLAT+'</td><td>'+datetime+'</td></tr>');
			table_capture.ajax.reload();
		}
	});
</script>

</body>
</html>

