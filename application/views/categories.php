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
			<div class="col-md-3 col-lg-3">
				<?php
				$this->load->view('includes/sidebar');
				?>
				<!-- <section  class="widget stats-widget">
					<div class="widget-wrap">
						<div class="inner-search container-fluid side">
							<div class="row">
								<input id="search" type="text" class="col-9 col-sm-10 col-md-10  main-search" placeholder="Search"> 
								<button class="col-3 col-sm-2 col-md-2  btn btn-search-upper"><i class="icon ion-md-search"></i></button> 
							</div>
						</div>
					</div>	
				</section> -->
			</div>
			<div  class="col-md-9 col-lg-9">

				<div class="main-heading-tags">

					<div class="row">
						<div class="col-5 col-md-6 col-lg-8">
							<h2 class="heading-tags mb-0">Categories</h2>
						</div>
						<div class="col-7 col-md-6 col-lg-4">
							 <!-- Tab panes --> 
							<ul class="nav nav-pills pull-right tags" role="tablist">
								<li type="popular" class="filters active nav-item">
									<a class="nav-link" >Popular</a>
								</li>
								<!-- <li type="name" class="filters nav-item">
									<a class="nav-link">Name</a>
								</li>
								<li type="new" class="filters nav-item">
									<a class="nav-link">New</a>
								</li> -->
							</ul>
						</div>
					</div>
				</div>
				 		<section  class="widget stats-widget">
					<div class="widget-wrap">
						<div class="inner-search container-fluid side">
							<div class="row">
								<input id="search" type="text" class="col-9 col-sm-10 col-md-10  main-search" placeholder="Categories Filter"> 
								<button class="col-3 col-sm-2 col-md-2  btn btn-search-upper"><i class="icon ion-md-search"></i></button> 
							</div>
						</div>
					</div>	
				</section>
				<div class="tab-content">
					<div id="home2" class=" tab-pane active px-0"><br>
						<div class="main-tag-list">
							<div class="tags-list">
								<div class="wrap-tag-list">
									<div id="catsSec" class="row">
										<?php foreach ($categories as $index=>$value) {?>
										<div class="col-sm-6 col-md-4 col-lg-3">
											<div class="tag-item category">
												<a href="<?php echo base_url()."categories/".$value['permalink'];?>" class="q-tag category" data-toggle="popover" data-trigger="hover" data-content="<?php echo $value['description'];?>" data-placement="bottom"  data-html="true"><?php echo $value['catname'];?> </a> x <?php echo $value['totalPosts'];?> 
												<p><?php echo $value['description'];?></p>
												<div class="overlay-category-text"></div>
											</div>
										</div>
										<?php } ?>
									</div>
								</div>
							</div>
							<div class="loadmore-cats text-center">
								<?php if ($totalCategories>$fetchedCategories) {?>
									<button class="btn btn-primary custom   loadmore-cats-btn comnt-q  running mt-4" value="<?php echo $next;?>">
									Load More</button>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</div>
</div>
<?php 
	$this->load->view('includes/footer');
?>	
<script>
var csrfName="<?php echo $this->security->get_csrf_token_name();?>";
var csrfHash="<?php echo $this->security->get_csrf_hash();?>";
function getCategories(nextR)
{
	$('.loadmore-cats-btn').html('<div class="ld ld-ring ld-spin-fast"></div>');
	var search=$('#search').val();
	var filter=$('.filters.active').attr('type');
	var fd = new FormData();
	fd.append('next',nextR);
	fd.append('search',search);
	fd.append('filters',filter);
	fd.append(csrfName,csrfHash);
	$.ajax({
		type:'POST',
		url:'<?php echo base_url()."load-more-categories"?>',
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
					$('#catsSec').append(result);
				}
				else
				{
					$('#catsSec').html(result);
				}
				$('[data-toggle="popover"]').popover();   
				if (response['loadMoreH']==1)
				{
					$('.loadmore-cats').addClass('d-none');
				}
				else
				{
					if ($('.loadmore-cats').hasClass('d-none'))
					{
						$('.loadmore-cats').removeClass('d-none');
					}
					$('.loadmore-cats-btn').val(response['next']);
					$('.loadmore-cats-btn').html('Load More');
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
				$('.loadmore-cats-btn').html('Load More');
			}
		}
	});
}

$(document).on('click','.filters',function() {
	$('.filters').removeClass('active');
	$(this).addClass('active');
	getCategories(0);
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
    getCategories(0);
  }, 400 );
});

$(document).on('click','.loadmore-cats-btn',function() {
	var next=$(this).attr('value');
	getCategories(next);
});
$(document).ready(function() {
    $('[data-toggle="popover"]').popover();   
});

</script>
