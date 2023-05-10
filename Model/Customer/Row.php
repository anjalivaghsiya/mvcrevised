<?php

/**
 * 
 */
class Model_Customer_Row extends Model_Core_Table_Row
{
	public $tableClass = 'Model_Customer';

     const STATUS_ACTIVE = 1;
    const STATUS_ACTIVE_LBL ='Active';
    const STATUS_INACTIVE = 2;
    const STATUS_INACTIVE_LBL ='Inactive';
    const STATUS_DEFAULT =2;
    

    public function getStatus()
    {
        if($this->status)
        {
            return $this->status; 
        }
        return Model_Customer_Row::STATUS_DEFAULT;
    }

    public function getStatusText()
    {
        $statuses = $this->getTable()->getStatusOptions();
        if (array_key_exists($this->status, $statuses))
        {
            return $statuses[$this->status];
        }
            return $statuses[ Model_Customer_Row::STATUS_DEFAULT];
    }
}