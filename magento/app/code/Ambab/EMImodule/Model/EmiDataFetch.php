<?php
namespace Ambab\EMImodule\Model;

// use Magento\Framework\Model\AbstractModel;
// use Ambab\EMImodule\Api\Data\;

use Ambab\EMImodule\Api\Data\AllemiInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Model\AbstractModel;


class EmiDataFetch extends AbstractModel implements AllemiInterface
{
	const CACHE_TAG = 'emi_options';

    /**
     * @var string
     */
    protected $_cacheTag = 'emi_options';

    /**
     * Prefix of model events names.
     *
     * @var string
     */
    protected $_eventPrefix = 'emi_options';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('Ambab\EMImodule\Model\ResourceModel\EmiDataFetch');
    }

	// id
    public function getId()
    {
        return $this->getData(self::ID);
    }

    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

	// bank

    public function getBank_name()
    {
        return $this->getData(self::BANK_NAME);
    }

    public function setBank_name($bank_name)
    {
        return $this->setData(self::BANK_NAME, $bank_name);
    }

	// month

    public function getMonth()
    {
        return $this->getData(self::MONTH);
    }

    public function setMonth($month)
    {
        return $this->setData(self::MONTH, $month);
    }

    /**
     * Get PublishDate.
     *
     * @return varchar
     */
    public function getROI()
    {
        return $this->getData(self::ROI);
    }

    /**
     * Set PublishDate.
     */
    public function setROI($ROI)
    {
        return $this->setData(self::ROI, $ROI);
    }

}
?>