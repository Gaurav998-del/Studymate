<?php 
$this->load->view('includes/head');
$this->load->view('includes/header');
?>	
	<div class="main-body">
		<div class="container custom py-5">
	
		<div class="content-wrapper">
			<div class="container-fluid px-md-0">
				<div class="row my-10 ">
 
				
				</div>
					  <!-- Tab panes -->
				<div class="tab-content">
					<div class="container custom tab-pane active px-0" style="background-color: white; ">
						<div class="row">
							
							<div class="col-md-12">
					 <div class="alert alert-danger"><?php echo $this->lang->line('pending_quiz_message');?></div>
 <br><br>
 <?php echo str_replace('[link]',site_url($openquizurl),$this->lang->line('manual_redirect'));?>
							
							</div>
						</div>
					</div>
				</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
setTimeout(function(){
window.location="<?php echo site_url($openquizurl);?>";
},7000);

</script>

<?php $this->load->view('includes/footer');?>	