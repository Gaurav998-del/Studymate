<?php 
$this->load->view('admin/includes/head');?>
<link rel="stylesheet" href="<?php echo base_url()."plugins/tags/jquery.tagsinput.css"?>">
<link rel="stylesheet" href="<?php echo base_url()."admincss/bower_components/datatables.net/css/dataTables.bootstrap.min.css"?>">
<link rel="stylesheet" href="<?php echo base_url()."plugins/jqueryConfirm/jquery-confirm.css"?>">
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
			<h3 class="box-title">Users Manage</h3>
				<div class="box-tools pull-right">
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
									<th>User Name</th>
									<th>Credit</th>
									<!-- <th>Moderator</th> -->
									<th>View Profile</th>
									<th>Registered on</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
							<?php 
							if (count($users)>0) {
							foreach($users as $index=>$value){?>
								<tr id="<?php echo "user-".$value['userid'];?>">
									<td><?php echo $value['name'];?></td>
									<td><?php echo $value['votes'];?></td>
									<!-- <td id="<?php echo "mod-".$value['userid'];?>"><?php echo $value['role']==2?"Yes":"No";?></td> -->
									<td><a target="_blank" href="<?php echo base_url()."profile/".$value['userid'];?>">Open</a></td>
									<td><?php echo date('d M, Y',strtotime($value['on']));?></td>
									<td >
										<?php if($value['role']!=2){?>
											<!-- <button data-userid="<?php echo $value['userid'];?>" value="1" type="button" class="mkMod btn btn-primary">Make Moderator</button> -->
										<?php } else {?>
											<button data-userid="<?php echo $value['userid'];?>" value="0" type="button" class="mkMod btn btn-primary">Remove Moderator</button>
										<?php } ?>
										<?php if($value['status']!=1){?>
										<button data-userid="<?php echo $value['userid'];?>" value="1" type="button" class="btn blockAppAcc btn-primary">Approve Account</button>
										<?php } else {?>
										<button data-userid="<?php echo $value['userid'];?>" value="0" type="button" class="btn blockAppAcc btn-primary">Block Account</button>
										<?php } ?>
										<button data-userid="<?php echo $value['userid'];?>" type="button" class="btn deleteAcc btn-danger">Delete Account</button>
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
					<div class="">
						<?php echo $pagination;?>
					</div>
				</div>
			</div>
		</div>
	</div>
	</section>
    <!-- /.content -->
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
	
	function deleteUser(userid)
	{
		$.confirm({
			title: 'Are you sure ?',
			content: 'You want to delete this user?',
			buttons: {
				deleteAnswer: {
					text: 'delete it',
					action: function () {
						var that = this;
						var fd = new FormData();
						fd.append('userid',userid);
						fd.append(csrfName,csrfHash);
						$.ajax({
							type:'POST',
							url:'<?php echo base_url()."post-admin-delete-user";?>',
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
									$('#user-'+userid).remove();
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
	function moderatorAction(userid,action)
	{
		if(action==0)
		{
			var text="Are you sure you want to make this account As Moderator";
		}
		else
		{
			var text="Are you sure you want to remove this account as Moderator";
		}
		
		$.confirm({
			title: 'Are you sure ?',
			content: text,
			buttons: {
				deleteAnswer: {
					text: 'Yes',
					action: function () {
						var that = this;
						var fd = new FormData();
						fd.append('userid',userid);
						fd.append('action',action);
						fd.append(csrfName,csrfHash);
						$.ajax({
							type:'POST',
							url:'<?php echo base_url()."post-admin-moderator-action";?>',
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
									if(action==0)
									{
										$('.mkMod[data-userid='+userid+']').attr('value',1).html('Make Moderator');
										$('#mod-'+userid).html('No');
									}
									else
									{
										$('.mkMod[data-userid='+userid+']').attr('value',2).html('Remove Moderator');
										$('#mod-'+userid).html('Yes');
									}
									that.close();
								}
								else if(response['type']==2)
								{
									window.location.href="<?php echo base_url()."admin";?>";
								}
								else
								{
									$.alert(response['html']);
								} 
							},
							error: function (xhr, data, error) {
								if (window.confirm("This page is expired , Please click Yes to reload the page"))
								{
									window.location.reload(true);
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
	function blockAppAction(userid,action)
	{
		if(action==0)
		{
			var text="Are you sure you want to block this account";
		}
		else
		{
			var text="Are you sure you want to activate this account";
		}
		
		$.confirm({
			title: 'Are you sure ?',
			content: text,
			buttons: {
				deleteAnswer: {
					text: 'Yes',
					action: function () {
						var that = this;
						var fd = new FormData();
						fd.append('userid',userid);
						fd.append('action',action);
						fd.append(csrfName,csrfHash);
						$.ajax({
							type:'POST',
							url:'<?php echo base_url()."post-admin-appBlock-action";?>',
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
									if(action==0)
									{
										$('.blockAppAcc[data-userid='+userid+']').attr('value',1).html('Approve Account');
									}
									else
									{
										$('.blockAppAcc[data-userid='+userid+']').attr('value',0).html('Block Account');
									}
									that.close();
								}
								else if(response['type']==2)
								{
									window.location.href="<?php echo base_url()."admin";?>";
								}
								else
								{
									$.alert(response['html']);
								} 
							},
							error: function (xhr, data, error) {
								if (window.confirm("This page is expired , Please click Yes to reload the page"))
								{
									window.location.reload(true);
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
	$(document).on('click','.mkMod',function(e){
		var userid=$(this).attr('data-userid');
		var action=$(this).val();
		moderatorAction(userid,action);
	});
	$(document).on('click','.blockAppAcc',function(e){
		var userid=$(this).attr('data-userid');
		var action=$(this).val();
		blockAppAction(userid,action);
	});
	$(document).on('click','.deleteAcc',function(e){
		var userid=$(this).attr('data-userid');
		deleteUser(userid);
	});
</script>
</body>
</html>