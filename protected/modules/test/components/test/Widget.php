<?php

class Widget extends CWidget {
	/**
	 *
	 * @todo Generic resources path for this widget
	 * @example function init(): $this->_path=dirname(__FILE__).DIRECTORY_SEPARATOR.'test'.DIRECTORY_SEPARATOR
	 * @return string
	 */
	protected $_path = NULL;
	private $_assetsUrl;
/*************************************************************************/
	/**
	 * (non-PHPdoc)
	 * Function for init widget
	 * @see CWidget::init()
	 */
	public function init()
	{
		$this->_path=($this->_path===NULL)
			?dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'test'.DIRECTORY_SEPARATOR
			:$this->_path;
		echo $this->registerCss('test.css');
		$this->registerImage('sprite.png');
		Yii::app()->clientScript->registerScriptFile(
			Yii::app()->getAssetManager()->publish(
				$this->_path.'js'.DIRECTORY_SEPARATOR.'test.js'
			)
		);
		parent::init();
	}
/*************************************************************************/
	/**
	 * (non-PHPdoc)
	 * Function for run widget
	 * @see CWidget::run()
	 */
	public function run() {
		$this->renderFile($this->_path.'views'.DIRECTORY_SEPARATOR.'index.php');
	}
/*************************************************************************/
	/**
	 * @return string the base URL that contains all published asset files of this module.
	 */
	public function getAssetsUrl()
	{
		if($this->_assetsUrl===null)
			$this->_assetsUrl=Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('test.components.test.assets'));
		return $this->_assetsUrl;
	}
/*************************************************************************/	
	/**
	 * @param string the base URL that contains all published asset files of this module.
	 */
	public function setAssetsUrl($value)
	{
		$this->_assetsUrl=$value;
	}
/*************************************************************************/
	/**
	 * 
	 * @param unknown $file
	 * @param string $media
	 * @return string
	 */	
	public function registerCss($file, $media='all')
	{
		$href = $this->getAssetsUrl().'/css/'.$file;
		return '<link rel="stylesheet" type="text/css" href="'.$href.'" media="'.$media.'" />';
	}
/*************************************************************************/	
	/**
	 * 
	 * @param unknown $file
	 * @return string
	 */
	public function registerImage($file)
	{
		return $this->getAssetsUrl().'/images/'.$file;
	}
/*************************************************************************/
}