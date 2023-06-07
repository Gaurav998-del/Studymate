<footer class="custom">
	<div class="main-foter">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-md-6 col-lg-4 col-xl-4 my-2">
					<ul class="foter-option">
						<li class="nav-item logo-main w-100 mb-2">
							<a class="nav-link custom pl-0" href="<?php echo base_url();?>">
								<img class="img-fluid logo foter" alt="logo" src="<?php echo base_url()."images/".$siteSettings['logo'];?>">
							</a>
						</li>
						
						<li>
							<ul class="inline-icon footer py-3">
								<?php if(strlen($siteSettings['facebookLink'])>0){?>
								<li><a href="<?php echo $siteSettings['facebookLink'];?>"><img  alt="social" style="width:32px;" src="<?php echo base_url()."images/facebook.png"?>"></a></li>
								<?php }
								if(strlen($siteSettings['twitterLink'])>0){?>
								<li><a href="<?php echo $siteSettings['twitterLink'];?>"><img alt="social" style="width:32px;" src="<?php echo base_url()."images/twitter.png"?>"></a></li>
								<?php }
								if(strlen($siteSettings['googleLink'])>0){?><li><a href="<?php echo $siteSettings['googleLink'];?>"><img alt="social" style="width:32px;" src="<?php echo base_url()."images/google.png"?>"></a></li>
								<?php }
								if(strlen($siteSettings['dribbleLink'])>0){?><li><a href="<?php echo $siteSettings['dribbleLink'];?>"><img alt="social" style="width:32px;" src="<?php echo base_url()."images/rss.png"?>"></a></li>
								<?php }?>
							</ul>
						</li>
					</ul>
				</div>
				<div class="col-sm-6 col-md-6 col-lg-4 col-xl-4 my-2">
					<ul class="foter-option">
						<li class="heading-fot nav-link">Questions </li>
						<li class="">
							<a class="nav-link custom" href="<?php echo base_url();?>"> Studymate</a>
						</li>
						<li class="">
							<a class="nav-link custom" href="<?php echo base_url()."questions";?>"> Questions</a>
						</li>
						<li class="">
							<a class="nav-link custom" href="<?php echo base_url()."questions/hot";?>">Trending</a>
						</li>
						<li class="">
							<a class="nav-link custom" href="<?php echo base_url()."questions/unanswered";?>"> Unanswered</a>
						</li>
						
					</ul>
				</div>
				<!-- <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3 my-2">
					<ul class="foter-option">
						<li class="heading-fot nav-link">Category </li>
						<li class="">
							<a class="nav-link custom" href="<?php echo base_url()."categories";?>"><span><i class="icon ion-md-pricetags"></i></span> Categories</a>
						</li>
						<li class="">
							<a class="nav-link custom" href="<?php echo base_url()."users";?>"><span><i class="icon ion-md-contacts"></i></span> Users</a>
						</li>
				
					</ul>
				</div> -->
				<div class="col-sm-6 col-md-6 col-lg-4 col-xl-4 my-2">
					<ul class="foter-option">
						<li class="heading-fot nav-link">Other </li>
						<li class="">
							<a class="nav-link custom" href=""> About Us</a>
						</li>
						<li class="">
							<a class="nav-link custom" href=""> Contact Us</a>
						</li>
						<li class="">
							<a class="nav-link custom" href=""> Privacy Policy</a>
						</li>
						
					</ul>
				</div>
				
			</div>
		</div>
	</div>
</footer>
<div class="footer-copyright foter"> 
	<div class="container-fluid text-center" > 
		<span class="">Powered By @2020 <a class="poweredby-foter" href="">Studymate</a></span>
	</div>
</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/script.js"></script>

	<script>
		var csrfName="<?php echo $this->security->get_csrf_token_name();?>";
		var csrfHash="<?php echo $this->security->get_csrf_hash();?>";
		$(document).on('click','#forgotM',function(){
			$('#signupModal').modal('toggle');
			$('#forgetModal').modal();
		});
		
		$(document).on('click','#signupB',function(){
			$('.signupmessages').addClass('d-none').html('');
			var name=$('#nameS').val();
			var email=$('#emailS').val();
			var password=$('#passwordS').val();
			var ucontact=$('#ucontact').val();
			var udob=$('#udob').val();

			var formData=new FormData();
			formData.append('name',name);
			formData.append('email',email);
			formData.append('password',password);
			formData.append('ucontact',ucontact);
			formData.append('udob',udob);
			formData.append(csrfName,csrfHash);
			$.ajax({
				type: 'post',
				data: formData,
				processData: false,
				contentType: false,
				url:"<?php echo base_url()."signup"?>",
				success: function(response) {
					var response=$.parseJSON(response);
					if(response['type']==1)
					{
						$('#successSignup').html(response['html']);
						$('#successSignup').removeClass('d-none');
					}
					else
					{
						$('#errorSignup').html(response['html']);
						$('#errorSignup').removeClass('d-none');
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
		$(document).on('click','#loginB',function(){
			$('.loginmessages').addClass('d-none').html('');
			var email=$('#emailL').val();
			var password=$('#passwordL').val();
			var formData=new FormData();
			formData.append('email',email);
			formData.append('password',password);
			formData.append(csrfName,csrfHash);
			$.ajax({
				type: 'post',
				data: formData,
				processData: false,
				contentType: false,
				url:"<?php echo base_url()."loginA"?>",
				success: function(response) {
					var response=$.parseJSON(response);
					if(response['type']==1)
					{
						$('#successLogin').html(response['html']);
						$('#successLogin').removeClass('d-none');
						window.location.reload(true);
					}
					else
					{
						$('#errorLogin').html(response['html']);
						$('#errorLogin').removeClass('d-none');
						if(response['type']==2)
						{
							window.location.reload(true);
						}
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
		
		$(document).on('click','#resetB',function(){
			$('.resetmessages').addClass('d-none').html('');
			var email=$('#emailF').val();
			var formData=new FormData();
			formData.append('email',email);
			formData.append(csrfName,csrfHash);
			$.ajax({
				type: 'post',
				data: formData,
				processData: false,
				contentType: false,
				url:"<?php echo base_url()."forgotA"?>",
				success: function(response) {
					var response=$.parseJSON(response);
					if(response['type']==1)
					{
						$('#successForgot').html(response['html']);
						$('#successForgot').removeClass('d-none');
					}
					else
					{
						$('#errorForgot').html(response['html']);
						$('#errorForgot').removeClass('d-none');
						if(response['type']==2)
						{
							window.location.reload(true);
						}
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
		$(document).on('click','#resetF',function(){
			$('.resetmessages').addClass('d-none').html('');
			var passwordF=$('#passwordF').val();
			var hash=$('#hash').val();
			var formData=new FormData();
			formData.append('passwordF',passwordF);
			formData.append('hash',hash);
			formData.append(csrfName,csrfHash);
			$.ajax({
				type: 'post',
				data: formData,
				processData: false,
				contentType: false,
				url:"<?php echo base_url()."forgotAc"?>",
				success: function(response) {
					var response=$.parseJSON(response);
					if(response['type']==1)
					{
						$('#successForgotC').html(response['html']);
						$('#successForgotC').removeClass('d-none');
						window.location.href="<?php echo base_url()."login";?>";
					}
					else
					{
						$('#errorForgotC').html(response['html']);
						$('#errorForgotC').removeClass('d-none');
						if(response['type']==2)
						{
							window.location.reload(true);
						}
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
	</script>
</body>
</html>