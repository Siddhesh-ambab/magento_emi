<?php
namespace Ambab\EMImodule\Model\ResourceModel\EmiDataFetch;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'id';
    /**
     * Define resource model.
     */
    protected function _construct()
    {
        $this->_init('Ambab\EMImodule\Model\EmiDataFetch', 'Ambab\EMImodule\Model\ResourceModel\EmiDataFetch');
    }
}
?>