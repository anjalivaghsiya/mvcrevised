<?php

/**
 * 
 */
class Controller_Customer extends Controller_Core_Action
{
	public function gridAction()
	{
		$adapter = $this->getAdapter();
		$query = "SELECT * FROM `customer`";
		$customers = $adapter->fetchAll($query);

		require_once 'View/customer/grid.phtml';
	}
}