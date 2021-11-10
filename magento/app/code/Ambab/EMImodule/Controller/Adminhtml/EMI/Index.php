<?php
namespace Ambab\EMImodule\Controller\Adminhtml\EMI;

class Index extends \Magento\Backend\App\Action
{
	protected $resultPageFactory;
	// protected $emiDataFetchFactory;
	
	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory
		// \Ambab\EMImodule\Model\emiDataFetchFactory $emiDataFetchFactory
	) {
		parent::__construct($context);
		$this->resultPageFactory = $resultPageFactory;

		// $this->emiDataFetchFactory = $emiDataFetchFactory;
	}

	public function execute()
	{

		// $emi = $this->emiDataFetchFactory->create();
		// $emiCollection = $emi->getCollection();
		// echo '<pre>';
		// print_r($emiCollection->getData());

		$resultPage = $this->resultPageFactory->create();
		$resultPage->getConfig()->getTitle()->prepend(__('All EMI Options'));

		return $resultPage;
	}
}
?>
