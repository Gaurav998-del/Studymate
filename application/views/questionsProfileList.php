<?php foreach ($questions as $index=>$value) {?>
	<li>
		<div class="row">
			<div class="col-md-8 col-lg-9 col-xl-10">
				<span class="icons"><i class="icon ion-md-help"></i></span> <span class="vote"><?php echo $value['votes'];?></span>
				<a href="<?php echo base_url()."questions/".$value['qid']."/".$value['permalink'];?>" class="question-text"><?php echo $value['title'];?></a>
			</div>
			<div class="col-md-4 col-lg-3 col-xl-2 text-right">
				<?php if (checksession()) {if ($value['userid']==getuserid()) {?>
				<div class="btn-option-profile-active">
					<a class="btn btn-db-edit" href="<?php echo base_url()."questions/edit/".$value['qid']."/".$value['permalink'];?>">Edit</a>
					<a class="btn btn-db-edit deleteQp" qid="<?php echo $value['qid'];?>" ><span class="del-profile-act"><i class="fa fa-trash-o" aria-hidden="true"></i></span></a>
				</div>
				<?php } }?>
				<span class=" votedate"><?php echo date('M d,Y',strtotime($value['on']));?></span>
			</div>
		</div> 
	</li>
<?php } ?>