<?php

/**
 * 
 */
class Block_Salesman_Address_Grid extends Block_Core_Grid
{
	
	function __construct()
	{
		parent::__construct();
		$this->setTitle('SALESMAN ADDRESS');
	}

	protected function _prepareColumns()
	{
		$this->addColumn('address_id',['title'=>"ADDRESS_ID "]);
		$this->addColumn('address',['title'=>"ADDRESS "]);
		$this->addColumn('city',['title'=>"CITY "]);
		$this->addColumn('state',['title'=>"STATE "]);
		$this->addColumn('country',['title'=>"COUNTRY "]);
		$this->addColumn('zip_code',['title'=>"ZIPCODE "]);
		$this->addColumn('salesman_id',['title'=>"SALESMAN_ID "]);
		
		return parent::_prepareColumns();
	}

	public function getColumnValue($row , $key)
	{
		if ($key == 'status') {
			return $row->getStatusText();
		}
		return $row->$key;
	}

	public function getCollection()
	{
		$request = new Controller_Core_Action();
		$query = "SELECT * FROM `salesman_Address` WHERE `salesman_id` ={$request->getRequest()->getParam('salesman_id')} ";

		$address = Ccc::getModel('Salesman_Address_Row')->fetchAll($query);
		return $address;
	}
}