<?php

/**
 *
 */
class Controller_Salesman extends Controller_Core_Action
{
	public function gridAction()
	{
		try {
			$Row = Ccc::getModel('Salesman_Row');
			$query = "SELECT * FROM `salesman`";
			$salesmen = $Row->fetchAll($query);
			if (!$salesmen) {
				throw new Exception("Data not found.", 1);
			}
			$this->getView()->setTemplate('salesman/grid.phtml')->setData($salesmen);
			$this->render();
		} catch (Exception $e) {
			echo "Missed data.";
		}
		
	}

	public function addAction()
	{
		try {
			
			$Row = Ccc::getModel('Salesman_Row');
			$this->getView()->setTemplate('salesman/add.phtml')->setData($Row);
			$this->render();
		} catch (Exception $e) {
			echo "Data not found";
		}
	}

	public function insertAction()
	{
		try {
			$Row = Ccc::getModel('Salesman_Row');
			$addressRow = Ccc::getModel('Salesman_Address_Row');
			$request = $this->getRequest();
			if (!$request->isPost()) {
				throw new Exception("Invalid request", 1);
			}
			$salesmen = $request->getPost('salesman');
			$address = $request->getPost('address');
			echo "<pre>";
			$insertSalesman = $Row->setData($salesmen)->save();
			$salesmanId = $insertSalesman->salesman_id;

			$address['salesman_id'] = $salesmanId;
			print_r($address);

			$addressRow->setData($address)->save();
			header("Location:index.php?c=salesman&a=grid");
			} catch (Exception $e) {
			echo "Data not inserted.";
		}
	}

	public function editAction()
	{
		try 
		{
			$salesmanRow = Ccc::getModel('Salesman_Row');
			$salesmanAddressRow = Ccc::getModel('Salesman_Address_Row');
			$request = $this->getrequest();
			$salesman_id = $request->getParam('id');
			$salesman = $salesmanRow->load($salesman_id);
			$salesmanAddress = $salesmanAddressRow->load($salesman_id,'salesman_id');
			$this->getView()->setTemplate('salesman/edit.phtml')->setData(['salesman'=>$salesman, 'salesmanAddress'=>$salesmanAddress])->render();
		} 
		catch (Exception $e) 
		{
			throw new Exception("customer Not Found", 1);			
		}
	}

	public function saveAction()
	{
		try
		{
			$request = $this->getRequest();
			$salesmanData = $request->getPost('salesman');
			$id=$request->getParam('id');
			if ($id) 
			{
				$salesman=Ccc::getModel('salesman_Row')->load($id);
				$salesman->update_at=date('Y-m-d H:i:s');
			}
			else
			{
				$salesman= Ccc::getModel('salesman_Row');
				$salesman->create_at = date("Y-m-d h:i:s");
			}
			$salesman->setData($salesmanData);
			$salesman->save();

			$salesmanAddressData = $request->getpost('address');
			if ($id = $request->getParam('id')) 
			{
			$salesmanAddress = Ccc::getModel('salesman_Address_Row')->load($id);
			}
			else
			{
				$salesmanAddress = Ccc::getModel('salesman_Address_Row');
				$salesmanAddress->salesman_id = $salesman->salesman_id;
			}
				$salesmanAddress->setData($salesmanAddressData);
				$salesmanAddress->save();
		}
		catch(Exception $e)
		{	
			echo "Data not found";
		}
		header("Location: index.php?c=salesman&a=grid");
	}


	

	public function deleteAction()
	{
		try {
			$Row = Ccc::getModel('Salesman_Row');
			// $addressRow = Ccc::getModel('Salesman_Address_Row');
			$request = $this->getRequest();
			if (!$request) {
				throw new Exception("Invalid request", 1);
			}
			$salesman_id = $request->getParam('id');
			if (!$salesman_id) {
				throw new Exception("Id not found", 1);
			}
			 $Row->load($salesman_id);
			// $salesman_id = $salesmanData->salesman_id;
			// $addressData = $addressRow->load($address_id);
			// echo "<pre>";
			// print_r($addressData);
			$Row->delete();
			// $addressRow->load($address_id);
			// $addressRow->delete();
			header("Location:index.php?c=salesman&a=grid");
		} catch (Exception $e) {
			echo "Row not delete";
		}
	}
}
