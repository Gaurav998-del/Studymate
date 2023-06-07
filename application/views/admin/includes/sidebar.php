<aside class="main-sidebar">
    <section class="sidebar">
	<?php 
	$pageMeta=$this->uri->segment(1)."/".$this->uri->segment(2).(strlen($this->uri->segment(3))>0?("/".$this->uri->segment(3)):"");?>
		<ul class="sidebar-menu" data-widget="tree">
			<li class="<?php echo ($pageMeta=="admin/" || $pageMeta=="admin/dashboard")?"active":"";?>"><a href="<?php echo base_url()."admin/dashboard";?>"><i class="fa fa-tachometer" aria-hidden="true"></i>  <span>Dashboard</span></a></li>
			
			<li class="<?php echo $pageMeta=="admin/users"?"active":"";?>"><a href="<?php echo base_url()."admin/users";?>"><i class="fa  fa-user-circle-o"></i> <span>Users</span></a></li>

			<li class="<?php echo $pageMeta=="admin/users"?"active":"";?>"><a href="<?php echo base_url()."admin/categories";?>"><i class="fa fa-tag"></i> <span>Categories</span></a></li>
			
			<li class="<?php echo $pageMeta=="admin/users"?"active":"";?>"><a href="<?php echo base_url()."admin/subcategories";?>"><i class="fa fa-tag"></i> <span>Sub Categories</span></a></li>

			<li class="treeview" style="height: auto;">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Question and Answer</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="display: none;">
            <li class="<?php echo ($pageMeta=="admin/questions" || $pageMeta=="admin/reported/questions")?"active":"";?>"><a href="<?php echo base_url()."admin/questions";?>"><i class="fa  fa-question-circle"></i> <span>Questions</span></a></li>
			<li class="<?php echo $pageMeta=="admin/reported/answers"?"active":"";?>"><a href="<?php echo base_url()."admin/reported/answers";?>"><i class="fa fa-flag"></i> <span>Reported Answers</span></a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Blog</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo $pageMeta=="post-blog"?"active":"";?>"><a href="<?php echo base_url()."admin/post-blog";?>"><i class="fa fa-rss"></i> <span>Post Blog</span></a></li>
			<li class="<?php echo $pageMeta=="view-blogs"?"active":"";?>"><a href="<?php echo base_url()."view-blogs";?>"><i class="fa fa-rss"></i> <span>View Blog</span></a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Exam</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo $pageMeta=="post-blog"?"active":"";?>"><a href="<?php echo base_url()."admin/post-examcat";?>"><i class="fa fa-rss"></i> <span>Exam Category</span></a></li>
      <li class="<?php echo $pageMeta=="view-blogs"?"active":"";?>"><a href="<?php echo base_url()."admin/post-level";?>"><i class="fa fa-rss"></i> <span>Exam Level</span></a></li>

      <li class="<?php echo $pageMeta=="view-blogs"?"active":"";?>"><a href="<?php echo base_url()."admin/post-pre_new_question";?>"><i class="fa fa-rss"></i> <span>Add Exam Question</span></a></li>

      <li class="<?php echo $pageMeta=="view-blogs"?"active":"";?>"><a href="<?php echo base_url()."admin/post-question_list";?>"><i class="fa fa-rss"></i> <span> Exam Question List</span></a></li>
<li class="<?php echo $pageMeta=="view-blogs"?"active":"";?>"><a href="<?php echo base_url()."admin/post_add_new_quiz";?>"><i class="fa fa-rss"></i> <span>Add Exam </span></a></li>
<li class="<?php echo $pageMeta=="view-blogs"?"active":"";?>"><a href="<?php echo base_url()."admin/post_exam_list";?>"><i class="fa fa-rss"></i> <span> Exam  List</span></a></li>
                

          </ul>
        </li>

			<li class="<?php echo $pageMeta=="admin/settings"?"active":"";?>"><a href="<?php echo base_url()."admin/settings";?>"><i class="fa fa-tasks" aria-hidden="true"></i> <span>Settings</span></a></li>

			
		</ul>
    </section>
</aside>
