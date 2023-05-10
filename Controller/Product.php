<?php 



class Controller_Product extends Controller_Core_Action 
{
	
	public function gridAction()
	{
			$layout = $this->getLayout();
	 	 		$grid = new Block_Product_Grid();

	 	 		$layout->getChild('content')->addChild('grid' , $grid);
	 	 		// $grid->getCollection();
	 	 		$layout->render();

			// $row = Ccc::getModel('Product_Row');
			// $query = "SELECT * FROM `product`";
			// $products = $row->fetchAll($query);
			// if (!$products) {
			// 	throw new Exception("products not found.", 1);
			// }
			// $this->getView()->setTemplate('product/grid.phtml')->setData($products);
			// $this->render();
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
		$request = $this->getRequest();
			$id=$request->getParam('product_id');
			if(!$id)
			{
				throw new Exception("invalid Request", 1);
				
			}
			$modelProduct = Ccc::getModel('Product_Row');
			$query = "SELECT * FROM `product` WHERE `product_id`= '$id'";
			$product =$modelProduct->fetchRow($query);
			if(!$product)
			{
				throw new Exception('invalid id', 1);
				
			}
			$layout = $this->getLayout();
			$edit = $layout->createBlock('Product_Edit');
			$edit->setData(['product' => $product]);
			$layout->getChild('content')->addChild('edit',$edit);

			$layout->render();
	}

	public function saveAction()
	{
				echo "<pre>";

		$product = Ccc::getModel('Product_Row');
					$request=$this->getRequest();
					if (!$request->isPost()){
				throw new Exception("Invalid Request", 1);
					}
					$products = $request->getPost('product');
					if (!$products) {
						throw new Exception("Data not posted", 1);
					}
					$id = $request->getParam('product_id');
					if(!$id){
						if(!$product->load($id)){
							throw new Exception("Data not found.", 1);
						}
					}
					$data = $product->setData($products);
					if ($data->product_id) {
						$data->update_at = date('Y-m-d h:i:sa');
					}
					else{
						$data->create_at = date('Y-m-d h:i:sa');
					}
					$data = $product->save();
		}
		// catch(Exception $e){	
		// 		echo "catch found";
		// }
		// header("Location: index.php?c=product&a=grid");

	

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