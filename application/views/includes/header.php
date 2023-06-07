</head>
<body>
	<section>
		<header>
			<div class="main-header-upper">
				<div class="container custom">
					<div class="navbars uppernav ">
						<ul class="navbar-navs options-nav  text-center pt-2 mb-0">
							<li class="nav-item logo-main">
								<a class="nav-link custom" href="<?php echo base_url();?>">
									<img class="img-fluid logo" alt="logo" src="<?php echo base_url()."images/".$siteSettings['logo'];?>">
								</a>
							</li>  
						
							<?php if (checksession()) { ?>
							<li class="nav-item dropdown notification  pull-right d-none d-md-flex">
								<a class="nav-link dropdown-toggle notify" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								  <span class="ti-bell"></span>
								  <span class="badge badge-light notify"><i class="fa fa-circle" aria-hidden="true"></i></span>
								</a> 
								<div class="dropdown-menu notification" aria-labelledby="navbarDropdown">
									<div class="heading-notify">Notifications</div>
									<?php if(count($notifications)>0){?>
									<ul class="notify main-list pl-0">
									<?php foreach($notifications as $index=>$value){?>
										<li>
											<div class="inner-heading-notify">
												<span class="heading-notify-type"><?php echo $value['title'];?></span>
												<?php $occuredTime=strtotime($value['on']);?>
											</div>
											<a class="dropdown-item" href="<?php 
											$permalink=$value['nPerma'];
											$permalink=str_replace('(questionId)',$value['qid'],$permalink);
											$permalink=str_replace('(questionPerma)',$value['permalink'],$permalink);
											$permalink=str_replace('(userid)',$value['for'],$permalink);
											echo base_url().$permalink;
											?>">
												<?php $description=$value['description'];
												$description=str_replace('(questionName)',$value['questionTitle'],$description);
												$description=str_replace('(badgeName)',$value['badgeName'],$description);
												$description=str_replace('(reputation)',$value['reputation'],$description);
												echo $description;
												?>
											</a>
											<span class="time-notify"><small><?php echo date('M d,Y H:i:s',$occuredTime);?> </small></span>
										</li>
									<?php } ?>
									</ul>
									<a href="<?php echo base_url()."notifications"?>" class="btn btn-all-notify">View All</a>
									<?php } else {?>
									<p>No notifications found</p>
									<?php } ?>
								</div>
							</li>
							<?php } 
							if(!checksession()){?>
							<li class="nav-item pull-right d-none d-md-flex">
								<a href="<?php echo base_url()."questions/ask";?>" class="nav-link custom"> <i class="icon ion-ios-person"></i> Sign In </a>
							</li>
							<?php }?> 

							<?php 
							if(checksession()){?>
							<li class="nav-item pull-right d-none d-md-flex">
								<a href="<?php echo base_url()."questions/loadexam";?>" class="nav-link custom">  Exam </a>
							</li>
							<?php }?> 
						<?php 
							if(checksession()){?>
							<li class="nav-item pull-right d-none d-md-flex">
								<a href="<?php echo base_url()."questions/result_list";?>" class="nav-link custom">  Result List </a>
							</li>
							<?php }?> 
						
							<li class="nav-item pull-right ask-question-nav d-none d-md-flex">
							<?php if(!checksession()){?>
								<a data-toggle="modal" data-target="#signupModal" class="nav-link custom">  Ask a Question </a>
							<?php } else {?>
								<a href="<?php echo base_url()."questions/ask";?>" class="nav-link custom">  Ask a Question </a>
							<?php } ?>
							</li>
						
							<?php if(checksession()){?>
								<li class="nav-item dropdown pull-right d-none d-md-flex">
									<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
										<img src="<?php echo base_url()."images/".$this->session->image;?>" class="user-pic-nav" alt=""/><?php echo $this->session->name;?>
									</a>
									<div class="dropdown-menu">
										<a href="<?php echo base_url()."profile/".$this->session->userid;?>" class="dropdown-item"> <i class="fa fa-user-circle-o" aria-hidden="true"></i> Profile </a>
										<a class="dropdown-item" href="<?php echo base_url()."logout"?>"><i class="fa fa-sign-in" aria-hidden="true"></i> Logout</a>
									</div>
								</li> 
							<?php } ?>
						
						</ul>
					</div>
				</div>
			</div>
			<nav class="navbar navbar-expand-md py-0">
			
				<?php if(!checksession()){?> 
					<span class="nav-item pull-right d-flex d-md-none">
						<a data-toggle="modal" data-target="#signupModal" class="nav-link custom" href="#"> <i class="icon ion-ios-person"></i> Sign In </a>
					</span>
				<?php }?> 
				
				
				
				<?php if(checksession()){?>
					<span class="nav-item dropdown pull-right d-flex d-md-none">
						<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
							<img src="<?php echo base_url()."images/".$this->session->image;?>" class="user-pic-nav" alt=""/><?php echo $this->session->name;?>
						</a>
						<div class="dropdown-menu">
							<a href="<?php echo base_url()."profile/".$this->session->userid;?>" class="dropdown-item"> <i class="icon ion-md-help"></i>Profile </a>
							<a class="dropdown-item" href="<?php echo base_url()."logout"?>">Logout</a>
						</div>
					</span> 
				<?php } ?>


				
				<span class="nav-item pull-right ask-question-nav  d-sm-flex d-md-none d-none">
					<?php if(!checksession()){?>
						<a data-toggle="modal" data-target="#signupModal" class="nav-link custom">  Ask a Question </a>
					<?php } else {?>
						<a href="<?php echo base_url()."questions/ask";?>" class="nav-link custom">  Ask a Question </a>

					<?php } ?>
				</span>
				
				<button class="navbar-toggler custom" type="button" data-toggle="collapse" data-target="#collapsibleNavbars">
					<span class="ti-menu"></span>
				</button>
				<div class="collapse navbar-collapse" id="collapsibleNavbars">
			<ul class="navbar-nav options-nav mx-auto custom">

					<?php if (checksession()) { ?>
						<li class="nav-item dropdown notification  d-md-none">
							<a class="nav-link dropdown-toggle notify" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							  <span class="ti-bell"></span>
							  <span class="badge badge-light notify"><i class="fa fa-circle" aria-hidden="true"></i></span>
							</a>
							<div class="dropdown-menu notification" aria-labelledby="navbarDropdown">
								<div class="heading-notify">Notifications</div>
								<?php if(count($notifications)>0){?>
								<ul class="notify main-list pl-0">
								<?php foreach ($notifications as $index=>$value) {
									$occuredTime=strtotime($value['on']);?>
									<li>
										<div class="inner-heading-notify">
											<span class="heading-notify-type"><?php echo $value['title'];?></span>
											<span class="time-notify"><?php echo date('H:i A',$occuredTime);?></span>
										</div>
										<a class="dropdown-item" href="<?php 
											$permalink=$value['nPerma'];
											$permalink=str_replace('(questionId)',$value['qid'],$permalink);
											$permalink=str_replace('(questionPerma)',$value['permalink'],$permalink);
											$permalink=str_replace('(userid)',$value['for'],$permalink);
											echo base_url().$permalink;?>">
											<?php 
											$description=$value['description'];
											$description=str_replace('(questionName)',$value['questionTitle'],$description);
											$description=str_replace('(badgeName)',$value['badgeName'],$description);
											$description=str_replace('(reputation)',$value['reputation'],$description);
											echo $description;
											?>
										</a>
									</li>
								<?php } ?>
								</ul>
								<a href="<?php echo base_url()."notifications"?>" class="btn btn-all-notify">View All</a>
								<?php } else {?>
								<p>No notifications found</p>
								<?php } ?>
							</div>
						</li>
						<?php } ?>
					</ul>
				</div> 

			</nav>

		</header>
	</section>
