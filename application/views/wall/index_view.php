<?php
if(isset($items) && count($items)){ 
	foreach($items as $item){
?>

<div id="container">
	<h1>Post</h1>
	<div id="body">
		<p><?php echo ($item->text===NULL)?'':$item->text?></p>
		<code>
		<div class="span12">
<?php if(_is_create_comment($this)){?>
<p><a href="#">Create Comment</a></p>
<?php } ?>
</div>
		
<div class="span12">
<?php if(_is_create_post($this)){?>
<p><a href="#">Create Post</a></p>
<?php } ?>
</div>

<div class="span12">
<?php if(_is_edit_post($this) && _is_edit_foreign_post($this,$item->user)){?>
<p><a href="#">Edit Post</a></p>
<?php } ?>
</div>


<div class="span12">
<?php if(_is_hide_post($this) && _is_hide_foreign_post($this,$item->user)){?>
<p><a href="#">Hide Post</a></p>
<?php } ?>
</div>
		
<div class="span12">
<?php if(_is_del_post($this) && _is_del_foreign_post($this,$item->user)){?>
<p><a href="#">Delete Post</a></p>
<?php } ?>
</div>


		</code>
	</div>

	
</div>
<?php }}?>
<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>