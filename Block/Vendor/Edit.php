<?php

/**
 * 
 */
class Block_Vendor_Edit extends Block_Core_Grid
{
	
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('vendor/edit.phtml');
	}
}