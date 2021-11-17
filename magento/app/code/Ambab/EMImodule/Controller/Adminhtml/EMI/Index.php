<?php
namespace Ambab\EMImodule\Controller\Adminhtml\EMI;

class Index extends \Magento\Backend\App\Action
{

    protected $_resultPageFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) 
    {
        parent::__construct($context);
        $this->_resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('Ambab_EMImodule::emi_list');
        $resultPage->getConfig()->getTitle()->prepend(__('Grid List'));

		// $resultPage = $this->_resultPageFactory->create();
		// $resultPage->getConfig()->getTitle()->prepend(__('All EMI Options'));

        return $resultPage;
    }

    /**
     * Check Grid List Permission.
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Ambab_EMImodule::grid_list');
    }
}
?>
