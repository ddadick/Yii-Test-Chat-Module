<div class="test-form">
	<div class="sprite close"></div>
	<div class="form-active">
		<div class="sprite open"></div>
		<textarea class="form-window" readonly></textarea>
		<div class="request">
<?php 
		echo CHtml::form('index.php/test/test/request','post',array('id'=>'test-form-request','name'=>'post'));
		echo CHtml::textField('post[message]', '',array('maxlength'=>100,));
		echo CHtml::ajaxSubmitButton(
			'SEND',
			'index.php/test/test/request',
			array(
    			'type' => 'POST',
    			'update' => '#test-form-request',
			),
			array(
			    'type' => 'submit'
			)
		);
		echo CHtml::endForm();
?>
		<!--  form id="test-form-request" action="index.php/test/test/request" name="send" method="post" enctype="application/x-www-form-urlencoded">
			<input name="send[message]" type="text" maxlength="100"></input>
			<button name="send[button-submit]" class="button-submit" type="submit">SEND</button>
		</form-->
		</div>
	</div>
</div>