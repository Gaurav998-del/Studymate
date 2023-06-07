<?php 
$this->load->view('includes/head');?>
<link rel="stylesheet" href="<?php echo base_url()."plugins/jqueryTextEditor/jquery-te.css"?>">
<link rel="stylesheet" href="<?php echo base_url()."plugins/jqueryConfirm/jquery-confirm.css"?>">
<?php
$this->load->view('includes/header');
?>	
	<div class="main-body">
		<div class="container custom py-5">
		<nav class="navbar navbar-expand-sm navbar-dark background-main-color profile">
			<!-- Brand/logo -->
			<a class="navbar-brand" href="">
				Profile
			</a>
			<!-- Links -->
			<ul class="navbar-nav nav nav-tabs  ml-auto profile" role="tablist">
				<li class="nav-item">
					<a href="<?php echo base_url()."profile/".$userid;?>" class="nav-link">User Profile</a>
				</li>
				<li id="activityTab" class="nav-item">
					<a href="<?php echo base_url()."profile/".$userid."/activity"?>" class="nav-link ">Activity</a>
				</li>
				<?php if (checksession()) {?>
				<li class="nav-item">
					<a class="nav-link active">Edit settings</a>
				</li>
				<?php }?>
			</ul>
		</nav>
		<div class="content-wrapper">
			<div class="container-fluid px-md-0">
				<div class="row my-3 ">
					<div class="col-xl-3 col-md-6  my-2 my-xl-0">    
						<div class="d-inline-block profileupper-option">
							<h6 class="text-uper-profile">
								<span class="icon-upper"><i class="icon ion-md-help"></i></span>
								<div class="content">
									<div class="card-title is-tile text-right">
										Questions
										<div class="card-stat primary text-right"><?php echo $questionPosted;?></div>
									</div>
								</div>
								<div class="more">
									
								</div>
							</h6>
						</div>
					</div>
					<div class="col-xl-3 col-md-6  my-2 my-xl-0">    
						<div class="d-inline-block profileupper-option">
							<h6 class="text-uper-profile">
								<span class="icon-upper"><i class="icon ion-md-chatbubbles"></i></span>
								<div class="content">
									<div class="card-title is-tile text-right"> 
										Answers
										<div class="card-stat primary text-right"><?php echo $answersPosted;?> </div>
									</div>
								</div>
								<div class="more">
									
								</div>
							</h6>
						</div>
					</div>
					<div class="col-xl-3 col-md-6  my-2 my-xl-0">    
						<div class="d-inline-block profileupper-option">
							<h6 class="text-uper-profile">
								<span class="icon-upper"><i class="icon ion-md-eye"></i></span>
								<div class="content">
									<div class="card-title is-tile text-right">
										Profile Views
										<div class="card-stat primary text-right"><?php echo $user['views'];?></div>
									</div>
								</div>
								<div class="more">
									
								</div>
							</h6>
						</div>
					</div>
					<div class="col-xl-3 col-md-6  my-2 my-xl-0">    
						<div class="d-inline-block profileupper-option">
							<h6 class="text-uper-profile">
								<span class="icon-upper"><i class="icon ion-md-people"></i></span>
								<div class="content">
									<div class="card-title is-tile text-right">
										people reached
										<div class="card-stat primary text-right"><?php echo $user['peopleReached'];?></div>
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
					<?php if (checksession()) {?>
					<div id="edit" class="container custom tab-pane active px-md-0">
						<div class="row"> 
							<div class="col-md-3">
								<div class="profile-inner-main">
									<div class="main-pic-user">
										<input onchange="readImage(this);" type="file" id="imageFile" class="edit-image"/>
										<img id="srcChange" class="img-fluid mx-auto d-block" src="<?php echo base_url()."images/".$user['image'];?>">
										<div class="overlay edit-img">Choose Image</div>
									</div>
									
									<button id="uploadPic" type="button" class="btn btn-success img-upload-profile d-none">Upload</button>
								</div>
							</div>
							<div class="col-md-9">
								<div class="main-inner-profiletext">
									<h3 class="heading-tags">
										Edit <span>Profile</span>
									</h3>
									<form class="edit-profile-form">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<input id="name" type="text" class="input-edit" value="<?php echo $user['name'];?>" placeholder="Enter Name">
												</div>
											</div>
											<div class="col-md-6"> 
												<div class="form-group">
													<input id="title" type="text" class="input-edit" value="<?php echo $user['title'];?>" placeholder="Title">
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<textarea id="editor" class="w-100 edit" rows="4" placeholder="About Me"><?php echo decodeContent($user['description']);?></textarea>
												</div>
											</div>
											<div class="col-md-12">
												<h3 class="inner-form-heading">Web presence</h3>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<input id="website" type="text" class="input-edit" value="<?php echo $user['website'];?>" placeholder="Website link">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<input id="twitter" type="text" class="input-edit" value="<?php echo $user['twitter'];?>" placeholder="Twitter link or username">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<input id="github" type="text" class="input-edit" value="<?php echo $user['github'];?>" placeholder="GitHub link or username">
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<input id="location" value="<?php echo $user['location'];?>" class="input-edit" placeholder="Location" type="text">
												</div>
											</div>
											<div class="col-md-12">
												<div id="successProfile" class="alert alert-success d-none profileMessages">
												</div>
												<div id="errorProfile" class="alert alert-danger d-none profileMessages">
												</div> 
												<div class="form-group">
													<button id="updateProfile" type="button" class="btn btn-primary">Update Profile</button>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php $this->load->view('includes/footer');?>	
<script type="text/javascript" src="<?php echo base_url()."plugins/jqueryTextEditor/jquery-te-1.4.0.min.js"?>"></script>
<script type="text/javascript" src="<?php echo base_url()."plugins/jqueryConfirm/jquery-confirm.js"?>"></script>
<script>
var userid=<?php echo $userid;?>;
var csrfName="<?php echo $this->security->get_csrf_token_name();?>";
var csrfHash="<?php echo $this->security->get_csrf_hash();?>";

function readImage(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
			$('#srcChange')
				.attr('src', e.target.result);
				
		};
		reader.readAsDataURL(input.files[0]);
		$('#uploadPic').removeClass('d-none');
	}
}
	$(document).ready(function() {
		$('#editor').jqte();
		// imageFile   
		
		$(document).on('click','#uploadPic',function(e) {
			var imgname  =  $('#imageFile').val();
			var size  =  $('#imageFile')[0].files[0].size;
			var ext =  imgname.substr( (imgname.lastIndexOf('.') +1) );
			if (ext=='jpg' || ext=='jpeg' || ext=='png' || ext=='gif' || ext=='PNG' || ext=='JPG' || ext=='JPEG')
			{
				if (size<=1000000)
				{
					var fd = new FormData();
					fd.append('image', $('#imageFile')[0].files[0]);
					fd.append(csrfName,csrfHash);
					$.ajax({
						type:'POST',
						url:'<?php echo base_url()."post-update-profile-pic"?>',
						type: "POST",
						data : fd,
						processData: false,
						contentType: false,
						success: function(response) 
						{
							var response=$.parseJSON(response);
							if (response['type']==1)
							{
								alert(response['html']);
								$('#uploadPic').addClass('d-none');
							}
							else if (response['type']==2)
							{
								$('#signupModal').modal();
							}
							else
							{
								alert(response['html']);
							}
						},
						error: function (xhr, data, error) {
							if (window.confirm("This page is expired , Please click Yes to reload the page"))
							{
								window.location.reload(true);
							}
						}
					});
				}
				else
				{
					alert('File size is too big');
					return false;
				}
			}
			else
			{
				alert('Please upload only images with jpg,jpeg,png,gif,PNG,JPG,JPEG');
				return false;
			}
		});
		$(document).on('click','#updateProfile',function(e) {
			$('.profileMessages').addClass('d-none').html('');
			
			var description=$('#editor').closest(".jqte").find(".jqte_editor").eq(0).html();
			var title=$('#title').val();
			var name=$('#name').val();
			var website=$('#website').val();
			var twitter=$('#twitter').val();
			var github=$('#github').val();
			var location=$('#location').val();
			
			var fd = new FormData(); 
			fd.append('description',description);
			fd.append('title',title);
			fd.append('name',name);
			fd.append('website',website);
			fd.append('twitter',twitter);
			fd.append('github',github);
			fd.append('location',location);
			fd.append(csrfName,csrfHash);
			$.ajax({
				type:'POST',
				url:'<?php echo base_url()."post-update-profile"?>',
				type: "POST",
				data : fd,
				processData: false,
				contentType: false,
				success: function(response) 
				{
					var response=$.parseJSON(response);
					if (response['type']==1)
					{
						$('#successProfile').html(response['html']);
						$('#successProfile').removeClass('d-none');
					}
					else
					{
						$('#errorProfile').html(response['html']);
						$('#errorProfile').removeClass('d-none');
					}
				},
				error: function (xhr, data, error) {
					if (window.confirm("This page is expired , Please click Yes to reload the page"))
					{
						window.location.reload(true);
					}
				}
			});
		});	
	});
</script>