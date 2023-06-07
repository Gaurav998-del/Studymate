<article id="answer-main-head-<?php echo $qaid;?>" class="article-question article-post clearfix question-type-normal">
	<div class="single-inner-content">
		<div class="question-inner row">
			<div class="col-md-1 px-md-1 ">
				<div class="question-image-vote">
					<div class="author-image text-center">
						<a href="">
							<span class="author-image-span">
								<img class="avatar avatar-42 photo" alt="name" width="42" height="42" src="<?php echo base_url()."images/".$this->session->image;?>">
							</span>
						</a>
					</div>
				</div>
				<div class="question-content question-content-first d-inline-block d-md-none">
					<header class="article-header">
						<div class="question-header">
							<a class="post-author" href="<?php echo base_url()."profile/".$this->session->userid;?>"><?php echo $this->session->name;?></a>
							<?php if (isset($recentBadges['name'])) {?>
								<span class="badge-span" style="background-color: #ffbf00"><?php echo $recentBadges['name'];?></span>
							<?php } ?>
						</div>
					</header>
				</div>
			</div>
			<div class="col-md-11">
				<div class="question-content question-content-first">
					<header class="article-header d-none d-md-block">
						<div class="question-header">
							<a class="post-author" href="<?php echo base_url()."profile/".$this->session->userid;?>"><?php echo $this->session->name;?></a>
							<?php if (isset($recentBadges['name'])) {?>
								<span class="badge-span" style="background-color: #ffbf00"><?php echo $recentBadges['name'];?></span>
							<?php } ?>
							<a href="" class="comment-date"> Added an answer on <?php echo date('M d,Y',strtotime($awnswerTime));?> </a>
						</div>
					</header>
				</div>
				<div class="question-content question-content-second">
					<div class="post-wrap-content">
					    <div id="answer-description-<?php echo $qaid;?>" class="question-content-text comment">
							<?php echo decodeContent($answerEditor);?>
						</div>
					</div>
					<div class="msg_error custom"></div>
					<ul class="question-mobile question-vote comment comment">
						<li qaid="<?php echo $qaid;?>" type="1" class="question-vote-up answerVote">
							<a class="question_vote_up vote_not_user" title="Like"><i class="fa fa-caret-up " aria-hidden="true"></i></a>
						</li>
						<li class="votes-answer-<?php echo $qaid;?>  vote_result">0</li>
						<li qaid="<?php echo $qaid;?>" type="0" class="question-vote-down answerVote">
							<a class="question_vote_down vote_not_user" title="Dislike"><i class="fa fa-caret-down" aria-hidden="true"></i></a>
						</li>
					</ul> 
					<span answerid="<?php echo $qaid?>" class="reply-answer reply-comment">
						<i class="fa fa-share" aria-hidden="true"></i> Reply
					</span>
					<span answerid="<?php echo $qaid?>" class="edit-reply-answer reply-comment">
						<i class="fa fa-share" aria-hidden="true"></i> Edit
					</span>
					<span answerid="<?php echo $qaid?>" class="delete-answer reply-comment">
						<i class="fa fa-share" aria-hidden="true"></i> Delete
					</span>
				</div>
				<div id="<?php echo $qaid?>-answerReplyInput" class="main-comment reply d-none">
					<div class="form-group">
						<label>Your comment on this answer:</label>
						<textarea class="reply answer w-100" rows="5"></textarea>
					</div>  
					<div class="form-group">
						<button answerid="<?php echo $qaid?>" class="addReplyAnswer btn btn-postcomment my-2">Add Comment</button>
						<button answerid="<?php echo $qaid?>" class="cancelReplyAnswer btn btn-cancelcomment my-2">Cancel </button>
					</div>
				</div>
				<div class="comments">
					<ul id="<?php echo $qaid?>-answerReplies"></ul>
				</div>
			</div>
		</div>								
	</div>
</article>