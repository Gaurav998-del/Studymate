<?php foreach ($categories as $index=>$value) {?>
	<div class="col-sm-6 col-md-4 col-lg-3">
		<div class="tag-item category">
			<a href="<?php echo base_url()."categories/".$value['permalink'];?>" class="q-tag category" data-toggle="popover" data-trigger="hover" data-content="<?php echo $value['description'];?>" data-placement="bottom"  data-html="true"><?php echo $value['catname'];?> </a> x <?php echo $value['totalPosts'];?> 
			<p><?php echo $value['description'];?></p>
			<div class="overlay-category-text"></div>
		</div>
	</div>
<?php } ?>