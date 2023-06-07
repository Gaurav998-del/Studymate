<?php
foreach ($answers as $index=>$answer) {
$qaid=$answer['qaid'];
?>
	<article id="answer-main-head-<?php echo $answer['qaid'];?>" class="article-question article-post clearfix question-type-normal">
	<div class="single-inner-content">
		<div class="question-inner row">
			<div class="col-md-1 px-md-1 ">
				<div class="question-image-vote">
					<div class="author-image text-center">
						<a href="">
							<span class="author-image-span">
								<img class="avatar avatar-42 photo" alt="name" width="42" height="42" src="<?php echo base_url()."images/".$answer['image'];?>">
							</span>
						</a>
					</div>
				</div>
				<div class="question-content question-content-first d-inline-block d-md-none">
					<header class="article-header">
						<div class="question-header">
							<a class="post-author" href="<?php echo base_url()."profile/".$answer['userid'];?>"><?php echo $answer['name'];?></a>
							<?php 
							$key = array_search($answer['userid'], array_column($recentBadges,'userid'));
							if (is_int($key))
							{?>
								<span class="badge-span" style="background-color: #ffbf00"><?php echo $recentBadges[$key]['name'];;?></span> 
							<?php } ?>
						</div>
					</header>
				</div>
			</div>
			<div class="col-md-11">
				<div class="question-content question-content-first">
					<header class="article-header d-none d-md-block">
						<div class="question-header">
							<a class="post-author" href="<?php echo base_url()."users/".$answer['userid']."/".$answer['name'];?>"><?php echo $answer['name'];?></a>
							<?php 
							$key = array_search($answer['userid'], array_column($recentBadges,'userid'));
							if (is_int($key)) {?>
								<span class="badge-span" style="background-color: #ffbf00"><?php echo $recentBadges[$key]['name'];;?></span> 
							<?php } ?>
							<a class="comment-date"> Added an answer on <?php echo date('M d,Y',strtotime($answer['on']));?> </a>
						</div>
					</header>
				</div>
				<div class="question-content question-content-second">
					<div class="post-wrap-content">
					   <div id="answer-description-<?php echo $answer['qaid']?>" class="question-content-text comment">
							<?php echo decodeContent($answer['description']);?>
					   </div>
					</div>
					<div class="msg_error custom"></div>
					<ul class="question-mobile question-vote comment comment">
						<li qaid="<?php echo $qaid;?>" type="1" class="question-vote-up answerVote
						<?php 
						if (isset($votedAnswerCon)) {
							$key = array_search($qaid, array_column($votedAnswerCon,'qaid'));
							if (is_int($key)) {
								$votedP=$votedAnswerCon[$key]['val'];
								echo $votedP==1?"active":"";
							}
						}
						?>">
							<a class="question_vote_up vote_not_user" title="Like"><i class="fa fa-caret-up " aria-hidden="true"></i></a>
						</li>
						<li class="votes-answer-<?php echo $qaid;?>  vote_result"><?php echo $answer['votes'];?></li>
						<li qaid="<?php echo $qaid;?>" type="0" class="question-vote-down answerVote <?php echo isset($votedP) && $votedP == 0?"active":"";?>">
							<a class="question_vote_down vote_not_user" title="Dislike"><i class="fa fa-caret-down" aria-hidden="true"></i></a>
						</li>
					</ul>
					<span answerid="<?php echo $answer['qaid']?>" class="reply-answer reply-comment">
						<i class="fa fa-share" aria-hidden="true"></i> Reply
					</span>
					<?php if (checksession()) {
					if ($answer['userid']==getuserid()) {?>
					<span answerid="<?php echo $answer['qaid']?>" class="edit-reply-answer reply-comment">
						<i class="fa fa-share" aria-hidden="true"></i> Edit
					</span>
					<span answerid="<?php echo $answer['qaid']?>" class="delete-answer reply-comment">
						<i class="fa fa-share" aria-hidden="true"></i> Delete
					</span>
					<?php } else {?>
					<span answerid="<?php echo $answer['qaid']?>" class="reportAnswerMod report-comment">
						<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Report
					</span>
					<?php } } else {?>
					<span data-toggle="modal" data-target="#signupModal" class="report-comment">
						<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Report
					</span>
					<?php } ?>
				</div>
				<div id="<?php echo $answer['qaid']?>-answerReplyInput" class="main-comment reply d-none">
					<div class="form-group">
						<label>Your comment on this answer:</label>
						<textarea class="reply answer w-100" rows="5"></textarea>
					</div> 
					<div class="form-group">
						<button answerid="<?php echo $answer['qaid']?>" class="addReplyAnswer btn btn-postcomment my-2">Add Comment</button>
						<button answerid="<?php echo $answer['qaid']?>" class="cancelReplyAnswer btn btn-cancelcomment my-2">Cancel </button>
					</div>
				</div>
				<div class="comments">
					<ul id="<?php echo $answer['qaid']?>-answerReplies">
						<?php 
						$answerReplies=$this->QuestionsModel->getanswerreplies($answer['qaid'],$limitAnswerReplies);
						$answerRepliesCount=$this->QuestionsModel->getanswerrepliescount($answer['qaid']);
						$answerRepliesVotesReports=$this->QuestionsModel->answerRepliesVotesReports($answerReplies);
						$votedAnswerReplies=$answerRepliesVotesReports['votedAnswerReplies'];
						$reportedAnswerRepliesIds=$answerRepliesVotesReports['reportedAnswerRepliesIds'];
						
						foreach ($answerReplies as $index=>$replya) {?>
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
									<?php } }?>
								</div>
							</li>
						</ul> 
						<?php } ?>
					</ul>
					<div class="loadmore-mqar text-center">
						<?php if ($answerRepliesCount>count($answerReplies)) {?>
							<button answerid="<?php echo $answer['qaid']?>" class="btn btn-primary loadmore-sqar-btn" value="<?php echo $limitAnswerReplies;?>">
							Load More
							</button>
						<?php } ?>
					</div>
				</div>
		</div>
	</div>								
</div>
</article>
<?php } ?>