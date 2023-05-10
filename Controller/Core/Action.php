<?php

/**
 * 
 */
class Controller_Core_Action

{
	public $adapter = null;
	public $url = null;
	public $request = null;
	public $view = null;
	public $layout = null;

	public function setLayout(Block_Core_Layout $layout)
	{
		$this->layout = $layout;
		return $this;
	}

	public function getLayout()
	{
		if ($this->layout) {
			return $this->layout;
		}
		$layout = new Block_Core_layout();
		$this->setLayout($layout);
		return $layout;
	}

	public function setRequest(Model_Core_Request $request)
	{
		$this->request = $request;
		return $this;
	}

	public function getRequest()
	{
		if ($this->request) {
			return $this->request;
		}
		$request = new Model_Core_Request();
		$this->setRequest($request);
		return $request;
	}
	public function setAdapter(Model_Core_Adapter $adapter)
	{
		$this->adapter = $adapter;
		return $this;
	}

	public function getAdapter()
	{
		if ($this->adapter) {
			return $this->adapter;
		}
		$adapter = new Model_Core_Adapter();
		$this->setAdapter($adapter);
		return $adapter;
	}

	

	public function getUrl()
	{
		if ($this->url)
		{
			return $this->url;
		}
		$url=new Model_Core_Url();
		$this->setUrl($url);
		return $url;
	}
	public function setUrl(Model_Core_Url $url)
	{
		$this->url =$url;
		return $this;
	}

	public function getView()
	{
		if ($this->view) {
			return $this->view;
		}
		$view = new Model_Core_View();
		$this->setView($view);
		return $view;
	}

	public function setView($view)
	{
		$this->view = $view;
		return $this;
	}

	public function render()
	{
		return $this->getView()->render();
	}

	public function getTemplete($templetePath)
	{
 		require_once 'View'.DS.$templetePath;
	}

	public function redirect($action=null,$controller=null, array $params=null,$reset = false,$url=null)
	{
		if($url == null){
			$url = $this->getUrl()->getUrl($action,$controller,$params,$reset);
		}
		header("location: {$url}");
		exit();
	}
}