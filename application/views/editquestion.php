<?php 
$this->load->view('includes/head');?>
<link rel="stylesheet" href="<?php echo base_url()."plugins/jqueryTextEditor/jquery-te.css"?>">
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
			<div class="row">
				<div class="d-none d-lg-flex col-lg-2">
				</div>
				<div  class="col-md-8 col-lg-7">
					<div class="inner-question main ask-question-main">
						<form >
							<div class="form-group">
								<label>Question Category</label>
								<select id="category" class="form-control input-rounded">
									<option value="">Please Select Category</option>
									<?php 
									$catid=$question['catid'];
									foreach ($categories as $index=>$value) {?>
									<option <?php echo $catid==$value['catid']?"selected":""?> value="<?php echo $value['catid'];?>">
											<?php echo $value['name'];?>
										</option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group">
								<label>Question Title</label>
								<input class="form-control" id="title" value="<?php echo $question['title'];?>" type="text" placeholder="Question Title">
							</div>
							<div class="form-group">
								<label>Question Description</label>
								<div class="alert alert-info">All the html tags are allowed except &lt;script&gt; tag</div>
								<textarea id="editor"><?php echo ($question['description']);?></textarea>
							</div>
							<div class="form-group">
								<label>Tags</label>
								<input id="tags" value="<?php echo $question['tags'];?>" type="text" placeholder="">
							</div>
							<div class="form-group">
								<div id="successQuestion" class="alert alert-success d-none questionMessages">
								</div>
								<div id="errorQuestion" class="alert alert-danger d-none questionMessages">
								</div> 
								<button class="btn btn-success" type="button" value="" id="postUQuestion">Update question</button>
								<button class="btn btn-primary" type="button" value="" id="submitImages">Embed images in Question</button>
							</div>
						</form>
					</div>
				</div>
				<div class="col-md-4 col-lg-3">
				</div>
		</div>
	</div>

<?php $this->load->view('includes/footer');?>	
<script src="//cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>plugins/animatedSelectBox/jquery.sumoselect.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()."plugins/tags/jquery.tagsinput.js"?>"></script>
<script>
	$(document).ready(function() {
		CKEDITOR.replace( 'editor',{allowedContent:true});
		$('#tags').tagsInput();
		$('#category').SumoSelect({search: true, searchText: 'Enter here.'});
		var csrfName="<?php echo $this->security->get_csrf_token_name();?>";
		var csrfHash="<?php echo $this->security->get_csrf_hash();?>";
		$(document).on('click','#postUQuestion',function(e) {
			e.preventDefault();
			$('.questionMessages').addClass('d-none').html('');
			var description=CKEDITOR.instances.editor.getData();
			var title=$('#title').val().replace(/&lt;/g, '<').replace(/&gt;/g, '>');
			var category=$('#category').val();
			var tags=$('#tags').val();
			var fd = new FormData(); 
			fd.append('description',description);
			fd.append('title',title);
			fd.append('tags',tags);
			fd.append('category',category);
			fd.append('qid',<?php echo $qid;?>);
			fd.append(csrfName,csrfHash);
			$.ajax({
				type:'POST',
				url:'<?php echo base_url()."post-update-question"?>',
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