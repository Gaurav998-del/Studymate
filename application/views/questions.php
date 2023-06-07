<?php 
$this->load->view('includes/head');
$this->load->view('includes/header');
?>	
	<div class="main-body">
		<div class="container custom pt-3 pb-5">
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
				<div class="col-md-2 col-lg-2">
					<?php
					$this->load->view('includes/sidebar');
				?>
				</div>
				<div  class="col-md-7 col-lg-7">
					<div class="inner-question main">
					<div id="questions">
						<?php 
						if (count($getAllQuestions)>0) {
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
														<div class="post-meta"><span class="post-date" itemprop="dateCreated">Asked: <span class="entry-date published"><?php echo $askTime=date('M d,Y',strtotime($question['on']));?></span></span><span class="byline"><span class="post-cat">In: <a href="<?php echo $catpermaQ=base_url()."categories/".$question['catperma'];?>"><?php echo $question['categoryName'];?></a></span></span></div>
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
												<!--<footer class="question-footer">
												   <a class="meta-answer dropdown pull-right" href="<?php echo base_url()."questions/".$question['qid']."/".$question['permalink']."?ref=anwser";?>">Answer</a>
												</footer>	-->
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
												<div class="article-header">
													<div class="question-header">
														<div class="post-meta">
															<span class="post-date" itemprop="dateCreated">Asked: <span class="entry-date published"><?php echo $askTime=date('M d,Y',strtotime($question['on']));?></span>
															</span>
															<span class="byline">
																<span class="post-cat">In: <a href="<?php echo $catpermaQ=base_url()."categories/".$question['catperma'];?>"><?php echo $question['categoryName'];?></a></span>
															</span>
														</div>
													</div>
												</div>
											  <a class="meta-answer dropdown pull-right qs-all" href="<?php echo base_url()."questions/".$question['qid']."/".$question['permalink']."?ref=anwser";?>">Answer</a>
											  
											</footer>
										</div>
									</div>
									<!--dropdown-answer-->
								</div>
							</article>
						<?php } ?>
						
						<?php if ($getAllQuestionsCount > count($getAllQuestions)) {?>
							<div class="loadmore-q text-center">
								<button class="btn btn-primary loadmore-q-btn" value="<?php echo $next;?>">
								Load More Questions
								</button>
							</div>
						<?php } ?>
						<input type="hidden" value="<?php echo $type;?>" id="selectedType">
						<?php 
						} else {?>
						<div class="record-not-found">
							<i class="fa fa-frown-o" aria-hidden="true" style=""></i>
							<h2 class="heading-error" style="">No Questions Found</h2>
						</div>
						<?php }?>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-lg-3">
					<section  class="widget stats-widget">
						<div class="widget-wrap">
							<div class="inner-search container-fluid side">
								<div class="row">
									<input type="text" id="search" class="col-9 col-sm-10 col-md-10 main-search" placeholder="Search"> 
									<button class="col-3 col-sm-2 col-md-2  btn btn-search-upper"><i class="icon ion-md-search"></i></button> 
								</div>
							</div>
						</div>
					</section>
					<?php if (count($getPopularQuestions)>0) {?>
					<section class="trendding-tags widget">
						<h2 class="widget-title"><i class="icon ion-md-help"></i> Popular Questions	</h2>
						<ul class="popular-qs pl-0">
							<?php foreach ($getPopularQuestions as $index=>$valuep) {?>
								<li>
									<div class="questions-side"><span class="box-count"><?php echo $valuep['votes'];?></span>
										<h3><a href="<?php echo base_url()."questions/".$valuep['qid']."/".$valuep['permalink'];?>"><?php echo $valuep['title'];?></a></h3>
										<a class="post-meta-comment" href=""><i class="icon ion-md-chatboxes"></i> <?php echo $valuep['awnsers'];?> Answers</a>
									</div>
								</li>
							<?php } ?>
						</ul>
					</section>
					<?php } 
					if (count($getPopularQuestionsTags)>0) {?>
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
					<?php } 
					if ($siteSettings['sidebarAdEnable']==1) {
						if (strlen($siteSettings['sidebarAd'])>0) {?>
						<div class="banner-side">
							<div id="cbprotect">
								<?php echo $siteSettings['sidebarAd'];?>
							</div>
						</div>
					<?php } 
					} ?>
				</div>
			</div>
		</div>
	</div>
<?php $this->load->view('includes/footer');?>
<script>
var csrfName="<?php echo $this->security->get_csrf_token_name();?>";
var csrfHash="<?php echo $this->security->get_csrf_hash();?>";

function search(next)
{
	$('.loadmore-q-btn').html('<div class="ld ld-ring ld-spin-fast"></div>');
	var search=$('#search').val();
	var selectedType=$('#selectedType').val();
	var tag="<?php echo isset($tagName)?$tagName:"";?>";
	var catid="<?php echo isset($catid)?$catid:"";?>";
	var fd = new FormData(); 
	fd.append('next',next);
	fd.append('selectedType',selectedType);
	fd.append('tag',tag);
	fd.append('search',search);
	fd.append('catid',catid);
	fd.append(csrfName,csrfHash);
	$.ajax({
		type:'POST',
		url:'<?php echo base_url()."load-more-q"?>',
		type: "POST",
		data : fd,
		processData: false,
		contentType: false,
		success: function(response) 
		{
			var response=$.parseJSON(response);
			if (response['type']==1)
			{
				var questions=response['result'];
				if (next>0)
				{
					$('.loadmore-q').before(questions);
				}
				else
				{
					$('#questions').html(questions);
				}
				if (response['loadMoreH']==1)
				{
					$('.loadmore-q').addClass('d-none');
				}
				else
				{
					$('.loadmore-q-btn').val(response['next']);
					if ($('.loadmore-q').hasClass('d-none'))
					$('.loadmore-q').removeClass('d-none');
					$('.loadmore-q-btn').html('Load More Questions');
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
				$('.loadmore-q-btn').html('Load More Questions');
			}
		}
	});
}
$(document).on('click','.loadmore-q-btn',function() {
	var next=$(this).attr('value');
	search(next);
});

var delay = (function() {
  var timer = 0;
  return function(callback, ms) {
  clearTimeout (timer);
  timer = setTimeout(callback, ms);
 };
})();

$(document).on('keyup keydown','#search',function() {
  delay(function() {
    search(0);
  }, 400 );
});
</script>