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
<p id="wall-comment-text-<?php echo $item->id?>" class="wall-comment-text" >
	<a id="wall-comment-text-add-<?php echo $item->id?>" class="wall-comment-text-add" href="javascript:;" onclick="Wall.comment_view('<?php echo $item->id?>');" style="display:block;"">Create Comment</a>
	<a id="wall-comment-text-cancel-<?php echo $item->id?>" class="wall-comment-text-cancel" href="javascript:;" onclick=" Wall.comment_link('','<?php echo $item->id?>');" style="display:none;"">Cancel Comment</a>
</p>
<?php } ?>
<div  id="wall-comment-<?php echo $item->id?>" class="wall-comment" style="display:none;"></div>
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
		<div id="comment-list" class="comment-list"><?php echo $comment?></div>
	</div>

	
</div>
<?php }}?>
<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>