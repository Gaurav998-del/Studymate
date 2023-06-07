<?php 
$this->load->view('includes/head');
$this->load->view('includes/header');
?>
	
<div class="main-body">
	<div class="container custom py-5">
		<div class="mian-badges">
			<div class="row points-system d-none">
				<div class="col-md-12">
					<h3>Points System</h3>
					<p>You earn reputation when people vote on your posts</p>
				</div>
				<div class="clearfix"></div>
				<ul class="points-define row w-100">
					<li class="col-md-3">
						<div>
							<span class="points-count">+2 </span>
							<span class="star">
								<i class="fa fa-star"></i><br>
								create a question </span>
						</div>
					</li>
					<li class="col-md-3">
						<div>
							<span class="points-count">+5  </span>
							<span class="star">
								<i class="fa fa-star"></i><br>
								question is voted up </span>
						</div>
					</li>
					<li class="col-md-3">
						<div>
							<span class="points-count">+5  </span>
							<span class="star">
								<i class="fa fa-star"></i><br>answer is voted up</span>
						</div>
					</li>
					<li class="col-md-3">
						<div>
							<span class="points-count">+15 </span>
							<span class="star">
								<i class="fa fa-star"></i><br>
								answer is accepted 
							</span>
						</div>
					</li>
				</ul>
			</div>
			<div class="row badges-system">
				<div class="col-md-12">
					<h3>Badges System</h3>
					<p>You earn reputation when people vote on your posts</p>
				</div>
				<?php $UserBtypes=['badgesGold','gold','silver','bronze'];?>
				<?php foreach ($badges as $index=>$value) {?>
				<div class="col-md-6 col-lg-4 badge-content px-2">
					<div class="border row mx-0">
						<div class="col-md-12 question-cat">
							<span class="user-badge professor" style="">
								<?php echo $value['name'];?></span>
								<?php if ($value['value']>0) {?>
									<div class="main-point pull-right">
										<span class="points-count d-block text-right"><?php echo $value['value']?> <i class="fa fa-star"></i></span>
										<span class="star d-block text-right">points</span>
									</div>
								<?php } ?>
								<br>
								<span>Badge Type :<?php echo $UserBtypes[$value['priority']];?></span>
						</div>
						<div class="col-md-12">
							<p><i class="fa fa-check"></i>
							<?php echo str_replace("<value>",$value['value'],$value['description']);?>
							</p>
							<p>
								<i class="fa fa-check"></i>
								<?php echo $value['totalAwarded'];?> Awarded
							</p>
						</div>
					</div>
				</div>
				<?php } ?> 
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('includes/footer');?>	