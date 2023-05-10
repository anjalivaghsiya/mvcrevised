<?php

class Block_Product_Grid extends Block_Core_Grid
{
	

	function __construct()
	{
		parent::__construct();
		$this->setTitle('MANAGE PRODUCT');
	} 

	protected function _prepareColumns()
	{
		$this->addColumn('product_id', [
			'title'=>'Product Id'
		]);		
		$this->addColumn('name', [
			'title'=>'Name'
		]);	
		$this->addColumn('sku', [
			'title'=>'SKU'
		]);	
		$this->addColumn('cost', [
			'title'=>'Cost'
		]);
		$this->addColumn('price', [
			'title'=>'Price'
		]);
		$this->addColumn('quantity', [
			'title'=>'Quantity'
		]);
		$this->addColumn('status', [
			'title'=>'Status'
		]);	
		$this->addColumn('color', [
			'title'=>'Color'
		]);	
		$this->addColumn('material', [
			'title'=>'Material'
		]);
		$this->addColumn('create_at', [
			'title'=>'Created At'
		]);
		$this->addColumn('update_at',[
			'title'=>"Update_At"
		]);

		return parent::_prepareColumns();
	}


	protected function _prepareActions()
	{
		$this->addAction('edit', [
			'title' => 'Edit',
			'method' => 'getEditUrl'
		]);		
		$this->addAction('delete', [
			'title' => 'Delete',
			'method' => 'getDeleteUrl'
		]);	


		return parent::_prepareActions();	
	}

	public function getEditUrl($row, $key)
	{
		// echo "string";
		return $this->getUrl(null,$key,['product_id'=>$row->getId()],true);
	}
	
	public function getDeleteUrl($row, $key)
	{
		return $this->getUrl(null,$key,['product_id' => $row->getId()], true);
	}

	public function getColumnValue($row, $key)
	{
		if($key == 'status')
		{
			return $row->getStatusText();
		}
		return $row->$key;
	}


	protected function _prepareButtons()
	{
		$this->addButton('product_id', 
			[
			'title' => 'ADD PRODUCT',
			'url' => $this->getUrl(null,'add')
		]);

		// $this->addButton('product_id', 
		// 	[
		// 	'title' => 'IMPORT',
		// 	'url' => $this->getUrl(null,'import')
		// ]);

		return parent::_prepareButtons();		
	}

	protected function _prepareImport()
	{
		$this->addButton('product_id',
			[
				'title' => 'IMPORT',
				'url'=> $this->getUrl(null,'import')
			]);
		return parent::_prepareImport();		

	}


	public function getCollection()
	{
		$query = "SELECT * FROM `product`";
		$products = Ccc::getModel('Product_Row')->fetchAll($query);
		return $products;
	}
}

