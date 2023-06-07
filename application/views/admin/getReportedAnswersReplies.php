<?php 
$this->load->view('admin/includes/head');?>
<link rel="stylesheet" href="<?php echo base_url()."plugins/tags/jquery.tagsinput.css"?>">
<link rel="stylesheet" href="<?php echo base_url()."admincss/bower_components/datatables.net/css/dataTables.bootstrap.min.css"?>">
<link rel="stylesheet" href="<?php echo base_url()."plugins/jqueryConfirm/jquery-confirm.css"?>">
<?php
$this->load->view('admin/includes/header');
$this->load->view('admin/includes/sidebar');
?>
	<!-- Modal -->
	<div id="answerModel" class="modal fade" role="dialog">
		<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Answer Reply Description</h4>
			</div>
			<div id="modalDescription" class="modal-body"></div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>

		</div>
	</div>
  <!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
        Website reported answer's reply
        <small>Update</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo base_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Answer's Reply</li>
		</ol>
    </section>

    <!-- Main content -->
    <section class="content">
		<div class="box box-default">
			<div class="box-header with-border">
			<h3 class="box-title">Manage</h3>
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
									<th>Report Title</th>
									<th>Report Reason</th>
									<th>Reported by</th>
									<th>View Answer Reply</th>
									<th>Visit Question</th>
									<th>Reported On</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
							<?php 
							if (count($getReportedAnswersReplies)>0) {
								foreach ($getReportedAnswersReplies as $index=>$value) {?>
								<tr id="<?php echo "answer-".$value['reportRId'];?>">
									<td><?php echo $value['reportSchemaName'];?></td> 
									<td><?php echo $value['reportSchemaDescription'];?></td> 
									<td><a target="_blank" href="<?php echo base_url()."profile/".$value['userid'];?>">View Profile</a></td>
									<td><a class="viewAnswer" data-description='<?php echo $value['reply'];?>'>Open</a></td>
									<td><a target="_blank" href="<?php echo base_url()."questions/".$value['qid']."/".$value['permalink'];?>">Visit</a></td>
									<td><?php echo date('d M, Y',strtotime($value['on']));?></td>
									<td>
										<button data-reportRId="<?php echo $value['reportRId'];?>" type="button" class="btn deleteReply btn-danger">Delete Answer Reply</button>
									</td>
								</tr>
							<?php } 
							} else {?>
							<td colspan='7' class="text-center">No record found</td>
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
	$(document).on('click','.viewAnswer',function(){
		var desc=$(this).attr('data-description');
		$('#modalDescription').html(desc);
		$('#answerModel').modal();
	});
	function deleteReply(reportRId)
	{
		$.confirm({
			title: 'Are you sure ?',
			content: 'You want to delete this answer reply?',
			buttons: {
				deleteReply: {
					text: 'delete it',
					action: function () {
						var that = this;
						var fd = new FormData();
						fd.append('reportRId',reportRId);
						fd.append(csrfName,csrfHash);
						$.ajax({
							type:'POST',
							url:'<?php echo base_url()."post-admin-delete-answer-reply";?>',
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
									$('#answer-'+reportRId).remove();
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
	
	$(document).on('click','.deleteReply',function(e){
		var reportRId=$(this).attr('data-reportRId');
		deleteReply(reportRId);
	});
</script>
</body>
</html>