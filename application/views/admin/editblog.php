<?php 
$this->load->view('admin/includes/head');?>
<link rel="stylesheet" href="<?php echo base_url()."plugins/tags/jquery.tagsinput.css"?>">
<link rel="stylesheet" href="<?php echo base_url()."admincss/bower_components/datatables.net/css/dataTables.bootstrap.min.css"?>">

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
			<h3 class="box-title">Blogs Manage</h3>
			
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				</div>
				
				
			</div>
			<div class="box-body">
			<!--<button type="button" class="btn btn-primary addcatbtn" id="addcatbtn">Add Category</button>-->
			
			  <div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>Blog Title</th>
									<th>Description</th>
									<th>Thumbnail</th>
									<th>Blog Image</th>
									<th>Tags</th>
									<th>Action</th>
									
								</tr>
							</thead>
							<tbody>
							<?php 
							if (count($blog)>0) {
							foreach($blog as $index=>$value){?>
								<tr id="<?php echo "categroy-".$value['id'];?>">
									<td><?php echo $value['blog_title'];?></td>
									<td><textarea rows="4" cols="50"> <?php echo htmlspecialchars_decode($value['blog_description']);?>  </textarea></td>
									<td><?php echo $value['thumbnail'];?></td>
									<td><?php echo $value['main_image'];?></td>
									<td><?php echo $value['tags'];?></td>
									<td>
									<button data-catid="<?php echo $value['id'];?>" type="button" class="editCat btn btn-primary">Edit</button>
									<button data-catid="<?php echo $value['id'];?>"  type="button" class="btn deleteCat btn-danger">Delete</button>
									</td>
								</tr>
							<?php } 
							} else {?>
							<td colspan='6' class="text-center">No record found</td>
							<?php } ?>
							</tbody>
						</table>
					</div>
					<hr>
					
				</div>
			</div>
		</div>
	</div>
	</section>
	
    <!-- /.content -->
	</div>
	
	
	
									
									
									
 <div class="modal" id="exampleModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Blog</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     <form method="POST" action="" enctype="multipart/form-data" id="myform">
    <div class="form-group">
      <label for="name">Blog Title:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter Blog Title" name="title">
    </div>
  
	 <div class="form-group">
      <label for="Description">Description:</label>
	  <textarea id="description" rows="5" value="" name="description" class="form-control"></textarea>
      
    </div>
	 
	 <div class="form-group">
      <label for="Description">Thumbnail:</label>
      <input type="file"  onload="loadImage()" class="form-control" id="thumbnail"  placeholder="Thumbnail" name="thumbnail">
	  <span id="thumb"></span>
	  
	  
	  
    </div>
	 <div class="form-group">
      <label for="Description">Blog Image:</label>
      <input type="file" onload="loadImage()" class="form-control" id="BlogImage"  placeholder="Blog Image" name="BlogImage">
    </div>
	<div class="form-group">
      <label for="Description">Tags:</label>
      <input type="text" class="form-control" id="tags" placeholder="Tags" name="tags">
    </div>
	<input type="hidden" id="thumbnailimage" name="thumbnailimage"/>
	<input type="hidden" id="mainimages" name="mainimages"/>
    <div class="form-group">
      <input type="hidden" class="form-control" id="ids"  name="id">
    </div>
   
   <div id="successAdmin" class="alert alert-success hide basicSetMessages"></div>
   <div id="errorAdmin" class="alert alert-danger hide basicSetMessages"></div>
    <button type="submit" id="updateBlog" class="btn btn-primary ">Update</button>
</form>
      </div>
      
    </div>
  </div>
</div>
  <div class="control-sidebar-bg"></div>
</div>


<!-- ./wrapper -->

<?php $this->load->view('admin/includes/footer');?>



