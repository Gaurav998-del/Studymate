<ul class="reply-main-brd" id="question-reply-main-head-<?php echo $qrid;?>">
	<ul class="question-vote reply">
		<li class="vote-count voteQReplyCount-<?php echo $qrid;?>"></li>
		<li qrid="<?php echo $qrid;?>" class="question-vote-up voteQReply">
			<a href="#" class="question_vote_up vote_not_user" title="Like"><i class="fa fa-caret-up" aria-hidden="true"></i></a>
		</li>
		<li qrid="<?php echo $qrid;?>" class="reportqr question-vote-down">
			<a class="flag-report" ><i class="icon ion-md-flag"></i></a>
		</li>
	</ul>
	<li>
		<div class="send-details">
			<span></span>
			<span class="sender"><a href="<?php echo base_url()."profile/".$this->session->userid;?>"><?php echo $this->session->name;?></a> </span>
			<span class="send-time">
				<a href="" class="comment-date"><?php echo date('M d,Y',strtotime($replyTime));?> </a>
			</span>
		</div>
		<div class="comment-text">
			<div class="act-reply-<?php echo $qrid;?>">
				<?php echo decodeContent($replyTextQ);?>
			</div>
			<div class="replyQRecord-<?php echo $qrid;?> d-none">
				<textarea id="replyq-<?php echo $qrid;?>" class="editorP w-100" rows="5"><?php echo decodeContent($replyTextQ);?></textarea>
			
			<a qrid="<?php echo $qrid;?>" class="saveReplyQ btn btn-primary">Save</a>
			<a qrid="<?php echo $qrid;?>" class=" cancelReplyQ btn btn-primary">Cancel</a>
			</div>
			<div class="edit-del-main">
				<span qrid="<?php echo $qrid;?>" class="edit-replyq edit-reply"><span class="ti-marker-alt"></span></span>
				<span qrid="<?php echo $qrid;?>" class="delete-replyQ"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
			</div>
		</div>
	</li> 
</ul>
