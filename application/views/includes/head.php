<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo (strlen($title)>0?$title." | ":"").$siteSettings['siteName'];?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="<?php echo $desc=substr($siteSettings['description'],30);?>"/>
	<meta name="keywords" content="<?php echo $siteSettings['tags'];?>"/>
	<meta property="og:title" content="<?php echo $siteSettings['siteName'];?> | <?php echo $title;?>" />
	<meta property="og:type" content="website" />
	<meta property="og:image" content="<?php echo base_url()."images/".$siteSettings['logo'];?>" />
	<meta property="og:description" content="<?php echo $desc;?>" /> 
	<meta property="og:site_name" content="<?php echo $title;?>" />
	<link rel="shortcut icon" type="image/png" href="<?php echo base_url()."images/".$siteSettings['favicon'];?>"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url()?>css/style.css"> 
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Maven+Pro:400,500&amp;subset=vietnamese" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Ropa+Sans" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/themify-icons/0.1.2/css/themify-icons.css" rel="stylesheet" type="text/css"> 

	<link rel="stylesheet" href="<?php echo base_url()?>plugins/animatedSelectBox/sumoselect.css"> 
	<link rel="stylesheet" href="<?php echo base_url()?>plugins/loading.css"> 
	<link rel="stylesheet" href="<?php echo base_url()?>plugins/loading-btn.css"> 
	<link href="https://unpkg.com/ionicons@4.2.4/dist/css/ionicons.min.css" rel="stylesheet">
	
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet"> 
	<link rel="stylesheet" href="<?php echo base_url()?>css/fontawesome/css/font-awesome.min.css" >
	<link rel="stylesheet" href="<?php echo base_url()?>css/animation.css" >
	