<?php

namespace Ambab\EMImodule\Controller\Adminhtml\EMI;

use Magento\Backend\App\Action;
use Ambab\EMImodule\Model\EmiDataFetch;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{

    var $emiDataFetchFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Ambab\EMImodule\Model\EmiDataFetchFactory $emiDataFetchFactory
    ) {
        parent::__construct($context);
        $this->emiDataFetchFactory = $emiDataFetchFactory;
    }

    /**
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        if (!$data) {
            $this->_redirect('emical/emi/addrow');
            return;
        }
        try {
            $rowData = $this->emiDataFetchFactory->create();
            $rowData->setData($data);
            if (isset($data['id'])) {
                $rowData->setId($data['id']);
            }
            $rowData->save();
            $this->messageManager->addSuccess(__('Row data has been successfully saved.'));
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        $this->_redirect('emical/emi/index');
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Ambab_EMIModule::save');
    }
}
?>
