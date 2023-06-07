<?php 
$this->load->view('includes/head');?>
<link rel="stylesheet" href="//www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<link rel="stylesheet" href="<?php echo base_url()."plugins/jqueryConfirm/jquery-confirm.css"?>">
<style>
#chartdiv {
  width: 100%;
  height: 350px;
}							
</style>
<?php
$this->load->view('includes/header');
?>	
	<div class="main-body">
		<div class="container custom py-5">
		<nav class="navbar navbar-expand-sm navbar-dark background-main-color profile">
			<!-- Brand/logo -->
			<a class="navbar-brand" href="">
				Profile
			</a>
			<!-- Links -->
			<ul class="navbar-nav nav nav-tabs  ml-auto profile" role="tablist">
				<li class="nav-item">
					<a href="<?php echo base_url()."profile/".$userid;?>" class="nav-link">User Profile</a>
				</li>
				<li id="activityTab" class="nav-item">
					<a class="nav-link active">Activity</a>
				</li>
				<?php if (getuserid()) {
					$g=getuserid();
					if(strval($g)==$userid){
					
					?>
				<li class="nav-item">
					<a href="<?php echo base_url()."profile/".$userid."/edit"?>" class="nav-link">Edit settings</a>
				</li>
				<?php } }?>
			</ul>
		</nav>
		<div class="content-wrapper">
			<div class="container-fluid px-md-0">
				<div class="row my-3 ">
					<div class="col-xl-3 col-md-6  my-2 my-xl-0">    
						<div class="d-inline-block profileupper-option">
							<h6 class="text-uper-profile">
								<span class="icon-upper"><i class="icon ion-md-help"></i></span>
								<div class="content">
									<div class="card-title is-tile text-right">
										Questions
										<div class="card-stat primary text-right"><?php echo $questionPosted;?></div>
									</div>
								</div>
								<div class="more">
									
								</div>
							</h6>
						</div>
					</div>
					<div class="col-xl-3 col-md-6  my-2 my-xl-0">    
						<div class="d-inline-block profileupper-option">
							<h6 class="text-uper-profile">
								<span class="icon-upper"><i class="icon ion-md-chatbubbles"></i></span>
								<div class="content">
									<div class="card-title is-tile text-right"> 
										Answers
										<div class="card-stat primary text-right"><?php echo $answersPosted;?> </div>
									</div>
								</div>
								<div class="more">
									
								</div>
							</h6>
						</div>
					</div>
					<div class="col-xl-3 col-md-6  my-2 my-xl-0">    
						<div class="d-inline-block profileupper-option">
							<h6 class="text-uper-profile">
								<span class="icon-upper"><i class="icon ion-md-eye"></i></span>
								<div class="content">
									<div class="card-title is-tile text-right">
										Profile Views
										<div class="card-stat primary text-right"><?php echo $user['views'];?></div>
									</div>
								</div>
								<div class="more">
									
								</div>
							</h6>
						</div>
					</div>
					<div class="col-xl-3 col-md-6  my-2 my-xl-0">    
						<div class="d-inline-block profileupper-option">
							<h6 class="text-uper-profile">
								<span class="icon-upper"><i class="icon ion-md-people"></i></span>
								<div class="content">
									<div class="card-title is-tile text-right">
										people reached
										<div class="card-stat primary text-right"><?php echo $user['peopleReached'];?></div>
									</div>
								</div>
								<div class="more">
									
								</div>
							</h6>
						</div>
					</div>
				</div>
					  <!-- Tab panes -->
					  <div class="main-inner-profiletext">
							<div class="row">
								<div class="col-md-9">
									<?php if ($totalReputationRecords>0) {?>
									<div id="chartdiv"></div>
									<?php } else {?>
									<div class="record-not-found">
										<i class="fa fa-frown-o" aria-hidden="true" style=""></i>
										<h2 class="heading-error" style="">No reputation record found</h2>
									</div>
									<?php } ?>
								</div>
								<div class="col-md-3">
									<div class="badges-number text-center">
										<span class="name">Badges</span>
										<span class="number"><?php echo $totalBadges=count($awardedBadges);?></span>
									</div>
									<?php if ($totalBadges>0) {?>
									<div class="rarest">
										<h4>Recent Badges</h4>
										<ul class="badges-list list-unstyled">
											<?php $r=1;foreach ($awardedBadges as $index=>$value) {
											if ($r==4)break;$r++;?>
											<li>
												<a title="bronze badge" class="badge"><span class="badge3"></span>&nbsp;<?php echo $value['name'];?></a>
												<span class="badge-date"><?php echo date('M d,Y',strtotime($value['on']));?></span>
											</li>
											<?php } ?>
										</ul>
									</div>
									<?php } ?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 text-sm-right">
									<ul class="nav nav-tabs d-inline-flex profile">
										<li class="questionsTab nav-item ">
											<a class="tabsp nav-link active" data-toggle="tab" href="#questionsTab">Questions</a>
										</li>
										<li class="answersTab nav-item ans-user  mr-md-1 mr-lg-2">
											<a class="tabsp nav-link " data-toggle="tab" href="#answersTab">Answers</a>
										</li>
										<li type="new" class="filters active nav-item first ml-md-1 ml-lg-2">
											<a class="nav-link">Newest</a>
										</li>
										<li type="votes" class="filters nav-item">
											<a class="nav-link">Votes</a>
										</li>
									</ul>
								</div>
							</div>
						
					<!-- Tab panes -->
					<div class="tab-content">
						<div class="tab-pane container active px-sm-0" id="questionsTab">
							<?php if (count($questions)>0) {?>
							<div>
								<ul id="questionsListActivity" class="top-question-profile">
									<?php foreach ($questions as $index=>$value) {?>
									<li>
										<div class="row">
											<div class="col-md-8 col-lg-9 col-xl-10">
												<span class="icons"><i class="icon ion-md-help"></i></span> <span class="vote"><?php echo $value['votes'];?></span>
												<a href="<?php echo base_url()."questions/".$value['qid']."/".$value['permalink'];?>" class="question-text"><?php echo $value['title'];?></a>
											</div>
											<div class="col-md-4 col-lg-3 col-xl-2 text-right">
												<?php if (checksession()) {if ($value['userid']==getuserid()) {?>
												<div class="btn-option-profile-active">
													<a class="btn btn-db-edit" href="<?php echo base_url()."questions/edit/".$value['qid']."/".$value['permalink'];?>">Edit</a>
													<a class="btn btn-db-edit deleteQp" qid="<?php echo $value['qid'];?>" ><span class="del-profile-act"><i class="fa fa-trash-o" aria-hidden="true"></i></span></a>
												</div>
												<?php } }?>
												<span class=" votedate"><?php echo date('M d,Y',strtotime($value['on']));?></span>
											</div>
										</div> 
									</li>
									<?php } ?>
								</ul>
							</div>
							<div class="loadmore-q-sec text-right viewall-qa">
								<?php if ($totalQuestionsCount>$now) {?>
									<span value="<?php echo $next;?>" class="loadmore-q-btn">Load More</span>
								<?php } ?>
							</div>
							<?php } else {?>
								<div class="record-not-found">
									<i class="fa fa-frown-o" aria-hidden="true" style=""></i>
									<h2 class="heading-error" style="">No Questions Found</h2>
								</div>
							<?php } ?>
						</div> 
						<div class="tab-pane container fade px-sm-0" id="answersTab">
						</div> 
						<div class="row">
							<div class="col-sm-12 col-md-6 px-0">
								<h3 class="heading-tags bordr-b">
									All Badges <span>(<?php echo $totalBadges?>)</span>
								</h3>
								<?php if ($totalBadges>0) {?>
									<div class="rarest">
										<ul class="badges-list list-unstyled">
											<?php foreach ($awardedBadges as $index=>$value) {?>
											<li>
												<a title="bronze badge" class="badge"><span class="badge3"></span>&nbsp;<?php echo $value['name'];?></a>
												<span class="badge-date"><?php echo date('M d,Y',strtotime($value['on']));?></span>
											</li>
											<?php } ?>
										</ul>
									</div>
								<?php } ?>
							</div>
							<div class="col-md-6"></div>
						</div>
						 
					</div>
					</div>
			</div>
		</div>
	</div>
