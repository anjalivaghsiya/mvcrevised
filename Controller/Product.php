<?php 



class Controller_Product extends Controller_Core_Action 
{
	
	public function gridAction()
	{

			$row = Ccc::getModel('Product_Row');
			$query = "SELECT * FROM `product`";
			$products = $row->fetchAll($query);
			if (!$products) {
				throw new Exception("products not found.", 1);
			}
			$this->getView()->setTemplate('product/grid.phtml')->setData($products);
			$this->render();
			// $products= $this->getData();
			// print_r($products);die();
			// require_once 'view/';
	}

	public function addAction()
	{
			require_once 'view/product/add.phtml';
	}

	public function insertAction()
	{
			$request = $this->getRequest();
			$products = $request->getPost('product');
			$row = Ccc::getModel('Product_Row');

			$row->setData($products)->save();

			
			header("Location:index.php?c=Product&a=grid");
	}

	public function editAction()
	{
		// echo "<pre>";
			$row = Ccc::getModel('Product_Row');
			$request = $this->getRequest();
			$product_id = $request->getParam('id');
			$product = $row->load($product_id);
			$query = "SELECT * FROM `product` WHERE `product_id` = {$product_id} ";
			$products = $row->fetchRow($query);
			// print_r($products);
			$this->getView()->setTemplate('product/edit.phtml')->setData($products);
			$this->render();
			// $row->setData($products);
			// require_once 'view/product/edit.phtml';
	}

	public function updateAction()
	{
			$request = $this->getRequest();
			$row = Ccc::getModel('Product_Row');
			$products = $request->getPost('product');
			$id = $request->getParam('product_id');
			$row->setData($products)->save();
			`update_at`->date('Y:m:d h:sa:i');


			
			// $adapter->update($query);
			header("Location:index.php?c=Product&a=grid");
	}

	// public function s($value='')
	// {
	// 	// code...
	// }

	public function deleteAction()
	{
		$request = $this->getRequest();
		$id = $request->getParam('product_id');
		$query = "DELETE FROM `product` WHERE `product_id` = {$id}";
		$adapter = $this->getAdapter();
		$adapter->update($query);
		header("Location:index.php?c=Product&a=grid");
	}

}
?>