<?php
if(isset($items) && count($items)){ 
	foreach($items as $item){
?>
<div id="comment-item" class="comment-item">
<div  id="comment-item-autor" class="comment-item-autor"><?php echo 'comment\'s '.$item->user?></div>
<div  id="comment-item-text" class="comment-item-text">
<?php echo $item->text?>
</div>
</div>
<?php 
	}
}
?>
