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
			<h3 class="box-title">Manage Exam Level</h3>
			
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				</div>
				
				
			</div>
			<div class="box-body">
			<div class="row">
				<div class="col-md-12">

		<?php 
		$logged_in=$this->session->userdata('logged_in');

	$list_view="table";
	     $acp=explode(',',$logged_in['quiz']);
			if(in_array('List_all',$acp)){
		?>
		<div class="row">
 
  <div class="col-lg-6">
    <form method="post" action="<?php echo site_url('admin/exam_list/0/'.$list_view);?>">
	<div class="input-group">
    <input type="text" class="form-control" name="search" placeholder="<?php echo $this->lang->line('search');?>...">
      <span class="input-group-btn">
        <button class="btn btn-default" type="submit"><?php echo $this->lang->line('search');?></button>
      </span>
	 
	  
    </div><!-- /input-group -->
	 </form>
  </div><!-- /.col-lg-6 -->
  <div class="col-lg-6">
  <p style="float:right;">
 
  </p>
  
  </div>
</div><!-- /.row -->

<?php 
	}
?>
<div class="row">
 
 
 <div class="col-lg-4">
   
<div class="card mb-4">
 <div class="card-header"  style="<?php if($stat=='active'){ echo 'background:#eeeeee;';}?> ">
 <a href="<?php echo site_url('admin/exam_list/'.$limit.'/table/active');?>"> <?php echo $this->lang->line('active');?>      
 <?php echo $this->lang->line('quiz');?>     
</a>
</div>
<div class="card-body"  >
	
<?php echo $active;?>	
						
</div>
</div>
</div>



 <div class="col-lg-4">
   
<div class="card mb-4">
 <div class="card-header"  style="<?php if($stat=='upcoming'){ echo 'background:#eeeeee;';}?> ">
 <a href="<?php echo site_url('admin/exam_list/'.$limit.'/table/upcoming');?>">   <?php echo $this->lang->line('upcoming');?>     
 <?php echo $this->lang->line('quiz');?>     
</a>
</div>
<div class="card-body"  >
		
		<?php echo $upcoming;?>
						
</div>
</div>
</div>



 <div class="col-lg-4">
   
<div class="card mb-4">
 <div class="card-header" style="<?php if($stat=='archived'){ echo 'background:#eeeeee;';}?> ">
  <a href="<?php echo site_url('admin/exam_list/'.$limit.'/table/archived');?>" >  <?php echo $this->lang->line('archived');?>     
 <?php echo $this->lang->line('quiz');?>     
</a>
</div>
<div class="card-body"  >
		
		<?php echo $archived;?>
						
</div>
</div>
</div>

 
</div>


  <div class="row">
 
<div class="col-md-12">
<br> 
			<?php 
		if($this->session->flashdata('message')){
			echo $this->session->flashdata('message');	
		}
		?>	
		 
<table class="table table-bordered">
<tr>
 <th>#</th>
 <th><?php echo $this->lang->line('quiz_name');?></th>
<th><?php echo $this->lang->line('noq');?></th>
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
 <td><?php echo $val['quid'];?></td>
 <td><?php echo substr(strip_tags($val['quiz_name']),0,50);?></td>
<td><?php echo $val['noq'];?></td>
 <td>
 <!-- <?php 
 if($val['quiz_price'] == 0 || in_array($val['quid'],$purchased_quiz)){
if($val['end_date'] >=time()){	 ?>
	 
<a href="<?php echo site_url('quiz/quiz_detail/'.$val['quid']);?>" class="btn btn-success"  ><?php echo $this->lang->line('attempt');?> </a>

<?php
}
if($val['end_date'] < time()){	 ?>
	 
<a href="#" class="btn btn-warning"  ><?php echo $this->lang->line('expired');?> </a>

<?php
}
if($val['start_date'] > time()){	 ?>
	 
<a href="#" class="btn btn-default"  ><?php echo $this->lang->line('upcoming');?> </a>

<?php
}
 
 }else{
 ?>
<a href="<?php echo site_url('payment_gateway_2/subscribe/0/'.$uid.'/'.$val['quid']);?>" class="btn btn-primary"  ><?php echo $this->config->item('base_currency_prefix').' '.$val['quiz_price'].' '.$this->config->item('base_currency_sufix')." ".$this->lang->line('paynow');?> </a>

 
 <?php 
 }
 ?> -->
<?php 
	     $acp=explode(',',$logged_in['quiz']);
		
			if(in_array('List_all',$acp)){
	?>
		 
<a href="<?php echo site_url('admin/edit_quiz/'.$val['quid']);?>"><img src="<?php echo base_url('images/edit.png');?>"></a>
<a href="javascript:remove_entry('admin/remove_quiz/<?php echo $val['quid'];?>');"><img src="<?php echo base_url('images/cross.png');?>"></a>
<?php 
}
?>
</td>
</tr>

<?php 
}
?>
</table>

   

</div>

</div>
<br><br>

<?php
if(($limit-($this->config->item('number_of_rows')))>=0){ $back=$limit-($this->config->item('number_of_rows')); }else{ $back='0'; } ?>

<a href="<?php echo site_url('admin/exam_list/'.$back.'/'.$list_view);?>"  class="btn btn-primary"><?php echo $this->lang->line('back');?></a>
&nbsp;&nbsp;
<?php
 $next=$limit+($this->config->item('number_of_rows'));  ?>

<a href="<?php echo site_url('admin/exam_list/'.$next.'/'.$list_view);?>"  class="btn btn-primary"><?php echo $this->lang->line('next');?></a>






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

function remove_entry(redir_cont){
	
	if(confirm("Do you really want to remove entry?")){
		window.location="http://localhost/knowledgehub/"+"index.php/"+redir_cont;
	}
	
}


		</script>
</body>
</html>