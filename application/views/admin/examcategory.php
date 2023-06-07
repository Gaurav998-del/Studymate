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
         Settings
        <small>Exam Category</small>
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
			<h3 class="box-title">Manage Exam Category</h3>
			
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				</div>
				
				
			</div>
			<div class="box-body">
			<div class="row">
				<div class="col-md-12">
				
			
		<form method="post" action="<?php echo base_url().'admin/post-insert_category'?>" enctype="multipart/form-data">
			<table class="table table-bordered">
<tr>
 <th><?php echo $this->lang->line('category_name');?></th>
<th><?php echo $this->lang->line('action');?> </th>
</tr>
<?php 
if(count($category_list)==0){
	?>
<tr>
 <td colspan="3"><?php echo $this->lang->line('no_record_found');?></td>
</tr>	
	
	
	<?php
}

foreach($category_list as $key => $val){
?>
<tr>
 <td><input type="text"   class="form-control"  value="<?php echo $val['category_name'];?>" onBlur="updatecategory(this.value,'<?php echo $val['cid'];?>');" ></td>
<td>
 
<a href="<?php echo site_url('admin/pre_remove_category/'.$val['cid']);?>"><img src="<?php echo base_url('images/cross.png');?>"></a>

</td>
</tr>

<?php 
}
?>
<tr>
 <td>
 
 <input type="text"   class="form-control"   name="category_name" value="" placeholder="<?php echo $this->lang->line('category_name');?>"  required ></td>
<td>
<button class="btn btn-default" type="submit">Add New <?php echo $this->lang->line('add_new');?></button>

</td>
</tr>
</table>			
							
							
							
						
					
				
		</form>
		
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