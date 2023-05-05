<?php

/**
 * 
 */
class Controller_Salesman_Address extends Controller_Core_Action
{
	public function gridAction()
	{
		try {
			$Row = Ccc::getModel('Salesman_Address_Row');
			$request = $this->getRequest();
			if (!$request->isGet()) {
				throw new Exception("Invalid request", 1);
			}
			$salesmanId  = $request->getParam('id');
			$query = "SELECT * FROM `salesman_address` WHERE `salesman_id` = '{$salesmanId}'";
			$address = $Row->fetchRow($query);

			$this->getView()->setTemplate('salesman_address/grid.phtml')->setData($address);
			$this->render();
			
		} catch (Exception $e) {
			echo "Data missed.";
		}

	}

	public function editAction()
	{
		try {
			echo "string";
			$Row = Ccc::getModel('Salesman_Address_Row');
			$request = $this->getRequest();
			if (!$request) {
				throw new Exception("Invalid id", 1);
			}
			$addressId = $request->getParam('id');
			$salesmanAddress = $Row->load($addressId);
			$query = "SELECT * FROM `salesman_address` WHERE `address_id` = '{$addressId}'";
			$address = $Row->fetchRow($query);
			// print_r($address);
			$this->getView()->setTemplate('salesman_address/edit.phtml')->setData($address);
			$this->render();
		} catch (Exception $e) {
			echo "Row not found";
		}
	}
}