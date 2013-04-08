<?php 
/**
 *
 * @author Denis Gubenko
 *
 */
echo CHtml::form('index.php/test/test/request','post',array('id'=>'test-form-request','name'=>'post'));
$message_placeholder='';
if(isset($error) && is_array($error) && count($error)){
	foreach($error as $key=>$items){
		if($key=='message'){
			$message_placeholder='Error';
			foreach($items as $key=>$item){
				$message_placeholder.='|'.$item.'. ';
			}
		}
	}
}
echo CHtml::textField('post[message]', '',array('maxlength'=>100,'placeholder'=>$message_placeholder,'title'=>$message_placeholder,));
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
