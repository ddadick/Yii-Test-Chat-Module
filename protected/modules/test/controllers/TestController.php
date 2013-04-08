<?php
/**
 * 
 * @author Denis Gubenko
 *
 */
class TestController extends Controller
{
/*************************************************************************/
	/**
	 * @see /index.php/test/index
	 */
	public function actionIndex()
	{
		$array=array();
		foreach(Message::model()->findAll(array('order'=>'timestamp DESC','limit'=>15,))as $key=>$items){
			$date=NULL;
			$time=NULL;
			$user='Anonymouse';
			$message=NULL;
			foreach($items as $key=>$item){
				if($key=='timestamp'){
					$item=new DateTime($item);
					$time=$item->format('g:i A');
					$date=$item->format('m/d/Y');
				}elseif($key=='user'){
					$user=($item===NULL)?'Anonymouse':User::model()->find('LOWER(id)=?',array(strtolower($item)))->username;
				}elseif($key=='message'){
					$message=$item;
				}
			}
			array_push($array,(object)array('time'=>$time,'date'=>$date,'user'=>$user,'message'=>$message));
		}
		$this->renderFile(dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'index.php',array(
				'list'=>$array,
		));
	}
/*************************************************************************/
	/**
	 * @see /index.php/test/request
	 */
	public function actionRequest()
	{
		$model=new Message();
		$model->attributes=$_POST['post'];
		if($model->validate(true)){
			$model->insert();
		}
		$this->renderFile(dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'request.php',array(
				'error'=>$model->getErrors(),
		));		
	}
/*************************************************************************/
}
