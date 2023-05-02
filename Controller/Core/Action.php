<?php

/**
 * 
 */
class Controller_Core_Action

{
	public $adapter = null;
	public $url = null;
	public $request = null;

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
		if ($this->url) {
			return $this->url;
		}
		$url = new Model_Core_Url();
		$this->setUrl($url);
		return $url;
	}

	public function setUrl($url)
	{
		$this->url = $url;
		return $this;
	}
}