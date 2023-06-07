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
        <small>Add Question to Exam </small>
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
			<h3 class="box-title">Add Question</h3>
			
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				</div>
				
				
			</div>
			<div class="box-body">
			<div class="row">
				<div class="col-md-12">
						<a href="<?php echo site_url('admin/edit_quiz/'.$quid);?>" class="btn btn-info"  ><?php echo $this->lang->line('close');?></a><br><br>
  <div class="row">
 
  <div class="col-lg-6">
    <form method="post" action="<?php echo site_url('admin/add_question/'.$quid.'/'.$limit.'/'.$cid.'/'.$lid);?>">
	<div class="input-group">
    <input type="text" class="form-control" name="search" placeholder="<?php echo $this->lang->line('search');?>...">
      <span class="input-group-btn">
        <button class="btn btn-default" type="submit"><?php echo $this->lang->line('search');?></button>
      </span>
	 
	  
    </div><!-- /input-group -->
	 </form>
  </div><!-- /.col-lg-6 -->
</div><!-- /.row -->


  <div class="row">
 
<div class="col-md-12">
<br> 
			<?php 
		if($this->session->flashdata('message')){
			echo $this->session->flashdata('message');	
		}
		?>	
		<input type="hidden" id="added" value="<?php echo $this->lang->line('added');?>">
		
		
		
					<div class="form-group">	 
					<form method="post" action="<?php echo site_url('admin/pre_add_question/'.$quid.'/'.$limit.'/'.$cid.'/'.$lid);?>">
					<select   name="cid">
					<option value="0"><?php echo $this->lang->line('all_category');?></option>
					<?php 
					foreach($category_list as $key => $val){
						?>
						
						<option value="<?php echo $val['cid'];?>" <?php if($val['cid']==$cid){ echo 'selected';} ?> ><?php echo $val['category_name'];?></option>
						<?php 
					}
					?>
					</select>
			 	<select  name="lid">
				<option value="0"><?php echo $this->lang->line('all_level');?></option>
					<?php 
					foreach($level_list as $key => $val){
						?>
						
						<option value="<?php echo $val['lid'];?>"  <?php if($val['lid']==$lid){ echo 'selected';} ?> ><?php echo $val['level_name'];?></option>
						<?php 
					}
					?>
					</select>
					 <button class="btn btn-default" type="submit"><?php echo $this->lang->line('filter');?></button>
					 </form>
			</div>

	
	
	
<table class="table table-bordered">
<tr>
 <th>#</th>
 <th><?php echo $this->lang->line('question');?></th>
<th><?php echo $this->lang->line('question_type');?></th>
<th><?php echo $this->lang->line('category_name');?> / <?php echo $this->lang->line('level_name');?></th>
<th><?php echo $this->lang->line('percent_corrected');?></th>
<th><?php echo $this->lang->line('action');?> </th>
</tr>
<?php 
if(count($result)==0){
	?>
<tr>
 <td colspan="3"><?php echo $this->lang->line('no_record_found');?></td>
</tr>	
	
	
	<?php
}
foreach($result as $key => $val){
?>
<tr>
 <td>  <a href="javascript:show_question_stat('<?php echo $val['qid'];?>');">+</a>   <?php echo $val['qid'];?></td>
 <td><?php echo substr(strip_tags($val['question']),0,50);?>
 
 <span style="display:none;" id="stat-<?php echo $val['qid'];?>">
 <table class="table table-bordered">
<tr><td><?php echo $this->lang->line('no_times_corrected');?></td><td><?php echo $val['no_time_corrected'];?></td></tr>
<tr><td><?php echo $this->lang->line('no_times_incorrected');?></td><td><?php echo $val['no_time_incorrected'];?></td></tr>
<tr><td><?php echo $this->lang->line('no_times_unattempted');?></td><td><?php echo $val['no_time_unattempted'];?></td></tr>
</table>
 </span>
 
 
 
 </td>
<td><?php echo $val['question_type'];?></td>
<td><?php echo $val['category_name'];?> / <span style="font-size:12px;"><?php echo $val['level_name'];?></span></td>
 
<td><?php if($val['no_time_served']!='0'){ $perc=($val['no_time_corrected']/$val['no_time_served'])*100; 
?>

<div style="background:#eeeeee;width:100%;height:10px;"><div style="background:#449d44;width:<?php echo intval($perc);?>%;height:10px;"></div>
<span style="font-size:10px;"><?php echo intval($perc);?>%</span>

<?php
}else{ echo $this->lang->line('not_used');} ?></td>

<td>
 
<a href="javascript:addquestion('<?php echo $quid;?>','<?php echo $val['qid'];?>');" class="btn btn-primary" id='q<?php echo $val['qid'];?>'>
<?php 
if(in_array($val['qid'],explode(',',$quiz['qids']))){
	 echo $this->lang->line('added'); 
}else{
  echo $this->lang->line('add');
}
?>
</a> 


</td>
</tr>

<?php 
}
?>
</table>
</div>

</div>


<?php
if(($limit-($this->config->item('number_of_rows')))>=0){ $back=$limit-($this->config->item('number_of_rows')); }else{ $back='0'; } ?>

<a href="<?php echo site_url('admin/add_question/'.$quid.'/'.$back.'/'.$cid.'/'.$lid);?>"  class="btn btn-primary"><?php echo $this->lang->line('back');?></a>
&nbsp;&nbsp;
<?php
 $next=$limit+($this->config->item('number_of_rows'));  ?>

<a href="<?php echo site_url('admin/add_question/'.$quid.'/'.$next.'/'.$cid.'/'.$lid);?>"  class="btn btn-primary"><?php echo $this->lang->line('next');?></a>




		

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


function addquestion(quid,qid){
	 var did='#q'+qid;
	var formData = {quid:quid};
	$.ajax({
		 type: "POST",
		 data : formData,
			url: "http://localhost/knowledgehub/" + "index.php/admin/add_qid/"+quid+'/'+qid,
		success: function(data){
		$(did).html(document.getElementById('added').value);
			
			},
		error: function(xhr,status,strErr){
			//alert(status);
			}	
		});
	
}


		</script>
</body>
</html>