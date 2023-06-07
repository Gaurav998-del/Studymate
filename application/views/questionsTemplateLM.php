<?php 
foreach ($getAllQuestions as $index=>$question) {?>
	<article  class="article-question article-post clearfix question-type-normal home">
		<div class="single-inner-content">
			<div class="question-inner row">
				<div class="col-md-12 col-lg-2 px-lg-1 d-none container-fluid">
					<div class="row">
						<div class="col-6 question-image-vote px-sm-0 vote-bg">
							<div class="vote-count text-center"><?php echo $question['votes'];?> <span>Vote</span></div>
						</div>
						<div class="col-6 question-image-vote px-sm-0 text-center ans-bg">
							<div class="vote-count text-center"><a href="#"><?php echo $question['awnsers'];?></a> <span>Answer</span></div>
						</div><div class="col-6 question-image-vote px-sm-0 text-center ans-bg">
							<div class="vote-count text-center"><a href="#"><?php echo $question['views'];?></a> <span>Views</span></div>
						</div>
					</div>
					<div class="question-content question-content-first d-inline-block d-none">
						<header class="article-header">
							<div class="question-header">
								<div class="post-meta"><span class="post-date" itemprop="dateCreated" datetime="April 19, 2018">Asked: <time class="entry-date published"><?php echo $askTime=date('M d,Y',strtotime($question['on']));?></time></span><span class="byline"><span class="post-cat">In: <a href="<?php echo $catpermaQ=base_url()."categories/".$question['catperma'];?>"><?php echo $question['categoryName'];?></a></span></span></div>
							</div>
						</header>
					</div>
				</div>
				<div class="col-md-12 col-lg-9 col-xl-9"> 
					<div class="question-content question-content-first">
						<h2 class="post-title"><a class="post-title" href="<?php echo base_url()."questions/".$question['qid']."/".$question['permalink'];?>" rel="bookmark"><?php echo $question['title'];?></a></h2>
					</div>
				
					<div class="question-content question-content-second">
						<div class="post-wrap-content">
						   <div class="tagcloud">
								<div class="question-tags">
									<i class="icon-tags"></i>
									<?php 
									$tags=explode(',',$question['tags']);
									foreach ($tags as $index=>$tag) {
									?>
									<a href="<?php echo base_url()."tags/".$tag;?>"><?php echo $tag;?></a>
									<?php } ?>
								</div>
						   </div>
						</div>
						<div class="wpqa_error"></div>
					</div>
				</div>
				<div class="col-md-12 col-lg-3 col-xl-3 px-lg-1 container-fluid">
					<div class="row mx-md-0">
						<div class="col-4 question-image-vote px-sm-1 px-md-2 vote-bg text-center">
							<div class="vote-count text-center"><span class="counter-num"><?php echo $question['votes'];?></span> <span>Vote</span></div>
						</div>
						<div class="col-4 question-image-vote px-sm-1 px-md-2 text-center ans-bg">
							<div class="vote-count text-center"><span class="counter-num"><?php echo $question['awnsers'];?></span> <span>Answer</span></div>
							
						</div>
						<div class="col-4 question-image-vote px-sm-1 px-md-2 text-center ans-bg">
							<div class="vote-count text-center"><span class="counter-num"><?php echo $question['views'];?></span> <span>Views</span></div>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<footer class="question-footer question-content">
						<header class="article-header">
							<div class="question-header">
								<div class="post-meta">
									<span class="post-date" itemprop="dateCreated" datetime="April 19, 2018">Asked: <time class="entry-date published"><?php echo $askTime=date('M d,Y',strtotime($question['on']));?></time>
									</span>
									<span class="byline">
										<span class="post-cat">In: <a href="<?php echo $catpermaQ=base_url()."categories/".$question['catperma'];?>"><?php echo $question['categoryName'];?></a></span>
									</span>
								</div>
							</div>
						</header>
					  <a class="meta-answer dropdown pull-right qs-all" href="<?php echo base_url()."questions/".$question['qid']."/".$question['permalink']."?ref=anwser";?>">Answer</a>
					  
					</footer>
				</div>
			</div>
			<!--dropdown-answer-->
		</div>
	</article>
<?php } ?>