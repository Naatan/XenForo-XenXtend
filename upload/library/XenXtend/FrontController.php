<?php

class XenXtend_FrontController extends XenForo_FrontController
{
	
	protected static $_instance = null;
	
	/**
	* Constructor. Sets up dependencies.
	*
	* @param XenForo_Dependencies_Abstract
	*/
	public function __construct($dependencyClass)
	{
		$this->_preloadEventListeners(); // this will cause an extra database query unless a cache is used, no decent way around it unfortunately
		
		$dependencyClass 		= XenForo_Application::resolveDynamicClass($dependencyClass, 'dependencies');
		$this->_dependencies 	= new $dependencyClass;
		
		self::$_instance = $this;
	}
	
	public static function getInstance()
	{
		return self::$_instance;
	}
	
	protected function _preloadEventListeners()
	{
		$required 	= array('codeEventListeners');
		$dataModel 	= new XenForo_Model_DataRegistry();
		$data 		= $dataModel->getMulti($required);
		
		if (XenForo_Application::get('config')->enableListeners)
		{
			if ( ! is_array($data['codeEventListeners']))
			{
				$codeModel = new XenForo_Model_CodeEvent;
				$data['codeEventListeners'] = $codeModel->rebuildEventListenerCache();
			}
			
			XenForo_CodeEvent::setListeners($data['codeEventListeners']);
		}
	}
	
}