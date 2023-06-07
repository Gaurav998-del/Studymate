<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $siteSettings['siteName'];?> | Log in</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url()."admincss/bower_components/bootstrap/dist/css/bootstrap.min.css"?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url()."admincss/bower_components/font-awesome/css/font-awesome.min.css"?>">
 
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()."admincss/dist/css/AdminLTE.min.css"?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url()."admincss/plugins/iCheck/square/blue.css"?>">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page" style="background-image: url('<?php echo base_url();?>images/adbg.jpg');" >
<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo base_url()."admin"?>" style="font-size: 50px;color: #fff;"><?php echo $siteSettings['siteName'];?></a>
  </div>
  <div class="login-box-body">
    <p class="login-box-msg">Admin Sign In</p>

    <form method="post">
      <div class="form-group has-feedback">
        <input id="emailL" type="email" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input id="passwordL" type="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-12">
			<div id="successLogin" class="alert alert-success hide loginmessages">
			</div>
			<div id="errorLogin" class="alert alert-danger hide loginmessages">
			</div>
          <button id="loginA" type="button" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script src="<?php echo base_url()."admincss/bower_components/jquery/dist/jquery.min.js"?>"></script>
<script src="<?php echo base_url()."admincss/bower_components/bootstrap/dist/js/bootstrap.min.js"?>"></script>

<script>
var csrfName="<?php echo $this->security->get_csrf_token_name();?>";
var csrfHash="<?php echo $this->security->get_csrf_hash();?>";

$(document).on('click','#loginA',function(){
	$('.loginmessages').addClass('hide').html('');
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
		url:"<?php echo base_url()."admin-loginA"?>",
		success: function(response) {
			console.log(response);
			var response=$.parseJSON(response);
			if(response['type']==1)
			{
				$('#successLogin').html(response['html']);
				$('#successLogin').removeClass('hide');
				location.reload();
			}
			else
			{
				$('#errorLogin').html(response['html']);
				$('#errorLogin').removeClass('hide');
				if(response['type']==2)
				{
					location.reload();
				}
			}
		},
		error: function (xhr, data, error) {
			if (window.confirm("Something Get Wrong, Please reload the page"))
			{
				window.location.reload(true);
			}
		}
	});
});
</script>
</body>
</html>
