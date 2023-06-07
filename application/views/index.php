<?php 
$this->load->view('includes/head');
$this->load->view('includes/header');
?>
<!-- <div id="preloader" class="containers">
	<svg class="pre loader" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 340 340"> -->
		<!-- <circle cx="170" cy="170" r="160" stroke="#fff"></circle>-->
		 <!-- <circle cx="170" cy="170" r="135" stroke="#007ee5"></circle>
		 <circle cx="170" cy="170" r="110" stroke="#fff"></circle>
		 <circle cx="170" cy="170" r="85" stroke="#007ee5"></circle>
	</svg>
</div>  -->
	<div class="main-body">
		<div class="upper-search"> 
			<div class="container custom">
				<div class="row justify-content-sm-center">
					<div class="col-sm-11 col-md-10 col-lg-10">
						<h3 class="heading-main">
							Let's Come Together....!
						</h3>
						<!-- <p class="sub-heading">AnsWiz is the largest online community for programmers to learn, share their knowledge and build their careers.</p> -->
					</div>
					<div class="col-sm-11 col-md-7">
						<div class="inner-search row">
							<input type="text" id="search" class="col-9 col-sm-10 col-md-11  main-search" placeholder="Search">
								<div id="loaderSearch" class="d-none loader-main-input">
									<!-- Loader 5 -->
									<div class=" loader-5 center"><span></span></div>
								</div>
								<!-- searchBtn -->
							<button id="" type="button" class="col-3 col-sm-2 col-md-1  btn btn-search-upper"><a href="<?php echo base_url()."welcome/asearch"?>"><i class="icon ion-md-search"></i></a></button>
							<button id="clearSearch" type="button" class="d-none close-search"><span><i class="fa fa-times-circle" aria-hidden="true"></i></span></button>
							<div id="searchDropdown" class="search-drpdon-main d-none"></div> 
						</div>
						<?php 
						if ($siteSettings['bannerAdEnable']==1) {
							if (strlen($siteSettings['bannerAd'])>0) {?>
								<div class="row">
									<div class="col-md-12 px-0 banner-header-add mt-2">
										<div id="cbprotect">									
											<?php echo ($siteSettings['bannerAd']);?>
										</div>
									</div>
								</div>
							<?php } 
						}?>
					</div>
				</div>
			</div>
		</div> 
		<div class="container custom py-5">
			<div class="row">
				<div class="col-md-2 col-lg-2">
					<?php 
$this->load->view('includes/sidebar');
?>
				</div>
				<div  class="col-md-7 col-lg-7">
					<div class="inner-question main">
						<?php foreach ($getAllQuestions as $index=>$question) {?>
							<article  class="article-question article-post clearfix question-type-normal home">
								<div class="single-inner-content">
									<div class="question-inner row">
										<div class="col-md-12 col-lg-3 col-xl-2 px-lg-1 d-none container-fluid">
											<div class="row">
												<div class="col-6 question-image-vote px-sm-0 vote-bg">
													<div class="vote-count text-center"><?php echo $question['votes'];?> <span>Vote</span></div>
												</div>
												<div class="col-6 question-image-vote px-sm-0 text-center ans-bg">
													<div class="vote-count text-center"><a href="#"><?php echo $question['awnsers'];?></a> <span>Answer</span></div>
												</div>
												<div class="col-6 question-image-vote px-sm-0 text-center ans-bg">
													<div class="vote-count text-center"><a href="#"><?php echo $question['views'];?></a> <span>Views</span></div>
												</div> 
											</div>
											<div class="question-content question-content-first d-inline-block d-md-none">
												<header class="article-header">
													<div class="question-header">
														<div class="post-meta">
															<span class="post-date" itemprop="dateCreated" >
																Asked: <span class="entry-date published">
																	<?php echo $askTime=date('M d,Y',strtotime($question['on']));?>
																</span>
															</span>
															<span class="byline">
																<span class="post-cat">In: 
																	<a href="<?php echo $catpermaQ=base_url()."categories/".$question['catperma'];?>">
																		<?php echo $question['categoryName'];?>
																	</a>
																</span>
															</span>
														</div>
													</div>
												</header>
											</div>
										</div>
										<div class="col-md-12 col-lg-9 col-xl-9">
											<div class="question-content question-content-first">
												<h2 class="post-title">
													<a class="post-title" href="<?php echo base_url()."questions/".$question['qid']."/".$question['permalink'];?>" rel="bookmark">
													<?php echo $question['title'];?></a></h2>
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
													
														<div class="question-header">
															<div class="post-meta">
																<span class="post-date" itemprop="dateCreated">Asked: <span class="entry-date published"><?php echo $askTime;?></span>
																</span>
																<span class="byline">
																	<span class="post-cat">In:<a href="<?php echo $catpermaQ;?>"><?php echo $question['categoryName'];?></a></span>
																</span>
															</div>
														</div>
												
												  <a class="meta-answer dropdown pull-right d-none" href="<?php echo base_url()."questions/".$question['qid']."/".$question['permalink']."?ref=anwser";?>">Answer</a>
												</footer>
										</div>
									</div>
									<!--dropdown-answer-->
								</div>
							</article> 
						<?php } ?>
						<?php if (count($getAllQuestions)>0) {?>
							<div class="text-center">
								<a class="btn btn-viewall-index w-100" href="<?php echo base_url()."questions";?>">View All Question</a>
							</div>
						<?php } else {?>
						<div class="record-not-found">
							<i class="fa fa-frown-o" aria-hidden="true" style=""></i>
							<h2 class="heading-error" style="">No Questions Found</h2>
						</div>
						<?php } ?>
					</div>
				</div>
				<div class="col-md-3 col-lg-3">
					<section  class="widget stats-widget">
						<div class="widget-wrap">
							<ul class="stats-inner m-0 p-0">
								<li class="stats-questions">
									<div>
										<span class="stats-text">Questions</span><span class="stats-value"><?php echo $stats['totalQuestions'];?></span>
									</div>
								</li>
								<li class="stats-answers">
									<div><span class="stats-text">Answers</span><span class="stats-value"><?php echo $stats['totalAnswers'];?></span></div>
								</li>
								<li class="stats-best_answers">
									<div><span class="stats-text">Best Answers</span><span class="stats-value"><?php echo $stats['totalVotedAnswers'];?></span></div>
								</li>
								<li class="stats-users">
									<div><span class="stats-text">Users</span><span class="stats-value"><?php echo $stats['totalUsers'];?></span></div>
								</li>
							</ul>
						</div>	
					</section>
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
							<?php foreach ($getPopularQuestions as $index=>$value) {?>
								<li>
									<div class="questions-side"><span class="box-count"><?php echo $value['votes'];?></span>
										<h3><a href="<?php echo base_url()."questions/".$value['qid']."/".$value['permalink'];?>"><?php echo $value['title'];?></a></h3>
										<a class="post-meta-comment" href=""><i class="icon ion-md-chatboxes"></i> <?php echo $value['awnsers'];?> Answers</a>
									</div>
								</li>
							<?php } ?>
						</ul>
					</section>
					<?php } 
					
					//if (count($getAllJobs)>0) {?>
					<!--<section class="trendding-tags widget">
						<h2 class="widget-title"><i class="icon ion-md-help"></i> Popular Jobs	</h2>
						<ul class="popular-qs pl-0">
							<?php //foreach ($getAllJobs as $index=>$value) {?>
								<li>
									<div class="questions-side">
										<h3><a href="<?php// echo base_url()."questions/".$value['id'];?>"><?php //echo $value['job_title'];?></a><span class="box-count">(<?php echo $value['job_category'];?>)</span></h3>
										<a class="post-meta-comment" href=""><i class="icon ion-md-chatboxes"></i> <?php //echo $value['companyname'];?></a>
									</div>
								</li>
							<?php //} ?>
						</ul>
					</section>-->
					<?php //} 
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
					<?php }?>
				
			</div>
		</div>
	</div>
	<button id='toTop' class="back-totop"><i class="fa fa-angle-up"></i></button>
	</div>
