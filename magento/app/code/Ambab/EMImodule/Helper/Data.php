<?php
namespace Ambab\EMImodule\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper 
{
	public function getModuleConfig()
	{
		return $this->scopeConfig->getValue('aureatelabs/general/emi',ScopeInterface::SCOPE_STORE);
	}
}