</div>

<?php $this->load->view('includes/footer');?>	
<script type="text/javascript" src="<?php echo base_url()."plugins/jqueryConfirm/jquery-confirm.js"?>"></script>
<?php if ($totalReputationRecords>0) {?>
<script src="//www.amcharts.com/lib/3/amcharts.js"></script>
<script src="//www.amcharts.com/lib/3/serial.js"></script>
<script src="//www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<script src="//www.amcharts.com/lib/3/themes/light.js"></script>

<!-- Chart code -->
<script>
$(document).ready(function() {
	var chart = AmCharts.makeChart( "chartdiv", {
	  "type": "serial",
	  "theme": "light",
	  "marginRight": 40,
	  "marginLeft": 40,
	  "autoMarginOffset": 20,
	  "dataDateFormat": "YYYY-MM-DD",
	  "valueAxes": [ {
		"id": "v1",
		"axisAlpha": 0,
		"position": "left",
		"ignoreAxisWidth": true
	  } ],
	  "balloon": {
		"borderThickness": 1,
		"shadowAlpha": 0
	  },
	  "graphs": [ {
		"id": "g1",
		"balloon": {
		  "drop": true,
		  "adjustBorderColor": false,
		  "color": "#ffffff",
		  "type": "smoothedLine"
		},
		"fillAlphas": 0.2,
		"bullet": "round",
		"bulletBorderAlpha": 1,
		"bulletColor": "#FFFFFF",
		"bulletSize": 5,
		"hideBulletsCount": 50,
		"lineThickness": 2,
		"title": "red line",
		"useLineColorForBulletBorder": true,
		"valueField": "value",
		"balloonText": "<span style='font-size:18px;'>[[value]]</span>"
	  } ],
	  "chartCursor": {
		"valueLineEnabled": true,
		"valueLineBalloonEnabled": true,
		"cursorAlpha": 0,
		"zoomable": false,
		"valueZoomable": true,
		"valueLineAlpha": 0.5
	  },
	  "valueScrollbar": {
		"autoGridCount": true,
		"color": "#000000",
		"scrollbarHeight": 50
	  },
	  "categoryField": "date",
	  "categoryAxis": {
		"parseDates": true,
		"dashLength": 1,
		"minorGridEnabled": true
	  },
	  "export": {
		"enabled": true
	  },
	  "dataProvider":  [
	  <?php foreach ($reputationRecord as $index=>$value) {?>
		{
			"date": "<?php echo date('Y-m-d',strtotime($value['on']));?>",
			"value": <?php echo $value['reputation'];?>
		}<?php echo ($index+1)!=$totalReputationRecords?",":"";?>
	 <?php } ?>]
	});
});
</script>
<?php } ?>
<script>
var userid=<?php echo $userid;?>;

	$(document).ready(function() {
		var csrfName="<?php echo $this->security->get_csrf_token_name();?>";
		var csrfHash="<?php echo $this->security->get_csrf_hash();?>";
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
										window.location.reload(true);
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
		$(document).on('click','.deleteQp',function() {
			var qid=$(this).attr('qid');
			deleteQuestion(qid);
		});
		
		function deleteAnswer(qaid,qid)
		{
			$.confirm({
				title: 'Are you sure ?',
				content: 'You want to delete this Answer?',
				buttons: {
					deleteAnswer: {
						text: 'Delete Answer',
						action: function () {
							var that = this;
							var fd = new FormData();
							fd.append('question',qid);
							fd.append('answerid',qaid);
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
										window.location.reload(true);
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
		$(document).on('click','.deleteAp',function() {
			var qaid=$(this).attr('qaid');
			var qid=$(this).attr('qid');
			deleteAnswer(qaid,qid);
		});
		
		
		$(document).on('click','.loadmore-q-btn',function() {
			var next=$(this).attr('value');
			var type=$('.filters.active').attr('type');
			
			var fd = new FormData();
			fd.append('userid',userid);
			fd.append('type',type);
			fd.append('next',next);
			fd.append(csrfName,csrfHash);
			$.ajax({
				type:'POST',
				url:'<?php echo base_url()."load-more-q-profile"?>',
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
						$('#questionsListActivity').append(recentAwnsers);
						if (response['loadMoreH']==1)
						{
							$('.loadmore-q-sec').html('');
						}
						else
						{
							$('.loadmore-q-btn').attr('value',response['next']);
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
		$(document).on('click','.loadmore-a-btn',function() {
			var next=$(this).attr('value');
			var type=$('.filters.active').attr('type');
			var fd = new FormData();
			fd.append('userid',userid);
			fd.append('type',type);
			fd.append('next',next);
			fd.append(csrfName,csrfHash);
			$.ajax({
				type:'POST',
				url:'<?php echo base_url()."load-more-a-profile"?>',
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
						$('#answersListActivity').append(recentAwnsers);
						if (response['loadMoreH']==1)
						{
							$('.loadmore-a-sec').html('');
						}
						else
						{
							$('.loadmore-a-btn').attr('value',response['next']);
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
		
		$(document).on('click','.questionsTab',function(e) {
			var type=$('.filters.active').attr('type');
			var fd = new FormData(); 
			fd.append('type',type);
			fd.append('userid',userid);
			fd.append(csrfName,csrfHash);
			$.ajax({
				type:'POST',
				url:'<?php echo base_url()."post-get-profile-questions";?>',
				type: "POST",
				data : fd,
				processData: false,
				contentType: false,
				success: function(response) 
				{
					var response=$.parseJSON(response);
					if (response['type']==1)
					{
						$('#questionsTab').html(response['result']);
						$('#tabCount').html(response['count']);
						$('#tabType').html("Questions");
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
		$(document).on('click','.answersTabActivity',function(e) {
			var type=$('.filtersActivity.active').attr('type');
			var fd = new FormData(); 
			fd.append('type',type);
			fd.append('userid',userid);
			fd.append(csrfName,csrfHash);
			$.ajax({
				type:'POST',
				url:'<?php echo base_url()."post-get-profile-questions-all";?>',
				type: "POST",
				data : fd,
				processData: false,
				contentType: false,
				success: function(response) 
				{
					var response=$.parseJSON(response);
					if (response['type']==1)
					{
						$('#questionsTab').html(response['result']);
						$('#tabCount').html(response['count']);
						$('#tabType').html("Questions");
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
		
		$(document).on('click','.answersTab',function(e) {
			
			var type=$('.filters.active').attr('type');
			var fd = new FormData(); 
			fd.append('type',type);
			fd.append('userid',userid);
			fd.append(csrfName,csrfHash);
			$.ajax({
				type:'POST',
				url:'<?php echo base_url()."post-get-profile-answers";?>',
				type: "POST",
				data : fd,
				processData: false,
				contentType: false,
				success: function(response) 
				{
					var response=$.parseJSON(response);
					if (response['type']==1)
					{
						$('#answersTab').html(response['result']);
						$('#tabCount').html(response['count']);
						$('#tabType').html("Answers");
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
		
		$(document).on('click','.filters',function() {
			$('.filters').removeClass('active');
			$(this).addClass('active');
			$('.tabsp.active').trigger('click');
		});
	});
</script>