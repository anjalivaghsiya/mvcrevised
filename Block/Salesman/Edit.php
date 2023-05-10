<?php

/**
 * 
 */
class Block_Salesman_Edit extends Block_Core_Grid
{
	
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('salesman/edit.phtml');
	}
}