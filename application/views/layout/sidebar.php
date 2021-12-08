 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
      <img src="<?php echo base_url('/assets/dist/images/logo.png'); ?>"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">MONITORING</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               <br /> with font-awesome or any other icon font library -->
			<li class="nav-item">
				<a href="<?php echo base_url('Admin/Capture_controller/dashboard_page'); ?>" class="nav-link">
					<i class="nav-icon fas fa-tachometer-alt"></i>
				<p>
					DASHBOARD
				</p>
				</a>
			</li>

			<li class="nav-item">
				<a href="<?php echo base_url('Admin/Capture_controller/report_page'); ?>" class="nav-link">
					<i class="nav-icon fas fa-chart-bar"></i>
				<p>
					REPORT
				</p>
				</a>
			</li>

			<li class="nav-item">
				<a href="<?php echo base_url('Admin/Capture_controller/configuration_page'); ?>" class="nav-link">
					<i class="nav-icon fas fa-cog"></i>
				<p>
					CONFIGURATION
				</p>
				</a>
			</li>
      
      <li class="nav-header">OTHER</li>
		  
      <li class="nav-item">
        <a href="<?php echo base_url('Admin/Capture_controller/'); ?>" class="nav-link">
          <i class="nav-icon fas fa-sign-out-alt"></i>
          <p>DETAIL</p>
        </a>
      </li>

      <li class="nav-item">
        <a href="<?php echo base_url('Login/logout'); ?>" class="nav-link">
          <i class="nav-icon fas fa-sign-out-alt"></i>
          <p>LOGOUT</p>
        </a>
      </li>
          <!-- <li class="nav-header">MULTI LEVEL EXAMPLE</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-circle nav-icon"></i>
              <p>Level 1</p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-circle"></i>
              <p>
                Level 1
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Level 2</p>
                </a>
              </li>
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Level 2
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Level 3</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Level 3</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Level 3</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Level 2</p>
                </a>
              </li>
            </ul>
          </li> -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>