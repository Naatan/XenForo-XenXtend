<?php

class XenXtend_Listen
{
	
	public static function load_class_dependencies($class, array &$extend)
	{
		$extend[] = 'XenXtend_Dependencies';
	}
	
}