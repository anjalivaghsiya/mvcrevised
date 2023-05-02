<?php
/**
 * 
 */
class Model_Core_Request
{
	public function isPost()
	{
		if($_SERVER['REQUEST_METHOD']=='POST')
		{
			return true;
		}
		return false;
	}
	public function isGet()
	{
		if ($_SERVER['REQUEST_METHOD']=='GET') 
		{
			return true;
		}
		return false;
	}
	public function getParam($key=null,$value=null)
	{
		if($key==null) 
		{
			return $_GET;
		}
		if(array_key_exists($key,$_GET)) 
		{
			return $_GET[$key];
		}
		  
		 	return null;
	}
	public function getPost($key=null,$value=null)
	{
		if (array_key_exists($key,$_POST))
		 {
			return $_POST[$key];
		 }
		 if ($key==null)
		  {
		 	return $_POST;
		 	
		 }
	}
	public function getActionName()
	{
		return $this->getParam('a','index');
	}
	public function getControllerName()
	{
		return $this->getParam('c','index');
	}

	 
	 
}
?>