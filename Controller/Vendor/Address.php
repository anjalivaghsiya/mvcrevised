<?php

/**
 * 
 */
class Controller_Vendor_Address extends Controller_Core_Action
{
	
	public function gridAction()
	{
		try {
			$Row = Ccc::getModel('Vendor_Address_Row');
			$request = $this->getRequest();
			if (!$request->isGet()) {
				throw new Exception("Invalid request", 1);
			}
			$vendorId  = $request->getParam('id');
			$query = "SELECT * FROM `vendor_address` WHERE `vendor_id` = '{$vendorId}'";
			$address = $Row->fetchRow($query);

			$this->getView()->setTemplate('vendor_address/grid.phtml')->setData($address);
			$this->render();
			
		} catch (Exception $e) {
			echo "Data missed.";
		}

	}
}