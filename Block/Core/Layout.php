<?php

/**
 * 
 */
class Block_Core_Layout extends Block_Core_Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplete('core/layout/3columns.phtml');

		$this->prepareChildren();
	}

	public function prepareChildren()
	{
		$head = $this->createBlock('Html_Head');
		$this->addChild('head',$head);

		$header = $this->createBlock('Html_Header');
		$this->addChild('header',$header);

		$message = $this->createBlock('Html_Message');
		$this->addChild('message',$message);

		$content = $this->createBlock('Html_Content');
		$this->addChild('content',$content);

		$left = $this->createBlock('Html_Left');
		$this->addChild('left', $left);

		$right = $this->createBlock('Html_Right');
		$this->addChild('right', $right);

		$footer = $this->createBlock('Html_Footer');
		$this->addChild('footer', $footer);
	}
	
	public function createBlock($block)
	{
		$block = "Block_".$block;
		$block = new $block();
		$block->setLayout($this);
		return $block;
	}
}