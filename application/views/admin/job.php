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
			<h3 class="box-title">Post Job</h3>
			
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				</div>
				
				
			</div>
			<div class="box-body">
			<div class="row">
				<div class="col-md-12">
		<form method="post" action="<?php echo base_url().'admin/postblog'?>" enctype="multipart/form-data">
		
							<div class="form-group ask-q-filter"> 
								<label>Job Category</label>
								<div class="SumoSelect w-100 ask-qu" tabindex="0">
									<select id="category" class="search_test SumoUnder form-control input-rounded w-100">
										<option value="">Please Select Category</option>
							
											<option value="Remote">Remote</option>
											<option value="Office">Office</option>
											
									</select>
								</div>
							</div>
							<div class="form-group">
								<label>Job Title</label>
								<input class="form-control" id="title" value="" type="text" placeholder="Question Title">
							</div>
							<div class="form-group">
								<label>Role</label>
								<input class="form-control" id="role" value="" type="text" placeholder="Role of Job">
							</div>
							<div class="form-group">
								<label>Job Type</label>
								<input class="form-control" id="jobtype" value="" type="text" placeholder="Full Time or Half Time">
							</div>
							<div class="form-group">
								<label>Experience Level</label>
								<input class="form-control" id="experience" value="" type="text" placeholder="Experience of Related Job">
							</div>
							<div class="form-group">
								<label>Question Description</label>
								<div class="alert alert-info">All the html tags are allowed except &lt;script&gt; tag</div>
								<textarea name="editor" id="editor"></textarea>
							</div>
							<div class="form-group tage-input-main">
								<label>Technologies</label>
								<input id="technologies" value="" class="tags-input w-100" type="text" placeholder="">
							</div>
							<div class="form-group">
								<div id="successQuestion" class="alert alert-success d-none questionMessages">
								</div>
								<div id="errorQuestion" class="alert alert-danger d-none questionMessages">
								</div> 
								<button class="btn btn-success" type="button" value="" id="postQuestion">Post Question</button>
								<button class="btn btn-primary" type="button" value="" id="submitImages">Embed images in Question</button>
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

</body>
</html>