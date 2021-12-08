<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<!DOCTYPE html>
	<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
	<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="x-ua-compatible" content="ie=edge">

		<title>CCTV</title>

		<link rel="icon" href="<?php echo base_url('/assets/dist/images/logo.png'); ?>">
		<link href="<?php echo base_url('/assets/dist/css/all.min.css')?>" rel="stylesheet">
		<link href="<?php echo base_url('/assets/dist/css/adminlte.css')?>" rel="stylesheet">
<!-- 		<link href="<?php echo base_url('/assets/dist/css/bootstrap.css')?>" rel="stylesheet"> -->
		<link href="<?php echo base_url('/assets/dist/css/dataTables.bootstrap4.min.css')?>" rel="stylesheet">
		<link href="<?php echo base_url('/assets/dist/css/custom.css')?>" rel="stylesheet">
		<link href="<?php echo base_url('/assets/dist/css/jquery.dataTables.min.css')?>" rel="stylesheet">
		<link href="<?php echo base_url('/assets/dist/css/buttons.dataTables.min.css')?>" rel="stylesheet">
		<link href="<?php echo base_url('/assets/datatables/Select/css/select.dataTables.min.css')?>" rel="stylesheet">
		<link href="<?php echo base_url('/assets/dist/jquery.contextMenu.min.css')?>" rel="stylesheet">
		<link href="<?php echo base_url('/assets/summernote/summernote-bs4.css')?>" rel="stylesheet">
		<!-- Toastr -->
		<link rel="stylesheet" href="<?php echo base_url('/assets/toastr/toastr.min.css')?>" rel="stylesheet">
		<!-- Google Font: Source Sans Pro -->
		<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
		crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.1.5/css/fixedHeader.bootstrap.min.css">
    	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
		<style>
		.context-menu-abc {
		border: 1px solid gray;
		padding: 5px;
		}
		/* used for all items */
		
		.context-menu-item {
		min-height: 18px;
		background-repeat: no-repeat;
		background-position: 4px 4px;
		}
		/* all custom icons */
		
		.context-menu-item.context-menu-icon-firstOpt {
		background-image: url("https://cdn4.iconfinder.com/data/icons/6x16-free-application-icons/16/Boss.png");
		}
		
		.context-menu-item.context-menu-icon-secondOpt {
		background-image: url('/assets/dist/images/logo.png');
		}
		
		.context-menu-item.context-menu-icon-thirdOpt {
		background-image: url('../../assets/dist/images/search.png');
		}
			
		.dataTables_filter { display: none; }
		</style>
	</head>

	<body class="hold-transition layout-top-nav">
		<audio controls autoplay id="notif_audio_success" style="display:none" >
			<source src="<?php echo base_url('assets/sounds/notify.mp3');?>" type="audio/mpeg">
		</audio>

		<audio controls autoplay id="notif_audio_failed" style="display:none" >
			<source src="<?php echo base_url('assets/sounds/alarm.mp3');?>" type="audio/mpeg">
		</audio>

		<!-- <audio id="myAudio" controls autoplay>
			<source src="<?php echo base_url('assets/sounds/notify.ogg');?>" type="audio/ogg">
			<source src="<?php echo base_url('assets/sounds/notify.mp3');?>" type="audio/mpeg">
			Your browser does not support the audio element.
		</audio>

		<p>Click the button to find out if the audio automatically started to play as soon as it was ready.</p>

		<button onclick="myFunction()">Try it</button>

		<p id="demo"></p>
		<iframe src="<?php echo base_url('assets/sounds/notify.mp3');?>" allow="autoplay; fullscreen"> -->

		<div class="wrapper">

			

			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<div class="content-header">
					<div class="container">
					</div>
				</div>
				<!-- /.content-header -->

				<!-- Main content -->
				<div class="content">
					<div class="container-fluid">
						<div class="row">
							<div class="col-12">
							<div id="new-message-notif"></div>
								<!-- Custom Tabs -->
								<div class="card">
									<div class="card-body">
										<div>
											<div class="row">
												<div class="col-lg-12">
												


												<!-- <button type="button" class="btn btn-success toastrDefaultSuccess">
												Launch Success Toast
												</button> -->
												<!-- <button id="testbutton" onclick="playAudio()" type="button">Play Audio</button> -->
													<!-- <button type="button" class="btn btn-app float-right selected-row" onClick="add()"><i class="fas fa-plus"></i>ADD</button> -->
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
												<table id="table_capture" class="display nowrap table-striped table-bordered table" style="width:100%">
													<thead>
														<tr style="background-color:#497f9e; color:white;   ">
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
														<tr style="background-color:#497f9e; color:white;   ">
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
												<!-- /.col -->
											</div>
										</div>
									</div>
									<!-- /.card-body -->
								</div>
								<!-- ADD NEW -->
								<div class="modal fade" id="modal_form_add">
									<div class="modal-dialog modal-xl">
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title">ADD FORM</h4>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<form method="post" action="<?php echo base_url('Admin/Master_controller/insert_mtdepartement'); ?>">
													
													<div class="row">
														<div class="col-lg-9">
															<div class="form-group">
																<label for="exampleInputEmail1">DEPARTEMENT NAME</label>
																<input type="hidden" class="form-control" id="add_ad" name="add_ad" value="<?php $bau_cookies = $_COOKIE["bau_cookies"]; $r_cookies = json_decode($bau_cookies, true); echo $r_cookies[0]["username"]; ?>" >
																<input type="hidden" class="form-control" id="add_created" name="add_created" value="<?php echo date('Y-m-d H:i:s');?>" >
																<input type="text" class="form-control" id="add_name" name="add_name" required>
															</div>
														</div>
													</div>
													
													
													
											</div>

											<div class="modal-footer justify-content-between">
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												<input type="submit" name="add_save" class="btn btn-primary " value="SAVE">
											</div>
											</form>
										</div>
									</div>
								</div>
								<!-- CHANGE-->
								<div class="modal fade" id="modal_form_change">
									<div class="modal-dialog modal-xl">
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title">EDIT FORM</h4>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<form method="post" action="<?php echo base_url('Admin/Master_controller/edit_mtdepartement'); ?>">
													
												<div class="row">
													<div class="col-lg-6">
														<div class="form-group">
															<label for="exampleInputEmail1">DEPARTEMENT</label>
															<!-- <input type="text" class="form-control" id="change_ad" name="change_ad" value="<?php $bau_cookies = $_COOKIE["bau_cookies"]; $r_cookies = json_decode($bau_cookies, true); echo $r_cookies[0]["username"]; ?>"> -->
															<input type="hidden" class="form-control" id="change_id" name="change_id">
															<input type="text" class="form-control" id="change_departement" name="change_departement">
														</div>
													</div>
													<div class="col-lg-6">
														<div class="form-group">
															<label for="exampleInputEmail1">STATUS</label>
																<select class="form-control" id="change_status" name="change_status" >
																	<option value="1">ACTIVE</option>
																	<option value="0">NOT ACTIVE</option>
																</select>
														</div>
													</div>
												</div>
													
											</div>

											<div class="modal-footer justify-content-between">
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												<input type="submit" name="add_save" class="btn btn-primary " value="UPDATE">
											</div>
											</form>
										</div>
									</div>
								</div>


							</div>
							<!-- /.col -->
						</div>

					</div>
					<!-- /.container-fluid -->
				</div>
				<!-- /.content -->

				<!-- DELETE-->
				<div class="modal fade" id="modal_form_delete">
					<div class="modal-dialog modal-xl">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">DELETE FORM</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form method="post" action="<?php echo base_url('Admin/Master_controller/delete_mtdepartement'); ?>">
									
								<div class="row">
									<div class="col-lg-5">
										<div class="form-group">
											<label for="exampleInputEmail1"></label>
											<input type="text" class="form-control" id="delete_header" name="delete_header"  value="APAKAH ANDA YAKIN MENGHAPUS DEPARTEMENT" style = 'border:none;' >
											
										</div>
									</div>
									<div class="col-lg-3">
											<label for="exampleInputEmail1"></label>
											<input type="text" class="form-control" id="delete_departement" name="delete_departement" style = 'border:none;'  >
											<!-- <input type="text" class="form-control" id="delete_header" name="delete_header"  value="?" style = 'border:none;' > -->
									</div>
									<div class="col-lg-3">
										<div class="form-group">
											<label for="exampleInputEmail1"></label>
											<input type="hidden" class="form-control" id="delete_id" name="delete_id" style = 'border:none;' >
										</div>
									</div>
								</div>
									
							</div>

							<div class="modal-footer justify-content-between">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								<input type="submit" name="add_save" class="btn btn-primary " value="DELETE">
							</div>
							</form>
						</div>
					</div>
				</div>

			</div>
			<!-- /.content-wrapper -->

			<?php $this->load->view('layout/footer'); ?>
		</div>
		<!-- ./wrapper -->

		<!-- REQUIRED SCRIPTS -->

		<script src="<?php echo base_url('assets/jquery/jquery-2.2.3.min.js')?>"></script>
			<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
			<script src="<?php echo base_url('/assets/dist/js/bootstrap.bundle.min.js')?>"></script>
			<script src="<?php echo base_url('/assets/dist/js/adminlte.min.js')?>"></script>
			<script src="<?php echo base_url('/assets/dist/js/dataTables.buttons.min.js')?>"></script>
			<script src="<?php echo base_url('/assets/dist/js/buttons.flash.min.js')?>"></script>
			<script src="<?php echo base_url('/assets/dist/js/jszip.min.js')?>"></script>
			<script src="<?php echo base_url('/assets/dist/js/pdfmake.min.js')?>"></script>
			<script src="<?php echo base_url('/assets/dist/js/vfs_fonts.js')?>"></script>
			<script src="<?php echo base_url('/assets/dist/js/buttons.html5.min.js')?>"></script>
			<script src="<?php echo base_url('/assets/dist/js/buttons.print.min.js')?>"></script>
			<script src="<?php echo base_url('/assets/datatables/Select/js/dataTables.select.min.js')?>"></script>
			<script src="<?php echo base_url('/assets/dist/jquery.contextMenu.min.js')?>"></script>
			<script src="<?php echo base_url('/assets/dist/jquery.ui.position.min.js')?>"></script>
			<script src="<?php echo base_url('/assets/summernote/summernote-bs4.min.js')?>"></script>
			<script src="<?php echo base_url('/assets/toastr/toastr.min.js')?>"></script>

			<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
			<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
			<script src="<?php echo base_url('server/node_modules/socket.io/node_modules/socket.io-client/socket.io.js');?>"></script>
			<script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
			<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
			<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
			<!-- <script>
			// myFunction();
			function myFunction() {
				var x = document.getElementById("myAudio").autoplay;
				document.getElementById("demo").innerHTML = x;
			}
			</script> -->

			<script type="text/javascript">
				var suara_success = document.getElementById("notif_audio_success"); 
				var suara_failed = document.getElementById("notif_audio_failed"); 
				var table_capture;
				
				// var myaudio = document.getElementById("audioID").autoplay = true;
				// console.log(datetime);

				// console.log(`${
				// 	(dt.getMonth()+1).toString().padStart(2, '0')}/${
				// 	dt.getDate().toString().padStart(2, '0')}/${
				// 	dt.getFullYear().toString().padStart(4, '0')} ${
				// 	dt.getHours().toString().padStart(2, '0')}:${
				// 	dt.getMinutes().toString().padStart(2, '0')}:${
				// 	dt.getSeconds().toString().padStart(2, '0')}`
				// );
				$(document).ready(function () {
					// suara_success.muted = true; 
					// suara_failed.muted = true; 
					// var x = document.getElementById("myAudio").autoplay;
					// var audio = new Audio('https://interactive-examples.mdn.mozilla.net/media/cc0-audio/t-rex-roar.mp3');
  					// audio.play();
				// document.getElementById("demo").innerHTML = x;
					//datatable_captures
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
				
						// $('input:radio[name=rb_display_all]').change(function() {
						//     if (this.value == 'active') {
						//         table_capture.draw();
						//     }
						//     else if (this.value == 'close') {
						//         table_capture.draw();
						//     }else {
						//         table_capture.draw();
						//     }
						// });
				
					// function filterGlobal(v) {
					// 	$('#table_capture').DataTable().search(
					// 			v,
					// 			false,
					// 			false
					// 			).draw();
					// }

					// filter keyword
					// $('#keyword_agreement').on('keyup click', function () {
					//      var v = jQuery(this).val();    
					//      filterGlobal(v);
					// });

					// $('#btn-filter').click(function(){ 
					// 	table_capture.ajax.reload(); 
					// });
					$('#btn-reset').click(function(){ 
					window.location.href = "<?php  echo site_url('Admin/Master_controller/mtdepartement_index' ); ?>"
					});
					

				});

				// var socket = io.connect( 'http://'+window.location.hostname+':3001' ); 188.88.3.39
				var socket = io.connect( 'http://188.88.3.39:3001' ); 
				// socket.on( 'emit_from_server', function( data ) {
				// 	console.log("ini adalah jawaban TCP server", data);
				
					// $( "#new_count_message" ).html( data.new_count_message );
					// $('#notif_audio')[0].play();

				// });

				socket.on( 'emit_from_server', function( data ) {
					
					// console.log(suara)
					// playAudio(); 
					// suara.muted = false; 
					
					var dt = new Date();
					var datetime = dt.getFullYear().toString().padStart(4, '0') +'-'+ 
					(dt.getMonth()+1).toString().padStart(2, '0') +'-'+
					dt.getDate().toString().padStart(2, '0') +' '+
					dt.getHours().toString().padStart(2, '0') +':'+
					dt.getMinutes().toString().padStart(2, '0') +':'+
					dt.getSeconds().toString().padStart(2, '0')
					;

					if (data.VLICENSEPLAT == 'unknown') {
						// suara_failed.muted = false; 
						suara_failed.play();
						// console.log("IF",data.VLICENSEPLAT );
						toastr.warning('Plat Nomor Tidak Tercapture .')
						// $( "#new-message-notif" ).html('<div class="alert alert-danger" role="alert"> <i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Plat Nomor Tidak Tercapture </div>');
						$( "#message-tbody" ).prepend('<tr><td>99</td><td>'+data.VIPCAM+'</td><td>'+data.VLICENSEPLAT+'</td><td>'+datetime+'</td></tr>');
						table_capture.ajax.reload();
					} else {
						// suara_success.muted = false; 
						suara_success.play();
						// console.log("ELSE",data.VLICENSEPLAT);
						toastr.success('Plat Nomor Sudah Tercapture dan Tersimpan ke Database.')
						// $( "#new-message-notif" ).html('<div class="alert alert-success" role="alert"> <i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Plat Nomor Sudah Tercapture dan Tersimpan ke Database</div>');
						$( "#message-tbody" ).prepend('<tr><td>99</td><td>'+data.VIPCAM+'</td><td>'+data.VLICENSEPLAT+'</td><td>'+datetime+'</td></tr>');
						table_capture.ajax.reload();
					}
					// $( "#message-tbody" ).prepend('<tr><td>99</td><td>'+data.VIPCAM+'</td><td>'+data.VLICENSEPLAT+'</td><td>'+datetime+'</td></tr>');
					// table_capture.ajax.reload();
					// // $( "#no-message-notif" ).html('');
					// $( "#new-message-notif" ).html('<div class="alert alert-success" role="alert"> <i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Plat Nomor Sudah Tercapture dan Tersimpan ke Database</div>');
				});

				function playAudio() { 
					// $("#notif_audio").prop('muted', true);
					console.log("suara")
					// suara.muted = true; 
					// suara.play(); 
					suara.muted = false; 
					suara.play(); 

					// $("#notif_audio").prop('muted', true);
    				// $("#notif_audio")[0].play();
				} 
				// <td><a style="cursor:pointer" data-toggle="modal" data-target=".bs-example-modal-sm" class="detail-message" id="'+data.id+'"><span class="glyphicon glyphicon-search"></span></a></td>


				// function add(){
				// 	var data = table_capture.row( { selected: true } ).data();
				// 	$('#modal_form_add').modal('show'); 
				// }

				// $.contextMenu({
				// 	selector: 'tr', 
				// 	trigger: 'right',
				// 	callback: function(key, options) {
				// 		var row = table_capture.row(options.$trigger)
						
				// 		switch (key) {
				// 		case 'edit' :
				// 			rowData = table_capture.row(this).data();
				// 			$.ajax({
				// 				type : "POST",
				// 				url  : "<?php echo site_url('Admin/Master_controller/get_mtdepartement_by_id')?>/" + rowData[1],
				// 				dataType : "JSON",
				// 				success: function(list){
				// 					// console.log(list)
				// 					$('[name="change_id"]').val(list.ID);
				// 					$('[name="change_departement"]').val(list.VNAME);
				// 					$("select[name='change_status']").val(list.VSTATUS.trim());
				// 					// $("select[name='change_time_periode']").val(list.VTIME_PERIODE_STATUS.trim());   
				// 					$('#modal_form_change').modal('show');
				// 				}
				// 			});
				// 			break;
				// 		case 'delete' :
				// 			rowData = table_capture.row(this).data();
				// 			$.ajax({
				// 				type : "POST",
				// 				url  : "<?php echo site_url('Admin/Master_controller/get_mtdepartement_by_id')?>/" + rowData[1],
				// 				dataType : "JSON",
				// 				success: function(list){
				// 					// console.log("a",list)
				// 					$('[name="delete_id"]').val(list.ID);
				// 					$('[name="delete_departement"]').val(list.VNAME);
				// 					$('#modal_form_delete').modal('show');
				// 				}
				// 			});
				// 			break;
				// 		default :
				// 			break
				// 		} 
				// 	},
				// 	items: {
				// 		"edit": {name: "Edit", icon: "edit"},
				// 		"delete": {name: "Delete ", icon: "delete"},
				// 	}
				// }) 
			</script>

	</body>

	</html>
