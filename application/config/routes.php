<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$route['default_controller'] = 'welcome';
$route['logout'] = 'Welcome/logout';
$route['signup'] = 'Welcome/signup';
$route['facebook/redirect'] = 'facebook/index';
$route['google/redirect'] = 'google/index';
$route['loginA'] = 'Welcome/login';
$route['forgotA'] = 'Welcome/forgot';
$route['forgotAc'] = 'Welcome/forgotAc';
$route['login'] = 'Welcome/index/1';
$route['search-main-page'] = 'Welcome/search';
$route['signup/confirm/(:any)'] = 'Welcome/signupConfirm/$1';
$route['forgot/confirm/(:any)'] = 'Welcome/index/2';
$route['notifications'] = 'Profile/loadNotifications';
$route['profile/(:num)'] = 'Profile/loadProfile/$1';
$route['profile/(:num)/activity'] = 'Profile/loadProfileActivity/$1';
$route['profile/(:num)/edit'] = 'Profile/loadProfileEdit/$1';
$route['post-update-profile'] = 'Profile/postUpdateProfile';
$route['post-update-profile-pic'] = 'Profile/postUpdateProfilePic';
$route['post-get-profile-questions'] = 'Profile/postGetProfileQuestions';
$route['post-get-profile-answers'] = 'Profile/postGetProfileAnswers';
$route['reputation/update/monthly'] = 'ReputationManage/index';
$route['badges'] = 'Badges/index';
  
$route['question/badges/award']='BadgesAward/questionsAward';
$route['answer/badges/award']='BadgesAward/answersAward';
$route['participation/badges/award']='BadgesAward/participationAward';

$route['tags/(:any)'] = 'Questions/loadTaged/$1';
$route['users'] = 'Users/loadUsers'; 
$route['load-more-users'] = 'Users/loadMoreUsers'; 
$route['filter-users'] = 'Users/filterUsers'; 
$route['categories'] = 'Categories/loadCategories'; 
$route['load-more-categories'] = 'Categories/loadMoreCategories'; 
$route['categories/(:any)'] = 'Questions/loadCategories/$1';
$route['categories/language/(:any)'] = 'Questions/loadCategories/language/$1';
$route['questions'] = 'Questions/loadQuestions/def';
$route['questions/hot'] = 'Questions/loadQuestions/hot';
$route['questions/unanswered'] = 'Questions/loadQuestions/unanswered';
$route['questions/ask'] = 'Questions/loadAsk';
$route['find-subcategories'] = 'Questions/findsubcategories';
$route['post-question'] = 'Questions/postQuestion';
$route['post-questioncheck'] = 'Questions/postQuestioncheck';
$route['post-images-to-embed'] = 'Questions/postImagesToEmbed';
$route['post-update-question'] = 'Questions/postUpdateQuestion';
$route['questions/(:any)/(:any)'] = 'Questions/questionViewer/$1';  
$route['questions/edit/(:any)/(:any)'] = 'Questions/questionEditor/$1';
$route['vote-manage-question'] = 'Questions/voteManageQuestion'; 
$route['vote-manage-answer'] = 'Questions/voteManageAnswer'; 
$route['vote-manage-questionR'] = 'Questions/voteManageQuestionR'; 
$route['vote-manage-AnswersR'] = 'Questions/voteManageAnswerR'; 
$route['post-question-reply'] = 'Questions/postQuestionReply'; 
$route['post-edit-question-reply'] = 'Questions/postEditQuestionReply'; 
$route['post-edit-answer-reply'] = 'Questions/postEditAnswerReply'; 
$route['post-question-answer'] = 'Questions/postQuestionAnswer'; 
$route['post-edit-answer'] = 'Questions/postEditAnswer'; 
$route['post-delete-answer'] = 'Questions/postDelAnswer'; 
$route['post-delete-question'] = 'Questions/postDelQuestion'; 
$route['post-delete-question-reply'] = 'Questions/postDelQuestionReply'; 
$route['post-delete-answer-reply'] = 'Questions/postDelAnswerReply'; 
$route['post-a-report-answer'] = 'Questions/postReportAnswer'; 
$route['post-a-report-qreply'] = 'Questions/postReportQreply'; 
$route['post-a-report-areply'] = 'Questions/postReportAreply'; 
$route['load-inner-tabs-question'] = 'Questions/loadInnerTabsQuestion'; 
$route['load-more-q-profile'] = 'Profile/loadMoreQProfile'; 
$route['load-more-a-profile'] = 'Profile/loadMoreAProfile'; 
$route['post-answer-reply'] = 'Questions/postQuestionAnswerReply'; 
$route['get-activity-tab'] = 'Profile/getActivityTab'; 
$route['load-more-q'] = 'Questions/loadMoreQ'; 
$route['load-more-n'] = 'Profile/loadMoreN'; 
$route['load-more-mq'] = 'Questions/loadMoreMq'; 
$route['load-more-mqar'] = 'Questions/loadMoreMqar'; 
$route['load-more-qa'] = 'Questions/loadMoreQa'; 
$route['admin'] = 'Admin/loadDashboard'; 
$route['post-update-site-logo'] = 'Admin/postUpdateSiteLogo'; 
$route['post-update-site-favicon'] = 'Admin/postUpdateSiteFavicon'; 
$route['post-update-settings'] = 'Admin/postUpdateSiteSettings'; 
$route['post-update-ads-settings'] = 'Admin/postUpdateAdsSiteSettings'; 
$route['post-update-admin-settings'] = 'Admin/postUpdateAdminSettings'; 

