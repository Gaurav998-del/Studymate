<?php foreach ($answerReplies as $index=>$replya) {?>
<ul class="reply-main-brd" id="answer-reply-main-head-<?php echo $replya['arid'];?>">
	<ul class="question-vote reply">
		<li class="vote-count voteAReplyCount-<?php echo $replya['arid'];?>"><?php echo $replya['votes']<=0?"":$replya['votes'];?></li>
		<li arid="<?php echo $replya['arid'];?>" class="question-vote-up voteAReply <?php echo in_array($replya['arid'],$votedAnswerReplies)?"active":"";?>">
			<a href="#" class="question_vote_up vote_not_user" title="Like"><i class="fa fa-caret-up" aria-hidden="true"></i></a>
		</li>
		<li arid="<?php echo $replya['arid'];?>" class="<?php echo in_array($replya['arid'],$reportedAnswerRepliesIds)?"active":"";?> reportar question-vote-down">
			<a class="flag-report" ><i class="icon ion-md-flag"></i></a>
		</li>
	</ul>
	<li>
		<div class="send-details">
			<span></span>
			<span class="sender"><a href="<?php echo base_url()."profile/".$replya['userid'];?>"><?php echo $replya['name'];?></a> </span>
			<span class="send-time">
				<a href="" class="comment-date">  <?php echo date('M d,Y',strtotime($replya['on']));?> </a>
			</span>
		</div>
		
		<div class="comment-text">
			<div class="act-reply-<?php echo $replya['arid'];?>">
			<?php echo decodeContent($replya['reply']);?>
			</div>
			<?php if (checksession()) {
				if ($replya['userid']==getuserid()) {?>
				<div class="replyARecord-<?php echo $replya['arid'];?> d-none">
					<textarea id="replya-<?php echo $replya['arid'];?>" class="editorP w-100" rows="5"><?php echo decodeContent($replya['reply']);?></textarea>
					<a arid="<?php echo $replya['arid'];?>" class=" saveReplyA btn btn-primary">Save</a>
					<a arid="<?php echo $replya['arid'];?>" class="cancelReplyA btn btn-primary">Cancel</a>
				</div>
				<div class="edit-del-main">
					<span arid="<?php echo $replya['arid'];?>" class="edit-replya edit-reply"><span class="ti-marker-alt"></span></span>
					<span arid="<?php echo $replya['arid'];?>" class="delete-replyA"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
				</div>
			<?php } 
			}?>
		</div>
	</li>
</ul> 
<?php } ?>