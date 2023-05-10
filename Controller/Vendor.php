<?php

/**
 * 
 */
class Controller_Vendor extends Controller_Core_Action
{
	
	public function gridAction()
	{
		try {
			$layout = $this->getLayout();
			$grid = $layout->createBlock('Vendor_Grid');
			
			$layout->getChild('content')->addChild('grid', $grid);
			$layout->render();
		} catch (Exception $e) {
			echo "Missed data.";
		}
		
	}

	public function addAction()
	{
		try {
			
			$Row = Ccc::getModel('Vendor_Row');
			$this->getView()->setTemplate('vendor/add.phtml')->setData($Row);
			$this->render();
		} catch (Exception $e) {
			echo "Data not found";
		}
	}

	public function saveAction()
	{
		// try
		// {
			$request = $this->getRequest();
			$vendorData = $request->getPost('vendor');
			$vendorRow=Ccc::getModel('Vendor_Row');
			$id=$request->getParam('id');
			if ($id) 
			{
				$vendorRow->load($id);
				$vendorRow->update_at=date('Y-m-d H:i:s');
			}
			else
			{
				// $vendor= Ccc::getModel('vendor_Row');
				$vendorRow->create_at = date("Y-m-d h:i:s");
			}
			$vendorRow->setData($vendorData);
			$vendorRow->save();

			$vendorAddressData = $request->getpost('address');
			if ($id = $request->getParam('id')) 
			{
			$vendorAddress = Ccc::getModel('vendor_Address_Row')->load($id);
			}
			else
			{
				$vendorAddress = Ccc::getModel('vendor_Address_Row');
				$vendorAddress->vendor_id = $vendorRow->vendor_id;
			}
				$vendorAddress->setData($vendorAddressData);
				$vendorAddress->save();
		// }
		// catch(Exception $e)
		// {	
		// 	echo "Data not found";
		// }
		header("Location: index.php?c=vendor&a=grid");
	}

	public function editAction()
	{
		try 
		{
			$request = $this->getrequest();
			$vendor_id = $request->getParam('vendor_id');
			if (!$vendor_id) {
				throw new Exception("Invalid id.", 1);
			}
			$vendorRow = Ccc::getModel('Vendor_Row');
			$vendorAddressRow = Ccc::getModel('Vendor_Address_Row');
			$vendor = $vendorRow->load($vendor_id);
			$vendorAddress = $vendorAddressRow->load($vendor_id,'vendor_id');

			$layout = $this->getLayout();
			$edit = $layout->createBlock('Vendor_Edit');
			$edit->setData(['vendor'=>$vendor, 'address'=>$vendorAddress]);
			$layout->getChild('content')->addChild('edit', $edit);
			$layout->render();
		} 
		catch (Exception $e) 
		{
			throw new Exception("customer Not Found", 1);			
		}
	}

	public function deleteAction()
	{
		try {
			$Row = Ccc::getModel('Vendor_Row');
			// $addressRow = Ccc::getModel('Salesman_Address_Row');
			$request = $this->getRequest();
			if (!$request) {
				throw new Exception("Invalid request", 1);
			}
			$vendor_id = $request->getParam('id');
			if (!$vendor_id) {
				throw new Exception("Id not found", 1);
			}
			 $Row->load($vendor_id);
			// $salesman_id = $salesmanData->salesman_id;
			// $addressData = $addressRow->load($address_id);
			// echo "<pre>";
			// print_r($addressData);
			$Row->delete();
			// $addressRow->load($address_id);
			// $addressRow->delete();
			header("Location:index.php?c=vendor&a=grid");
		} catch (Exception $e) {
			echo "Row not delete";
		}
	}




}