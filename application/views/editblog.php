<?php if (checksession()){
$this->load->view('includes/head');
}
else{
	$this->load->view('admin/includes/head');
}
?>
<link rel="stylesheet" href="<?php echo base_url()."plugins/tags/jquery.tagsinput.css"?>">
<?php if (checksession()){
$this->load->view('includes/header');
}
else{
	$this->load->view('admin/includes/header');
	//$this->load->view('admin/includes/sidebar');
}
?>
	
	<div class="main-body">
		<div class="container custom py-5">
		<form method="post" enctype="multipart/form-data">
			<div class="row justify-content-md-center">

				<div  class="col-md-8 col-lg-7">
					<div class="inner-question main ask-question-main">
						<form > 
							
							<div class="form-group">
								<label>Blog Title</label>
								<input class="form-control" id="title" value="<?php echo $question['blog_title'];?>" name="title"  type="text" placeholder="Blog Title">
							</div>
							
							<div class="form-group">
								<label>Blog Description</label>
								
								<textarea name="editor" id="editor"><?php echo $question['blog_description'];?></textarea>
							</div>
							
							<div class="form-group tage-input-main">
								<label>Tags</label>
								<input id="tags" name="tags" value="<?php echo $question['tags'];?>" class="tags-input w-100" type="text" placeholder="">
							</div>
							<div class="form-group">
								<label>Blog Thumbnail</label>
								<input class="form-control" name="thumbnail"id="thumbnail" value="<?php echo $question['thumbnail'];?>" type="file">
							</div>
							<div class="form-group">
								<label>Blog Image</label>
								<input class="form-control" id="img" name="userfile" value="<?php echo $question['main_image'];?>" type="file">
							</div>
							<div class="form-group">
								<label>Category</label>
								<input class="form-control" id="title" value="<?php echo $question['blog_category'];?>" name="category" type="text" placeholder="Category">
							</div>
							<input type="hidden" value="<?php echo $question['id'];?>" name="blogid"/>
							<div class="form-group">
								<div id="successQuestion" class="alert alert-success d-none questionMessages">
								</div>
								<div id="errorQuestion" class="alert alert-danger d-none questionMessages">
								</div> 
								<input  class="btn btn-success" type="submit" value="Update Blog" id="submit">
							</div>
						</form>
					</div>
				</div>
</form>
		</div>
	</div>
</div>
<?php $this->load->view('includes/footer');?>	
<script src="//cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>plugins/animatedSelectBox/jquery.sumoselect.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()."plugins/tags/jquery.tagsinput.js"?>"></script>


<script type="text/javascript">
$('#submit').submit(function(e){
    e.preventDefault(); 
         $.ajax({
             url:'<?php echo base_url()."post-update-blogs"?>',
             type:"post",
             data:new FormData(this),
             processData:false,
             contentType:false,
             cache:false,
             async:false,
              success: function(data){
                  alert(data);
           }
         });
    });  

</script>



