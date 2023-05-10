<?php

/**
 * 
 */
class Block_Salesman_Grid extends Block_Core_Grid
{
	
	function __construct()
	{
		parent::__construct();
		$this->setTitle('MANAGE CUSTOMER');
	}
	protected function _prepareColumns()
	{
		$this->addColumn('salesman_id',['title'=>"SALESMAN_ID"]);
		$this->addColumn('fname',['title'=>"FIRST NAME"]);
		$this->addColumn('lname',['title'=>"LAST NAME"]);
		$this->addColumn('email',['title'=>"EMAIL"]);
		$this->addColumn('gender',['title'=>"GENDER"]);
		$this->addColumn('mobile',['title'=>"MOBILE"]);
		$this->addColumn('status',['title'=>"STATUS"]);
		$this->addColumn('company',['title'=>"COMPANY"]);
		$this->addColumn('create_at',['title'=>"CREATED AT"]);
		$this->addColumn('update_at',['title'=>"UPDated AT"]);
		$this->addColumn('address',['title'=>"ADDRESS"]);

		return parent::_prepareColumns();
	}

	protected function _prepareActions()
	{
		$this->addAction('edit', [
			'title'=>'EDIT',
			'method'=>'getEditUrl'
		]);

		$this->addAction('delete', [
			'title'=>'DELETE',
			'method'=>'getDeleteUrl'
		]);

		$this->addAction('address', [
			'title'=>'ADDRESS',
			'method'=>'getAddressUrl'
		]);
		return parent::_prepareActions();
	}

	public function getEditUrl($row , $key)
	{
		return $this->getUrl(null, $key, ['salesman_id'=>$row->getId()], true);
	}

	public function getDeleteUrl($row , $key)
	{
		return $this->getUrl(null, $key, ['salesman_id'=>$row->getId()], true);
	}

	public function getAddressUrl($row , $key)
	{
		return $this->getUrl('salesman_Address', 'grid', ['salesman_id'=>$row->getId()], true);
	}

	public function getColumnValue($row , $key)
	{
		if ($key == 'status') {
			return $row->getStatusText();
		}
		return $row->$key;
	}

	protected function _prepareButtons()
	{
		$this->addButton('salesman_id',[
			'title'=>'ADD SALESMAN',
			'url'=>$this->getUrl(null, 'add')
		]);
		return parent::_prepareButtons();
	}

	public function getCollection()
	{

		$query = "SELECT * FROM `salesman`";
		$salesmen = Ccc::getModel('Salesman_Row')->fetchAll($query);
		return $salesmen;
	}
}