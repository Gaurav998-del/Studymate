<?php 
$this->load->view('admin/includes/head');?>
<link rel="stylesheet" href="<?php echo base_url()."plugins/tags/jquery.tagsinput.css"?>">
<style>
	.settingsLogSec{
		position:relative;
	}
	.settingsLogSec input{
		 position: absolute;
		height: 100%;
		width: 100%;
		opacity: 0;
		z-index: 1;
	}
	
</style>
<?php
$this->load->view('admin/includes/header');
$this->load->view('admin/includes/sidebar');

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<h1>
        Website Settings
        <small>Update</small>
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
			<h3 class="box-title">Basic</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
				</div>
			</div>
			<div class="box-body">
			  <div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Site Name</label>
						<input type="text" id="siteName" value="<?php echo $siteSettings['siteName'];?>" placeholder="Enter site name" class="form-control"/>
					</div>
					<div class="form-group">
						<label>Site meta tags</label>
						<input type="text" id="siteTags" value="<?php echo $siteSettings['tags'];?>" placeholder="Enter site tags" class="form-control"/>
					</div>
					<div class=" form-group">
						<label>Site logo</label>
						<img id="logo" src="<?php echo base_url()."images/".$siteSettings['logo'];?>" width="128" class="img-responsive" height="auto"/>
						<br>
						<div class="settingsLogSec">
							<input onchange="readImageLogo(this);" class="image-upload" type="file" id="logoFile" />
							<button class="btn btn-primary">Change</button>
						</div><br>
						<button id="uploadLogo" class="hide btn btn-success">Upload Logo</button>
					</div>
					<div class=" form-group">
						<label>Site Favicon</label>
						<img id="favicon" src="<?php echo base_url()."images/".$siteSettings['favicon'];?>" width="16" class="img-responsive" height="auto"/><br>
						<div class="settingsLogSec">
							<input onchange="readImageFavicon(this);" class="image-upload" type="file" id="faviconFile" />
							<button class="btn btn-primary">Change</button>
						</div><br>
						<button id="uploadFavicon" class="hide btn btn-success">Upload Favicon</button>
					</div>
					<div class="form-group">
						<label>Facebook Link</label>
						<input id="fb" type="text" value="<?php echo $siteSettings['facebookLink'];?>" class="form-control"/>
					</div>
					<div class="form-group">
						<label>Twitter Link</label>
						<input id="tw" type="text" value="<?php echo $siteSettings['twitterLink'];?>" class="form-control"/>
					</div>
					<div class="form-group">
						<label>GooglePlus Link</label>
						<input id="gp" type="text" value="<?php echo $siteSettings['googleLink'];?>" class="form-control"/>
					</div>
					<div class="form-group">
						<label>Dribble Link</label>
						<input id="db" type="text" value="<?php echo $siteSettings['dribbleLink'];?>" class="form-control"/>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Site meta description</label>
						<textarea id="siteDescription" rows="5" value="" class="form-control"><?php echo decodeContent($siteSettings['description']);?></textarea>
					</div>
					<div class="form-group" style="display: none;">
						<label>Google Analytics code</label>
						<textarea id="googleAnalyticsCode" rows="5" value="" class="form-control"><?php echo decodeContent($siteSettings['googleAnalyticsCode']);?></textarea>
					</div>
					<div class="form-group" style="display: none;">
						<label>Google App Id</label>
						<input id="googleAppId" type="text" value="<?php echo $siteSettings['googleAppId'];?>" class="form-control"/>
					</div>
					<div class="form-group" style="display: none;">
						<label>Google App Secret</label>
						<input id="googleAppSecret" type="text" value="<?php echo $siteSettings['googleAppSecret'];?>" class="form-control"/>
					</div>
					<div class="form-group" style="display: none;">
						<label>Facebook App Id</label>
						<input id="fbAppId" type="text" value="<?php echo $siteSettings['fbAppId'];?>" class="form-control"/>
					</div>
					<div class="form-group" style="display: none;">
						<label>Facebook App Secret</label>
						<input id="fbAppSecet" type="text" value="<?php echo $siteSettings['fbAppSecet'];?>" class="form-control"/>
					</div>
					<div class="form-group" style="display: none;">
						<label>Smtp Username</label>
						<input id="smtpUsername" type="text" value="<?php echo $siteSettings['smtpUsername'];?>" class="form-control"/>
					</div>
					<div class="form-group" style="display: none;">
						<label>Smtp Password</label>
						<input id="smtpPassword" type="password" value="<?php echo $siteSettings['smtpPassword'];?>" class="form-control"/>
					</div>
					<div class="form-group" style="display: none;">
						<label>IMGur Client Id</label>
						<input id="imgurClientId" type="text" value="<?php echo $siteSettings['imgurClientId'];?>" class="form-control"/>
					</div>
					<div class="form-group">
						<label>
							<input id="adminApproveQuestions" type="checkbox" class="minimal" <?php echo $siteSettings['adminApproveQuestions']==1?"checked":"";?>> Enable admin approval restriction after the question is posted
						</label>
					</div>
					<div class="form-group">
						<div id="successSettings" class="alert alert-success hide basicSetMessages"></div>
						<div id="errorSettings" class="alert alert-danger hide basicSetMessages"></div>
						<button id="updateBasic" class="btn btn-primary">Update Settings</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- <div class="box box-default">
		<div class="box-header with-border">
			<h3 class="box-title">Ads settings</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
				</div>
			</div>
			<div class="box-body">
			  <div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Banner ad (728x90)</label>
						<textarea id="bannerAd" rows="5" value="" class="form-control"><?php echo $siteSettings['googleAnalyticsCode'];?></textarea>
					</div>
					<div class="form-group">
						<label>
							<input id="bannerAdEnable" type="checkbox" class="minimal" <?php echo $siteSettings['bannerAdEnable']==1?"checked":"";?>> Enabled
						</label>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Sidebar ad (max 300 width)</label>
						<textarea id="sidebarAd" rows="5" value="" class="form-control"><?php echo $siteSettings['sidebarAd'];?></textarea>
					</div>
					<div class="form-group">
						<label>
							<input id="sidebarAdEnable" <?php echo $siteSettings['sidebarAdEnable']==1?"checked":"";?> type="checkbox" class="minimal"> Enabled
						</label>
					</div>
					<div class="form-group">
						<div id="successAds" class="alert alert-success hide basicSetMessages"></div>
						<div id="errorAds" class="alert alert-danger hide basicSetMessages"></div>
						<button id="updateAds" class="btn btn-primary">Update</button>
					</div>
				</div>
			</div>
		</div>
	</div> -->
	<div class="box box-default">
		<div class="box-header with-border">
			<h3 class="box-title">Admin Account Settings</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
				</div>
			</div>
			<div class="box-body">
			  <div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Email</label>
						<input id="adminEmail" type="text" value="<?php echo $admin['email'];?>" class="form-control"/>
					</div>
					<div class="form-group">
						<label>Previous Password</label>
						<input id="adminPrevPassword" type="password" value="" class="form-control"/>
					</div>
					<div class="form-group">
						<label>New Password</label>
						<input id="adminNewPassword" type="password" value="" class="form-control"/>
					</div>
				</div>
				<div class="col-md-6">
					
					<div class="form-group">
						<div id="successAdmin" class="alert alert-success hide basicSetMessages"></div>
						<div id="errorAdmin" class="alert alert-danger hide basicSetMessages"></div>
						<button id="updateAdmin" class="btn btn-primary">Change Password</button>
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
<script src="//cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo base_url()."plugins/tags/jquery.tagsinput.js"?>"></script>
<script>
	var csrfName="<?php echo $this->security->get_csrf_token_name();?>";
	var csrfHash="<?php echo $this->security->get_csrf_hash();?>";
	$(document).ready(function(){
		CKEDITOR.replace('siteDescription',{allowedContent:true});
		$('#siteTags').tagsInput();
	});
	function readImageLogo(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#logo').attr('src', e.target.result);
			};
			reader.readAsDataURL(input.files[0]);
			$('#uploadLogo').removeClass('hide');
		}
	}
	function readImageFavicon(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#favicon').attr('src', e.target.result);
			};
			reader.readAsDataURL(input.files[0]);
			$('#uploadFavicon').removeClass('hide');
		}
	}
	
	$(document).on('click','#updateBasic',function(e){
		$('#successSettings').addClass('hide').html('');
		$('#errorSettings').addClass('hide').html('');
		var description=CKEDITOR.instances.siteDescription.getData();
		var googleAnalyticsCode=$('#googleAnalyticsCode').val();
		var fbAppId=$('#fbAppId').val();
		var fbAppSecet=$('#fbAppSecet').val();
		var googleAppId=$('#googleAppId').val();
		var googleAppSecret=$('#googleAppSecret').val();
		
		var siteTags=$('#siteTags').val();
		var siteName=$('#siteName').val();
		var fb=$('#fb').val();
		var tw=$('#tw').val();
		var db=$('#db').val();
		var gp=$('#gp').val();
		var smtpUsername=$('#smtpUsername').val();
		var smtpPassword=$('#smtpPassword').val();
		var imgurClientId=$('#imgurClientId').val();
		
		var adminApproveQuestions=$('#adminApproveQuestions').is(":checked")?1:0;
		var fd = new FormData(); 
		fd.append('googleAnalyticsCode',googleAnalyticsCode);
		fd.append('fbAppId',fbAppId);
		fd.append('fbAppSecet',fbAppSecet);
		fd.append('googleAppId',googleAppId);
		fd.append('googleAppSecret',googleAppSecret);
		fd.append('description',description);
		fd.append('siteTags',siteTags);
		fd.append('siteName',siteName);
		fd.append('smtpUsername',smtpUsername);
		fd.append('smtpPassword',smtpPassword);
		fd.append('imgurClientId',imgurClientId);
		fd.append('adminApproveQuestions',adminApproveQuestions);  
		fd.append('fb',fb);
		fd.append('tw',tw);
		fd.append('db',db);
		fd.append('gp',gp);
		fd.append(csrfName,csrfHash);
		$.ajax({
			type:'POST',
			url:'<?php echo base_url()."post-update-settings"?>',
			type: "POST",
			data : fd,
			processData: false,
			contentType: false,
			success: function(response) 
			{
				var response=$.parseJSON(response);
				if(response['type']==1)
				{
					$('#successSettings').html(response['html']);
					$('#successSettings').removeClass('hide');
				}
				else
				{
					$('#errorSettings').html(response['html']);
					$('#errorSettings').removeClass('hide');
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
	
	$(document).on('click','#updateAds',function(e){
		$('#successAds').addClass('hide').html('');
		$('#errorAds').addClass('hide').html('');
		var bannerAd=$('#bannerAd').val();
		
		var sidebarAd=$('#sidebarAd').val();
		var bannerAdEnable=$('#bannerAdEnable').is(":checked")?1:0;
		var sidebarAdEnable=$('#sidebarAdEnable').is(":checked")?1:0;
		
		var fd = new FormData(); 
		fd.append('bannerAd',bannerAd);
		fd.append('sidebarAd',sidebarAd);
		fd.append('bannerAdEnable',bannerAdEnable);
		fd.append('sidebarAdEnable',sidebarAdEnable);
		fd.append(csrfName,csrfHash);
		$.ajax({
			type:'POST',
			url:'<?php echo base_url()."post-update-ads-settings"?>',
			type: "POST",
			data : fd,
			processData: false,
			contentType: false,
			success: function(response) 
			{
				var response=$.parseJSON(response);
				if(response['type']==1)
				{
					$('#successAds').html(response['html']);
					$('#successAds').removeClass('hide');
				}
				else
				{
					$('#errorAds').html(response['html']);
					$('#errorAds').removeClass('hide');
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
	$(document).on('click','#updateAdmin',function(e){
		$('#successAdmin').addClass('hide').html('');
		$('#errorAdmin').addClass('hide').html('');
		  
		var adminPrevPassword=$('#adminPrevPassword').val();
		var adminEmail=$('#adminEmail').val();
		var adminNewPassword=$('#adminNewPassword').val();
		
		var fd = new FormData(); 
		fd.append('adminPrevPassword',adminPrevPassword);
		fd.append('adminEmail',adminEmail);
		fd.append('adminNewPassword',adminNewPassword);
		fd.append(csrfName,csrfHash);
		$.ajax({
			type:'POST',
			url:'<?php echo base_url()."post-update-admin-settings"?>',
			type: "POST",
			data : fd,
			processData: false,
			contentType: false,
			success: function(response) 
			{
				var response=$.parseJSON(response);
				if(response['type']==1)
				{
					$('#successAdmin').html(response['html']);
					$('#successAdmin').removeClass('hide');
				}
				else
				{
					$('#errorAdmin').html(response['html']);
					$('#errorAdmin').removeClass('hide');
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
	$(document).on('click','#uploadLogo',function(e){
		var element=$(this);
		element.html('uploading ....'); 
		var imgname  =  $('#logoFile').val();
		var size  =  $('#logoFile')[0].files[0].size;
		var ext =  imgname.substr( (imgname.lastIndexOf('.') +1) );
		if(ext=='jpg' || ext=='jpeg' || ext=='png' || ext=='gif' || ext=='PNG' || ext=='JPG' || ext=='JPEG')
		{
			if(size<=1000000)
			{
				var data = new FormData();
				data.append('image', $('#logoFile')[0].files[0]);
				data.append(csrfName,csrfHash);
				$.ajax({
					type:'POST',
					url:'<?php echo base_url()."post-update-site-logo"?>',
					type: "POST",
					data : data,
					processData: false,
					contentType: false,
					success: function(response) 
					{
						var response=$.parseJSON(response);
						if(response['type']==1)
						{
							alert(response['html']);
							element.addClass('hide');  
						}
						else if(response['type']==2)
						{
							window.location.href="<?php echo base_url()."admin/login";?>"; 
						}
						else
						{
							alert(response['html']);
						}
						element.html('Upload Logo');
					},
					error: function (xhr, data, error) {
						if (window.confirm("This page is expired , Please click Yes to reload the page"))
						{
							window.location.reload(true);
						}
						else
						{
							element.html('Upload Logo');
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
	$(document).on('click','#uploadFavicon',function(e){
		var element=$(this);
		element.html('uploading ....');
		var imgname  =  $('#faviconFile').val();
		var size  =  $('#faviconFile')[0].files[0].size;
		var ext =  imgname.substr( (imgname.lastIndexOf('.') +1) );
		if(ext=='jpg' || ext=='jpeg' || ext=='png' || ext=='gif' || ext=='PNG' || ext=='JPG' || ext=='JPEG')
		{
			if(size<=1000000)
			{
				var data = new FormData();
				data.append('image', $('#faviconFile')[0].files[0]);
				data.append(csrfName,csrfHash);
				$.ajax({
					type:'POST',
					url:'<?php echo base_url()."post-update-site-favicon"?>',
					type: "POST",
					data : data,
					processData: false,
					contentType: false,
					success: function(response) 
					{
						var response=$.parseJSON(response);
						if(response['type']==1)
						{
							alert(response['html']);
							element.addClass('hide');
						}
						else if(response['type']==2)
						{
							window.location.href="<?php echo base_url()."admin/login";?>";
						}
						else
						{
							alert(response['html']);
						} 
						element.html('Upload Favicon');
					},
					error: function (xhr, data, error) {
						if (window.confirm("This page is expired , Please click Yes to reload the page"))
						{
							window.location.reload(true);
						}
						else{
							element.html('Upload Favicon');
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
	
</script>
</body>
</html>