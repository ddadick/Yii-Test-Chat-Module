<?php
/**
 *
 * @author Denis Gubenko
 *
 */
class TestModule extends CWebModule
{
/*************************************************************************/
	/**
	 * (non-PHPdoc)
	 * @see CWebModule::init()
	 */
	public function init()
	{
		/**
		 * Import all models
		 */
		$this->setImport(array(
				'test.models.*',
		));
	}
/*************************************************************************/
}