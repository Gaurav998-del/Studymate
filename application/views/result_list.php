<?php 
$this->load->view('includes/head');
$this->load->view('includes/header');
?>	
	<script>
	
	var base_url="<?php echo base_url();?>";

	</script>
   
    <script src="<?php echo base_url('js/basic.js');?>"></script>


	<div class="main-body">
		<div class="container custom py-5">
	
		<div class="content-wrapper">
			<div class="container-fluid px-md-0">
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
 <th><?php echo $this->lang->line('result_id');?></th>
<th><?php echo $this->lang->line('name');?> </th>
 <th><?php echo $this->lang->line('quiz_name');?></th>
 <th><?php echo $this->lang->line('status');?>
 <select onChange="sort_result('<?php echo $limit;?>',this.value);">
 <option value="0"><?php echo $this->lang->line('all');?></option>
 <option value="<?php echo $this->lang->line('pass');?>" <?php if($status==$this->lang->line('pass')){ echo 'selected'; } ?> ><?php echo $this->lang->line('pass');?></option>
 <option value="<?php echo $this->lang->line('fail');?>" <?php if($status==$this->lang->line('fail')){ echo 'selected'; } ?> ><?php echo $this->lang->line('fail');?></option>
 <option value="<?php echo $this->lang->line('pending');?>" <?php if($status==$this->lang->line('pending')){ echo 'selected'; } ?> ><?php echo $this->lang->line('pending');?></option>
 </select>
 </th>
 <th><?php echo $this->lang->line('percentage_obtained');?></th>
<th><?php echo $this->lang->line('action');?> </th>
</tr>
<?php 
if(count($result)==0){
	?>
<tr>
 <td colspan="6"><?php echo $this->lang->line('no_record_found');?></td>
</tr>	
	
	
	<?php
}

foreach($result as $key => $val){
?>
<tr>
 <td><?php echo $val['rid'];?></td>
<td><?php echo $val['name'];?></td>
 <td><?php echo $val['quiz_name'];?></td>
 <td><?php echo $val['result_status'];?></td>
 <td><?php echo $val['percentage_obtained'];?>%</td>
<td>
<a href="<?php echo site_url('Questions/view_result/'.$val['rid']);?>" class="btn btn-success" ><?php echo $this->lang->line('view');?> </a>

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