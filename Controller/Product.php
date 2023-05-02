<?php 



class Controller_Product extends Controller_Core_Action 
{
	
	public function gridAction()
	{
			$query = "SELECT * FROM `product`";
			$adapter = $this->getAdapter();
			$products = $adapter->fetchAll($query);
			if (!$products) {
				throw new Exception("products not found.", 1);
			}

			require_once 'view/product/grid.phtml';
	}

	public function addAction()
	{
			require_once 'view/product/add.phtml';
	}

	public function insertAction()
	{
			$request = $this->getRequest();
			$products = $request->getPost('product');

			$query = "INSERT INTO `product`(`name`, `cost`, `price`, `sku`, `status`, `quantity`, `description`, `color`, `material`) VALUES ('$products[name]','$products[cost]','$products[price]','$products[sku]','$products[status]','$products[quantity]','$products[description]','$products[color]','$products[material]')";
			$adapter = $this->getAdapter();
			$adapter->insert($query);
			header("Location:index.php?c=Product&a=grid");
	}

	public function editAction()
	{
			$request = $this->getRequest();
			$id = $request->getParam('product_id');
			$query = "SELECT * FROM `product` WHERE `product_id`={$id}";
			$adapter = $this->getAdapter();
			$productRow = $adapter->fetchRow($query);
			require_once 'view/product/edit.phtml';
	}

	public function updateAction()
	{
			$request = $this->getRequest();
			$products = $request->getPost('product');
			$id = $request->getParam('product_id');

			$query = "UPDATE 
							`product` SET 
							`name`='$products[name]',
							`sku`='$products[sku]',
							`cost`='$products[cost]',
							`price`='$products[price]',
							`quantity`='$products[quantity]',
							`description`='$products[description]',
							`status`='$products[status]',
							`color`='$products[color]',
							`material`='$products[material]' 
							 -- `update_at`=current_timestamp();
							WHERE `product_id` = {$id}";
			$adapter = $this->getAdapter();
			$adapter->update($query);
			header("Location:index.php?c=Product&a=grid");
	}

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