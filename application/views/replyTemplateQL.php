<?php foreach ($questionReplies as $index=>$replyQ) {?>
<ul class="reply-main-brd" id="question-reply-main-head-<?php echo $replyQ['qrid'];?>">
	<ul class="question-vote reply">
		<li class="vote-count voteQReplyCount-<?php echo $replyQ['qrid'];?>"><?php echo $replyQ['votes']<=0?"":$replyQ['votes'];?></li>
		<li qrid="<?php echo $replyQ['qrid'];?>" class="question-vote-up voteQReply <?php echo in_array($replyQ['qrid'],$votedQuestionsReplies)?"active":"";?>">
			<a href="#" class="question_vote_up vote_not_user" title="Like"><i class="fa fa-caret-up" aria-hidden="true"></i></a>
		</li>
		<li qrid="<?php echo $replyQ['qrid'];?>" class="<?php echo in_array($replyQ['qrid'],$reportedQuestionsReplies)?"active":"";?> reportqr question-vote-down">
			<a class="flag-report" ><i class="icon ion-md-flag"></i></a>
		</li>
	</ul>
	<li>
		<div class="send-details">
			<span></span>
			<span class="sender"><a href="<?php echo base_url()."profile/".$replyQ['userid'];?>"><?php echo $replyQ['name'];?></a> </span>
			<span class="send-time">
				<a href="" class="comment-date">  <?php echo date('M d,Y',strtotime($replyQ['on']));?> </a>
			</span>
		</div>
		<div class="comment-text">
			<div class="act-reply-<?php echo $replyQ['qrid'];?>">
			<?php echo decodeContent($replyQ['reply']);?>
			</div>
			<?php if (checksession()) {
			if ($replyQ['userid']==getuserid()) {?>
			<div class="replyQRecord-<?php echo $replyQ['qrid'];?> d-none">
				<textarea id="replyq-<?php echo $replyQ['qrid'];?>" class="editorP w-100" rows="5"><?php echo decodeContent($replyQ['reply']);?></textarea>
			
			<a qrid="<?php echo $replyQ['qrid'];?>" class="saveReplyQ btn btn-primary">Save</a>
			<a qrid="<?php echo $replyQ['qrid'];?>" class=" cancelReplyQ btn btn-primary">Cancel</a>
			</div>
			<div class="edit-del-main">
				<span qrid="<?php echo $replyQ['qrid'];?>" class="edit-replyq edit-reply"><span class="ti-marker-alt"></span></span>
				<span qrid="<?php echo $replyQ['qrid'];?>" class="delete-replyQ"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
			</div>
			<?php } 
			}?>
		</div>
	</li> 
	</ul>
	<?php } ?>