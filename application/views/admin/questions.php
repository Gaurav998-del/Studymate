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
        All posted questions
        <small>Update</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Questions</li>
		</ol>
    </section>

    <!-- Main content -->
    <section class="content">
		<div class="box box-default">
			<div class="box-header with-border">
			<a href="<?php echo base_url()."admin/reported/questions/replies";?>" class="btn btn-primary">View reported question replies</a>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				</div>
			</div>
			<div class="box-body">
			  <div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-bordered table-hover table-responsive">
							<thead>
								<tr>
									<th>Question Name</th>
									<th>Status</th>
									<th>User</th>
									<th>Added on</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
							<?php 
							if (count($getQuestions)>0) {
							foreach ($getQuestions as $index=>$value) {?>
								<tr id="<?php echo "question-".$value['qid'];?>">
									<td><a target="_blank" href="<?php echo base_url()."questions/".$value['qid'].'/'.$value['permalink'];?>"><?php echo $value['title'];?></a></td> 
									<td><span class="label label-<?php echo $value['status']==1?"success":"danger";?>"><?php echo $value['status']==1?"Approved":"Not approved";?></span></td>
									<td><a target="_blank" href="<?php echo base_url()."profile/".$value['userid'];?>">View Profile</a></td>
									<td><?php echo date('d M, Y',strtotime($value['on']));?></td>
									<td>
										<?php if($value['status']!=1){?>
										<button data-qid="<?php echo $value['qid'];?>" value="1" type="button" class="btn blockQuestionAction btn-primary">Approve question</button>
										<?php } else {?>
										<button data-qid="<?php echo $value['qid'];?>" value="0" type="button" class="btn blockQuestionAction btn-primary">Block question</button>
										<?php } ?>
										<button data-qid="<?php echo $value['qid'];?>" type="button" class="btn deleteQuestion btn-danger">Delete question</button>
									</td>
								</tr>
							<?php } 
							} else {?>
							<td colspan='5' class="text-center">No record found</td>
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

<script type="text/javascript" src="<?php echo base_url()."admincss/bower_components/datatables.net/js/jquery.dataTables.min.js"?>"></script>
<script type="text/javascript" src="<?php echo base_url()."admincss/bower_components/datatables.net/js/dataTables.bootstrap.min.js"?>"></script>
<script type="text/javascript" src="<?php echo base_url()."plugins/jqueryConfirm/jquery-confirm.js"?>"></script>
<script type="text/javascript" src="<?php echo base_url()."plugins/jqueryConfirm/jquery-confirm.js"?>"></script>
<script>
	var csrfName="<?php echo $this->security->get_csrf_token_name();?>";
	var csrfHash="<?php echo $this->security->get_csrf_hash();?>";
	
	function deleteQuestion(qid)
	{
		$.confirm({
			title: 'Are you sure ?',
			content: 'You want to delete this question?',
			buttons: {
				deleteAnswer: {
					text: 'delete it',
					action: function () {
						var that = this;
						var fd = new FormData();
						fd.append('qid',qid);
						fd.append(csrfName,csrfHash);
						$.ajax({
							type:'POST',
							url:'<?php echo base_url()."post-admin-delete-question";?>',
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
									$('#question-'+qid).remove();
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
	function blockQuestionAction(qid,action)
	{
		if(action==0)
		{
			var text="Are you sure you want to block this question";
		}
		else
		{
			var text="Are you sure you want to activate this question";
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
						fd.append('qid',qid);
						fd.append('action',action);
						fd.append(csrfName,csrfHash);
						$.ajax({
							type:'POST',
							url:'<?php echo base_url()."post-admin-questionBlock-action";?>',
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
										$('.blockQuestionAction[data-qid='+qid+']').attr('value',1).html('Approve Question');
									}
									else
									{
										$('.blockQuestionAction[data-qid='+qid+']').attr('value',0).html('Block Question');
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
	$(document).on('click','.blockQuestionAction',function(e){
		var qid=$(this).attr('data-qid');
		var action=$(this).val();
		blockQuestionAction(qid,action);
	});
	$(document).on('click','.deleteQuestion',function(e){
		var qid=$(this).attr('data-qid');
		deleteQuestion(qid);
	});
</script>
</body>
</html>