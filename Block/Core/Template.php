<?php


class Block_Core_Template extends Model_Core_View
{
	protected $children = [];
	public $layout = null ;

	
	public function __construct()
	{
		parent::__construct();
	}

	public function setLayout(Block_Core_Layout $layout)
	{
		$this->layout = $layout;
		return $this;
	}

	public function getLayout()
	{
		return $this->layout ; 
	}
	
	public function setChildren(array $children)
	{
		$this->children = $children;
		return $this;
	}

	public function getChildren()
	{
		if($this->children)
		{
			return $this->children;
		}
		return false;
	}

	public function addChild($key , $value)
	{
		$this->children[$key] = $value;
		
	}
	public function getChild($key)
	{
		if (array_key_exists($key, $this->children)) {

		return $this->children[$key];
		}

		return null;
	}
	public function removeChild($key)
	{
		if (array_key_exists($key, $this->children)) {

		unset($this->children[$key]);
		}

		return $this;
	}

	


}