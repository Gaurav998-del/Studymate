<?php 
$this->load->view('includes/head');
$this->load->view('includes/header');
?>	
	<div class="main-body">
		<div class="container custom py-5">
		<nav class="navbar navbar-expand-sm navbar-dark background-main-color profile">
			<!-- Brand/logo -->
			<a class="navbar-brand" href="">
				Profile
			</a>
		  
			<!-- Links -->
			<ul class="navbar-nav nav nav-tabs  ml-auto profile" role="tablist">
				<li class="nav-item">
					<a <?php echo base_url()."profile/".$userid."/activity"?> class="nav-link active">User Profile</a>
				</li>
				<li id="activityTab" class="nav-item">
					<a href="<?php echo base_url()."profile/".$userid."/activity"?>" class="nav-link">Activity</a>
				</li>
				<?php if (getuserid()) {
					$g=getuserid();
					if(strval($g)==$userid){
					
					?>
				<li class="nav-item">
					<a href="<?php echo base_url()."profile/".$userid."/edit"?>" class="nav-link">Edit settings</a>
				</li>
				<?php } }?>
			</ul>
		</nav>
		<div class="content-wrapper">
			<div class="container-fluid px-md-0">
				<div class="row my-3 ">
					<div class="col-xl-3 col-md-6  my-2 my-xl-0">    
						<div class="d-inline-block profileupper-option">
							<h6 class="text-uper-profile">
								<span class="icon-upper"><i class="icon ion-md-help"></i></span>
								<div class="content">
									<div class="card-title is-tile text-right">
										Questions
										<div class="card-stat primary text-right"><?php echo $questionPosted;?></div>
									</div>
								</div>
								<div class="more">
									
								</div>
							</h6>
						</div>
					</div>
					<div class="col-xl-3 col-md-6  my-2 my-xl-0">    
						<div class="d-inline-block profileupper-option">
							<h6 class="text-uper-profile">
								<span class="icon-upper"><i class="icon ion-md-chatbubbles"></i></span>
								<div class="content">
									<div class="card-title is-tile text-right"> 
										Answers
										<div class="card-stat primary text-right"><?php echo $answersPosted;?> </div>
									</div>
								</div>
								<div class="more">
									
								</div>
							</h6>
						</div>
					</div>
					<div class="col-xl-3 col-md-6  my-2 my-xl-0">    
						<div class="d-inline-block profileupper-option">
							<h6 class="text-uper-profile">
								<span class="icon-upper"><i class="icon ion-md-eye"></i></span>
								<div class="content">
									<div class="card-title is-tile text-right">
										Profile Views
										<div class="card-stat primary text-right"><?php echo $user['views'];?></div>
									</div>
								</div>
								<div class="more">
									
								</div>
							</h6>
						</div>
					</div>
					<div class="col-xl-3 col-md-6  my-2 my-xl-0">    
						<div class="d-inline-block profileupper-option">
							<h6 class="text-uper-profile">
								<span class="icon-upper"><i class="icon ion-md-people"></i></span>
								<div class="content">
									<div class="card-title is-tile text-right">
										People reached
										<div class="card-stat primary text-right"><?php echo $user['peopleReached'];?></div>
									</div>
								</div>
								<div class="more">
									
								</div>
							</h6>
						</div>
					</div>
				</div>
					  <!-- Tab panes -->
				<div class="tab-content">
					<div class="container custom tab-pane active px-0">
						<div class="row">
							<div class="col-md-3">
								<div class="profile-inner-main">
									<img class="img-fluid user-picprofile" src="<?php echo base_url()."images/".$user['image']?>" alt=""> 
									<h3 class="name-user-profile"><?php echo $user['name'];?></h3>
									<h3 class="name-user-profile"> Contact:- <?php echo $user['contact'];?></h3>
									<h3 class="name-user-profile">DOB:- <?php echo $user['birthdate'];?></h3>

									<ul class="inner-profile-option">
										<?php if (strlen($user['location'])>0) {?>
											<li><?php echo $user['location'];?><span><i class="icon ion-md-pin"></i></span></li>
										<?php }
										if (strlen($user['website'])>0) {?>
											<li> <a href="<?php $websiteName=basename($user['website']);echo $user['website'];?>"><?php echo $websiteName;?></a><span><i class="fa fa-paper-plane-o" aria-hidden="true"></i></span></li>
										<?php }
										if (strlen($user['github'])>0) {?>
											<li> 
											<a><?php echo $user['github'];?></a>
											<span><i class="fa fa-github" aria-hidden="true"></i></span></li>
										<?php } 
										if (strlen($user['twitter'])>0) {?>
											<li> 
											<a><?php echo $user['twitter'];?></a>
											<span><i class="fa fa-twitter" aria-hidden="true"></i></span></li>
										<?php } ?>
										<li> Registered <?php echo $user['memberSince'];?> <span><span class="ti-time"></span></span></li>
									</ul>
								</div>
							</div>
							<div class="col-md-9">
								<div class="main-inner-profiletext">
									<div class="row">
										<div class="col-sm-8 col-md-8 col-lg-9">
											<h3 class="heading-tags">
												Top categories <span>(<?php echo count($getUserCategoryStats);?>)</span>
											</h3>
										</div>
										<div class="col-sm-4 col-md-4 col-lg-3 text-right">
											<h3 class="heading-tags">
												Reputation <span><?php echo $user['votes'];?></span>
											</h3>
										</div>
									</div>
									