<script src="//cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo base_url()."plugins/tags/jquery.tagsinput.js"?>"></script>
<script type="text/javascript" src="<?php echo base_url()."plugins/jqueryConfirm/jquery-confirm.js"?>"></script>
<script>
$(document).ready(function() {
	//	$('#tags').tagsInput();
		CKEDITOR.replace('description',{allowedContent:true});
});
		</script>
		
		<script>
			function deleteCategory(catid)
			{
		$.confirm({
			
			buttons: {
				deleteAnswer: {
					text: 'delete it',
					action: function () {
						var that = this;
						var fd = new FormData();
						fd.append('catid',catid);
						fd.append(csrfName,csrfHash);
						$.ajax({
							type:'POST',
							url:'<?php echo base_url()."post-delete-blog";?>',
							type: "POST",
							data : fd,
							processData: false,
							contentType: false,
							success: function(response) 
							{
								var response=$.parseJSON(response);
								if(response['type']==1)
								{
									$.alert(response['html']);
									$('#user-'+catid).remove();
									that.close();
									location.reload(true);
									
								}
								else if(response['type']==2)
								{
									window.location.href="<?php echo base_url()."admin/login";?>";
								}
								else
								{
									$.alert(response['html']);
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
	
		
		</script>
<script>
	var csrfName="<?php echo $this->security->get_csrf_token_name();?>";
	var csrfHash="<?php echo $this->security->get_csrf_hash();?>";
	

	
	
	function editCategory(catid)
	
	{
		var that = this;
		var fd = new FormData();
		fd.append('catid',catid);
		
		fd.append(csrfName,csrfHash);
		$.ajax({
		method:'POST',
		url:'<?php echo base_url()."post-admin-edit-blog";?>',
		data : fd,
		processData: false,
	    contentType: false,
		success: function(response) 
		{
			var obj=JSON.parse(response);
	
			
	
			$('#exampleModal').modal('show');
			
			$("#name").val(obj.blog_title);
			$("#BlogCategory").val(obj.blog_category);
			CKEDITOR.instances['description'].setData(obj.blog_description)
			$("#tags").val(obj.tags);	
			$("#ids").val(obj.id);	
		
			$("#thumbnailimage").val(obj.thumbnail);	
			$("#mainimages").val(obj.main_image);	
			//$('span #thumb ').text(obj.thumb);
		}
	});
	
	}
	
	
	<!-- add category modal-->
	
	
		$(document).on('click','.addcatbtn',function(e){
		$('#addcat').modal('show');
		
		
	});
	
	
	<!-- show category in  modal-->
	$(document).on('click','.editCat',function(e){
		var catid=$(this).attr('data-catid');
		
		editCategory(catid)
	});
	
	<!-- delete category-->
	$(document).on('click','.deleteCat',function(e){
		var catid=$(this).attr('data-catid');
		
		deleteCategory(catid);
	});
	
	
	
	
	
	
	
	<!-- add categories-->
	
		$(document).on('click','#addCategory',function(e){
		
		var catname=$('#catname').val();
		var catpermalink=$('#catpermalink').val();
		var catdescription=$('#catdescription').val();
		var catstatus=$('#catstatus').val();
	
		var fd = new FormData(); 
		fd.append('name',catname);
		fd.append('permalink',catpermalink);
		fd.append('description',catdescription);
		fd.append('status',catstatus);

		fd.append(csrfName,csrfHash);
		$.ajax({
			type:'POST',
			url:'<?php echo base_url()."post-insert-categories"?>',
			type: "POST",
			data : fd,
			processData: false,
			contentType: false,
			success: function(response) 
			{
				var response=$.parseJSON(response);
				if(response['type']==1)
				{
					$('#successAdmin').html(response['html']);
					$('#successAdmin').removeClass('hide');
				}
				else
				{
					$('#errorAdmin').html(response['html']);
					$('#errorAdmin').removeClass('hide');
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
	
	
	
	
	
	
	<!-- update categories-->
	
	$(document).on('click','#updateBlog',function(e){
		var element=$(this);
		element.html('uploading ....');
		var imgname  =  $('#thumbnail').val();
		var blog_title=$('#name').val();
		var Description=CKEDITOR.instances.description.getData();
		var tags=$('#tags').val();
		var thumbnailimage=$('#thumbnailimage').val();
		var mainimages=$('#mainimages').val();
		
		var id=$('#ids').val();

		if(document.getElementById("thumbnail").files.length != 0 && document.getElementById("BlogImage").files.length != 0 ){
			var firstimage=$('#thumbnail')[0].files[0];
		    var secondimage=$('#BlogImage')[0].files[0];
		}
		else if(document.getElementById("thumbnail").files.length != 0){
			var firstimage=$('#thumbnail')[0].files[0];
			var secondimage=mainimages;
		}
		else if(document.getElementById("BlogImage").files.length != 0){
			var firstimage=thumbnailimage;
			var secondimage=$('#BlogImage')[0].files[0];
		}
		else if(document.getElementById("thumbnail").files.length == 0 && document.getElementById("BlogImage").files.length == 0 ){
			var firstimage=thumbnailimage;
			var secondimage=mainimages;
		}
		
		
		
				var data = new FormData();
				data.append('thumbnail',firstimage );
				data.append('BlogImage',secondimage );
				data.append('blog_title',blog_title);
				data.append('Description',Description);
				data.append('tags',tags);
				data.append('thumbnailimage',thumbnailimage);
				data.append('mainimages',mainimages);
				data.append('id',id);
				
				data.append(csrfName,csrfHash);
				$.ajax({
					type:'POST',
					url:'<?php echo base_url()."post-update-blogs"?>',
					type: "POST",
					data : data,
					processData: false,
					contentType: false,
					success: function(response) 
					{
						
						
						var response=$.parseJSON(response);
						
						if(response['type']==1)
						{
							alert(response['html']);
							element.addClass('hide');
						}
						else if(response['type']==2)
						{
							window.location.href="<?php echo base_url()."admin/login";?>";
						}
						else if(response['type']==3)
						{
							alert(response['html']);
							element.addClass('hide');
						}
						else if(response['type']==4)
						{
							alert(response['html']);
							element.addClass('hide');
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
						else{
							element.html('Upload Favicon');
						}
					}
				});
			
	});
	
	
	
	
</script>
</body>
</html>