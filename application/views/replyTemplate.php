<li>
	<div class="send-details">
		<span></span>
		<span class="sender"><a href="<?php echo base_url()."profile/".$this->session->userid;?>"><?php echo $this->session->name;?></a> </span>
		<span class="send-time">
			<a href="" class="comment-date">  <?php echo date('M d,Y',strtotime($replyTime));?> </a>
		</span>
	</div>
	<div class="comment-text">
		<?php echo decodeContent($replyTextQ);?>
	</div>
</li>