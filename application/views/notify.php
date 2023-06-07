<?php 
$this->load->view('includes/head');
$this->load->view('includes/header');
?>
<style>
<!--@media screen and (max-width: 768px) {
	time.time-notify {
		display: inline-block;
		text-align: right;
		font-size: 14px;
		vertical-align: top;
		font-weight: 400;
		margin-top: 8px;
	}
	.dropdown-menu.notification.show a.dropdown-item {
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: normal;
		height: 37px;
		display: inline-block;
		font-weight: 600 !important;
		vertical-align: middle;
		font-size: 13px !important;
	}
	.dropdown-menu.notification.show {
		width: 100%;
		padding: 0pc;
		box-shadow: rgba(28, 29, 32, 0.23) 0px 6px 16px, rgba(23, 24, 27, 0.25) 0px 9px 40px;
		background-clip: padding-box;
		transition: all 0.11s ease-in 0s;
		border-radius: 0px 0px 0.25rem 0.25rem;
		transition-delay: 0s;
	}
	ul.notify.main-list.pl-0 li {
		white-space: normal;
		max-width: 100%;
		width: 100%;
		padding: 0px 15px;
		border-bottom: 1px solid #dedede;
	}
	ul.notify.main-list.pl-0 {
		max-height: 252px;
		overflow-y: auto;
		width: 100%;
}}
@media screen and (min-width: 768px) {
	li.nav-item.logo-main {
		float: left;
	}
	.dropdown-menu.notification.show {
		transform: translate3d(-261px, 49px, 0px) !important;
}}



.dropdown-menu.notification.show {
	left: auto !important;
    /* right: 0px; */
    width: 23rem;
	padding: 0pc;
	box-shadow: rgba(28, 29, 32, 0.23) 0px 6px 16px, rgba(23, 24, 27, 0.25) 0px 9px 40px;
    background-clip: padding-box;
    transition: all 0.11s ease-in 0s;
    border-radius: 0px 0px 0.25rem 0.25rem;
	transition-delay: 0s;
}
a.nav-link.dropdown-toggle.notify span.ti-bell {
    font-size: 19px;
    color: #007ee5;
    background-color: #f5f9ff;
    border-radius: 50px;
    padding: 5px 6px;
}
span.badge.badge-light.notify i {
    font-size: 8px;
}
ul.notify.main-list.pl-0 li {
    white-space: nowrap;
}
a.nav-link.dropdown-toggle.notify {
    position: relative;
	display: list-item;
}
a.nav-link.dropdown-toggle.notify>.badge.badge-light.notify {
	position: absolute;
    top: 7%;
    background-color: #fff;
    right: 14%;
    padding: 3px 3px;
}
a.nav-link.dropdown-toggle.notify:after {
	display:none;
}
ul.navbar-navs.options-nav li ul.notify.main-list.pl-0 li {
	display: block;
    padding: 0px 15px;
    border-bottom: 1px solid #dedede;
}
.heading-notify {
    background-color: rgb(248, 249, 252);
    color: rgb(71, 73, 79);
    padding: 0.5rem 0.9rem;
}
ul.notify.main-list.pl-0 {
    max-height: 252px;
    overflow-y: auto;
}

.dropdown-menu.notification.show a.dropdown-item {
	overflow: hidden;
    width: 100%;
    font-size: 13px;
    text-align: left;
    padding: 0px 0px 4px;
    display: inline-block;
    text-overflow: ellipsis;
    vertical-align: middle;
    line-height: 19px;
}
.heading-notify-type {
    display: inline-block;
    width: 81%;
    font-weight: 600;
    font-size: 13px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    line-height: 10px;
}
button.btn.btn-all-notify {
    background-color: transparent;
    text-align: right;
    width: 100%;
    color: #0171cd;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    padding: 9px 15px;
}
.dropdown-menu.notification.show a.dropdown-item:hover {
	color: #0c6dcc !important;
    background-color: #fff;
}
time.time-notify {
    display: inline-block;
    text-align: right;
    font-size: 14px;
    vertical-align: top;
    font-weight: 400;
} -->
.main-motify-all {
    background-color: #fff;
    padding: 15px 19px;
}
.date-notify {
    display: inline-block;
    padding: 4px 2px;
    text-align: center;
    width: 57px;
    background-color: #f0f0f0;
    font-size: 13px;
    border-style: dotted;
    border: none;
    border-top: 2px dotted;
    border-color: #1174d5;
	color: #8d8d8d;
}
span.notify-type {
    vertical-align: top;
    margin-top: 9px;
    display: inline-block;
    padding: 3px 3px;
}
.notify-allheading {
    color: #0c6dcc;
    font-weight: 600;
    font-size: 14px;
}
p.notify-description {
    font-size: 12px;
    color: #9c9c9c;
	margin: 0px;
}
li.row.inner-allnotify {
    border-bottom: 1px solid #dadfea !important;
    vertical-align: top;
    padding: 8px 0px 8px;
}
</style>

	<div class="main-body">
		<div class="upper-search"> 
			<div class="container custom">
				<div class="row justify-content-sm-center">
					<div class="col-sm-11 col-md-10 col-lg-10">
						<h3 class="heading-main">
							Share & grow the world's knowledge!
						</h3>
						<p class="sub-heading">AnsWiz is the largest online community for programmers to learn, share their knowledge and build their careers.</p>
					</div>
					<div class="col-sm-11 col-md-7">
						<div class="inner-search row">
							<input type="text" id="search" class="col-9 col-sm-10 col-md-11  main-search" placeholder="Search">
								<span id="loaderSearch" class="d-none loader-main-input">
									<!-- Loader 5 -->
									<div class=" loader-5 center"><span></span></div>
								</span>
							<button id="searchBtn" type="button" class="col-3 col-sm-2 col-md-1  btn btn-search-upper"><i class="icon ion-md-search"></i></button>
							<button id="clearSearch" type="button" class="d-none close-search"><span><i class="fa fa-times-circle" aria-hidden="true"></i></span></button>
							<div id="searchDropdown" class="search-drpdon-main d-none"></div> 
						</div>
						<?php if (strlen($siteSettings['bannerAd'])>0) {?>
							<div class="row">
								<div class="col-md-12 px-0 banner-header-add mt-2">
									<div id="cbprotect">
										<?php echo $siteSettings['bannerAd'];?>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div> 
		<div class="container custom py-5">
			<div class="row">
				<div  class="col-md-8 col-lg-9">
					<div class="main-motify-all">
						<ul class="all-notify pl-0 container-fluid">
							<li class="row inner-allnotify">
								<div class="col-md-4 col-lg-3">
									<div class="date-notify">Jul <br/> 28</div>
									<span class="notify-type"> Comment</span>
								</div>
								<div class="col-md-8 col-lg-9">
									<div class="notify-allheading">Contrary to popular belief, Lorem Ipsum is not simply random text</div>
									<p class="notify-description">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.</p>
								</div>
							</li>
							<li class="row inner-allnotify">
								<div class="col-md-4 col-lg-3">
									<div class="date-notify">Jul <br/> 28</div>
									<span class="notify-type"> Comment</span>
								</div>
								<div class="col-md-8 col-lg-9">
									<div class="notify-allheading">Contrary to popular belief, Lorem Ipsum is not simply random text</div>
									<p class="notify-description">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.</p>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-md-4 col-lg-3">
				
						<img class="img-fluid" src="http://via.placeholder.com/350x650">
			
				</div>
			</div>
		</div>