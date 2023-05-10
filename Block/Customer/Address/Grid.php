<?php

/**
 * 
 */
class Block_Customer_Address_Grid extends Block_Core_Grid
{
	
	function __construct()
	{
		parent::__construct();
		$this->setTitle('CUSTOMER ADDRESS');
	}

	protected function _prepareColumns()
	{
		$this->addColumn('address_id',['title'=>"ADDRESS_ID "]);
		$this->addColumn('address',['title'=>"ADDRESS "]);
		$this->addColumn('city',['title'=>"CITY "]);
		$this->addColumn('state',['title'=>"STATE "]);
		$this->addColumn('country',['title'=>"COUNTRY "]);
		$this->addColumn('zip_code',['title'=>"ZIPCODE "]);
		$this->addColumn('customer_id',['title'=>"CUSTOMER_ID "]);
		
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
		$query = "SELECT * FROM `customer_address` WHERE `customer_id` ={$request->getRequest()->getParam('customer_id')} ";

		$address = Ccc::getModel('Customer_Address_Row')->fetchAll($query);
		return $address;
	}
}