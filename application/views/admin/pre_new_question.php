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
			
			<form method="post" action="<?php echo site_url('Admin/pre_new_question/');?>">
	
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
					<label   ><?php echo $this->lang->line('select_question_type');?></label> 
					<select class="form-control" name="question_type" onChange="hidenop(this.value);">
						<option value="1">Multiple Choice Single Answer</option>
						<option value="2">Multiple Choice Multiple Answer</option>
						<option value="3">Match the Column</option>
						<option value="4">Short Answer</option>
						<option value="5">Long Answer</option>

					</select>
			</div>

			<div class="form-group" id="nop" >	 
					<label for="inputEmail"  ><?php echo $this->lang->line('nop');?></label> 
					<input type="text"   name="nop"  class="form-control" value="4"   >
			</div>
			<div class="form-group">
<input type="checkbox" name="with_paragraph" value="1">  With Paragraph</div>

 
	<button class="btn btn-default" type="submit">Next</button>
 
		</div>
</div>
 
 
 
 
</div>
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