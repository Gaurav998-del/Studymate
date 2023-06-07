<?php if (count($answers)>0) {?>
<div>
<ul id="answersListActivity" class="top-question-profile">
	<?php foreach ($answers as $index=>$value) {?>
		<li>
			<div class="row">
				<div class="col-md-8 col-lg-9 col-xl-10">
					<span class="icons"><i class="icon ion-md-help"></i></span> <span class="vote"><?php echo $value['votes'];?></span>
					<a href="<?php echo base_url()."questions/".$value['qid']."/".$value['permalink'];?>" class="question-text"><?php echo $value['qtitle'];?></a>
				</div>
				<div class="col-md-4 col-lg-3 col-xl-2 text-right">
				<?php if (checksession()) {
					if ($value['userid']==getuserid()) {?>
						<div class="btn-option-profile-active">
							<a class="btn btn-db-edit" href="<?php echo base_url()."questions/edit/".$value['qid']."/".$value['permalink'];?>">Edit</a>
							<a class="btn btn-db-edit deleteAp" qaid="<?php echo $value['qaid'];?>" qid="<?php echo $value['qid'];?>" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
						</div>
				<?php } }?>
				<span class=" votedate"><?php echo date('M d,Y',strtotime($value['on']));?></span>
				</div>
			</div> 
		</li>
	<?php } ?>
</ul>
</div>
<div class="loadmore-a-sec text-right viewall-qa">
	<?php if ($totalAnswersCount>$now) {?>
		<span value="<?php echo $next;?>" class="loadmore-a-btn">Load More</span>
	<?php } ?>
</div>
<?php } else {?>
	<div class="record-not-found">
		<i class="fa fa-frown-o" aria-hidden="true" style=""></i>
		<h2 class="heading-error" style="">No answers Found</h2>
	</div>
<?php } ?>