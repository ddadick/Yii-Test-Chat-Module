<?php
/**
 * 
 * @author Denis Gubenko
 *
 */
class Message extends CActiveRecord
{
/*************************************************************************/
	/**
	 * The followings are the available columns in table 'tbl_message':
	 * @var integer $id
	 * @var datetime $timestamp
	 * @var integer $user
	 * @var string $message
	 */
/*************************************************************************/
	/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
/*************************************************************************/
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{message}}';
	}
/*************************************************************************/
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('message', 'required'),
			array('message', 'length', 'max'=>100),
		);
	}
/*************************************************************************/
	/**
	 * This is invoked before the record is saved.
	 * @return boolean whether the record should be saved.
	 */
	protected function beforeSave()
	{
		if(parent::beforeSave())
		{
			if($this->isNewRecord)
			{
				$this->user=Yii::app()->user->id;
			}
			return true;
		}
		else
			return false;
	}
/*************************************************************************/
}