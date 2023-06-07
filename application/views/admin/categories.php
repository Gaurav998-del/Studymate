<?php 
$this->load->view('admin/includes/head');?>
<link rel="stylesheet" href="<?php echo base_url()."plugins/tags/jquery.tagsinput.css"?>">
<link rel="stylesheet" href="<?php echo base_url()."admincss/bower_components/datatables.net/css/dataTables.bootstrap.min.css"?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

<?php
$this->load->view('admin/includes/header');
$this->load->view('admin/includes/sidebar');
?>
  <!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
        Category
        <small>Studymate</small>
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
			<h3 class="box-title">Manage Categories:- </h3>
			
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-primary addcatbtn" id="addcatbtn">Add Category</button>
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				</div>
				
				
			</div>
			<div class="box-body">
			
			
			  <div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>Name</th>
									<th>Permalink</th>
									<th>Description</th>
									<th>Action</th>
									
								</tr>
							</thead>
							<tbody>
							<?php 
							if (count($categories)>0) {
							foreach($categories as $index=>$value){?>
								<tr id="<?php echo "categroy-".$value['catid'];?>">
									<td><?php echo $value['catname'];?></td>
									<td><?php echo $value['permalink'];?></td>
									<td><?php echo $value['description'];?></td>
									<td>
									<button data-catid="<?php echo $value['catid'];?>" type="button" class="editCat btn btn-primary">Edit  Category</button>

									<button data-catid="<?php echo $value['catid'];?>"  type="button" class="btn deleteCat btn-danger" style="margin-top: 3px">Delete Category</button>
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
	
	<!--add category modal start-->
	
	<div class="modal" id="addcat" class="addcat" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Categories</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" id="catname" placeholder="Enter Name" name="name">
    </div>
    <div class="form-group">
      <label for="Permanlink">Permanlink:</label>
      <input type="text" class="form-control" id="catpermalink" name="Permalink">
    </div>
	 <div class="form-group">
      <label for="Description">Description:</label>
      <input type="text" class="form-control" id="catdescription" placeholder="Description" name="Description">
    </div>
    <div class="form-group">
      
      <input type="hidden" class="form-control" id="catstatus" name="status" value="1">
    </div>
   <div id="successAdmin" class="alert alert-success hide basicSetMessages"></div>
   <div id="errorAdmin" class="alert alert-danger hide basicSetMessages"></div>
    <button type="submit" id="addCategory" class="btn btn-primary ">Add Category</button>

      </div>
      
    </div>
  </div>
</div>
	
	
	<!-- add category modal end-->
	
	
 <div class="modal" id="exampleModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Categories</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name">
    </div>
    <div class="form-group">
      <label for="Permanlink">Permanlink:</label>
      <input type="text" class="form-control" id="permalink" name="Permanlink">
    </div>
	 <div class="form-group">
      <label for="Description">Description:</label>
      <input type="text" class="form-control" id="description" placeholder="Description" name="Description">
    </div>
    <div class="form-group">
      <input type="hidden" class="form-control" id="catid"  name="catid">
    </div>
   
   <div id="successAdmin" class="alert alert-success hide basicSetMessages"></div>
   <div id="errorAdmin" class="alert alert-danger hide basicSetMessages"></div>
    <button type="submit" id="updateCategory" class="btn btn-primary ">Update</button>

      </div>
      
    </div>
  </div>
</div>
  <div class="control-sidebar-bg"></div>
</div>


<!-- ./wrapper -->

<?php $this->load->view('admin/includes/footer');?>

<!-- <script type="text/javascript" src="<?php echo base_url()."plugins/jqueryConfirm/jquery-confirm.js"?>"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

<script>
	var csrfName="<?php echo $this->security->get_csrf_token_name();?>";
	var csrfHash="<?php echo $this->security->get_csrf_hash();?>";
	
	function deleteCategory(catid)
	{
		$.confirm({
			title: 'Are you sure ?',
			content: 'You want to delete this category?',
			buttons: {
				deleteAnswer: {
					text: 'delete category',
					action: function () {
						var that = this;
						var fd = new FormData();
						fd.append('catid',catid);
						fd.append(csrfName,csrfHash);
						$.ajax({
							type:'POST',
							url:'<?php echo base_url()."post-admin-delete-category";?>',
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
	
	
	
	function editCategory(catid)
	
	{
		var that = this;
		var fd = new FormData();
		fd.append('catid',catid);
		fd.append(csrfName,csrfHash);
		$.ajax({
		method:'POST',
		url:'<?php echo base_url()."post-admin-edit-category";?>',
		data : fd,
		processData: false,
	    contentType: false,
		success: function(response) 
		{
			var obj=JSON.parse(response);
	
			$('#exampleModal').modal('show');
			$("#name").val(obj.name);
			$("#permalink").val(obj.permalink);
			$("#description").val(obj.description);		
			$("#catid").val(obj.catid);		
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
	
		$(document).on('click','#updateCategory',function(e){
		var catid=$('#catid').val();
		var name=$('#name').val();
		var permalink=$('#permalink').val();
		var description=$('#description').val();
			alert(name);
		var fd = new FormData(); 
		fd.append('catid',catid);
		fd.append('name',name);
		fd.append('permalink',permalink);
		fd.append('description',description);
		fd.append(csrfName,csrfHash);
		$.ajax({
			type:'POST',
			url:'<?php echo base_url()."post-update-categories"?>',
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
	
	
	
</script>
</body>
</html>