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
			$row = Ccc::getModel('Product_Row');
			$this->getView()->setTemplate('product/add.phtml')->setData($row);
			$this->render();
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

	public function saveAction()
	{
		try {
		$request=$this->getRequest();
			$data = $request->getPost('product');
			if (!$data) 
			{
				throw new Exception("Data not saved");
			}
			$id = $request->getParam('id');
			if ($id) 
			{
				echo "<pre>";
				$product=Ccc::getModel('Product_Row')->load($id);
				$product->update_at=date('Y-m-d H:i:s');
			}
			else
			{
				$product= Ccc::getModel('Product_Row');
				$product->create_at = date("Y-m-d h:i:s");
			}
			$product->setData($data);
			$product->save();
		}
		catch(Exception $e){	
				echo "catch found";
		}
		header("Location: index.php?c=product&a=grid");

	}

	public function deleteAction()
	{
		$request = $this->getRequest();
		$id = $request->getParam('id');
		$Row = Ccc::getModel('Product_Row');
		$Row->load($id);
		$Row->delete();
		header("Location:index.php?c=Product&a=grid");
	}

}
?>