$route['post-update-categories'] = 'Admin/postUpdateCategories'; 
$route['post-update-subcategories'] = 'Admin/postUpdatesubCategories'; 

$route['post-update-blogs'] = 'Admin/postUpdateBlogs'; 

$route['post-insert-categories'] = 'Admin/postInsertCategories'; 
$route['post-insert-subcategories'] = 'Admin/postInsertSubCategories'; 
$route['post-admin-moderator-action'] = 'Admin/postModeratorAction'; 
$route['post-admin-appBlock-action'] = 'Admin/postAppBlockAction'; 
$route['post-admin-delete-user'] = 'Admin/postDeleteUser'; 
$route['post-admin-delete-category'] = 'Admin/postDeleteCategory'; 
$route['post-admin-edit-category'] = 'Admin/postEditCategory'; 
$route['post-admin-delete-subcategory'] = 'Admin/postDeletesubCategory'; 
$route['post-admin-edit-subcategory'] = 'Admin/postEditsubCategory'; 

$route['post-admin-delete-answer'] = 'Admin/postDeleteAnswer'; 
$route['post-admin-delete-answer-reply'] = 'Admin/postDeleteAnswerReply'; 
$route['post-admin-delete-question'] = 'Admin/postDeleteQuestion'; 
$route['post-admin-questionBlock-action'] = 'Admin/postQuestionBlockAction'; 
$route['post-admin-delete-question-reply'] = 'Admin/postDeleteQuestionReply'; 
$route['admin/dashboard'] = 'Admin/loadDashboard'; 

$route['admin/login'] = 'Admin/loadLogin'; 
$route['admin/logout'] = 'Admin/logout'; 
$route['admin/settings'] = 'Admin/loadSettings';
$route['admin/users'] = 'Admin/loadUsers/0';
$route['admin/users/(:any)'] = 'Admin/loadUsers/$1';
$route['admin/questions'] = 'Admin/loadQuestions/0';
$route['admin/questions/(:any)'] = 'Admin/loadQuestions/$1';
$route['admin/reported/answers'] = 'Admin/loadReportedAnswers/0';
$route['admin/reported/answers/replies'] = 'Admin/loadReportedAnswersReplies/0';
$route['admin/reported/answers/replies/(:any)'] = 'Admin/loadReportedAnswersReplies/$1';
$route['admin/reported/questions/replies'] = 'Admin/loadReportedQuestionsReplies/0';
$route['admin/reported/questions/replies/(:any)'] = 'Admin/loadReportedQuestionsReplies/$1';
$route['admin/reported/answers/(:any)'] = 'Admin/loadReportedAnswers/$1';
$route['admin-loginA'] = 'Admin/login'; 
$route['searchquestion'] = 'Welcome/searchquestion'; 
$route['admin/post-blog'] = 'Admin/blog'; 
//Exam Cat
$route['admin/post-examcat'] = 'Admin/examcat'; 
$route['admin/post-insert_category'] = 'Admin/insert_category'; 
$route['admin/post-remove_category/(:any)'] = 'Admin/remove_category/$1'; 

