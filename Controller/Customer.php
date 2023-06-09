<?php

/**
 * 
 */
class Controller_Customer extends Controller_Core_Action
{
	
		public function gridAction()
	{
		try {
				$layout = $this->getLayout();
				$grid = $layout->createBlock('Customer_Grid');

				$layout->getChild('content')->addChild('grid', $grid);
				$layout->render();
			
		} catch (Exception $e) {
			echo "Missed data.";
		}
	}

	public function addAction()
	{
		try {
			
			$Row = Ccc::getModel('Customer_Row');
			$this->getView()->setTemplate('customer/add.phtml')->setData($Row);
			$this->render();
		} catch (Exception $e) {
			echo "Data not found";
		}
	}

	public function saveAction()
	{
		try
		{
			$request = $this->getRequest();
			$customerData = $request->getPost('customer');
			$id=$request->getParam('id');
			if ($id) 
			{
				$customer=Ccc::getModel('Customer_Row')->load($id);
				$customer->update_at=date('Y-m-d H:i:s');
			}
			else
			{
				$customer= Ccc::getModel('Customer_Row');
				$customer->create_at = date("Y-m-d h:i:s");
			}
			$customer->setData($customerData);
			$customer->save();

			$customerAddressData = $request->getpost('address');
			print_r($customerAddressData);
			if ($id = $request->getParam('id')) 
			{
			$customerAddress = Ccc::getModel('Customer_Address_Row')->load($id);
			}
			else
			{
				$customerAddress = Ccc::getModel('Customer_Address_Row');
				$customerAddress->customer_id = $customer->customer_id;
			}
				$customerAddress->setData($customerAddressData);
				$customerAddress->save();
		}
		catch(Exception $e)
		{	
			echo "Data not found";
		}
		// header("Location: index.php?c=customer&a=grid");
	}

	public function editAction()
	{
		try 
		{
			$request = $this->getrequest();
			$Customer_id = $request->getParam('customer_id');
			if (!$Customer_id) {
				throw new Exception("Invalid id.", 1);
				
			}
			$CustomerRow = Ccc::getModel('Customer_Row');
			$CustomerAddressRow = Ccc::getModel('Customer_Address_Row');
			$Customer = $CustomerRow->load($Customer_id);
			$CustomerAddress = $CustomerAddressRow->load($Customer_id,'Customer_id');

			$layout = $this->getLayout();
			$edit = $layout->createBlock('Customer_Edit');
			$edit->setData(['Customer'=>$Customer, 'CustomerAddress'=>$CustomerAddress]);
			$layout->getChild('content')->addChild('edit',$edit);
			$layout->render();
		} 
		catch (Exception $e) 
		{
			throw new Exception("customer Not Found", 1);			
		}
	}

	public function deleteAction()
	{
		$Row = Ccc::getModel('Customer_Row');
			// $addressRow = Ccc::getModel('Salesman_Address_Row');
			$request = $this->getRequest();
			if (!$request) {
				throw new Exception("Invalid request", 1);
			}
			$customer_id = $request->getParam('customer_id');
			if (!$customer_id) {
				throw new Exception("Id not found", 1);
			}
			 $Row->load($customer_id);
			// $customer_id = $salesmanData->customer_id;
			// $addressData = $addressRow->load($address_id);
			// echo "<pre>";
			// print_r($addressData);
			$Row->delete();
	}

	
	
}