<?php $totalS=count($getUserCategoryStats);foreach ($getUserCategoryStats as $index=>$value) {?>

	<?php if ($index==0) {?>
	<ul class="tags-profile">
	<li class="main-top">
		<div class="row">
			<div class="col-sm-6">
				<span class="tag">
					<a href="<?php echo base_url()."categories/".$value['catperma'];?>"><?php echo $value['categoryName']?></a>
				</span>
			</div>
			<div class="col-sm-6">
				<div class="score-details text-sm-right">
					<ul class="pl-0">
						<li><span class="text">SCORE</span> <?php echo $value['totalVotes']?></li>
						<li><span class="text">POSTS</span> <?php echo $value['totalPosts']?></li>
						<li><span class="text">POSTS %</span> <?php echo round((($value['totalPosts']/$questionPosted)*100),2);?></li>
					</ul>
				</div>
			</div>
		</div>
	</li>
	<?php } ?>
	<?php if ($index>0&& $index<=2) {?>
	<?php if ($index==1) {?>
	<li class="main-top parts">
		<div class="row">
		<?php } ?>
			<div class="<?php echo $index;?> col-sm-6 px-1">
				<div class="inner-tags bg-color">
					<div class="row">
						<div class="col-sm-3">
							<span class="tag"><a href="<?php echo base_url()."categories/".$value['catperma'];?>"><?php echo $value['categoryName']?></a></span>
						</div>
						<div class="col-sm-9 px-sm-1">
							<div class="score-details text-sm-right">
								<ul class="pl-0">
									<li><span class="text">SCORE</span> <?php echo $value['totalVotes']?></li>
									<li><span class="text">POSTS</span> <?php echo $value['totalPosts']?></li>
									<li><span class="text">POSTS %</span> <?php echo round((($value['totalPosts']/$questionPosted)*100),2);?></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
<?php if ($index==2) {?>
		</div>
	</li>
<?php  } } ?>
	<?php if ($index>3) {?>
	<?php if ($index==3) {?>
	<li class="main-top parts">
		<div class="row">
		<?php } ?>
			<div class="col-sm-4  px-1">
				<div class="inner-tags bg-color">
					<div class="row">
						<div class="col-sm-3">
							<span class="tag"><a href="<?php echo base_url()."categories/".$value['catperma'];?>"><?php echo $value['categoryName']?></a></span>
						</div>
						<div class="col-sm-9 px-sm-1">
							<div class="score-details text-sm-right">
								<ul class="pl-0">
									<li><span class="text">SCORE</span> <?php echo $value['totalVotes']?></li>
									<li><span class="text">POSTS</span> <?php echo $value['totalPosts']?></li>
									<li><span class="text">POSTS %</span> <?php echo round((($value['totalPosts']/$questionPosted)*100),2);?></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php if ($index==3) {?>
		</div>
	</li>
	<?php } }?>
	<?php if ($index+1==$totalS) {?>
</ul>
	<?php } } ?>
									
									<!-- Tab panes -->
									<div class="tab-content">
										<div class="tab-pane container active px-sm-0" id="question">
											<h3 class="heading-tags bordr-b">
												Badges <span>(<?php echo $user['badgesSilver']+$user['badgesGold']+$user['badgesBronze'];?>)</span>
											</h3>
											<div class="row">
												<div class="col-sm-4 col-md-4 px-0">
													<div class="badges-number text-center">
														<span class="name">Gold</span>
														<span class="number"><?php echo $user['badgesGold'];?></span>
													</div>
													<?php if (count($goldBadges)>0) {?>
													<div class="rarest">
														<ul class="badges-list list-unstyled">
															<?php foreach ($goldBadges as $index=>$value) {?>
															<li>
																<a title="bronze badge" class="badge"><span class="badge3"></span>&nbsp;<?php echo $value['name'];?></a>
																<span class="badge-date"><?php echo date('M d,Y',strtotime($value['on']));?></span>
															</li>
															<?php } ?>
														</ul>
													</div>
													<?php } ?>
												</div>
												<div class="col-sm-4 col-md-4 px-0 bdr-badges">
													<div class="badges-number text-center">
														<span class="name">SILVER</span>
														<span class="number"><?php echo $user['badgesSilver'];?></span>
													</div>
													<?php if (count($silverBadges)>0) {?>
													<div class="rarest">
														<ul class="badges-list list-unstyled">
															<?php foreach ($silverBadges as $index=>$value) {?>
															<li>
																<a title="bronze badge" class="badge"><span class="badge3"></span>&nbsp;<?php echo $value['name'];?></a>
																<span class="badge-date"><?php echo date('M d,Y',strtotime($value['on']));?></span>
															</li>
															<?php } ?>
														</ul>
													</div>
													<?php } ?>
												</div>
												<div class="col-sm-4 col-md-4 px-0">
													<div class="badges-number text-center">
														<span class="name">BRONZE</span>
														<span class="number"><?php echo $user['badgesBronze'];?></span>
													</div>
													<?php if (count($bronzeBadges)>0) {?>
													<div class="rarest">
														<ul class="badges-list list-unstyled">
															<?php foreach ($bronzeBadges as $index=>$value) {?>
															<li>
																<a title="bronze badge" class="badge"><span class="badge3"></span>&nbsp;<?php echo $value['name'];?></a>
																<span class="badge-date"><?php echo date('M d,Y',strtotime($value['on']));?></span>
															</li>
															<?php } ?>
														</ul>
													</div>
													<?php } ?>
												</div>
											</div>
										</div> 
										<div class="tab-pane container fade px-sm-0" id="answer">
											<div id="answersTab"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php $this->load->view('includes/footer');?>	