<?php

class XenXtend_Dependencies extends XFCP_XenXtend_Dependencies
{
	
	/**
	* Creates the view renderer for a specified response type. If an invalid
	* type is specified, false is returned.
	*
	* @param Zend_Controller_Response_Http Response object
	* @param string                        Type of response
	* @param Zend_Controller_Request_Http  Request object
	*
	* @return XenForo_ViewRenderer_Abstract|false
	*/
	public function getViewRenderer(Zend_Controller_Response_Http $response, $responseType, Zend_Controller_Request_Http $request)
	{
		$viewRenderer = false;
		
		switch ($responseType)
		{
			case 'json':      	$viewRenderer = 'XenForo_ViewRenderer_Json';
			case 'json-text': 	$viewRenderer = 'XenForo_ViewRenderer_JsonText';
			case 'rss':       	$viewRenderer = 'XenForo_ViewRenderer_Rss';
			case 'css':       	$viewRenderer = 'XenForo_ViewRenderer_Css';
			case 'xml':      	$viewRenderer = 'XenForo_ViewRenderer_Xml';
			case 'raw':       	$viewRenderer = 'XenForo_ViewRenderer_Raw';
			default: 			$viewRenderer = 'XenForo_ViewRenderer_HtmlPublic';
		}
		
		$viewRenderer = XenForo_Application::resolveDynamicClass($viewRenderer, 'viewrenderer');
		
		if ( ! $viewRenderer)
		{
			return false;
		}
		
		return new $viewRenderer($this, $response, $request);
	}
	
}