<?php

namespace Ambab\EMImodule\Controller\Adminhtml\EMI;

use Magento\Backend\App\Action;
use Ambab\EMImodule\Model\emiDataFetch;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

   
    private $emiDataFetchFactory;

    
    private $allemiRepository;

    public function __construct(
        Action\Context $context,
        DataPersistorInterface $dataPersistor,
        \Ambab\EMImodule\Model\emiDataFetchFactory $emiDataFetchFactory = null,
        \Ambab\EMImodule\Api\AllemiRepositoryInterface $allemiRepository = null
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->emiDataFetchFactory = $emiDataFetchFactory
            ?: \Magento\Framework\App\ObjectManager::getInstance()->get(\Ambab\EMImodule\Model\emiDataFetchFactory::class);
        $this->allemiRepository = $allemiRepository
            ?: \Magento\Framework\App\ObjectManager::getInstance()->get(\Ambab\EMImodule\Api\AllemiRepositoryInterface::class);
        parent::__construct($context);
    }
	
	/**
     * Authorization level
     *
     * @see _isAllowed()
     */
	protected function _isAllowed()
	{
		return $this->_authorization->isAllowed('Ambab_EMImodule::save');
	}

    /**
     * Save action
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        // print_r($data); exit;

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) 
        {
            if (empty($data['id'])) {
                $data['id'] = null;
            }

            
            $model = $this->emiDataFetchFactory->create();

            $id = $this->getRequest()->getParam('id');
            if ($id) {
                try {
                    $model = $this->allemiRepository->getById($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This emi no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            }

            $model->setData($data);

            $this->_eventManager->dispatch(
                'emical_emi_prepare_save',
                ['emi' => $model, 'request' => $this->getRequest()]
            );

            try {
                $this->allemiRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the emi.'));
                $this->dataPersistor->clear('emical_emi');
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addExceptionMessage($e->getPrevious() ?:$e);
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the emi.'));
            }

            $this->dataPersistor->set('emical_emi', $data);
            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
?>
