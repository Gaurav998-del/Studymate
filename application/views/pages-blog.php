<!doctype html>
<html lang="en">

<head>

<!-- Basic Page Needs
================================================== -->
<title><?php echo $title;?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS
================================================== -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/colors/blue.css">
<style>
.widget-content:hover:before, .widget-content.active:before {
    opacity: .6;
    background:white;
}
</style>
<?php 
$this->load->view('includes/head');

?>

</head>

<body>

<!-- Wrapper -->
<div id="wrapper">

<!-- Header Container
================================================== -->
<?php
$this->load->view('includes/header');

?>
<div class="clearfix"></div>
<!-- Header Container / End -->



<!-- Content
================================================== -->
<div id="titlebar" class="white margin-bottom-30">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2>Blog</h2>
				<span>Featured Posts</span>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="#">Home</a></li>
						<li>Blog</li>
					</ul>
				</nav>
			</div>
		</div>
	</div>
</div>

<!-- Recent Blog Posts -->
<div class="section white padding-top-0 padding-bottom-60 full-width-carousel-fix">
	<div class="container">
		<div class="row">
			<div class="col-xl-12">
				<div class="blog-carousel">
               <?php foreach($blog as $b){
				   
				 
				   ?>
			   
			
					<a href="<?php echo base_url().'blog/'.str_replace(' ', '-',$b['id'].'/'. $b['blog_title']);?>" class="blog-compact-item-container">
						<div class="blog-compact-item">
							<img src="<?php echo base_url();?>images/<?php echo	$b['thumbnail'];?>" alt="">
							<span class="blog-item-tag"><?php echo	$b['blog_category'];?></span>
							<div class="blog-compact-item-content">
								<ul class="blog-post-tags">
									<li><?php echo $b['blog_date'];?></li>
								</ul>
								<h3><?php echo $b['blog_title'];?></h3>
								<p><?php echo substr($b['blog_description'],0,100);?></p>
							</div>
						</div>
					</a>
			   <?php } ?>
					


				</div>

			</div>
		</div>
	</div>
</div>
<!-- Recent Blog Posts / End -->


<!-- Section -->
<div class="section gray">
	<div class="container">
		<div class="row">
			<div class="col-xl-8 col-lg-8">

				<!-- Section Headline -->
				<div class="section-headline margin-top-60 margin-bottom-35">
					<h4>Recent Posts</h4>
				</div>
				<div id="bb">
				<?php foreach($blog as $b){?>
				<!-- Blog Post -->
				
				<a href="<?php echo base_url().'blog/'.str_replace(' ', '-',$b['id'].'/'. $b['blog_title']);?>" class="blog-post" id="blog-post" style="text-decoration:none;">
					<!-- Blog Post Thumbnail -->
					<div class="blog-post-thumbnail">
						<div class="blog-post-thumbnail-inner">
							<span class="blog-item-tag"><?php echo	$b['blog_category'];?></span>
							<img src="<?php echo base_url();?>images/<?php echo	$b['thumbnail'];?>" alt="">
						</div>
					</div>
					<!-- Blog Post Content -->
					<div class="blog-post-content">
						<span class="blog-post-date"><?php echo $b['blog_date'];?></span>
						<h3><?php echo $b['blog_title'];?></h3>
						<p><?php echo  substr($b['blog_description'],0,400);?> </p>
						
						
					</div>
					
					<!-- Icon -->
					<div class="entry-icon"></div>
				</a>
				
				<?php }?>
				<p><?php echo $links; ?></p>
				</div>
				<div class="posts"></div>
				
				<div class="clearfix"></div>
				

			</div>


			<div class="col-xl-4 col-lg-4 content-left-offset">
				<div class="sidebar-container margin-top-65">
					
					<!-- Location -->
					<div class="sidebar-widget margin-bottom-40">
						<div class="input-with-icon">
							<input id="ab" type="text" placeholder="Search" oninput="myFunction()">
							<i class="icon-material-outline-search"></i>
						</div>
					</div>

					<!-- Widget -->
					<div class="sidebar-widget">

						<h3>Post Categories</h3>
						<ul class="widget-tabs">
						<?php foreach($blog as $b){?>
							<li>
							<a href="<?php echo base_url().'blog/'.str_replace(' ', '-',$b['id'].'/'. $b['blog_category']);?>" class="widget-content active" style="text-decoration:none;">	<?php echo $b['blog_category'];?>
							
							</a>
							</li>
						<?php } ?>	
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="padding-top-40"></div>

</div>
<!-- Section / End -->

<!-- Footer
================================================== -->
<?php $this->load->view('includes/footer');?>	
<!-- Footer / End -->

</div>
<!-- Wrapper / End -->

<!-- Scripts
================================================== -->
<script src="<?php echo base_url();?>assets/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery-migrate-3.0.0.min.js"></script>
<script src="<?php echo base_url();?>assets/js/mmenu.min.js"></script>
<script src="<?php echo base_url();?>assets/js/tippy.all.min.js"></script>
<script src="<?php echo base_url();?>assets/js/simplebar.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap-slider.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap-select.min.js"></script>
<script src="<?php echo base_url();?>assets/js/snackbar.js"></script>
<script src="<?php echo base_url();?>assets/js/clipboard.min.js"></script>
<script src="<?php echo base_url();?>assets/js/counterup.min.js"></script>
<script src="<?php echo base_url();?>assets/js/magnific-popup.min.js"></script>
<script src="<?php echo base_url();?>assets/js/slick.min.js"></script>
<script src="<?php echo base_url();?>assets/js/custom.js"></script>


<!-- Snackbar // documentation: https://www.polonel.com/snackbar/ -->
<script>
// Snackbar for user status switcher
$('#snackbar-user-status label').click(function() { 
	Snackbar.show({
		text: 'Your status has been changed!',
		pos: 'bottom-center',
		showAction: false,
		actionText: "Dismiss",
		duration: 3000,
		textColor: '#fff',
		backgroundColor: '#383838'
	}); 
}); 
</script>
<script>
function myFunction() {
    var x = $('#ab').val();
	$.ajax({  
          url:'<?php echo base_url()."blog-search"?>',  
           method:"POST",  
           data:{'search':x},  
           dataType:"json",  
           success:function(data)  
           {  
		      document.getElementById("bb").style.display = "none";
               $(".posts").html(data);
            }  
            
      }); 
   
}
</script>
<script>
$(document).on('click','.deleteQuestion',function() {
						var qid=$(this).attr('data-qid');
						$.ajax({  
          url:'<?php echo base_url()."post-delete-blog"?>',  
           method:"POST",  
           data:{'qid':qid},  
           dataType:"json",  
           success:function(response)  
           {  
		      var response=$.parseJSON(response);
				if (response['type']==1)
				{
					
					window.location.reload(true);
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
							
	
	
	


</script>
</body>

</html>