<?php
namespace Ambab\EMImodule\Model\ResourceModel\emiDataFetch;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'id';
	
	protected $_eventPrefix = 'emical_emi_grid_collection';

    protected $_eventObject = 'emical_emi_collection';
	
	/**
     * Define model & resource model
     */
	protected function _construct()
	{
		$this->_init('Ambab\EMImodule\Model\emiDataFetch', 'Ambab\EMImodule\Model\ResourceModel\emiDataFetch');
	}
}
?>