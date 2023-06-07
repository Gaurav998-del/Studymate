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
			<h3 class="box-title">Jobs Manage</h3>
			
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
									<th>Job Title</th>
									<th>Job Category</th>
									<th>Description</th>
									<th>Job Role</th>
									<th>Job Type</th>
									<th>Job Experience</th>
									<th>Salary</th>
									<th>Company Name</th>
									<th>Company Location</th>
									<th>Tags</th>
									<th>Action</th>
									
								</tr>
							</thead>
							<tbody>
							<?php 
							if (count($job)>0) {
							foreach($job as $index=>$value){?>
								<tr id="<?php echo "categroy-".$value['id'];?>">
									<td><?php echo $value['job_title'];?></td>
									<td><?php echo $value['job_category'];?></td>
									<td><?php echo substr($value['description'],0,50);?></td>
									<td><?php echo $value['job_role'];?></td>
									<td><?php echo $value['job_type'];?></td>
									<td><?php echo $value['job_experience'];?></td>
									<td><?php echo $value['salary'];?></td>
									<td><?php echo $value['companyname'];?></td>
									<td><?php echo $value['companylocation'];?></td>
									<td><?php echo $value['technologies'];?></td>
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
        <h5 class="modal-title">Update Job</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     <form method="POST" action=""  id="myform">
      <div class="form-group ask-q-filter"> 
								<label>Job Category</label>
								<div class="SumoSelect w-100 ask-qu" tabindex="0">
									<select id="category" class="search_test SumoUnder form-control input-rounded w-100" name="category">
										<option value="">Please Select Category</option>
							
											<option value="Remote">Remote</option>
											<option value="Office">Office</option>
											
									</select>
								</div>
							</div>
							<div class="form-group">
								<label>Job Title</label>
								<input class="form-control" id="title" value="" type="text" placeholder="Question Title" name="title">
							</div>
							<div class="form-group">
								<label>Role</label>
								<input class="form-control" id="role" value="" type="text" placeholder="Role of Job" name="role">
							</div>
							<div class="form-group">
								<label>Job Type</label>
								<input class="form-control" id="jobtype" value="" type="text" placeholder="Full Time or Half Time" name="jobtype">
							</div>
							<div class="form-group">
								<label>Experience Level</label>
								<input class="form-control" id="experience" value="" type="text" placeholder="Experience of Related Job" name="experience">
							</div>
							<div class="form-group">
								<label>Salary</label>
								<input class="form-control" id="salary" value="" type="text" placeholder="Enter Salary" name="salary">
							</div>
							<div class="form-group">
								<label>Company Name</label>
								<input class="form-control" id="companyname" value="" type="text" placeholder="Enter Company Name" name="companyname">
							</div>
							<div class="form-group">
								<label>Company Location</label>
								<input class="form-control" id="companylocation" value="" type="text" placeholder="Enter Company Location" name="companylocation">
							</div>
							<div class="form-group">
								<label>Question Description</label>
								<div class="alert alert-info">All the html tags are allowed except &lt;script&gt; tag</div>
								<textarea name="editor" id="editor" rows="5" class="form-control"></textarea>
							</div>
							<div class="form-group tage-input-main">
								<label>Technologies</label>
								<input id="technologies" name="technologies" value="" class="tags-input w-100 form-control" type="text" placeholder="">
							</div>
    
								<div class="form-group">
								  <input type="hidden" class="form-control" id="id"  name="id">
								</div>
							   
							   <div id="successAdmin" class="alert alert-success hide basicSetMessages"></div>
							   <div id="errorAdmin" class="alert alert-danger hide basicSetMessages"></div>
								<button type="submit" id="updateJob" class="btn btn-primary ">Update</button>
						</form>
      </div>
      
    </div>
  </div>
</div>
  <div class="control-sidebar-bg"></div>
</div>


<!-- ./wrapper -->

<?php $this->load->view('admin/includes/footer');?>

<script type="text/javascript" src="<?php echo base_url()."plugins/jqueryConfirm/jquery-confirm.js"?>"></script>
<script type="text/javascript" src="<?php echo base_url()."plugins/jqueryConfirm/jquery-confirm.js"?>"></script>
<script>
	var csrfName="<?php echo $this->security->get_csrf_token_name();?>";
	var csrfHash="<?php echo $this->security->get_csrf_hash();?>";
	
	function deleteJob(catid)
	{
		var that = this;
						var fd = new FormData();
						fd.append('catid',catid);
						fd.append(csrfName,csrfHash);
						$.ajax({
							type:'POST',
							url:'<?php echo base_url()."post-delete-job";?>',
							type: "POST",
							data : fd,
							processData: false,
							contentType: false,
							success: function(response) 
							{
								var response=$.parseJSON(response);
								if(response['type']==1)
								{
									alert(response['html']);
							window.location.reload(true);
									
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
	
	
	
	function editJob(catid)
	
	{
		var that = this;
		var fd = new FormData();
		fd.append('catid',catid);
		fd.append(csrfName,csrfHash);
		$.ajax({
		method:'POST',
		url:'<?php echo base_url()."post-admin-edit-job";?>',
		data : fd,
		processData: false,
	    contentType: false,
		success: function(response) 
		{
			var obj=JSON.parse(response);
	
			$('#exampleModal').modal('show');
			$("#title").val(obj.job_title);
			$("#role").val(obj.	job_role);
			$("#jobtype").val(obj.job_type);			
			$("#experience").val(obj.job_experience);		
			$("#catid").val(obj.id);	
			$("#salary").val(obj.salary);	
			$("#companyname").val(obj.companyname);	
			$('#companylocation ').val(obj.companylocation);
			$('#editor ').val(obj.description);
			$('#technologies ').val(obj.technologies);
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
		
		editJob(catid)
	});
	
	<!-- delete category-->
	$(document).on('click','.deleteCat',function(e){
		var catid=$(this).attr('data-catid');
		
		deleteJob(catid);
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
	
	$(document).on('click','#updateJob',function(e){
		var element=$(this);
		element.html('uploading ....');
		var job_title=$('#title').val();
		var JobCategory=$('#category').val();
		var Description=$('#editor').val();
		var role=$('#role').val();
		var jobtype=$('#jobtype').val();
		var experience=$('#experience').val();
		var salary=$('#salary').val();
		var companyname=$('#companyname').val();
		
		var companylocation=$('#companylocation').val();
		var technologies=$('#technologies').val();
		
				var data = new FormData();
				data.append('job_title',job_title );
				data.append('JobCategory',JobCategory );
				data.append('Description',Description);
				data.append('role',role);
				data.append('jobtype',jobtype);
				data.append('experience',experience);
				data.append('salary',salary);
				data.append('companyname',companyname);
				data.append('companylocation',companylocation);
				data.append('technologies',technologies);
				
				data.append(csrfName,csrfHash);
				$.ajax({
					type:'POST',
					url:'<?php echo base_url()."Admin/UpdateJobs"?>',
					data : data,
					processData: false,
					contentType: false,
					success: function(response) 
					{
						
						
						var response=$.parseJSON(response);
						
						if(response['type']==1)
						{
							alert(response['html']);
							window.location.reload(true);
						}
						else if(response['type']==2)
						{
							window.location.href="<?php echo base_url()."admin/login";?>";
						}
						
						else
						{ 
							alert(response['html']);
						} 
						
					},
					error: function (xhr, data, error) {
						alert(error);
						
						if (window.confirm("This page is expired , Please click Yes to reload the page"))
						{
							window.location.reload(true);
						}
						else{
							element.html('Upload Favicon');
						}
					}
				});
				 return false;
			
	});
	
	
	
	
</script>
</body>
</html>