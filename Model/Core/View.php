<?php

class Model_Core_View
{
	protected $template = null;
 	protected $data = [];

 	public function __construct()
 		{
 			// code...
 		}

 		
 	public function setTemplate($template)
 	{
 		$this->template = $template;
 		return $this;
 	}

 	public function getTemplate()
 	{
		return $this->template;
 	}

 	public function setData($data)
 	{
 		$this->data = $data;
 		return $this;
 	}

 	public function getData($key = null)
 	{
 		if($key == null)
		{
			return $this->data;
		}
		if (array_key_exists($key, $this->data)) 
		{
			return $this->data[$key];
		}
		return null;
 	}

 	public function render()
 	{
 		require_once 'View'.DS.$this->getTemplate();
 	}

 	public function getUrl($action = null, $controller = null, $params = [], $reset = false)
	{
		$url = Ccc::getModel('Core_Url')->getUrl($action, $controller, $params, $reset);
		return $url;
	}



}



?>