// level list
$route['admin/post-level'] = 'Admin/level_list'; 
$route['admin/post-insert_level'] = 'Admin/insert_level'; 
$route['admin/post-remove_level/(:any)'] = 'Admin/remove_level/$1'; 

// Exam Question
$route['admin/post-pre_new_question'] = 'Admin/pre_new_question';
$route['admin/post-new_question_1/(:any)/(:any)'] = 'Admin/new_question_1/$1/$1';
$route['admin/post-new_question_2/(:any)/(:any)'] = 'Admin/new_question_2/$1/$1';
$route['admin/post-new_question_3/(:any)/(:any)'] = 'Admin/new_question_3/$1/$1';
$route['admin/post-new_question_4/(:any)/(:any)'] = 'Admin/new_question_4/$1/$1';
$route['admin/post-new_question_5/(:any)/(:any)'] = 'Admin/new_question_5/$1/$1';
$route['admin/post-question_list'] = 'Admin/question_list';
$route['admin/post-edit_question_1/(:any)'] = 'Admin/edit_question_1/$1';
$route['admin/post-edit_question_2/(:any)'] = 'Admin/edit_question_2/$1';
$route['admin/post-edit_question_3/(:any)'] = 'Admin/edit_question_3/$1';
$route['admin/post-edit_question_4/(:any)'] = 'Admin/edit_question_4/$1';
$route['admin/post-edit_question_5/(:any)'] = 'Admin/edit_question_5/$1';
$route['admin/post-pre_question_list'] = 'Admin/pre_question_list';
$route['admin/post_exam_list'] = 'admin/exam_list';
$route['admin/post_add_new_quiz'] = 'Admin/add_new_quiz';
$route['admin/post-insert_quiz'] = 'Admin/insert_quiz';
$route['admin/post-update_quiz/(:any)'] = 'Admin/update_quiz/(:any)';



// Endquestion 
$route['blog-search'] = 'Blogs/search_blog'; 
$route['blogs'] = 'Admin/blog_posted'; 
$route['blogs/(:any)'] = 'Admin/blog_posted'; 
$route['blog/(:any)/(:any)'] = 'Admin/blog_details/$1/$2';
$route['blog/(:any)/(:any)'] = 'Blogs/blog_details/$1/$2';
$route['blogs/edit/(:any)'] = 'Blogs/blogEditor/$1';
$route['post-update-blog'] = 'Admin/postUpdateBlogs';
$route['post-delete-blog'] = 'Admin/postDelBlog'; 
$route['view-blogs'] = 'Admin/blogs_posted'; 
$route['post-admin-edit-blog'] = 'Admin/postEditBlog'; 
$route['post-comment-blog'] = 'Blogs/blog_comment'; 
$route['post-job'] = 'Admin/postJobs'; 
$route['job-post'] = 'Admin/postedJob';
$route['view-jobs'] = 'Admin/jobs_posted';  
$route['post-admin-edit-job'] = 'Admin/postEditJob';
$route['post-update-job'] = 'Admin/postUpdateJobs';
$route['post-delete-job'] = 'Admin/postDelJob'; 
$route['Questions/post_validate_quiz/(:any)'] = 'questions/validate_exam/$1'; 

$route['privacy'] = 'welcome';
$route['terms'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
