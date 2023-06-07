<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Blogs extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('QuestionsModel');
	}
	
	
	public function postImagesForBlog()
	{
		
		
		$getSettings=$this->App_model->getData('siteSettings',$resultType="row_array",$arg=['select'=>['imgurClientId']]);
		if(strlen($getSettings['imgurClientId'])==0)
		{
			responseGenerate(0,"There is some error in the configuration, Please try again later");
		}
		
		if (isset($_FILES['image'])) {
			if ($_FILES['image']['error']==0) {
				$client_id=$getSettings['imgurClientId'];
				$filetype = explode('/',mime_content_type($_FILES['image']['tmp_name']));
				if ($filetype[0] !== 'image') {
					die('Invalid image type');
				}
				$image = file_get_contents($_FILES['image']['tmp_name']);
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, 'https://api.imgur.com/3/image.json');
				curl_setopt($ch, CURLOPT_POST, TRUE);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
				curl_setopt($ch, CURLOPT_HTTPHEADER, array( "Authorization: Client-ID $client_id" ));
				curl_setopt($ch, CURLOPT_POSTFIELDS, array( 'image' => base64_encode($image) ));
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				$dataReturned = curl_exec($ch);
				curl_close($ch);
				$dataReturned = json_decode($dataReturned,true);
				if (isset($dataReturned['data']))
				{
					$imgGet=$dataReturned['data'];
					if(array_key_exists('link',$imgGet))
					{
						$imgCreate='<img src="'.$imgGet['link'].'"/>';
						$result=['type'=>1,'link'=>encodeContent($imgCreate),'html'=>"Image was successfully uploaded"];
						echo json_encode($result);
					} else {
						responseGenerate(0,"Unable to upload image as server is busy, Pleas try again later");
					}
				} else {
					responseGenerate(0,"Unable to upload image as server is busy, Pleas try again later");
				}
			} else {
				responseGenerate(2,"This file is corrupted , Please chose another");
			}
		} else {
			responseGenerate(2,"Please choose an image to upload");
		}
	}
	
	public function blog_comment()
	{
			$name=trim($this->input->post('name'));
			$email=trim($this->input->post('email'));
			$comments=trim($this->input->post('comments'));
			$commentid=trim($this->input->post('commentid'));
			$m=date("Y-m-d");
			
			//$userid=getuserid();
		
			$b=$this->App_model->insert('blog_comment',['name'=>$name,'email'=>$email,'comment'=>$comments,'date'=>$m,'comment_id'=>$commentid,],$batch=false);
			if($b){
			
		echo json_encode($name);
			}
			else{
				echo "error";
				exit;
			}
		
	}
	public function search_blog(){
		$name=trim($this->input->post('search'));
		$data=$this->SiteModel->getSiteData();
		$data['title']="Ask";
		$output='';
		$this->load->model("Blog");
		$p=$this->Blog->search($name);
		
		foreach($p as $b){
			
		$output='<a href="'.base_url().'blog/'.$b['blog_title'].'/'.$b['id'].'" class="blog-post" id="blog-post" style="text-decoration:none;">
					<!-- Blog Post Thumbnail -->
					<div class="blog-post-thumbnail">
						<div class="blog-post-thumbnail-inner">
							<span class="blog-item-tag">Tips</span>
							<img src="'.base_url().'images/'.$b['thumbnail'].'" alt=""></img>
						</div>
					</div>
					<!-- Blog Post Content -->
					<div class="blog-post-content">
						<span class="blog-post-date">'.$b['blog_date'].'</span>
						<h3>'.$b['blog_title'].'</h3>
						<p>'.$b['blog_description'].'</p>
					</div>
					<!-- Icon -->
					<div class="entry-icon"></div>
				</a>';
		
		}
	echo json_encode($output);
	
		
		
	}
	public function blogEditor($id)
	{
		$question=$this->App_model->getData('Blog',$resultType="row_array",$arg=['select'=>['id','blog_title','blog_category','blog_description','thumbnail','tags','main_image'],'where'=>['id'=>$id]]);
		
		if (count($question)==0) {
			show_404();
		} 
		
		$data=$this->SiteModel->getSiteData();
		$data['title']=$question['blog_title'];
		
		$data['question']=$question;
		
		$this->load->view('editblog',$data);
	}
	
	public function updateBlog()
	{
		
		
		
			$title=trim($this->input->post('title'));
			$category=trim($this->input->post('category'));
		
			$tags=strip_tags(trim($this->input->post('tags')));
			    $config['upload_path']          = './images/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 2000;
                $config['max_width']            = 2000;
                $config['max_height']           = 2000;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('thumbnail'))
                {
				
                        $error = array('error' => $this->upload->display_errors());

                        echo "file not upload";
                }
                else
                {
					
                        $data = $this->upload->data();
						$image = $data['file_name'];
					
                }
				
				$immg=$image;
				
				$config['upload_path']          = './images/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 1024;
                $config['max_width']            = 1024;
                $config['max_height']           = 2000;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('userfile'))
                {
				
                        $error = array('error' => $this->upload->display_errors());

                        echo "file not upload";
                }
                else
                {
					
                        $data = $this->upload->data();
						$mainimage = $data['file_name'];
					
					
                }

			$description=trim($this->input->post('editor'));
			$id=trim($this->input->post('blogid'));
			
			
			$m=date("Y-m-d");
			
			$userid=getuserid();
			$this->App_model->updateData('Blog',['blog_title'=>$title,'blog_category'=>$category,'tags'=>$tags,'blog_description'=>$description,'thumbnail'=>$immg,'main_image'=>$mainimage,'blog_date'=>$m,],['id'=>$id]);
			redirect("/Blogs/blog_posted");
		
	}
	
	public function postDelBlog()
	{
		
		if (!checksessionAdmin())
		responseGenerate(2,"Please login to continue");
	
		$qid=(int) secureInput($this->input->post('qid'));
	
		
		$where=['id'=>$qid];
		$this->App_model->deleteData('Blog',$where);
		responseGenerate(1,"Blog was successfully deleted");
	}
	
	public function blog_details($id,$b){
		$c=str_replace('-', ' ', $b);
	
		$data=$this->SiteModel->getSiteData();
		$data['title']=$c;
		$this->load->model("Blog");
		$r=$this->Blog->blogs($id);
		$data['blog']=$r;
	
		$f=$this->Blog->comments($id);
		$data['count']=count($f);
		$data['comments']=$f;
		$rel=$this->Blog->related($c);
        $data['related']=$rel;
		
		$this->load->view('blog-post',$data);
	}
}