<?php

/**
 * 
 */
class Model_Core_Table
{
	public $tableName = null;
	public $primaryKey = null;
	public $adapter = null;

	public function setTableName($tableName)
	{
		$this->tableName = $tableName;
		return $this;
	}

	public function getTableName()
	{
		return $this->tableName;
	}

	public function setPrimaryKey($primaryKey)
	{
		$this->primaryKey = $primaryKey;
		return $this;
	}

	public function getPrimaryKey()
	{
		return $this->primaryKey;
	}

	public function setAdapter(Model_Core_Adapter $adapter)
	{
		$this->adapter = $adapter;
		return $this;
	}

	public function getAdapter()
	{
		if ($this->adapter) {
			return $this->adapter;
		}
		$adapter = new Model_Core_Adapter();
		$this->setAdapter($adapter);
		return $adapter;
	}

	public function fetchAll($query = null)
	{
		$adapter = $this->getAdapter();

		if ($query == null) {
			$query = "SELECT * FROM `{$this->getTableName()}`";
			$result = $adapter->fetchAll($query);
		}
		else{
			$result = $adapter->fetchAll($query);
		}
			return $result;
	}

	public function fetchRow($query = null)
	{
		$adapter = $this->getAdapter();

		if ($query == null) {
			$query = "SELECT * FROM `{$this->TableName()}` WHERE `{$this->PrimaryKey()}`= '$id'";
			$result = $adapter->fetchRow($query);
		}
		else{
			$result = $adapter->fetchRow($query);
		}

		return $result;
	}

	public function insert($data)
	{
		$keys = "`".implode("`,`", array_keys($data))."`";
		$values = "'".implode("','", array_values($data))."'";

		$query = "INSERT INTO `{$this->getTableName()}` ({$keys}) VALUES ({$values})";

		return $this->getAdapter()->insert($query);

	}

	public function update($data,$condition)
	{
		$where = [];
		if (is_array($data)) {
				foreach ($data as $key => $value) {
					$where[] = "`$key`='$value'";
				}
		}
		$conditions = [];	
		if (is_array($condition)) {
			foreach ($condition as $key => $value) {
				$conditions[] = "`$key`='$value'";
			}
		$query = "UPDATE  `{$this->getTableName()}` SET".implode(',', $where)."WHERE".implode('AND', $conditions);
		}
		else{
		$query = "UPDATE `{$this->getTableName()}` SET".implode(',',$where).
		"WHERE`{$this->getPrimaryKey()}` = '{$condition}'";
		}
		return $this->getAdapter()->update($query);
	}

	public function delete($condition)
	{
		echo $query = "DELETE FROM `{$this->getTableName()}` WHERE `{$this->getPrimaryKey()}` = '$condition'";
		return $this->getAdapter()->delete($query);
	}

	public function load($id)
	{
		 $query = "SELECT * FROM `{$this->tablename}` WHERE `{$this->primarykey}` = '{$id}' ";
		return $this->getAdapter()->fetchRow($query);
	}

}