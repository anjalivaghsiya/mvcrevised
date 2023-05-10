<?php

/**
 * 
 */
class Controller_Vendor_Address extends Controller_Core_Action
{
	
	public function gridAction()
	{
		try {
			$layout = $this->getLayout();
			$grid = $layout->createBlock('Vendor_Address_Grid');

			$layout->getChild('content')->addChild('grid', $grid);
			$layout->render();
			
		} catch (Exception $e) {
			echo "Data missed.";
		}

	}
}