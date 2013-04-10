<?php
if(isset($items) && count($items)){ 
	foreach($items as $item){
?>
<div id="container">
	<h1>Post</h1>
	<div id="body">
		<p><?php echo ($item->text===NULL)?'':$item->text?></p>
		<code>Comments</code>
	</div>

	
</div>
<?php }}?>
<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>