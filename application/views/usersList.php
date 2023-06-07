<?php 
$this->load->view('includes/head');?>
<style>
.filters.active{
	background-color: #fff;
color: #0888f1;
border-radius: 0px;
margin: 0px 2px;
border-bottom: 4px solid #f39c12;
}
</style>

<?php 
$this->load->view('includes/header');
?>
<div class="main-body">
	<div class="container custom py-5">	
	
		<div class="row">
			<div  class="col-md-8 col-lg-9">
				<div class="main-heading-tags">
					<div class="row">
						<div class="col-5 col-md-4 col-lg-5 col-xl-6">
							<h2 class="heading-tags mb-0">Users</h2>
						</div>
						<div class="col-7 col-md-8 col-lg-7 col-xl-6">
							 <!-- Tab panes -->
							<ul class="nav nav-pills pull-right tags" role="tablist">
								<li type="reputation" class="filters active nav-item">
									<a class="nav-link ">Reputation</a>
								</li>
								<li type="new" class="filters nav-item">
									<a class="nav-link">New Users</a>
								</li>
								<li type="voters" class="filters nav-item">
									<a class="nav-link">Voters</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				 
				<div class="tab-content">
					<div id="home2" class=" tab-pane active px-0"><br>
						<div class="main-user-list">
							<ul id="usersSec" class="row">
								<?php if (count($getAllUsers)>0) {?>
								<?php foreach ($getAllUsers as $index=>$value) {?>
									<li class="user-item col-md-4 col-xs-6">
										<span class="user-auther user">
											<a href="<?php echo base_url()."profile/".$value['userid'];?>">
											<img src="<?php echo base_url()."images/".$value['image'];?>" class="avatar users" alt=""> 
											</a>
										</span>
										<div class="left-info">
											<a href="<?php echo base_url()."profile/".$value['userid'];?>">
												<span class="display_name"><?php echo $value['name'];?></span>
											</a>
											<?php if (strlen($value['location'])>0) {?>
											<span class="location users">
												<i class="fa fa-map-marker"></i><?php echo $value['location'];?>
											</span>
											<?php } ?>
											
											<div class="question-cat">
												<span class="points">
													<?php echo $value['votes'];?> Points ,<?php echo $value['voted'];?> voted
												</span>
											</div>
										</div>
										<div class="left-info ml-0 d-block  secund">
											
											
											<?php $cats=$this->UserModel->getUserCategoryNames($value['userid']);
											$total=count($cats);
											if ($total>0) {?>
												<div class="question-cat tagcloud">
													<span class="points">
														<?php foreach ($cats as $indexCat=>$cat) {?>
															<a href="<?php echo base_url()."categories/".$cat['permalink'];?>"><?php echo $cat['name']?></a>
														<?php 
														echo ($indexCat+1)!=$total?",":"";
														} ?>
													</span>
												</div>
											<?php } ?>
										</div>
									</li>
								<?php } 
								 } else {?>
								<div class="record-not-found">
									<i class="fa fa-frown-o" aria-hidden="true" style=""></i>
									<h2 class="heading-error" style="">No users Found</h2>
								</div>
								<?php } ?>
							</ul>
							<div class="loadmore-user text-center">
								<?php if ($totalUsers>$fetchedUsersCount) {?>
									<button class="btn btn-primary custom   loadmore-users-btn comnt-q  running mt-4" value="<?php echo $next;?>">
									Load More
									</button>
								<?php } ?>
							</div>
						</div>
					</div>
					
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
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('includes/footer');?>	
<script type="text/javascript" src="<?php echo base_url()."plugins/search/search.js"?>"></script>
<script>
var csrfName="<?php echo $this->security->get_csrf_token_name();?>";
var csrfHash="<?php echo $this->security->get_csrf_hash();?>";

function getUsers(nextR)
{
	$('.loadmore-users-btn').html('<div class="ld ld-ring ld-spin-fast"></div>');
	var search=$('#search').val();
	var filter=$('.filters.active').attr('type');
	var fd = new FormData();
	fd.append('next',nextR);
	fd.append('search',search);
	fd.append('filters',filter);
	fd.append(csrfName,csrfHash);
	$.ajax({
		type:'POST',
		url:'<?php echo base_url()."load-more-users"?>',
		type: "POST",
		data : fd,
		processData: false,
		contentType: false,
		success: function(response) 
		{
			var response=$.parseJSON(response);
			if (response['type']==1)
			{
				var result=response['result'];
				if (nextR>0)
				{
					$('#usersSec').append(result);
				}
				else
				{
					$('#usersSec').html(result);
				}
				$('.loadmore-users-btn').html('Load More');
				if (response['loadMoreH']==1)
				{
					$('.loadmore-user').addClass('d-none');
				}
				else
				{
					if ($('.loadmore-user').hasClass('d-none'))
					{
						$('.loadmore-user').removeClass('d-none');
					}
					$('.loadmore-users-btn').val(response['next']);
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
}


$(document).on('click','.filters',function() {
	$('.filters').removeClass('active');
	$(this).addClass('active');
	getUsers(0);
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
    getUsers(0);
  }, 400 );
});

$(document).on('click','.loadmore-users-btn',function() {
	var next=$(this).attr('value');
	getUsers(next);
});
</script>