<!-- The Modal signup -->
  <div class="modal fade signin" id="signupModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal body -->
        <div class="modal-body">
			<!-- <button type="button" class="close" data-dismiss="modal"><i class="icon ion-md-close"></i></button> -->
			<ul class="nav nav-pills signin w-100 text-center" role="tablist">
				<li class="nav-item w-50">
				  <a class="nav-link active" data-toggle="pill" href="#home">Log In <span><i class="fa fa-sign-in" aria-hidden="true"></i></span></a>
				</li>
				<li class="nav-item w-50">
				  <a class="nav-link" data-toggle="pill" href="#menu1">Sign Up <span><i class="icon ion-md-person"></i></span></a>
				</li>
			</ul>
			<!-- Tab panes -->
			<div class="tab-content">
				<div id="home" class="container tab-pane active py-4">
					<div class=" row">
						<div class="col-md-12">
							<form class="sign">
								<div class="form-group">
									<label>Enter your Email</label>
									<input id="emailL" value="" type="email" placeholder="Email">
									<span class="icon-input"><i class="icon ion-md-mail"></i></span>
								</div>
								<div class="form-group">
									<label>Enter your Password</label>
									<input id="passwordL" value="" type="password" placeholder="Password">
									<span class="icon-input"><i class="icon ion-md-unlock"></i></span>
								</div>
							</form>
						</div>
						<!-- <div class="col-md-6">
							<h2 class="heading-social-media">Login with Social Media</h2>
							<div class="form-group">
								<button onclick="window.location.href='<?php echo base_url()."facebook"?>'" class="btn btn-socila fb"><i class="icon ion-logo-facebook"></i> Login with facebook</button>
							</div>
							<div class="form-group">
								<button onclick="window.location.href='<?php echo base_url()."google"?>'" class="btn btn-socila gmail"><i class="fa fa-google-plus" aria-hidden="true"></i> Login with Gmail</button>
							</div>
						</div> -->
						<div class="col-md-12">
							<div id="successLogin" class="alert alert-success d-none loginmessages">
							</div>
							<div id="errorLogin" class="alert alert-danger d-none loginmessages">
							</div> 
							<button id="loginB" type="button" class="btn btn-signin">Sign In</button>
						</div>
						<div class="col-sm-6">
							<a id="forgotM" class="forgetpass">Forgot Password</a>
						</div>
					</div>
				</div>
				<div id="menu1" class="container tab-pane fade py-4">
					<form class="sign">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Display Name</label>
									<input value="" type="text" id="nameS" placeholder="Your name">
									<span class="icon-input"><i class="icon ion-md-person"></i></span>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>Enter your Email</label>
									<input value="" type="email" id="emailS" placeholder="Email">
									<span class="icon-input"><i class="icon ion-md-mail"></i></span>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>Enter your Password</label>
									<input value="" type="password" id="passwordS" placeholder="Password">
									<span class="icon-input"><i class="icon ion-md-unlock"></i></span>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>Enter your Contact</label>
									<input value="" type="number" id="ucontact" placeholder="Contact">
									<span class="icon-input"><i class="icon ion-md-unlock"></i></span>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>Enter your Date Of Birth</label>
									<input value="" type="date" id="udob" placeholder="DOB">
									<span class="icon-input"><i class="icon ion-md-unlock"></i></span>
								</div>
							</div>
							<div class="col-md-12">
								<div id="successSignup" class="alert alert-success d-none signupmessages">
								</div>
								<div id="errorSignup" class="alert alert-danger d-none signupmessages">
								</div> 
								<button type="button" id="signupB" class="btn btn-signin">Sign Up</button> 
							</div>
						</div>
					</form>
				</div>
			</div>
        </div>
      </div>
    </div>
  </div>
  <div id="forgetModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body p-0">
				<div class="header-pass-reset">
					<h3 class="text-center m-0">Forget password</h3>
				</div>
				<div id="successForgot" class="alert alert-success d-none resetmessages"></div>
				<div id="errorForgot" class="alert alert-danger d-none resetmessages"></div> 
				<div class="main-body-pass">
					<div class="form-group">
						<label class="forget-pass">Enter your email and we will send you instructions on how to reset your password</label>
						<div class="input-group forget-pass">
							<span class="icon-forgwt-pass"><i class="icon ion-md-mail"></i></span>
							<input value="" type="email" id="emailF" placeholder="Email">
						</div>
					</div>
					<button id="resetB" type="button" class="btn btn-reset-pass">Reset</button>
				</div> 
			</div> 
		</div>
	</div>
</div>
<div id="forgetModalCon" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Forget password</h4>
			</div>
			<div class="modal-body">
				<input value="" type="password" id="passwordF" placeholder="New password">
				<input value="<?php echo isset($hash)?$hash:"";?>" type="hidden" id="hash">
			</div>
			<div class="modal-footer">
				<div id="successForgotC" class="alert alert-success d-none resetmessages"></div>
				<div id="errorForgotC" class="alert alert-danger d-none resetmessages"></div> 
				<button id="resetF" type="button" class="btn btn-default">Reset</button>
			</div>
		</div>
	</div>
</div>