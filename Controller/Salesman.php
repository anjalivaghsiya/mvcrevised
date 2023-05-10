<?php

/**
 *
 */
class Controller_Salesman extends Controller_Core_Action
{
	public function gridAction()
	{
		try {
			$layout = $this->getLayout();
			$grid = $layout->createBlock('Salesman_Grid');
			$layout->getChild('content')->addChild('grid', $grid);
			$layout->render();
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

	
	public function editAction()
	{
		try 
		{
			$request = $this->getrequest();
			$salesman_id = $request->getParam('salesman_id');
			if (!$salesman_id) {
				throw new Exception("Invalid id.", 1);
			}
			$salesmanRow = Ccc::getModel('Salesman_Row');
			$salesmanAddressRow = Ccc::getModel('Salesman_Address_Row');
			$salesman = $salesmanRow->load($salesman_id);
			$salesmanAddress = $salesmanAddressRow->load($salesman_id,'salesman_id');

			$layout = $this->getLayout();
			$edit = $layout->createBlock('Salesman_Edit');
			$edit->setData(['salesman'=>$salesman, 'salesmanAddress'=>$salesmanAddress]);
			$layout->getChild('content')->addChild('edit', $edit);
			$layout->render();
		} 
		catch (Exception $e) 
		{
			throw new Exception("customer Not Found", 1);			
		}
	}

	public function saveAction()
	{
		// try
		// {
			$request = $this->getRequest();

			$salesmanData = $request->getPost('salesman');
			$id=$request->getParam('salesman_id');
			if (!$id) 
			{
				$salesman= Ccc::getModel('Salesman_Row');
				$salesman->create_at = date("Y-m-d h:i:s");
			}
			else
			{
				$salesman=Ccc::getModel('Salesman_Row')->load($id);
				$salesman->update_at=date('Y-m-d H:i:s');
				
			}
			$salesman->setData($salesmanData);
			$salesman->save();

			$salesmanAddressData = $request->getpost('address');
			if ($id = $request->getParam('id')) 
			{
			$salesmanAddress = Ccc::getModel('Salesman_Address_Row')->load($id);
			}
			else
			{
				$salesmanAddress = Ccc::getModel('Salesman_Address_Row');
				$salesmanAddress->salesman_id = $salesman->salesman_id;
			}
				$salesmanAddress->setData($salesmanAddressData);
				$salesmanAddress->save();
		// }
		// catch(Exception $e)
		// {	
		// 	echo "Data not found";
		// }
		// header("Location: index.php?c=salesman&a=grid");
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
