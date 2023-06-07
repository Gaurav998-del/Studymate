<ul class="reply-main-brd" id="answer-reply-main-head-<?php echo $arid;?>">
	<ul class="question-vote reply  ">
		<li class="vote-count voteAReplyCount-<?php echo $arid;?>"></li>
		<li arid="<?php echo $arid;?>" class="question-vote-up voteAReply">
			<a href="#" class="question_vote_up vote_not_user" title="Like"><i class="fa fa-caret-up" aria-hidden="true"></i></a>
		</li>
		<li arid="<?php echo $arid;?>" type="1" class="reportar question-vote-down">
			<a class="flag-report" ><i class="icon ion-md-flag"></i></a>
		</li>
	</ul>
	<li>
		<div class="send-details">
			<span></span>
			<span class="sender"><a href="<?php echo base_url()."profile/".$this->session->userid;?>"><?php echo $this->session->name;?></a> </span>
			<span class="send-time">
				<a href="" class="comment-date">  <?php echo date('M d,Y',strtotime($replyTime));?> </a>
			</span>
		</div>
		<div class="comment-text">
			<div class="act-reply-<?php echo $arid;?>">
			<?php echo decodeContent($replyTextQ);?>
			</div>
			<div class="replyARecord-<?php echo $arid;?> d-none">
				<textarea id="replya-<?php echo $arid;?>" class="editorP w-100" rows="5"><?php echo decodeContent($replyTextQ);?></textarea>
				<a arid="<?php echo $arid;?>" class="saveReplyA btn btn-primary">Save</a>
				<a class="cancelReplyA btn btn-primary">Cancel</a>
			</div>
			<div class="edit-del-main">
				<span arid="<?php echo $arid;?>" class="edit-replya edit-reply"><span class="ti-marker-alt"></span></span>
				<span arid="<?php echo $arid;?>" class="delete-replyA"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
			</div>
		</div>
	</li>
</li>