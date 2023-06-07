</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url()."admin"?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b><?php echo $siteSettings['siteName'];?></b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
			<li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
				<span class="hidden-xs">Admin</span>
            </a>
            <ul class="dropdown-menu">
              <!-- Menu Body -->
				<li class="user-footer">
					<div class="pull-right">
					  <a href="<?php echo base_url()."admin/logout";?>" class="btn btn-default btn-flat">Logout</a>
					</div>
				</li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>