<?php $this->load->view('includes/footer');?>	
<script>
var csrfName="<?php echo $this->security->get_csrf_token_name();?>";
var csrfHash="<?php echo $this->security->get_csrf_hash();?>";

$(document).ready(function() {
	$('#preloader').fadeOut('slow',function() {$(this).remove();});
});

// go_to_top
$(window).scroll(function() {
	if ($(this).scrollTop() >= 400) {   
		$('#toTop').fadeIn(200);
	} else {
		$('#toTop').fadeOut(200);
	}
}); 
$('#toTop').click(function() { 
	$('body,html').animate({
		scrollTop : '0px'                  
	}, 800);  
	return false; 
});

var delay = (function() {
  var timer = 0;
  return function(callback, ms) {
  clearTimeout (timer);
  timer = setTimeout(callback, ms);
 };
})();
function search()
{  
	var search=$('#search').val().trim();
	if (search.length==0)
	{
		$('#searchDropdown').addClass('d-none');
		$('#clearSearch').addClass('d-none');
		return false;
	}
	$('#clearSearch').addClass('d-none');
	$('#loaderSearch').removeClass('d-none');
	var fd = new FormData();
	fd.append('search',search);
	fd.append(csrfName,csrfHash);
	$.ajax({
		type:'POST',
		url:'<?php echo base_url()."search-main-page"?>',
		type: "POST",
		data : fd,
		processData: false,
		contentType: false,
		success: function(response) 
		{
			var response=$.parseJSON(response);
			if (response['type']==1)
			{
				var result=response['html'];
				$('#searchDropdown').html(result);
				$('#searchDropdown').removeClass('d-none');
				$('#clearSearch').removeClass('d-none');
			}
			else
			{
				alert(response['html']);
			}
			$('#loaderSearch').addClass('d-none');
		},
		error: function (xhr, data, error) {
			if (window.confirm("This page is expired , Please click Yes to reload the page"))
			{
				window.location.reload(true);
			}
			else
			{
				$('#loaderSearch').addClass('d-none');
			}
		}
	});
}
$(document).on('keyup keydown','#search',function() {
  delay(function() {
    search();
  }, 400 );
});
$(document).on('click','#searchBtn',function() {
  search();
});
$(document).on('click','#clearSearch',function() {
  $('#search').val('');
  $('#searchDropdown').html('');
  $(this).addClass('d-none');
 });


<?php if ($login==1) {?>
	$('#signupModal').modal();
<?php } ?>
<?php if ($login==2) {?>
	$('#forgetModalCon').modal();
<?php } ?>
</script>