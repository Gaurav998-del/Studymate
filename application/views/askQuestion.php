<?php 
$this->load->view('includes/head');?>
<link rel="stylesheet" href="<?php echo base_url()."plugins/tags/jquery.tagsinput.css"?>">
<?php 
$this->load->view('includes/header');
?>	
	<div id="postImages" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body p-0">
					<div class="report-heading">
						<h4 class="">Upload Images and Get Links to embed</h4>
					</div> 
					<div class="image-upload-area">
						<input type="file" id="imageFile" class="edit-image"/>
						<span class="upload-info">Select an image from here and click upload button below</span>
					</div>
					<div id="successImageUploaded" class="alert alert-success d-none"></div>
					<p class="d-none" id="successImageUploadedDesc">Place/Embed the above image code in the html to output image</p>
				</div>
				<div class="modal-footer">
					<button id="uploadPic" type="button" class="btn btn-default">Upload</button>
				</div>
			</div>
		</div>
	</div>
	<div class="main-body">
		<div class="container custom py-5">
			<div class="row justify-content-md-center">
				<div  class="col-md-8 col-lg-7">
					<div class="inner-question main ask-question-main">
						<form> 
							<div class="form-group ask-q-filter"> 
								<label>Question Category</label>
								<div class="SumoSelect w-100 ask-qu" tabindex="0">
									<select id="category" class="search_test SumoUnder form-control input-rounded w-100" onchange="subcategory()">
										<option value="">Please Select Category</option>
										<?php foreach ($categories as $index=>$value) {?>
											<option value="<?php echo $value['catid'];?>">
												<?php echo $value['name'];?>
											</option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="form-group ask-q-filter"> 
								<label>Question Subcategory</label>
								<div class="SumoSelect w-100 ask-qu" >
									<select id="scategory" class="form-control input-rounded w-100">
										<option value="">Please Select Subcategory</option>
									</select>
									<!-- <select id="scategory" class="search_test SumoUnder form-control input-rounded w-100">
										<option value="">Please Select SubCategory</option>
										<?php foreach ($categories as $index=>$value) {?>
											<option value="<?php echo $value['catid'];?>">
												<?php echo $value['name'];?>
											</option>
										<?php } ?>
									</select> -->
								</div>
							</div>

							<div class="form-group">
								<label>Question </label>
								<input class="form-control" id="title" name="title" value="" type="text" placeholder="Please Enter Your Question" onkeypress="checkquestion()">
								<span id="questionerror" style="color: red"></span>


							</div>
							<div class="form-group">
								<label>Question Description</label>
								<!-- <div class="alert alert-info">Do not add &lt;script&gt; tag</div> -->
								<textarea name="editor" id="editor"></textarea>
							</div>
							<div class="form-group tage-input-main">
								<label>Tags</label>
								<input id="tags" value="" class="tags-input w-100" type="text" placeholder="">
							</div>
							<div class="form-group">
								<div id="successQuestion" class="alert alert-success d-none questionMessages">
								</div>
								<div id="errorQuestion" class="alert alert-danger d-none questionMessages">
								</div> 
								<button class="btn btn-success" type="button" value="" id="postQuestion">Post Question</button>
								<!-- <button class="btn btn-primary" type="button" value="" id="submitImages">Embed images in Question</button> -->
							</div>
						</form>
					</div>
				</div>
		</div>
	</div>
</div>
<?php $this->load->view('includes/footer');?>	
<script src="//cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>plugins/animatedSelectBox/jquery.sumoselect.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()."plugins/tags/jquery.tagsinput.js"?>"></script>
<script>
	$(document).ready(function() {
		$('#category').SumoSelect({search: true, searchText: 'Enter here.'});
		var csrfName="<?php echo $this->security->get_csrf_token_name();?>";
		var csrfHash="<?php echo $this->security->get_csrf_hash();?>";
	
		$('#tags').tagsInput();
		CKEDITOR.replace('editor',{allowedContent:true});
		$(document).on('click','#postQuestion',function(e) {
			e.preventDefault();
			$('.questionMessages').addClass('d-none').html('');
			var description=CKEDITOR.instances.editor.getData();
			var title=$('#title').val().replace(/&lt;/g, '<').replace(/&gt;/g, '>');
			var category=$('#category').val();
			var scategory=$('#scategory').val();
			var tags=$('#tags').val();
			var fd = new FormData(); 
			fd.append('description',description);
			fd.append('title',title);
			fd.append('tags',tags);
			fd.append('category',category);
			fd.append('scategory',scategory);
			fd.append(csrfName,csrfHash);
			$.ajax({
				type:'POST',
				url:'<?php echo base_url()."post-question"?>',
				type: "POST",
				data : fd,
				processData: false,
				contentType: false,
				success: function(response) 
				{
					var response=$.parseJSON(response);
					if (response['type']==1)
					{
						$('#successQuestion').html(response['html']);
						$('#successQuestion').removeClass('d-none');
						<?php if ($siteSettings['adminApproveQuestions']==0) {?>
						window.location.href=response['link'];
						<?php } ?>
					}
					else
					{
						$('#errorQuestion').html(response['html']);
						$('#errorQuestion').removeClass('d-none');
					}
				},
				error: function (xhr, data, error) {
					if (window.confirm("This page is expired , Please click Yes to reload the page"))
					{
						window.location.reload(true);
					}
					else
					{
						$('.questionMessages').addClass('d-none').html('');
					}
				}
			});
		});
		
	$(document).on('click','#submitImages',function(){
		<?php if (checksession()) {?>
		$('#postImages').modal();
		<?php } else {?>
		$('#signupModal').modal();
		<?php }?>
	});
	$(document).on('click','#uploadPic',function(e) {
		
			var image  =  $('#imageFile').val();
			
			if (image == '') {
				alert('Please select an image to upload');
				return false;
			}
			var element=$(this);
			var size  =  $('#imageFile')[0].files[0].size;
			var ext =  image.substr( (image.lastIndexOf('.') +1) );
			if (ext=='jpg' || ext=='jpeg' || ext=='png' || ext=='gif' || ext=='PNG' || ext=='JPG' || ext=='JPEG')
			{
				if (size<=1000000)
				{
					element.html('<div class="ld ld-ring ld-spin-fast"></div>');
					$('#successImageUploaded').html('').addClass('d-none');
					$('#successImageUploadedDesc').addClass('d-none');
					var fd = new FormData();
					fd.append('image', $('#imageFile')[0].files[0]);
					fd.append(csrfName,csrfHash);
					$.ajax({
						type:'POST',
						url:'<?php echo base_url()."post-images-to-embed"?>',
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
								$('#successImageUploaded').html(response['link']).removeClass('d-none');
								$('#successImageUploadedDesc').removeClass('d-none');
							}
							else if (response['type']==2)
							{
								$('#signupModal').modal();
							}
							else
							{
								alert(response['html']);
							}
							element.html('Upload');
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
					$('#successImageUploaded').html('').addClass('d-none');
					$('#successImageUploadedDesc').addClass('d-none');
					return false;
				}
			}
			else
			{
				alert('Please upload only images with jpg,jpeg,png,gif,PNG,JPG,JPEG');
				return false;
			}
		});
	});
</script>
<script>
function checkquestion() {
var question=$("#title").val();


		var fd = new FormData();
		fd.append('question',question);
		$.ajax({
		method:'POST',
		url:'<?php echo base_url()."post-questioncheck";?>',
		data : fd,
		processData: false,
	    contentType: false,
		success: function(response) 
		{
			var obj=JSON.parse(response);
	if(obj.type==0)
	{
		$("#questionerror").text(obj.html);
		document.getElementById("postQuestion").disabled = true;
	}
	else
	{
		if(question.includes("porn")==true || question.includes("bitch")==true || question.includes("kiss")==true || question.includes("asshole")==true  || question.includes("fuckoff")==true || question.includes("sonoofbitch")==true)
{
	document.getElementById("postQuestion").disabled = true;

			$("#questionerror").text('Question Contain  Abuse word ');

}
else
{
$("#questionerror").text('');
	document.getElementById("postQuestion").disabled = false;
}
	}
			
		}
	});




}
 function subcategory(){
               var category_id=$('#category').val();
               var fd = new FormData(); 
		fd.append('category_id',category_id);
               $.ajax({
			type:'POST',
			url:'<?php echo base_url()."find-subcategories"?>',
			type: "POST",
			data : fd,
			processData: false,
			contentType: false,
			success: function(response) 
			{
				// console.log(response);
$('#scategory').html(response);
			},
			error: function (xhr, data, error) {
				if (window.confirm("This page is expired , Please click Yes to reload the page"))
				{
					window.location.reload(true);
				}
			}
		});
            }
</script>
