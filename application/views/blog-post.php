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
    background: white;
}
</style>
<?php
$this->load->view('includes/head');
?>
</head>
<body class="gray">

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
<div id="titlebar" class="gradient">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2>Blog</h2>
				<span><?php echo $title;?></span>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs" class="dark">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">Blog</a></li>
						
					</ul>
				</nav>
			</div>
		</div>
	</div>
</div>

<!-- Post Content -->
<div class="container">
	<div class="row">
		
		<!-- Inner Content -->
		<div class="col-xl-8 col-lg-8">
			<!-- Blog Post -->
			<div class="blog-post single-post">
			<?php foreach($blog as $b){?>
				<!-- Blog Post Thumbnail -->
				<div class="blog-post-thumbnail">
					<div class="blog-post-thumbnail-inner">
					
						<img src="<?php echo base_url();?>images/<?php echo	$b['thumbnail'];?>" alt="">
					</div>
				</div>

				<!-- Blog Post Content -->
				<div class="blog-post-content">
					<h3 class="margin-bottom-10"><?php echo	$b['blog_title'];?></h3>

					<div class="blog-post-info-list margin-bottom-20">
						<a href="#" class="blog-post-info"><?php echo $b['blog_date'];?></a>
						
					</div>

					

					<blockquote class="margin-top-20 margin-bottom-20">
						<?php echo $b['blog_description'];?>
					</blockquote>

				</div>

			</div>
			<?php } ?>  
			<!-- Blog Post Content / End -->
			
			<!-- Blog Nav -->
			
			
			<!-- Related Posts -->
			<div class="row">
				
				
          <?php foreach($related as $rel){?>
				<!-- Blog Post Item -->
				<div class="col-xl-6">
					<a href="pages-blog-post.html" class="blog-compact-item-container">
						<div class="blog-compact-item">
							<img src="<?php echo base_url();?>images/<?php echo $rel['thumbnail'];?>" alt="">
							<span class="blog-item-tag"><?php echo $rel['blog_title'];?></span>
							<div class="blog-compact-item-content">
								<ul class="blog-post-tags">
									<li><?php echo $rel['blog_date'];?></li>
								</ul>
								
								<p><?php echo substr($rel['blog_description'],0,100);?></p>
							</div>
						</div>
					</a>
				</div>
		  <?php } ?>
				
			</div>
			<!-- Related Posts / End -->
				

			<!-- Comments -->
			<div class="row">
				<div class="col-xl-12">
					<section class="comments">
						<h3 class="margin-top-45 margin-bottom-0">Comments <span class="comments-amount">(<?php echo $count;?>)</span></h3>

						<ul>
						<?php foreach($comments as $com){?>
							<li>
							
								<div class="avatar"><img src="<?php echo base_url();?>assets/images/default-user.png" alt=""></div>
								<div class="comment-content"><div class="arrow-comment"></div>
									<div class="comment-by"><?php echo $com['name'];?><span class="date"><?php echo $com['date'];?></span>
										
									</div>
									<p><?php echo $com['comment'];?></p>
								</div>
							</li>
						<?php } ?>
						 </ul>

					</section>
				</div>
			</div>
			<!-- Comments / End -->


			<!-- Leava a Comment -->
			<div class="row">
				<div class="col-xl-12">
					
					<h3 class="margin-top-35 margin-bottom-30">Add Comment</h3>

					<!-- Form -->
					<form  method="post" id="add-comment">

						<div class="row">
							<div class="col-xl-6">
								<div class="input-with-icon-left no-border">
									<i class="icon-material-outline-account-circle"></i>
									<input type="text" class="input-text" name="commentname" id="namecomment" placeholder="Name" required/>
								</div>
							</div>
							<div class="col-xl-6">
								<div class="input-with-icon-left no-border">
									<i class="icon-material-baseline-mail-outline"></i>
									<input type="text" class="input-text" name="emailaddress" id="emailaddress" placeholder="Email Address" required/>
								</div>
							</div>
						</div>

						<textarea  name="comment-content" id="comments" cols="30" rows="5" placeholder="Comment"></textarea>
					</form>
					
					<!-- Button -->
					<button class="button button-sliding-icon ripple-effect margin-bottom-40 comment" type="submit" form="add-comment">Add Comment <i class="icon-material-outline-arrow-right-alt"></i></button>
					
				</div>
			</div>
			<!-- Leava a Comment / End -->

		</div>
		<!-- Inner Content / End -->


		<div class="col-xl-4 col-lg-4 content-left-offset">
			<div class="sidebar-container">
				
				
				<!-- Widget -->
				<div class="sidebar-widget">

					<h3>More Posts</h3>
					<ul class="widget-tabs">

						<!-- Post #1 -->
						 <?php foreach($blog as $b){?>
						<li>
							<a href="<?php echo base_url().'blog/'.str_replace(' ', '-',$b['id'].'/'. $b['blog_title']);?>" class="widget-content active" style="text-decoration:none;">
								
									<h5 style="color: black;margin-left:10px;padding-top:8px;">
									<?php echo substr(htmlspecialchars_decode($b['blog_description']),0,20);?></h5>
								
							</a>
						</li>
						
						 <?php } ?>
						<!-- Post #2 -->
						
						<!-- Post #3 -->
						
					</ul>

				</div>
				<!-- Widget / End-->


				<!-- Widget -->
			
				<!-- Widget -->
				<?php foreach($blog as $b){?>
				<input type="hidden" id="commentid" value="<?php echo $b['id'];?>"/>
				<div class="sidebar-widget">
					<h3>Tags</h3>
					<div class="task-tags">
						<?php $b=explode(",",$b['tags']);
						foreach($b as $g){?>
							<span><?php echo $g;?>
						
						</span>
						<?php } ?>
					</div>
				</div>
				<?php } ?>

			</div>
		</div>

	</div>
</div>

<!-- Spacer -->
<div class="padding-top-40"></div>
<!-- Spacer -->



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

</body>

<!-- Mirrored from www.vasterad.com/themes/hireo/pages-blog-post.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 29 Aug 2018 05:55:45 GMT -->
</html>

<Script>
	  
	    $('.comment').on('click', function(e){  
        e.preventDefault();
		var name=$('#namecomment').val();
		var email=$('#emailaddress').val();
		var comments=$('#comments').val();
		var commentid=$('#commentid').val();
		
      $.ajax({  
          url:'<?php echo base_url()."post-comment-blog"?>',  
           method:"POST",  
           data:{'name':name,'email':email,'comments':comments,'commentid':commentid},  
           dataType:"json",  
           success:function(data)  
           {  
                window.location.reload();
            }  
            
      });  
});
	  </script>
	  <script>
function myFunction() {
    var x = $('#dSuggest').val();
	alert(x);
   
}
</script>