<?php

class Dhmedia_Devel_Block_Frontend extends Mage_Core_Block_Template
{
	protected function _construct()
	{
		parent::_construct();
		$this->setTemplate('devel/frontend.phtml');
		
		$this->initKrumo();
	}

	protected function initKrumo()
	{
		require_once(Mage::getBaseDir('lib') . '/krumo/class.krumo.php');
	}
	
	public function getLayoutXml()
	{
		$layout = Mage::getSingleton('core/layout');
		
		$update = $layout->getUpdate();
			
		$update->addHandle('devel_handle');
		
		foreach($update->getHandles() as $handle) {
			$update->fetchPackageLayoutUpdates($handle);
		}
		
		$xml = $update->asSimplexml();
		return $xml->asNiceXml();
	}
	
	public function getShowTemplateHints()
	{
		return false;
	}
	
	public function getAdminPath()
	{
		return Mage::getStoreConfig('admin/url/use_custom') ? 
			Mage::getStoreConfig('admin/url/custom') :
			'admin';
	}
}