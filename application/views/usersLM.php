<?php foreach ($users as $index=>$value) {?>
	<li class="user-item col-md-4 col-xs-6">
		<span class="user-auther user">
			<a href="<?php echo base_url()."profile/".$value['userid'];?>">
			<img src="<?php echo base_url()."images/".$value['image'];?>" class="avatar users" alt=""> 
			</a>
		</span>
		<div class="left-info">
			<a href="<?php echo base_url()."profile/".$value['userid'];?>">
				<span class="display_name"><?php echo $value['name'];?></span>
			</a>
			<?php if (strlen($value['location'])>0) {?>
			<span class="location users">
				<i class="fa fa-map-marker"></i><?php echo $value['location'];?>
			</span>
			<?php } ?>
			
			<div class="question-cat">
				<span class="points">
					<?php echo $value['votes'];?> Points ,<?php echo $value['voted'];?> voted
				</span>
			</div>
		</div>
		<div class="left-info ml-0 d-block  secund">
			
			
			<?php $cats=$this->UserModel->getUserCategoryNames($value['userid']);
			$total=count($cats);
			if ($total>0) {?>
				<div class="question-cat tagcloud">
					<span class="points">
						<?php foreach ($cats as $indexCat=>$cat) {?>
							<a href="<?php echo base_url()."categories/".$cat['permalink'];?>"><?php echo $cat['name']?></a>
						<?php 
						echo ($indexCat+1)!=$total?",":"";
						} ?>
					</span>
				</div>
			<?php } ?>
		</div>
	</li>
<?php } ?>