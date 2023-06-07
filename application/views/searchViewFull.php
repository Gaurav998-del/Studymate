<?php if (count($searchRows)>0) {?>
<ul class="questions-drpdwn pl-0 mb-0">
	<?php foreach ($searchRows as $index=>$value) {?>
	<li><a href="<?php echo base_url()."questions/".$value['qid']."/".$value['permalink'];?>"><?php echo $value['title'];?></a></li>
	<?php } ?>
</ul>
<?php } else { ?>
<ul class="questions-drpdwn pl-0 mb-0">
	<li class="not-found-search">
		<span><i class="fa fa-exclamation-triangle"></i></span> No Question found against your query!
	</li>
</ul>
<?php }?>