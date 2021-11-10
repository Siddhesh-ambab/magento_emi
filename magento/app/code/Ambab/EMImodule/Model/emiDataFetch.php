<?php
namespace Ambab\EMImodule\Model;

// use Magento\Framework\Model\AbstractModel;
// use Ambab\EMImodule\Api\Data\;

use Ambab\EMImodule\Api\Data\AllemiInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Model\AbstractModel;


class emiDataFetch extends AbstractModel implements AllemiInterface, IdentityInterface
{
	const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;
    
    
    const CACHE_TAG = 'emi_options';
	
	//Unique identifier for use within caching
	protected $_cacheTag = self::CACHE_TAG;
	protected function _construct()
    {
        $this->_init('\Ambab\EMImodule\Model\ResourceModel\emiDataFetch');
    }
	
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];
        return $values;
    }


    public function getAvailableStatuses()
    {
        return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
    }

// for getting valu*******************

    public function getId()
	{
		return parent::getData(self::ID);
	}

	public function getBank_name()
	{
		return $this->getData(self::Bank_name);
	}

	public function getMonth()
	{
		return $this->getData(self::Month);
	}

	public function getROI()
	{
		return $this->getData(self::ROI);
	}

	// for set values**************************

	public function setId($id)
	{
		return $this->setData(self::ID, $id);
	}

	public function setBank_name($bank_name)
	{
		return $this->setData(self::Bank_name, $bank_name);
	}

	public function setMonth($month)
	{
		return $this->setData(self::Month, $month);
	}

	public function setROI($ROI)
	{
		return $this->setData(self::ROI, $ROI);
	}
	
}
?>