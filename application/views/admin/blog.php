<?php 
$this->load->view('admin/includes/head');?>
<link rel="stylesheet" href="<?php echo base_url()."plugins/tags/jquery.tagsinput.css"?>">


<?php
$this->load->view('admin/includes/header');
$this->load->view('admin/includes/sidebar');
?>
  <!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
        Website Settings
        <small>Update</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url()."admin"?>"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Settings</li>
		</ol>
    </section>
    <!-- Main content -->
    <section class="content">
		<div class="box box-default">
			<div class="box-header with-border">
			<h3 class="box-title">Manage Blog</h3>
			
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				</div>
				
				
			</div>
			<div class="box-body">
			<div class="row">
				<div class="col-md-12">
				
			
		<form method="post" action="<?php echo base_url().'admin/postblog'?>" enctype="multipart/form-data">
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
							<div class="form-group">
								<label>Blog Title</label>
								<input class="form-control" id="title" value="" name="title" type="text" placeholder="Blog Title">
							</div>
							<div class="form-group">
							<button type="button" class="btn btn-leave-comment w-100 mb-1" id="submitImages">Embed images in answer</button>
							</div>
							<div class="form-group">
								<label>Blog Description</label>
								
							<textarea id="siteDescription" rows="5" value="" class="form-control" name="description"></textarea>
							</div>
							
							<div class="form-group tage-input-main">
								<label>Tags</label>
								<input type="text" id="siteTags" value="" name="tags" placeholder="Enter tags" class="form-control"/>
							</div>
							
							<div class="form-group">
								<label>Blog Thumbnail</label>
								<input class="form-control" name="thumbnail"id="thumbnail" value="" type="file">
							</div>
							<div class="form-group">
								<label>Blog Image</label>
								<input class="form-control" id="img" name="userfile" value="" type="file">
							</div>
							<div class="form-group">
								<label>Category</label>
								<input class="form-control" id="title" value="" name="category" type="text" placeholder="Category">
							</div>
							<div class="form-group">
								
								<input  class="btn btn-success" type="submit" value="Post Blog" id="postblog">
							</div>
						
					
				
	`	</form>
		
	</div>
			
			 
		</div>
	</div>
	
	
    <!-- /.content -->
	</div>
</div>
  <div class="control-sidebar-bg"></div>
</div>


<!-- ./wrapper -->

<?php $this->load->view('admin/includes/footer');?>

<script src="//cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo base_url()."plugins/tags/jquery.tagsinput.js"?>"></script>
<script src="//cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo base_url()."plugins/tags/jquery.tagsinput.js"?>"></script>
<script>
var csrfName="<?php echo $this->security->get_csrf_token_name();?>";
var csrfHash="<?php echo $this->security->get_csrf_hash();?>";

$(document).ready(function() {
		$('#siteTags').tagsInput();
		CKEDITOR.replace('siteDescription',{allowedContent:true});
});


	$(document).on('click','#submitImages',function(){
$('#postImages').modal();
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
						url:'<?php echo base_url()."post-images-to-embed-blog"?>',
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
</body>
</html>