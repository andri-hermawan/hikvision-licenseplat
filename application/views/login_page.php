<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>R System | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="icon" href="<?php echo base_url('/assets/dist/images/logo.png'); ?>">
		<link href="<?php echo base_url('/assets/dist/css/all.min.css')?>" rel="stylesheet">
		<link href="<?php echo base_url('/assets/dist/css/adminlte.css')?>" rel="stylesheet">
		<!-- <link href="<?php echo base_url('/assets/dist/css/bootstrap.css')?>" rel="stylesheet"> -->
		<link href="<?php echo base_url('/assets/dist/css/dataTables.bootstrap4.min.css')?>" rel="stylesheet">
		<link href="<?php echo base_url('/assets/dist/css/custom.css')?>" rel="stylesheet">
		<link href="<?php echo base_url('/assets/dist/css/jquery.dataTables.min.css')?>" rel="stylesheet">
		<link href="<?php echo base_url('/assets/dist/css/buttons.dataTables.min.css')?>" rel="stylesheet">
		<link href="<?php echo base_url('/assets/datatables/Select/css/select.dataTables.min.css')?>" rel="stylesheet">
		<link href="<?php echo base_url('/assets/dist/jquery.contextMenu.min.css')?>" rel="stylesheet">
		<!-- Google Font: Source Sans Pro -->
		<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
		crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo base_url('/assets/index2.html'); ?>"><b>LEGAL ADMINISTRATION SYSTEM</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form method="post" action="<?php echo base_url('Login/check_login'); ?>" >
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username" name="username">
          <div class="input-group-append">
            <div class="input-group-text">
              <!-- <span class="fas fa-envelope"></span> -->
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <!-- <span class="fas fa-lock"></span> -->
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <!-- <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label> -->
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center mb-3">
        <!-- <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a> -->
      </div>
      <!-- /.social-auth-links -->

      <!-- <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p> -->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

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

			<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
			<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

</body>
</html>
