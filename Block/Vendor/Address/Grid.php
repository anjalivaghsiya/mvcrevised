<?php

/**
 * 
 */
class Block_Vendor_Address_Grid extends Block_Core_Grid
{
	
	function __construct()
	{
		parent::__construct();
		$this->setTitle('VENDOR ADDRESS');
	}

	protected function _prepareColumns()
	{
		$this->addColumn('address_id',['title'=>"ADDRESS_ID "]);
		$this->addColumn('address',['title'=>"ADDRESS "]);
		$this->addColumn('city',['title'=>"CITY "]);
		$this->addColumn('state',['title'=>"STATE "]);
		$this->addColumn('country',['title'=>"COUNTRY "]);
		$this->addColumn('zip_code',['title'=>"ZIPCODE "]);
		$this->addColumn('vendor_id',['title'=>"VENDORR_ID "]);
		
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
		$query = "SELECT * FROM `vendor_address` WHERE `vendor_id` ={$request->getRequest()->getParam('vendor_id')} ";

		$address = Ccc::getModel('Vendor_Address_Row')->fetchAll($query);
		return $address;
	}
}