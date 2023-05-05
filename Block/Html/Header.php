<?php

 
/**
 * 
 */
class Block_Html_Header extends Block_Core_Template
{
	
	function __construct(argument)
	{
		parent::__construct();
		$this->setTemplete('html/header.phtml');
	}
}