<?php 
$this->load->view('includes/head');?>
<?php
$this->load->view('includes/header');
?>	
	<div class="main-body">
		<div class="container custom pt-3 pb-5">
			<div class="row">
				<div  class="col-md-8 col-lg-9">
				<div class="main-motify-all">
					<?php 
					if (count($getAllNotifications)>0) {?>
					<ul id="notifications" class="all-notify pl-0 container-fluid">
					<?php foreach ($getAllNotifications as $index=>$value) {?>
							<li class="row inner-allnotify">
								<div class="col-8 col-sm-2 col-md-2 col-lg-2 col-xl-1">
									<?php $occuredTime=strtotime($value['on']);?>
									<div class="date-notify">
										<?php echo date('M',$occuredTime);?> <br/> <?php echo date('d',$occuredTime);?>
									</div>			
								</div>
								<div class="col-4 text-right d-sm-none mt-2">
									<time class="notify-timezone"><?php echo date('H:i',$occuredTime);?> <span><?php echo date('A',$occuredTime);?></span></time>
								</div>
								<div class="col-sm-8 col-md-8 col-lg-9 col-xl-10">
									<span class="notify-type"> <?php echo $value['title'];?></span>
									<div class="notify-allheading"><a href="<?php 
										$permalink=$value['nPerma'];
										$permalink=str_replace('(questionId)',$value['qid'],$permalink);
										$permalink=str_replace('(questionPerma)',$value['permalink'],$permalink);
										$permalink=str_replace('(userid)',$value['for'],$permalink);
										echo base_url().$permalink;?>"><?php $description=$value['description'];
										$description=str_replace('(questionName)',$value['questionTitle'],$description);
										$description=str_replace('(badgeName)',$value['badgeName'],$description);
										$description=str_replace('(reputation)',$value['reputation'],$description);
										echo $description;
										?></a>
										</div>
								</div>
								<div class="col-sm-2 col-md-2 col-lg-1 d-none d-sm-flex">
									<time class="notify-timezone"><?php echo date('H:i',$occuredTime);?> <span><?php echo date('A',$occuredTime);?></span></time>
								</div>
							</li>
					<?php } ?>
					</ul>
					<?php if ($getAllNotificationsCount > count($getAllNotifications)) {?>
						<div class="loadmore-n text-center">
							<button class="btn btn-primary loadmore-n-btn" value="<?php echo $next;?>">
							Load More Notifications
							</button>
						</div>
						<?php } ?>
					<?php 
						} else {?>
						<div class="record-not-found">
							<i class="fa fa-frown-o" aria-hidden="true" style=""></i>
							<h2 class="heading-error" style="">No Questions Found</h2>
						</div>
						<?php }?>
					</div>
				</div>
				<div class="col-md-4 col-lg-3">
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
					
					<?php } if (count($getPopularQuestionsTags)>0) {?>
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
					</section>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
<?php $this->load->view('includes/footer');?>
<script>
var csrfName="<?php echo $this->security->get_csrf_token_name();?>";
var csrfHash="<?php echo $this->security->get_csrf_hash();?>";

$(document).on('click','.loadmore-n-btn',function() {
	var next=$(this).attr('value');
	$('.loadmore-n-btn').html('<div class="ld ld-ring ld-spin-fast"></div>');
	var fd = new FormData(); 
	fd.append('next',next);
	fd.append(csrfName,csrfHash);
	$.ajax({
		type:'POST',
		url:'<?php echo base_url()."load-more-n"?>',
		type: "POST",
		data : fd,
		processData: false,
		contentType: false,
		success: function(response) 
		{
			var response=$.parseJSON(response);
			if (response['type']==1)
			{
				var notifications=response['result'];
				$('#notifications').append(notifications);
				if (response['loadMoreH']==1)
				{
					$('.loadmore-n').addClass('d-none');
				}
				else
				{
					$('.loadmore-n-btn').val(response['next']);
					$('.loadmore-n-btn').html('Load More Notifications');
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
				$('.loadmore-n-btn').html('Load More Notifications');
			}
		}
	});
});

</script>