<?php

namespace Ambab\EMImodule\Controller\Adminhtml\EMI;

use Magento\Backend\App\Action;

class Edit extends \Magento\Backend\App\Action
{
	
    protected $_coreRegistry;

    protected $resultPageFactory;

    public function __construct(
        Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Registry $registry
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $registry;
        parent::__construct($context);
    }
	
	protected function _isAllowed()
	{
		return $this->_authorization->isAllowed('Ambab_EMImodule::save');
	}

    protected function _initAction()
    {
    
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Ambab_EMImodule::emical_emi')
            ->addBreadcrumb(__('emi'), __('emi'))
            ->addBreadcrumb(__('Manage All emi'), __('Manage All emi'));
        return $resultPage;
    }
   
    public function execute()
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('id');
        $model = $this->_objectManager->create(\Ambab\EMImodule\Model\emiDataFetch::class);
        
        // 2. Initial checking
        // print_r($id); exit;
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This emi no longer exists.'));
                // \Magento\Backend\Model\View\Result\Redirect $resultRedirect 
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }

        $this->_coreRegistry->register('emical_emi', $model);

        $resultPage = $this->_initAction();
        $resultPage->addBreadcrumb(
            $id ? __('Edit emi') : __('Add emi'),
            $id ? __('Edit emi') : __('Add emi')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('emi'));
        $resultPage->getConfig()->getTitle()
            ->prepend($model->getId() ? $model->getTitle() : __('Add emi'));

        return $resultPage;
    }
}