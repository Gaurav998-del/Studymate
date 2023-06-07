<ul class="navbar-nav options-nav mx-auto custom">
						<li class="nav-item pull-right ask-question-nav   d-sm-none ">
							<?php if(!checksession()){?>
								<a data-toggle="modal" data-target="#signupModal" class="nav-link custom">  Ask a Question </a>
							<?php } else {?>
								<a href="<?php echo base_url()."questions/ask";?>" class="nav-link custom">  Ask a Question </a>
							<?php } ?>
						</li>
						
						<?php $pageMeta=$this->uri->segment(1)."/".$this->uri->segment(2);?>
						<li class="nav-item">
							<a class="nav-link custom <?php echo $pageMeta=="/"?"active":"";?>" href="<?php echo base_url()?>"><!-- <span><i class="fa fa-line-chart" aria-hidden="true"></i></span> --> Studymate</a>
						</li>
						<li class="nav-item ">
							<a class="nav-link custom <?php echo $pageMeta=="questions/"?"active":"";?>" href="<?php echo base_url()."questions"?>"><!-- <span><i class="icon ion-md-list"></i></span> --> Questions</a>
						</li>
						<li class="nav-item">
							<a class="nav-link custom <?php echo $pageMeta=="questions/hot"?"active":"";?>" href="<?php echo base_url()."questions/hot"?>"><!-- <span><i class="icon ion-md-cafe"></i></span> --> Trending</a>
						</li>
						<li class="nav-item">
							<a class="nav-link custom <?php echo $pageMeta=="questions/unanswered"?"active":"";?>" href="<?php echo base_url()."questions/unanswered"?>"><!-- <span><i class="icon ion-md-book"></i></span> --> Unanswered</a>
						</li>
						<li class="nav-item">
							<a class="nav-link custom <?php echo $pageMeta=="categories/"?"active":"";?>" href="<?php echo base_url()."categories";?>"><!-- <span><i class="icon ion-md-pricetags"></i></span> --> Categories</a>
						</li>
						<!-- <li class="nav-item">
							<a class="nav-link custom <?php echo $pageMeta=="users/"?"active":"";?>" href="<?php echo base_url()."users";?>"><span><i class="icon ion-md-contacts"></i></span> Users</a>
						</li> -->
						<!-- <li class="nav-item">
							<a class="nav-link custom <?php echo $pageMeta=="badges/"?"active":"";?>" href="<?php echo base_url()."badges"?>"><span><i class="icon ion-md-infinite"></i></span> Badges</a>
						</li> -->
						
					</ul> 