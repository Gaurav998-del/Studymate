<?php 
$this->load->view('admin/includes/head');?>
<link rel="stylesheet" href="<?php echo base_url()."plugins/tags/jquery.tagsinput.css"?>">


<?php
$this->load->view('admin/includes/header');
$this->load->view('admin/includes/sidebar');
?>
<?php
$lang=$this->config->item('question_lang');
?>

  <!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
         Settings
        <small>Exam Question</small>
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
			<h3 class="box-title">Add Exam Question</h3>
			
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				</div>
				
				
			</div>
			<div class="box-body">
			<div class="row">
				<div class="col-md-12">
<form method="post" action="<?php echo site_url('admin/edit_question_3/'.$question['qid']);?>">
	
<div class="col-md-8">
<br> 
 <div class="login-panel panel panel-default">
		<div class="panel-body"> 
	
	
	
			<?php 
		if($this->session->flashdata('message')){
			echo $this->session->flashdata('message');	
		}
		?>	
		
	
		
				<div class="form-group">	 
					<?php echo $this->lang->line('match_the_column');?>

			</div>

			
			<div class="form-group">	 
					<label   ><?php echo $this->lang->line('select_category');?></label> 
					<select class="form-control" name="cid">
					<?php 
					foreach($category_list as $key => $val){
						?>
						
						<option value="<?php echo $val['cid'];?>"  <?php if($question['cid']==$val['cid']){ echo 'selected'; } ?> ><?php echo $val['category_name'];?></option>
						<?php 
					}
					?>
					</select>
			</div>
			
			
			<div class="form-group">	 
					<label   ><?php echo $this->lang->line('select_level');?></label> 
					<select class="form-control" name="lid">
					<?php 
					foreach($level_list as $key => $val){
						?>
						
						<option value="<?php echo $val['lid'];?>" <?php if($question['lid']==$val['lid']){ echo 'selected'; } ?> ><?php echo $val['level_name'];?></option>
						<?php 
					}
					?>
					</select>
			</div>

<?php 
if(strip_tags($question['paragraph'])!=""){
?>

			<div class="form-group">	 
					<label for="inputEmail"  ><?php echo $this->lang->line('paragraph');?></label> 
					<textarea  name="paragraph"  class="form-control"   ><?php echo $question['paragraph'];?></textarea>
			</div>
			 

<?php
} 
?>			
			

			<div class="form-group">	 
					<label for="inputEmail"  ><?php echo $this->lang->line('question');?></label> 
					<textarea  name="question"  class="form-control"   ><?php echo $question['question'];?></textarea>
			</div>
			<div class="form-group">	 
					<label for="inputEmail"  ><?php echo $this->lang->line('description');?></label> 
					<textarea  name="description"  class="form-control"><?php echo $question['description'];?></textarea>
			</div>

		<?php 
		foreach($options as $key => $val){
			?>
			<div class="form-group">	 
					<label for="inputEmail"  ><?php echo $this->lang->line('options');?> <?php echo $key+1;?>)</label> <br>
					<input type="text" name="option[]" value="<?php echo $val['q_option'];?>"  > =	<input type="text" name="option2[]" value="<?php echo $val['q_option_match'];?>"  > 
			</div>
		<?php 
		}
		?>

 
	<button class="btn btn-default" type="submit"><?php echo $this->lang->line('submit');?></button>
 
		</div>
</div>
 
 
 
 
</div>
      </form>
	  
	  <div class="col-md-3">
		
		
			<div class="form-group">	 
			<table class="table table-bordered">
			<tr><td><?php echo $this->lang->line('no_times_corrected');?></td><td><?php echo $question['no_time_corrected'];?></td></tr>
			<tr><td><?php echo $this->lang->line('no_times_incorrected');?></td><td><?php echo $question['no_time_incorrected'];?></td></tr>
			<tr><td><?php echo $this->lang->line('no_times_unattempted');?></td><td><?php echo $question['no_time_unattempted'];?></td></tr>

			</table>

			</div>

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
function hidenop(vall){
	if(vall == '1' || vall=='2' || vall=='3'){
		$("#nop").css('display','block');
	}else{
	$("#nop").css('display','none');
	}
}

	</script>

</body>
</html>