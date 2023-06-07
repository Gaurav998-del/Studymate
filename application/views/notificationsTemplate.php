<?php if (count($getAllNotifications)>0) {?>
<?php foreach ($getAllNotifications as $index=>$value) {?>
	<li class="row inner-allnotify">
		<div class="col-8 col-sm-2 col-md-2 col-lg-2 col-xl-1">
			<?php $occuredTime=strtotime($value['on']);?>
			<div class="date-notify">
				<?php echo date('M',$occuredTime);?> <br/> <?php echo date('d',$occuredTime);?>
			</div>			
		</div>
		<div class="col-4 text-right d-sm-none mt-2">
			<time class="notify-timezone"><?php echo date('H:i',$occuredTime);?> <span><?php echo date('A',$occuredTime);?></span></time>
		</div>
		<div class="col-sm-8 col-md-8 col-lg-9 col-xl-10">
			<span class="notify-type"> <?php echo $value['title'];?></span>
			<div class="notify-allheading"><a href="<?php 
				$permalink=$value['nPerma'];
				$permalink=str_replace('(questionId)',$value['qid'],$permalink);
				$permalink=str_replace('(questionPerma)',$value['permalink'],$permalink);
				$permalink=str_replace('(userid)',$value['for'],$permalink);
				echo base_url().$permalink;?>"><?php $description=$value['description'];
				$description=str_replace('(questionName)',$value['questionTitle'],$description);
				$description=str_replace('(badgeName)',$value['badgeName'],$description);
				$description=str_replace('(reputation)',$value['reputation'],$description);
				echo $description;
				?></a>
				</div>
		</div>
		<div class="col-sm-2 col-md-2 col-lg-1 d-none d-sm-flex">
			<time class="notify-timezone"><?php echo date('H:i',$occuredTime);?> <span><?php echo date('A',$occuredTime);?></span></time>
		</div>
	</li>
<?php } }?>
