<?php 
$this->load->view('includes/head');
$this->load->view('includes/header');
?>	
	<div class="main-body">
		<div class="container custom py-5">
	
		<div class="content-wrapper">
			<div class="container-fluid px-md-0">
				<div class="row my-3 ">
					<div class="col-xl-4 col-md-6  my-2 my-xl-0">    
						<div class="d-inline-block profileupper-option">
							<h6 class="text-uper-profile">
								<span class="icon-upper">
									<?php echo $active;?><!-- <i class="icon ion-md-help"></i> --></span>
								<div class="content">
									<div class="card-title is-tile text-right">
										Active Exam
									<!-- 	<div class="card-stat primary text-right"><?php echo $questionPosted;?></div> -->

									</div>
								</div>
								<div class="more">
									
								</div>
							</h6>
						</div>
					</div>
					<div class="col-xl-4 col-md-6  my-2 my-xl-0">    
						<div class="d-inline-block profileupper-option">
							<h6 class="text-uper-profile">
								<span class="icon-upper"><?php echo $upcoming;?><!-- <i class="icon ion-md-chatbubbles"></i> --></span>
								<div class="content">
									<div class="card-title is-tile text-right"> 
										Upcoming Exam
								<!-- 		<div class="card-stat primary text-right"><?php echo $answersPosted;?> </div> -->
									</div>
								</div>
								<div class="more">
									
								</div>
							</h6>
						</div>
					</div>
					<div class="col-xl-4 col-md-6  my-2 my-xl-0">    
						<div class="d-inline-block profileupper-option">
							<h6 class="text-uper-profile">
								<span class="icon-upper"><?php echo $archived;?><!-- <i class="icon ion-md-eye"></i> --></span>
								<div class="content">
									<div class="card-title is-tile text-right">
										Archived Quiz
										<!-- <div class="card-stat primary text-right"><?php echo $archived;?></div> -->
									</div>
								</div>
								<div class="more">
									
								</div>
							</h6>
						</div>
					</div>
				
				</div>
					  <!-- Tab panes -->
				<div class="tab-content">
					<div class="container custom tab-pane active px-0">
						<div class="row">
							
							<div class="col-md-12">
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
 <?php 
 if($val['quiz_price'] == 0 || in_array($val['quid'],$purchased_quiz)){
if($val['end_date'] >=time()){	 ?>
	 
<a href="<?php echo site_url('Questions/quiz_detail/'.$val['quid']);?>" class="btn btn-success"  ><?php echo $this->lang->line('attempt');?> </a>

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
 ?>

</td>
</tr>

<?php 
}
?>
</table>

   
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php $this->load->view('includes/footer');?>	