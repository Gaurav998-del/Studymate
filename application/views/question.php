<?php 
$this->load->view('includes/head');?>
<link rel="stylesheet" href="<?php echo base_url()."plugins/jqueryTextEditor/jquery-te.css"?>">
<link rel="stylesheet" href="<?php echo base_url()."plugins/jqueryConfirm/jquery-confirm.css"?>">

<?php $this->load->view('includes/header');?>
	<div id="replyEditQuestion" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body p-0">
					<div class="replyq-heading">
						<h4 class="">Edit your Answer</h4>
					</div>
					<div class="main-replyq p-3">
						<textarea id="editAnswer" class="editorP w-100" rows="5"></textarea>
						<input type="hidden" value="" id="answerEditId">
						<button id="updateAnswer" type="button" class="btn btn-edit-ans">Update</button>
					</div>
				</div>

			</div>
		</div>
	</div>
	<?php if (checksession()) {?>
	<div id="reportModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body p-0">
					<div class="report-heading">
						<h4 class="">Select reason to report an answer</h4>
					</div> 
					<input type="hidden" id="answeridR" value="" />
					<div class="main-report-model">
						<?php foreach ($reportSchema as $index=>$value) {?>
							<div>
								<p class="heading-report"><?php echo $value['name'];?>
								<input class="reportSelectedCheckboxes d-none" name="repAnswer" type="radio" id="check<?php echo $value['rsid'];?>" value="<?php echo $value['rsid'];?>">
								<label class="dom-checks" for="check<?php echo $value['rsid'];?>"></label>
								</p>
								<p class="details-report-model"><?php echo $value['description'];?> </p>
							</div>
						<?php } ?> 
					</div>
				</div>
				<div class="modal-footer">
					<button id="reportAnswer" type="button" class="btn btn-default">Report</button>
				</div>
			</div>
		</div>
	</div>
	<div id="reportQModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body p-0">
					<div class="report-heading">
						<h4 class="">Select a reason to report this reply</h4>
					</div> 
				<input type="hidden" id="qridR" value="" />
				<?php foreach ($reportSchema as $index=>$value) {?>
					<div>
						<p><strong><?php echo $value['name'];?></strong> <input name="reportSelectedCheckboxesqr" class="reportSelectedCheckboxesqr" type="radio" value="<?php echo $value['rsid'];?>"></p>
						<p><?php echo $value['description'];?> </p>
					</div>
				<?php } ?>
				</div>
				<div class="modal-footer">
					<button id="reportQr" type="button" class="btn btn-default">Report</button>
				</div>
			</div>
		</div>
	</div>
	<div id="postImages" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body p-0">
					<div class="report-heading">
						<h4 class="">Upload Images and Get Links to embed</h4>
					</div> 
					<div class="image-upload-area">
						<input type="file" id="imageFile" class="edit-image"/>
						<span class="upload-info">Select an image from here and click upload button below</span>
					</div>
					<div id="successImageUploaded" class="alert alert-success d-none"></div>
					<p class="d-none" id="successImageUploadedDesc">Place/Embed the above image code in the html to output image</p>
				</div>
				<div class="modal-footer">
					<button id="uploadPic" type="button" class="btn btn-default">Upload</button>
				</div>
			</div>
		</div>
	</div>
	<div id="reportAModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body p-0">
					<div class="report-heading">
						<h4 class="">Select a reason to report this reply</h4>
					</div> 
				<input type="hidden" id="aridR" value="" />
				<?php foreach ($reportSchema as $index=>$value) {?>
					<div>
						<p><strong><?php echo $value['name'];?></strong> <input name="reportSelectedCheckboxesar" class="reportSelectedCheckboxesar" type="radio" value="<?php echo $value['rsid'];?>"></p>
						<p><?php echo $value['description'];?> </p>
					</div>
				<?php } ?>
				</div>
				<div class="modal-footer">
					<button id="reportAr" type="button" class="btn btn-default">Report</button>
				</div>
			</div>
		</div>
	</div>
	<?php } ?>
	<div class="main-body">
		<div class="container custom pb-5 pt-3">
			<?php 
			if ($siteSettings['bannerAdEnable']==1) {
				if (strlen($siteSettings['bannerAd'])>0) {?>
					<div class="row">
						<div class="col-md-12 px-0 banner-header-add mt-2">
							<div id="cbprotect">
								<?php echo $siteSettings['bannerAd'];?>
							</div>
						</div>
					</div>
				<?php } 
			}?>
			<div class="row"> 
				<div  class="col-md-8 col-lg-9">
				
					<div class="inner-question main">
						<article  class="article-question article-post clearfix question-type-normal py-0">
							<div class="single-inner-content">
								<div class="row select-category single-head m-0">
									<div class="col-3 col-sm-2 col-md-2 col-lg-2 px-lg-1 text-center d-none d-sm-flex">
										<div class="question-image-vote ans-bg w-100">
											<div class="vote-count ans text-center">
												<span class="awnsersCount"><?php echo $question['awnsers'];?></span> <span class="ans-text">Answer<?php echo $question['awnsers']>1?"s":"";?></span>
											</div>
										</div>
									</div>
									<div class="col-md-10 col-sm-10 col-12 col-lg-10 px-1">
										<h1 class="post-titles"><a class="post-titles" href="" rel="bookmark"><?php echo $question['title'];?></a></h1>
								
										<div class="ribbon base">
										   <div class="ribbon-container">
												<span id="ribbon">
													<i class="fa fa-eye" aria-hidden="true"	></i><?php echo $question['views'];?> <span class="question-span">View<?php echo $question['views']>1?"s":"";?></span>
												</span>
										   </div>	
										</div>
									</div>
								</div>
							
								<div class="question-inner row">
									<div class="col-sm-2 col-md-2 col-lg-2 col-6 px-lg-1 ">
											<div class=" question-image-vote px-sm-0 text-center vote-bg">
												<ul class="question-mobile question-vote">
													<li qid="<?php echo $question['qid'];?>" type="1" class="question-vote-up voteQuestion <?php 
													if (isset($votedQuestions))
													{
														if (isset($votedQuestions['val']))
														{
															$votedP=$votedQuestions['val'];
															echo $votedP==1?"active":"";
														}
													}
													?>">
														<a class="question_vote_up vote_not_user" title="Like"><i class="fa fa-caret-up" aria-hidden="true"></i></a>
													</li>
													<li class="count-vote-mid">
														<span class="vote votesCount-<?php echo $question['qid'];?>"><?php echo $question['votes'];?></span> 
													</li>
													<li qid="<?php echo $question['qid'];?>" type="0" class="question-vote-down voteQuestion <?php echo isset($votedP) && $votedP == 0?"active":"";?>">
														<a class="question_vote_down vote_not_user" title="Dislike"><i class="fa fa-caret-down" aria-hidden="true"></i></a>
													</li>
												</ul>
												<div class="vote-count text text-center "><span>Votes</span></div>
											</div>
									
										<div class="question-content question-content-first d-none"> 
											<header class="article-header">
												<div class="question-header">
													<span class="author-image-span pull-left">
														<img class="avatar avatar-42 photo" alt="name" width="21" height="21" src="<?php echo base_url()."images/".$userinfo['image'];?>">
													</span>	
												
													<a class="post-author" href="<?php echo base_url()."profile/".$question['userid'];?>"><?php echo $userinfo['name'];?></a> 
													<?php 
													$key = array_search($userinfo['userid'], array_column($recentBadges,'userid'));
													if (is_int($key))
													{?>
														<span class="badge-span" style="background-color: #ffbf00"><?php echo $recentBadges[$key]['name'];;?></span> 
													<?php } ?>
													<div class="post-meta">
														<span class="post-date" itemprop="dateCreated">Asked: 
															<span class="entry-date published"><?php echo $askTime=date('M d,Y',strtotime($question['on']));?></span>
														</span>
														<span class="byline">
															<span class="post-cat">In: 
																<a href="<?php echo $catpermaQ=base_url()."categories/".$catInfo['permalink'];?>"><?php echo $catInfo['name'];?></a>
															</span>
														</span>
														
													</div>
												</div>
											</header> 
										</div>
									</div>
									<div class="col-md-2 col-lg-1 col-sm-2 col-6 text-center d-flex d-sm-none">
										<div class="question-image-vote ans-bg pt-4">
											<div class="vote-count ans text-center">
												<a href="#"><span class="awnsersCount"><?php echo $question['awnsers'];?></span> <span class="ans-text">Answer<?php echo $question['awnsers']>1?"s":"";?></span></a>
											</div>
										</div>
									</div>
									<div class="col-sm-10 col-md-10 col-lg-10 px-lg-1">
										<div class="question-content question-content-first  d-none">
											<header class="article-header d-none">
												<div class="question-header">
													<span class="author-image-span pull-left">
														<img class="avatar avatar-42 photo" alt="name" width="21" height="21" src="<?php echo base_url()."images/".$userinfo['image'];?>">
													</span>	
													<a class="post-author" href="<?php echo base_url()."profile/".$question['userid'];?>"><?php echo $userinfo['name'];?></a>
													<span class="badge-span" style="background-color: #ffbf00">Punditsdkoslkdosdkoskdo</span>
													<div class="post-meta">
														<span class="post-date" itemprop="dateCreated">Asked: 
															<span class="entry-date published"><?php echo $askTime;?></span>
														</span>
														<span class="byline">
															<span class="post-cat">In: 
																<a href="<?php echo $catpermaQ;?>"><?php echo $catInfo['name'];?></a>
															</span>
														</span>
													</div>
												</div>
											</header>
											<h2 class="post-title"><a class="post-title" href="" rel="bookmark"><?php echo $question['title'];?></a></h2>
										</div> 
										<div class="question-content question-content-second pt-sm-4">
										
											<div class="post-wrap-content">
											   <div class="question-content-text">
													<?php echo decodeContent($question['description']);?>
											   </div>
											   
											</div>
											<div class="wpqa_error"></div>
											<div class="tagcloud">
												<div class="question-tags"><i class="icon-tags"></i>
												<?php 
												$tags=explode(',',$question['tags']);
												foreach ($tags as $index=>$tag) {
												?>
												<a href="<?php echo base_url()."tags/".$tag;?>"><?php echo $tag;?></a>
												<?php } ?>
												</div>
										   </div>
											<footer class="question-footer row">
												<div class="col-md-7 d-none">
													<ul class="footer-meta">
														<li><i class="icon ion-md-chatboxes"></i><a class="awnsersCount"><?php echo $question['awnsers'];?></a><span class="question-span"> <a href="#">Answer<?php echo $question['awnsers']>1?"s":"";?></a></span></li>
														<li><i class="fa fa-eye" aria-hidden="true"	></i><?php echo $question['views'];?> <span class="question-span">View<?php echo $question['views']>1?"s":"";?></span></li>
												   </ul>
												</div>
												<div class="col-md-12 col-lg-8">
												
													<div class="question-content question-content-first"> 
														<div class="article-header">
															<div class="question-header">
																<span class="author-image-span pull-left">
																	<img class="avatar avatar-42 photo" alt="name" width="21" height="21" src="<?php echo base_url()."images/".$userinfo['image'];?>">
																</span>	
															
																<a class="post-author" href="<?php echo base_url()."profile/".$question['userid'];?>"><?php echo $userinfo['name'];?></a>
																<?php 
																$key = array_search($question['userid'], array_column($recentBadges,'userid'));
																if (is_int($key))
																{?>
																	<span class="badge-span" style="background-color: #ffbf00"><?php echo $recentBadges[$key]['name'];;?></span> 
																<?php } ?>
																<div class="post-meta"><span class="post-date" itemprop="dateCreated">Asked: 
																<span class="entry-date published"><?php echo $askTime=date('M d,Y',strtotime($question['on']));?></span>
																</span><span class="byline"><span class="post-cat">In: 
																<a href="<?php echo $catpermaQ=base_url()."categories/".$catInfo['permalink'];?>"><?php echo $catInfo['name'];?></a>
																</span></span>
																<?php if (isset($this->session->role) && ($this->session->role==2 || $this->session->userid==$question['userid']) ) {?>
																<span class="byline">
																	<a target="_blank" href="<?php echo base_url()."questions/edit/".$question['qid']."/".$question['permalink'];?>">Edit the question</a>
																</span>
																<span class="byline">
																	<span class="deleteQuestion" data-qid="<?php echo $question['qid'];?>">Delete this question</span>
																</span>
																<?php } ?>
																</div>
																<?php if (count($editByUsers)>0) {?>
																<div>
																	<span>Edited By : </span>
																	<?php foreach ($editByUsers as $index=>$value) {?>
																		<span>
																			<a href="<?php echo base_url()."profile/".$value['userid']?>">
																			<img class="avatar avatar-42 photo" alt="name" width="12" height="12" src="<?php echo base_url()."images/".$value['image'];?>"> <?php echo $value['name'];?> </a><?php echo $value['on'];?>
																		</span>
																	<?php } ?>
																</div>
																<?php } ?>
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-12 col-lg-4 text-right">
												   <button class="meta-answer comment mx-2 my-1" id="replyQuestion" href="#"><span><span class="ti-comments"></span></span> Reply</button> 
												   <a onclick="animateAwnser('#submitForm');" class="meta-answer dropdown my-1"><span><i class="icon ion-md-chatbubbles"></i></span> Answer</a>
											   </div>
											</footer>
											<div style="display:none" class="main-comment" id="replyQuestion-textarea">
													<div class="form-group">
														<label>Your reply on this question:</label>
														<textarea id="replyTextQ" class="editorP answer w-100" rows="2"  ></textarea>
													</div>
													<div class="form-group">
														<button id="addReplyQuestion" class="btn btn-postcomment my-2">Add Reply</button>
														<button id="cancelReplyQuestion" class="btn btn-cancelcomment my-2">Cancel </button>
													</div>
												</div>
											
											<div class="comments">
												<ul id="questionReplies">
												<?php if (count($questionReplies)>0) {?>
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
															
															<?php } }?>
														</div>
													</li> 
													</ul>
													<?php } ?>
													<?php } ?>
												</ul>
												<div class="loadmore-mqr text-center">
													<?php if ($questionsRepliesCount>count($questionReplies)) {?>
														<button class="btn btn-primary loadmore-mqr-btn comnt-q ld-ext-right running" value="<?php echo $next;?>">
														Load More</button>
													<?php } ?>
												</div>
											</div>
										
										</div>
										
									</div>
								</div>
							</div>
						</article>
					</div>
					<div class="answer-main-heading">
						<div class="row"> 
							<div class="col-sm-12 col-md-12 col-lg-12 text-right">
								<ul class="nav nav-tabs ans-category" role="tablist">
									<li type="resc" class="tabs-question nav-item">
										<a class="nav-link active" data-toggle="tab" href="#recent">Recent</a>
									</li>
									<li type="vote" class="tabs-question nav-item">
										<a class="nav-link " data-toggle="tab" href="#voted">Voted</a>
									</li>
									<li type="old" class="tabs-question nav-item">
										<a class="nav-link" data-toggle="tab" href="#oldest">Oldest</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="inner-question main">
						<!-- Tab panes -->
						<div class="tab-content">
							<div id="recent" class="container tab-pane active">
								<div class="" id="recentAwnsers">
								<?php $userid=getuserid();
								foreach ($recentAnswers as $index=>$answer) {
								$qaid=$answer['qaid'];
								?>
								<article id="answer-main-head-<?php echo $qaid;?>" class="article-question article-post clearfix question-type-normal">
									<div class="single-inner-content">
										<div class="question-inner row">
											<div class="col-md-2 col-lg-1 px-md-1  ">
												<div class="question-image-vote ans">
													<div class="author-image text-center">
														<a href="">
															<span class="author-image-span">
																<img class="avatar avatar-42 photo" alt="name" width="42" height="42" src="<?php echo base_url()."images/".$answer['image']?>">
															</span>
														</a>
														
														
														
														
														<ul class="question-mobile question-vote comment comment">
															
															<li qaid="<?php echo $qaid;?>" type="1" class="question-vote-up answerVote
															<?php 
															if (isset($votedAnswerCon))
															{
																$key = array_search($qaid, array_column($votedAnswerCon,'qaid'));
																if (is_int($key))
																{
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
											<div class="col-md-10 col-lg-11">
												<div class="question-content question-content-first">
													<header class="article-header d-none d-md-block">
														<div class="question-header d-sm-inline-block">
															<a class="post-author" href="<?php echo base_url()."profile/".$answer['userid'];?>"><?php echo $answer['name'];?></a>
															<?php 
															$key = array_search($answer['userid'], array_column($recentBadges,'userid'));
															if (is_int($key))
															{?>
																<span class="badge-span" style="background-color: #ffbf00"><?php echo $recentBadges[$key]['name'];;?></span> 
															<?php } ?>
															<a href="" class="comment-date"> Added an answer on <?php echo date('M d,Y',strtotime($answer['on']));?> </a>
														</div>
													</header>
												</div>
												  
												<div class="question-content question-content-second">
													<div class="post-wrap-content">
													   <div id="answer-description-<?php echo $qaid;?>" class="question-content-text comment">
															<?php echo decodeContent($answer['description']);?>
													   </div>
													</div>
													<div class="main-comment-option">
														<ul class="question-mobile question-vote comment comment d-none">
															
															<li qaid="<?php echo $qaid;?>" type="1" class="question-vote-up answerVote
															<?php 
															if (isset($votedAnswerCon))
															{
																$key = array_search($qaid, array_column($votedAnswerCon,'qaid'));
																if (is_int($key))
																{
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
														<span answerid="<?php echo $qaid?>" class="reply-answer reply-comment">
															<i class="fa fa-share" aria-hidden="true"></i> Reply
														</span>
														<?php if (checksession()) {
														if ($answer['userid']==getuserid()) {?>
														<span answerid="<?php echo $qaid?>" class="edit-reply-answer reply-comment">
															<span class="ti-pencil"></span> Edit
														</span>
														<span answerid="<?php echo $qaid?>" class="delete-answer reply-comment">
															<span class="ti-trash"></span> Delete
														</span> 
														<?php } else {?>
														<span answerid="<?php echo $qaid?>" class="reportAnswerMod report-comment">
															<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Report
														</span>
														<?php } } else {?>
														<span data-toggle="modal" data-target="#signupModal" class="report-comment">
															<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Report
														</span>
														<?php } ?>
													</div>
												</div>
												<div id="<?php echo $qaid?>-answerReplyInput" class="main-comment reply d-none">
													<div class="form-group">
														<label>Your comment on this answer:</label>
														<textarea class="editorP reply answer w-100" rows="5"></textarea>
													</div> 
													<div class="form-group">
														<button answerid="<?php echo $qaid?>" class="addReplyAnswer btn btn-postcomment my-2">Add Comment</button>
														<button answerid="<?php echo $qaid?>" class="cancelReplyAnswer btn btn-cancelcomment my-2">Cancel </button>
													</div>
												</div>
												<div class="comments">
<ul id="<?php echo $qaid?>-answerReplies">
	<?php 
	$answerReplies=$this->QuestionsModel->getanswerreplies($qaid,$limitAnswerReplies);
	$answerRepliesCount=$this->QuestionsModel->getanswerrepliescount($qaid);
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
															<button answerid="<?php echo $qaid?>" class="btn btn-primary loadmore-sqar-btn ld-ext-right" value="<?php echo $limitAnswerReplies;?>">
															Load More</button>
														<?php } ?> 
													</div>
												</div>
										</div>
									</div>								
								</div>
								</article>
								<?php } ?>
								<input type="hidden" value="resc" id="selectedType">

								<?php if ($recentAnswersCount>count($recentAnswers)) {?>
									<div class="loadmore-qa text-center">
											<button class="btn btn-primary loadmore-qa-btn" value="<?php echo $next;?>">
											Load More Answers
											</button>
									</div>
								<?php } ?>
								</div>
								<div id="submitForm" class="">
									<form class="comment-leave">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<div class="input-group">
														<textarea id="answerEditor" class="w-100 text-comment" rows="6"></textarea>
														<span class="icons-comment"><span class="ti-marker-alt"></span></span>
													</div>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<button type="button" class="btn btn-leave-comment w-100 mb-1" id="submitAnswer">Submit an answer</button>
												</div>
											</div>
										<!-- 	<div class="col-md-6">
												<div class="form-group">
													<button type="button" class="btn btn-leave-comment w-100 mb-1" id="submitImages">Embed images in answer</button>
												</div>
											</div> -->
										</div>
									</form>
								</div>
							</div>
							<div id="voted" class="container tab-pane fade"><br>
								<div class="" id="votedAwnsersContent">
									<div class="" id="votedAwnsers"></div>
								</div>
							</div>
							<div id="oldest" class="container tab-pane fade"><br>
								<div class="" id="oldestAwnsersContent">
									<div class="" id="oldestAwnsers"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-lg-3">
					<?php 
					if ($siteSettings['sidebarAdEnable']==1) {
						if (strlen($siteSettings['sidebarAd'])>0) {?>
						<div class="banner-side">
							<div id="cbprotect">
								<?php echo $siteSettings['sidebarAd'];?>
							</div>
						</div>
					<?php } 
					}
					
					if (count($getPopularQuestions)>0) {?>
					<section class="trendding-tags widget">
						<h2 class="widget-title"><i class="icon ion-md-help"></i> Popular Questions	</h2>
						<ul class="popular-qs pl-0">
							<?php foreach ($getPopularQuestions as $index=>$valuep) {?>
								<li>
									<div class="questions-side">
										<span class="box-cont"><?php echo $valuep['votes'];?></span>
										<h3><a href="<?php echo base_url()."questions/".$valuep['qid']."/".$valuep['permalink'];?>"><?php echo $valuep['title'];?></a></h3>
										<a class="post-meta-comment" href=""><i class="icon ion-md-chatboxes"></i> <?php echo $valuep['awnsers'];?> Answers</a>
									</div>
								</li>
							<?php } ?>
						</ul>
					</section>
					<?php } ?>
					
					
					<section class="trendding-tags widget">
					
						<h2 class="widget-title"><i class="icon ion-md-pricetags"></i> Trending Tags</h2>
						<div class="tagcloud">
							<?php 
							$tags=[];
							foreach ($getPopularQuestionsTags as $index=>$value)
							{
								$tags=array_merge($tags,explode(',',$value['tags']));
								if (count($tags)>20)
								break;
							}
							$tags=array_unique($tags);
							foreach ($tags as $index=>$tag) {?>
							<a class="tag-cloud-link" href="<?php echo base_url()."tags/".$tag;?>"><?php echo $tag;?></a>
							<?php } ?>
						</div>
						
						
					</section>
					<?php if (count($getRelatedQuestions)>0) {?>
					<section class="trendding-tags widget">
						<h2 class="widget-title"><i class="icon ion-md-help"></i> Related Questions	</h2>
						<ul class="popular-qs pl-0">
							<?php foreach ($getRelatedQuestions as $index=>$valuep) {?>
								<li>
									<div class="questions-side">
										<span class="box-cont"><?php echo $valuep['votes'];?></span>
										<h3><a href="<?php echo base_url()."questions/".$valuep['qid']."/".$valuep['permalink'];?>"><?php echo $valuep['title'];?></a></h3>
										<a class="post-meta-comment" href=""><i class="icon ion-md-chatboxes"></i> <?php echo $valuep['awnsers'];?> Answers</a>
									</div>
								</li>
							<?php } ?>
						</ul>
					</section>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('includes/footer');?>	
<script type="text/javascript" src="<?php echo base_url()."plugins/jqueryTextEditor/jquery-te-1.4.0.min.js"?>"></script>
<script type="text/javascript" src="<?php echo base_url()."plugins/jqueryConfirm/jquery-confirm.js"?>"></script>
<script src="//cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script>
<script>
	var csrfName="<?php echo $this->security->get_csrf_token_name();?>";
	var csrfHash="<?php echo $this->security->get_csrf_hash();?>";
	
	$(document).ready(function() {
		// $('.editorP').jqte();
		CKEDITOR.replace( 'answerEditor',{allowedContent:true});
		CKEDITOR.replace( 'editAnswer',{allowedContent:true});
	});
	
	$(document).on('click','#replyQuestion,#cancelReplyQuestion',function() {
		$('#replyQuestion-textarea').toggle();
	});
	var totalanswers=<?php echo $question['awnsers'];?>;
	
	$(document).on('click','.edit-replyq,.cancelReplyQ',function() {
		var qrid=$(this).attr('qrid');
		$('.replyQRecord-'+qrid).toggleClass('d-none');
	});
	
	$(document).on('click','.edit-replya,.cancelReplyA',function() {
		var arid=$(this).attr('arid');
		$('.replyARecord-'+arid).toggleClass('d-none');
	});
	
	$(document).on('click','#submitAnswer',function() {
		var element=$(this);
		element.html('<div class="ld ld-ring ld-spin-fast"></div>');
		var answerEditor=CKEDITOR.instances.answerEditor.getData();
		var question=<?php echo $question['qid'];?>;
		var fd = new FormData(); 
		fd.append('answerEditor',answerEditor);
		fd.append('question',question);
		fd.append(csrfName,csrfHash);
		$.ajax({
			type:'POST',
			url:'<?php echo base_url()."post-question-answer"?>',
			type: "POST",
			data : fd,
			processData: false,
			contentType: false,
			success: function(response) 
			{
				var response=$.parseJSON(response);
				if (response['type']==1)
				{
					var replyHtml=response['html'];
					CKEDITOR.instances.answerEditor.setData('')
					$('#recentAwnsers').prepend(replyHtml);
					totalanswers++;
					animateAwnser('#recentAwnsers'); 
					$('.awnsersCount').html(totalanswers);
				}
				else if (response['type']==2)
				{
					$('#signupModal').modal();
				}
				else
				{
					alert(response['html']);
				}
				element.html('Submit an answer');
			}
			,
			error: function (xhr, data, error) {
				if (window.confirm("This page seems to be expired , Please click 'OK' to reload the page"))
				{
					window.location.reload(true);
				}
				else
				{
					element.html('Submit an answer');
				}
			}
		});
	});
	$(document).on('click','.tabs-question',function() {
		$('#votedAwnsers,#oldestAwnsers,#recentAwnsers').html('');
		
		var question=<?php echo $question['qid'];?>;
		var type=$(this).attr('type');
		var fd = new FormData(); 
		fd.append('question',question);
		fd.append('type',type);
		fd.append('next',0);
		fd.append(csrfName,csrfHash);
		$.ajax({
			type:'POST',
			url:'<?php echo base_url()."load-inner-tabs-question"?>',
			type: "POST",
			data : fd,
			processData: false,
			contentType: false,
			success: function(response) 
			{
				var response=$.parseJSON(response);
				if (response['type']==1)
				{
					var html=response['html'];
					if (type=="vote")
					{
						$('#votedAwnsers').html(html);
					}
					else if (type=="old")
					{
						$('#oldestAwnsers').html(html);
					}
					else
					{
						$('#recentAwnsers').html(html);
					}
				}
				else if (response['type']==2)
				{
					$('#signupModal').modal();
				}
				else
				{
					alert(response['html']);
				}
			},
			error: function (xhr, data, error) {
				if (window.confirm("This page is expired , Please click Yes to reload the page"))
				{
					window.location.reload(true);
				}
			}
		});
	});
	$(document).on('click','#addReplyQuestion',function() {
		var element=$(this);
		element.html('<div class="ld ld-ring ld-spin-fast"></div>');
		var replyTextQ=$('#replyTextQ').val();
		var question=<?php echo $question['qid'];?>;
		var fd = new FormData(); 
		fd.append('replyTextQ',replyTextQ);
		fd.append('question',question);
		fd.append(csrfName,csrfHash);
		$.ajax({
			type:'POST',
			url:'<?php echo base_url()."post-question-reply"?>',
			type: "POST",
			data : fd,
			processData: false,
			contentType: false,
			success: function(response) 
			{
				var response=$.parseJSON(response);
				if (response['type']==1)
				{
					var replyHtml=response['html'];
					$('#replyTextQ').val('');
					$('#replyQuestion-textarea').toggle();
					$('#questionReplies').prepend(replyHtml);
				}
				else if (response['type']==2)
				{
					$('#signupModal').modal();
				}
				else
				{
					alert(response['html']);
				}
				element.html('Add Reply');
			}
			,
			error: function (xhr, data, error) {
				if (window.confirm("This page is expired , Please click Yes to reload the page"))
				{
					window.location.reload(true);
				}
				else
				{
					element.html('Add Reply');
				}
			}
		});
	});
	
	$(document).on('click','.saveReplyQ',function() {
		var element=$(this);
		element.html('<div class="ld ld-ring ld-spin-fast"></div>');
		var qrid=$(this).attr('qrid');
		var elem=$(this).parent();
		var replyTextQ=$('#replyq-'+qrid).val();
		var question=<?php echo $question['qid'];?>;
		var fd = new FormData(); 
		fd.append('replyTextQ',replyTextQ);
		fd.append('qrid',qrid);
		fd.append('question',question);
		fd.append(csrfName,csrfHash);
		$.ajax({
			type:'POST',
			url:'<?php echo base_url()."post-edit-question-reply"?>',
			type: "POST",
			data : fd,
			processData: false,
			contentType: false,
			success: function(response) 
			{
				var response=$.parseJSON(response);
				if (response['type']==1)
				{
					alert(response['html']);
					$('.replyQRecord-'+qrid).toggleClass('d-none');
					replyTextQ=replyTextQ.replace(/script/g, "removed");
					$('.act-reply-'+qrid).html(replyTextQ);
					$('#replyq-'+qrid).val(replyTextQ);
				}
				else if (response['type']==2)
				{
					$('#signupModal').modal();
				}
				else
				{
					alert(response['html']);
				}
				element.html('Save');
			},
			error: function (xhr, data, error) {
				if (window.confirm("This page is expired , Please click Yes to reload the page"))
				{
					window.location.reload(true);
				}
				else
				{
					element.html('Save');
				}
			}
		});
	});
	$(document).on('click','.saveReplyA',function() {
		var element=$(this);
		element.html('<div class="ld ld-ring ld-spin-fast"></div>');
		var arid=$(this).attr('arid');
		var elem=$(this).parent();
		var replyTextA=$('#replya-'+arid).val();
		var fd = new FormData(); 
		fd.append('replyTextA',replyTextA);
		fd.append('arid',arid);
		fd.append(csrfName,csrfHash);
		$.ajax({
			type:'POST',
			url:'<?php echo base_url()."post-edit-answer-reply"?>',
			type: "POST",
			data : fd,
			processData: false,
			contentType: false,
			success: function(response) 
			{
				var response=$.parseJSON(response);
				if (response['type']==1)
				{
					alert(response['html']);
					$('.replyARecord-'+arid).toggleClass('d-none');
					replyTextA=replyTextA.replace(/script/g, "removed");
					$('.act-reply-'+arid).html(replyTextA);
					$('#replya-'+arid).val(replyTextA);
				}
				else if (response['type']==2)
				{
					$('#signupModal').modal();
				}
				else
				{
					alert(response['html']);
				}
				element.html('Save');
			},
			error: function (xhr, data, error) {
				if (window.confirm("This page is expired , Please click Yes to reload the page"))
				{
					window.location.reload(true);
				}
				else
				{
					element.html('Save');
				}
			}
		});
	});
	
	$(document).on('click','.loadmore-mqr-btn',function() {
		var element=$(this);
		element.html('<div class="ld ld-ring ld-spin-fast"></div>');
		var next=element.attr('value');
		var question=<?php echo $question['qid'];?>;
		var fd = new FormData(); 
		fd.append('next',next);
		fd.append('question',question);
		fd.append(csrfName,csrfHash);
		$.ajax({
			type:'POST',
			url:'<?php echo base_url()."load-more-mq"?>',
			type: "POST",
			data : fd,
			processData: false,
			contentType: false,
			success: function(response) 
			{
				var response=$.parseJSON(response);
				if (response['type']==1)
				{
					var questionReplies=response['result'];
					$('#questionReplies').append(questionReplies);
					if (response['loadMoreH']==1)
					{
						$('.loadmore-mqr').html('');
					}
					else
					{
						$('.loadmore-mqr-btn').val(response['next']);
						element.html('Load More');
					}
					
				}
				else if (response['type']==2)
				{
					$('#signupModal').modal();
				}
				else
				{
					alert(response['html']);
				}
			},
			error: function (xhr, data, error) {
				if (window.confirm("This page is expired , Please click Yes to reload the page"))
				{
					window.location.reload(true);
				}
				else
				{
					element.html('Load More');
				}
			}
		});
	});
	// old vote resc
	$(document).on('click','.loadmore-qa-btn',function() {
		var element=$(this);
		element.html('<div class="ld ld-ring ld-spin-fast"></div>');
		var next=element.attr('value');
		var dtype=$('#selectedType').val();
		var question=<?php echo $question['qid'];?>;
		var fd = new FormData();
		fd.append('next',next);
		fd.append('dtype',dtype);
		fd.append('question',question);
		fd.append(csrfName,csrfHash);
		$.ajax({
			type:'POST',
			url:'<?php echo base_url()."load-more-qa"?>',
			type: "POST",
			data : fd,
			processData: false,
			contentType: false,
			success: function(response) 
			{
				var response=$.parseJSON(response);
				if (response['type']==1)
				{
					var recentAwnsers=response['result'];
					$('.loadmore-qa').before(recentAwnsers);
					if (response['loadMoreH']==1)
					{
						$('.loadmore-qa').html('');
					}
					else
					{
						$('.loadmore-qa-btn').val(response['next']);
						element.html('Load More');
		
					}
				}
				else if (response['type']==2)
				{
					$('#signupModal').modal();
				}
				else
				{
					alert(response['html']);
				}
			},
			error: function (xhr, data, error) {
				if (window.confirm("This page is expired , Please click Yes to reload the page"))
				{
					window.location.reload(true);
				}
				else
				{
					element.html('Load More');
				}
			}
		});
	});
	
	function deleteAnswer(answerid)
	{
		var question=<?php echo $question['qid'];?>;
		$.confirm({
			title: 'Are you sure ?',
			content: 'You want to delete this answer?',
			buttons: {
				deleteAnswer: {
					text: 'delete answer',
					action: function () {
						var that = this;
						var fd = new FormData();
						fd.append('answerid',answerid);
						fd.append('question',question);
						fd.append(csrfName,csrfHash);
						$.ajax({
							type:'POST',
							url:'<?php echo base_url()."post-delete-answer"?>',
							type: "POST",
							data : fd,
							processData: false,
							contentType: false,
							success: function(response) 
							{
								var response=$.parseJSON(response);
								if (response['type']==1)
								{
									$.alert(response['html']);
									totalanswers--;
									$('.awnsersCount').html(totalanswers);
									$('#answer-main-head-'+answerid).remove();
									that.close();
								}
								else if (response['type']==2)
								{
									that.close();
									$('#signupModal').modal();
								}
								else
								{
									$.alert(response['html']);
								} 
							},
							error: function (xhr, data, error) {
								that.close();
								if (window.confirm("This page is expired , Please click Yes to reload the page"))
								{
									window.location.reload(true);
								}
							}
						});
						return false;
					}
				},
				cancel: function () {},
			}
		});
	}
	function deleteQReply(qrid)
	{
		$.confirm({
			title: 'Are you sure ?',
			content: 'You want to delete this question reply?',
			buttons: {
				deleteAnswer: {
					text: 'delete reply',
					action: function () {
						var that = this;
						var fd = new FormData();
						fd.append('qrid',qrid);
						fd.append(csrfName,csrfHash);
						$.ajax({
							type:'POST',
							url:'<?php echo base_url()."post-delete-question-reply"?>',
							type: "POST",
							data : fd,
							processData: false,
							contentType: false,
							success: function(response) 
							{
								var response=$.parseJSON(response);
								if (response['type']==1)
								{
									$.alert(response['html']);
									$('#question-reply-main-head-'+qrid).remove();
									that.close();
								}
								else if (response['type']==2)
								{
									that.close();
									$('#signupModal').modal();
								}
								else
								{
									$.alert(response['html']);
								} 
							},
							error: function (xhr, data, error) {
								that.close();
								if (window.confirm("This page is expired , Please click Yes to reload the page"))
								{
									window.location.reload(true);
								}
							}
						});
						return false;
					}
				},
				cancel: function () {},
			}
		});
	}
	function deleteAReply(arid)
	{
		$.confirm({
			title: 'Are you sure ?',
			content: 'You want to delete this answer reply?',
			buttons: {
				deleteAnswer: {
					text: 'delete reply',
					action: function () {
						var that = this;
						var fd = new FormData();
						fd.append('arid',arid);
						fd.append(csrfName,csrfHash);
						$.ajax({
							type:'POST',
							url:'<?php echo base_url()."post-delete-answer-reply"?>',
							type: "POST",
							data : fd,
							processData: false,
							contentType: false,
							success: function(response) 
							{
								var response=$.parseJSON(response);
								if (response['type']==1)
								{
									$.alert(response['html']);
									$('#answer-reply-main-head-'+arid).remove();
									that.close();
								}
								else if (response['type']==2)
								{
									that.close();
									$('#signupModal').modal();
								}
								else
								{
									$.alert(response['html']);
								} 
							},
							error: function (xhr, data, error) {
								that.close();
								if (window.confirm("This page is expired , Please click Yes to reload the page"))
								{
									window.location.reload(true);
								}
							}
						});
						return false;
					}
				},
				cancel: function () {},
			}
		});
	}
	$(document).on('click','.delete-answer',function() {
		var answerid=$(this).attr('answerid');
		deleteAnswer(answerid);
	});
	$(document).on('click','.delete-replyQ',function() {
		var qrid=$(this).attr('qrid');
		deleteQReply(qrid);
	});
	$(document).on('click','.delete-replyA',function() {
		var arid=$(this).attr('arid');
		deleteAReply(arid);
	});
	$(document).on('click','.reportAnswerMod',function() {
		var answerid=$(this).attr('answerid');
		$('#answeridR').val(answerid);
		$('#reportModal').modal();
	});

	function deleteQuestion(qid)
	{
		$.confirm({
			title: 'Are you sure ?',
			content: 'You want to delete this Question?',
			buttons: {
				deleteAnswer: {
					text: 'Delete Question',
					action: function () {
						var that = this;
						var fd = new FormData();
						fd.append('qid',qid);
						fd.append(csrfName,csrfHash);
						$.ajax({
							type:'POST',
							url:'<?php echo base_url()."post-delete-question"?>',
							type: "POST",
							data : fd,
							processData: false,
							contentType: false,
							success: function(response) 
							{
								var response=$.parseJSON(response);
								if (response['type']==1)
								{
									$.alert(response['html']);
									window.location.href="<?php echo base_url();?>";
								}
								else if (response['type']==2)
								{
									that.close();
									$('#signupModal').modal();
								}
								else
								{
									$.alert(response['html']);
								} 
							},
							error: function (xhr, data, error) {
								that.close();
								if (window.confirm("This page is expired , Please click Yes to reload the page"))
								{
									window.location.reload(true);
								}
							}
						});
						return false;
					}
				},
				cancel: function () {},
			}
		});
	}
	$(document).on('click','.deleteQuestion',function() {
		var qid=$(this).attr('data-qid');
		deleteQuestion(qid);
	});

	$(document).on('click','.reportqr',function() {
		<?php if (!checksession()) {?>
			$('#signupModal').modal();
			return false;	
		<?php } ?>
		if ($(this).hasClass('active'))
		{
			return false;
		}
		
		var qrid=$(this).attr('qrid');
		$('#qridR').val(qrid);
		$('#reportQModal').modal();
	});
	$(document).on('click','.reportar',function() {
		if ($(this).hasClass('active'))
		{
			return false;
		}
		var arid=$(this).attr('arid');
		$('#aridR').val(arid);
		$('#reportAModal').modal();
	});
	$(document).on('click','#reportAnswer',function() {
		var reportedReason=$('.reportSelectedCheckboxes:checked').val();
		if (reportedReason==undefined)
		{
			alert('Please select a reason');
			return false;
		}
		var element=$(this);
		element.html('<div class="ld ld-ring ld-spin-fast"></div>');
		var answerid=$('#answeridR').val();
		
		var fd = new FormData(); 
		fd.append('answerid',answerid);
		fd.append('reportedReason',reportedReason);
		fd.append(csrfName,csrfHash);
		$.ajax({
			type:'POST',
			url:'<?php echo base_url()."post-a-report-answer"?>',
			type: "POST",
			data : fd,
			processData: false,
			contentType: false,
			success: function(response) 
			{
				var response=$.parseJSON(response);
				if (response['type']==1)
				{
					alert(response['html']);
					$('.reportSelectedCheckboxes').prop('checked', false);
					$('#reportModal').modal('toggle');
				}
				else if (response['type']==2)
				{
					$('#signupModal').modal();
				}
				else
				{
					alert(response['html']);
				}
				element.html('Report');
			},
			error: function (xhr, data, error) {
				if (window.confirm("This page is expired , Please click Yes to reload the page"))
				{
					window.location.reload(true);
				}
				else
				{
					element.html('Report');
				}
			}
		});
	});
	
	$(document).on('click','#reportQr',function() {
		var reportedReason=$('.reportSelectedCheckboxesqr:checked').val();
		if (reportedReason==undefined)
		{
			alert('Please select a reason');
			return false;
		}
		var element=$(this);
		element.html('<div class="ld ld-ring ld-spin-fast"></div>');
		var qrid=$('#qridR').val();
		var fd = new FormData(); 
		fd.append('qrid',qrid);
		fd.append('reportedReason',reportedReason);
		fd.append(csrfName,csrfHash);
		$.ajax({
			type:'POST',
			url:'<?php echo base_url()."post-a-report-qreply"?>',
			type: "POST",
			data : fd,
			processData: false,
			contentType: false,
			success: function(response) 
			{
				var response=$.parseJSON(response);
				if (response['type']==1)
				{
					alert(response['html']);
					$('.reportqr[qrid='+qrid+']').addClass('active');
					$('#reportQModal').modal('toggle');
				}
				else if (response['type']==2)
				{
					$('#signupModal').modal();
				}
				else
				{
					alert(response['html']);
				}
				element.html('Report');
			},
			error: function (xhr, data, error) {
				if (window.confirm("This page is expired , Please click Yes to reload the page"))
				{
					window.location.reload(true);
				}
				else
				{
					element.html('Report');
				}
			}
		});
	});
	$(document).on('click','#reportAr',function() {
		var element=$(this);
		element.html('<div class="ld ld-ring ld-spin-fast"></div>');
		var arid=$('#aridR').val();
		var reportedReason=$('.reportSelectedCheckboxesar:checked').val();
		if (reportedReason==undefined)
		{
			alert('Please select a reason');
			return false;
		}
		
		var fd = new FormData(); 
		fd.append('arid',arid);
		fd.append('reportedReason',reportedReason);
		fd.append(csrfName,csrfHash);
		$.ajax({
			type:'POST',
			url:'<?php echo base_url()."post-a-report-areply"?>',
			type: "POST",
			data : fd,
			processData: false,
			contentType: false,
			success: function(response) 
			{
				var response=$.parseJSON(response);
				if (response['type']==1)
				{
					alert(response['html']);
					$('.reportar[arid='+arid+']').addClass('active');
					$('#reportAModal').modal('toggle');
				}
				else if (response['type']==2)
				{
					$('#signupModal').modal();
				}
				else
				{
					alert(response['html']);
				}
				
				element.html('Report');
			},
			error: function (xhr, data, error) {
				if (window.confirm("This page is expired , Please click Yes to reload the page"))
				{
					window.location.reload(true);
				}
				else
				{
					element.html('Report');
				}
			}
		});
	});
	$(document).on('click','.loadmore-sqar-btn',function() {
		var element=$(this);
		element.html('<div class="ld ld-ring ld-spin-fast"></div>');
		var answerid=element.attr('answerid');
		var next=element.attr('value');
		var fd = new FormData(); 
		fd.append('next',next);
		fd.append('answerid',answerid);
		fd.append(csrfName,csrfHash);
		$.ajax({
			type:'POST',
			url:'<?php echo base_url()."load-more-mqar"?>',
			type: "POST",
			data : fd,
			processData: false,
			contentType: false,
			success: function(response) 
			{
				var response=$.parseJSON(response);
				if (response['type']==1)
				{
					var questionReplies=response['result'];
					$('#'+answerid+'-answerReplies').append(questionReplies);
					if (response['loadMoreH']==1)
					{
						element.parent().html('');
					}
					else
					{
						$('.loadmore-sqar-btn[answerid='+answerid+']').val(response['next']);
						element.html('Load More');
					}
				}
				else if (response['type']==2)
				{
					$('#signupModal').modal();
				}
				else
				{
					alert(response['html']);
				}
			},
			error: function (xhr, data, error) {
				if (window.confirm("This page is expired , Please click Yes to reload the page"))
				{
					window.location.reload(true);
				}
				else
				{
					element.html('Load More');
				}
			}
		});
		
		
	});
	function animateAwnser(target)
	{
		$('html, body').animate({
			scrollTop: $(target).offset().top
		}, 500);
	}
	<?php if (isset($_GET['ref'])) {?>
		animateAwnser("#submitForm");
	<?php } ?>
	$(document).on('click','.reply-answer,.cancelReplyAnswer',function(e) {
		var answerId=$(this).attr('answerid');
		$("#"+answerId+'-answerReplyInput').toggleClass('d-none');
	});
	$(document).on('click','.edit-reply-answer',function() {
		var answerid=$(this).attr('answerid');
		var answer=$('#answer-description-'+answerid).html();
		// $('#editAnswer').closest(".jqte").find(".jqte_editor").eq(0).html(answer);
		CKEDITOR.instances.editAnswer.setData(answer);
		$('#answerEditId').val(answerid);
		$('#replyEditQuestion').modal();
	});
	$(document).on('click','#updateAnswer',function() {
		var element=$(this);
		element.html('<div class="ld ld-ring ld-spin-fast"></div>');
		var answerid=$('#answerEditId').val();
		var answer=CKEDITOR.instances.editAnswer.getData();
		var fd = new FormData();
		var question=<?php echo $question['qid'];?>;
		fd.append('answerid',answerid);
		fd.append('answer',answer);
		fd.append(csrfName,csrfHash);
		$.ajax({
			type:'POST',
			url:'<?php echo base_url()."post-edit-answer"?>',
			type: "POST",
			data : fd,
			processData: false,
			contentType: false,
			success: function(response) 
			{
				var response=$.parseJSON(response);
				if (response['type']==1)
				{
					alert(response['html']);
					answer=answer.replace(/script/g, "removed");
					$('#answer-description-'+answerid).html(answer);
					$('#replyEditQuestion').modal('toggle');
					animateAwnser('#answer-main-head-'+answerid);
				}
				else if (response['type']==2)
				{
					$('#signupModal').modal();
				}
				else
				{
					alert(response['html']);
				}
				element.html('Update');
			},
			error: function (xhr, data, error) {
				if (window.confirm("This page is expired , Please click Yes to reload the page"))
				{
					window.location.reload(true);
				}
				else
				{
					element.html('Update');
				}
			}
		});
	});
	$(document).on('click','.addReplyAnswer',function() {
		var element=$(this);
		element.html('<div class="ld ld-ring ld-spin-fast"></div>');
		var answerid=$(this).attr('answerid');
		var textareaT=$('#'+answerid+'-answerReplyInput').find('.reply');
		var answerReply=textareaT.val();
		var fd = new FormData();
		var question=<?php echo $question['qid'];?>;
		fd.append('answerReply',answerReply);
		fd.append('answerid',answerid);
		fd.append('question',question);
		fd.append(csrfName,csrfHash);
		$.ajax({
			type:'POST',
			url:'<?php echo base_url()."post-answer-reply"?>',
			type: "POST",
			data : fd,
			processData: false,
			contentType: false,
			success: function(response) 
			{
				var response=$.parseJSON(response);
				if (response['type']==1)
				{
					var replyHtml=response['html'];
					textareaT.val('');
					$("#"+answerid+'-answerReplyInput').toggleClass('d-none');
					$("#"+answerid+'-answerReplies').prepend(replyHtml);
				}
				else if (response['type']==2)
				{
					$('#signupModal').modal();
				}
				else
				{
					alert(response['html']);
				}
				
				element.html('Reply');
			},
			error: function (xhr, data, error) {
				if (window.confirm("This page is expired , Please click Yes to reload the page"))
				{
					window.location.reload(true);
				}
				else
				{
					element.html('Reply');
				}
			}
		});
	});
	$(document).on('click','.voteQuestion',function(e) {
		e.preventDefault();
		var element=$(this);
		element.removeClass('voteQuestion');
		var question=<?php echo $question['qid'];?>;
		var votesCount=parseFloat($('.votesCount-'+question).html().trim());
		if ($(this).hasClass('active'))
		{
			if (votesCount!=0)
			{
				return false;
			}
		}
		var type=$(this).attr('type');
		var fd = new FormData(); 
		fd.append('type',type);
		fd.append('question',question);
		fd.append(csrfName,csrfHash);
		$.ajax({
			type:'POST',
			url:'<?php echo base_url()."vote-manage-question"?>',
			type: "POST",
			data : fd,
			processData: false,
			contentType: false,
			success: function(response) 
			{
				var response=$.parseJSON(response);
				if (response['type']==1)
				{
					$('.voteQuestion[qid='+question+']').removeClass('active');
					element.addClass('active');
					
					if (type==0)
					{
						votesCount--;
					}
					else
					{
						votesCount++;
					}
					
					$('.votesCount-'+question).html(votesCount);
				}
				else if (response['type']==2)
				{
					$('#signupModal').modal();
				}
				else
				{
					alert(response['html']);
				}
				element.addClass('voteQuestion');
			},
			error: function (xhr, data, error) {
				if (window.confirm("This page is expired , Please click Yes to reload the page"))
				{
					window.location.reload(true);
				}
				else
				{
					element.addClass('voteQuestion');
				}
			}
		});
	});
	
	$(document).on('click','.answerVote',function(e) {
		e.preventDefault();
		var element=$(this);
		element.removeClass('answerVote');
		var qaid=$(this).attr('qaid');
		var votesCount=parseFloat($('.votes-answer-'+qaid).html().trim());
		if ($(this).hasClass('active'))
		{
			if (votesCount!=0)
			{
				return false;
			}
		}
		var type=$(this).attr('type');
		var fd = new FormData(); 
		fd.append('type',type);
		fd.append('qaid',qaid);
		fd.append(csrfName,csrfHash);
		$.ajax({
			type:'POST',
			url:'<?php echo base_url()."vote-manage-answer"?>',
			type: "POST",
			data : fd,
			processData: false,
			contentType: false,
			success: function(response) 
			{
				var response=$.parseJSON(response);
				if (response['type']==1)
				{
					$('.answerVote[qaid='+qaid+']').removeClass('active');
					element.addClass('active');
					
					if (type==0)
					{
						votesCount--;
					}
					else
					{
						votesCount++;
					}
					$('.votes-answer-'+qaid).html(votesCount);
				}
				else if (response['type']==2)
				{
					$('#signupModal').modal();
				}
				else
				{
					alert(response['html']);
				}
				element.addClass('answerVote');
			},
			error: function (xhr, data, error) {
				if (window.confirm("This page is expired , Please click Yes to reload the page"))
				{
					window.location.reload(true);
				}
				else
				{
					element.addClass('answerVote');
				}
			}
		});
	});
	
	$(document).on('click','.voteQReply',function(e) {
		e.preventDefault();
		var element=$(this);
		element.removeClass('voteQReply');
		var qrid=$(this).attr('qrid');
		var votesHtml=$('.voteQReplyCount-'+qrid).html().trim();
		
		if (votesHtml.length==0)
		{
			votesCount=0;
		}
		else
		{
			votesCount=parseFloat(votesHtml);
		}
		
		var type=1;
		if ($(this).hasClass('active'))
		{
			type=0;
		}
		
		var fd = new FormData(); 
		fd.append('qrid',qrid);
		fd.append('type',type);
		fd.append(csrfName,csrfHash);
		$.ajax({
			type:'POST',
			url:'<?php echo base_url()."vote-manage-questionR"?>',
			type: "POST",
			data : fd,
			processData: false,
			contentType: false,
			success: function(response) 
			{
				var response=$.parseJSON(response);
				if (response['type']==1)
				{
					if (type==0)
					{
						element.removeClass('active');
						
						votesCount--;
						if (votesCount<=0)
						$('.voteQReplyCount-'+qrid).html('');
						else
						$('.voteQReplyCount-'+qrid).html(votesCount);
					}
					else
					{
						votesCount++;
						$('.voteQReplyCount-'+qrid).html(votesCount);
						element.addClass('active');
					}
				}
				else if (response['type']==2)
				{
					$('#signupModal').modal();
				}
				else
				{
					alert(response['html']);
				}
				element.addClass('voteQReply');
			},
			error: function (xhr, data, error) {
				if (window.confirm("This page is expired , Please click Yes to reload the page"))
				{
					window.location.reload(true);
				}
				else
				{
					element.addClass('voteQReply');
				}
			}
		});
	});
	$(document).on('click','.voteAReply',function(e) {
		e.preventDefault();
		var element=$(this);
		element.removeClass('voteAReply');
		var arid=$(this).attr('arid');
		var votesHtml=$('.voteAReplyCount-'+arid).html().trim();
		
		if (votesHtml.length==0)
		{
			votesCount=0;
		}
		else
		{
			votesCount=parseFloat(votesHtml);
		}
		
		var type=1;
		if ($(this).hasClass('active'))
		{
			type=0;
		}
		
		var fd = new FormData(); 
		fd.append('arid',arid);
		fd.append('type',type);
		fd.append(csrfName,csrfHash);
		$.ajax({
			type:'POST',
			url:'<?php echo base_url()."vote-manage-AnswersR"?>',
			type: "POST",
			data : fd,
			processData: false,
			contentType: false,
			success: function(response) 
			{
				var response=$.parseJSON(response);
				if (response['type']==1)
				{
					if (type==0)
					{
						element.removeClass('active');
						
						votesCount--;
						if (votesCount<=0)
						$('.voteAReplyCount-'+arid).html('');
						else
						$('.voteAReplyCount-'+arid).html(votesCount);
					}
					else
					{
						votesCount++;
						$('.voteAReplyCount-'+arid).html(votesCount);
						element.addClass('active');
					}
				}
				else if (response['type']==2)
				{
					$('#signupModal').modal();
				}
				else
				{
					alert(response['html']);
				}
				element.addClass('voteAReply');
			},
			error: function (xhr, data, error) {
				if (window.confirm("This page is expired , Please click Yes to reload the page"))
				{
					window.location.reload(true);
				}
				else
				{
					element.addClass('voteAReply');
				}
			}
		});
	});
	
	$(document).on('click','#submitImages',function(){
		<?php if (checksession()) {?>
		$('#postImages').modal();
		<?php } else {?>
		$('#signupModal').modal();
		<?php }?>
	});
	$(document).on('click','#uploadPic',function(e) {
		
			var image  =  $('#imageFile').val();
			if (image == '') {
				alert('Please select an image to upload');
				return false;
			}
			var element=$(this);
			var size  =  $('#imageFile')[0].files[0].size;
			var ext =  image.substr( (image.lastIndexOf('.') +1) );
			if (ext=='jpg' || ext=='jpeg' || ext=='png' || ext=='gif' || ext=='PNG' || ext=='JPG' || ext=='JPEG')
			{
				if (size<=1000000)
				{
					element.html('<div class="ld ld-ring ld-spin-fast"></div>');
					$('#successImageUploaded').html('').addClass('d-none');
					$('#successImageUploadedDesc').addClass('d-none');
					var fd = new FormData();
					fd.append('image', $('#imageFile')[0].files[0]);
					fd.append(csrfName,csrfHash);
					$.ajax({
						type:'POST',
						url:'<?php echo base_url()."post-images-to-embed"?>',
						type: "POST",
						data : fd,
						processData: false,
						contentType: false,
						success: function(response) 
						{
							var response=$.parseJSON(response);
							if (response['type']==1)
							{
								alert(response['html']);
								$('#successImageUploaded').html(response['link']).removeClass('d-none');
								$('#successImageUploadedDesc').removeClass('d-none');
							}
							else if (response['type']==2)
							{
								$('#signupModal').modal();
							}
							else
							{
								alert(response['html']);
							}
							element.html('Upload');
						},
						error: function (xhr, data, error) {
							if (window.confirm("This page is expired , Please click Yes to reload the page"))
							{
								window.location.reload(true);
							}
						}
					});
				}
				else
				{
					alert('File size is too big');
					$('#successImageUploaded').html('').addClass('d-none');
					$('#successImageUploadedDesc').addClass('d-none');
					return false;
				}
			}
			else
			{
				alert('Please upload only images with jpg,jpeg,png,gif,PNG,JPG,JPEG');
				return false;
			}
		});
</script>