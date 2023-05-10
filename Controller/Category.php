<?php

/**
 * 
 */
class Controller_Category extends Controller_Core_Action
{
	public function gridAction()
	{
		try {
			
		$row = Ccc::getModel('Category_Row');
			$query = "SELECT * FROM `category`";
			$categories = $row->fetchAll($query);
			if (!$categories) {
				throw new Exception("category not found.", 1);
			}
			$this->getView()->setTemplate('category/grid.phtml')->setData($categories);
			$this->render();
		} catch (Exception $e) {
			echo "Data Missed";
		}
	}

	public function addAction()
	{
		try {
			
		$row = Ccc::getModel('Category_Row');
		$this->getView()->setTemplate('category/add.phtml')->setData($row);
		$this->render();
		} catch (Exception $e) {
			echo "Row not found";
		}
	}

	public function saveAction()
	{
		try {
			
		$CategoryRow = Ccc::getModel('Category_Row');
		$request = $this->getRequest();
		if (!$request) {
			throw new Exception("Invalid request.", 1);
		}
		$categoryData = $request->getPost('category');
		$categoryId = $request->getParam('id');
		if ($categoryId) {
			$CategoryRow->load($categoryId);
			$CategoryRow->update_at = date("Y-m-d h:i:s");
		}
		else{
			$CategoryRow->create_at = date("Y-m-d h:i:s");
		}
		$CategoryRow->setData($categoryData);
		$CategoryRow->save();
		} catch (Exception $e) {
			echo "Data not saved.";
		}
			header("Location:index.php?c=category&a=grid");

	}

	public function editAction()
	{
		$row = Ccc::getModel('Category_Row');
			$request = $this->getRequest();
			if (!$request) {
				throw new Exception("Invalid request.", 1);
			}
			$categoryId = $request->getParam('id');
			$category = $row->load($categoryId);
			$query = "SELECT * FROM `category` WHERE `category_id` = '$categoryId' ";
			$category = $row->fetchRow($query);
			$this->getView()->setTemplate('category/edit.phtml')->setData($category);
			$this->render();
	}

	public function deleteAction()
	{
		$row = Ccc::getModel('Category_Row');
		$request  =$this->getRequest();
		if (!$request) {
			throw new Exception("Invalid request", 1);
		}
		$id = $request->getParam('id');
		$row->load($id);
		$row->delete();
			header("Location:index.php?c=category&a=grid");
	}
}