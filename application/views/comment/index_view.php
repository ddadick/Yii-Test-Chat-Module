<script src="<?php echo $this->uri->config->item('base_url'); ?>layout/js/app/comment/index.js"></script>
<?php
$comment = array(
	'name'	=> 'comment',
	'id'	=> 'comment',
	'value' => set_value('comment'),
);
$comment_label = 'Add Comment';
?>

<?php echo form_open($this->uri->uri_string(),array('id'=>'myCommentId')); ?>
<table>
	<tr>
		<td></td>
		<td><?php echo form_label($comment_label, $comment['id']); ?><br /><?php echo form_textarea($comment); ?></td>
		<td style="color: red;"><?php echo form_error($comment['name']); ?><?php echo isset($errors[$comment['name']])?$errors[$comment['name']]:''; ?></td>
	</tr>
</table>
<?php echo form_submit('submit', 'Submit'); ?>
<?php echo '<br />'.((isset($form_error))?$form_error:'');?>
<?php echo form_close(); ?>
