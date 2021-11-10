<?php

namespace Ambab\EMImodule\Model;

use Ambab\EMImodule\Api\Data;
use Ambab\EMImodule\Api\AllemiRepositoryInterface;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Ambab\EMImodule\Model\ResourceModel\emiDataFetch as ResourceAllemi;
use Ambab\EMImodule\Model\ResourceModel\emiDataFetch\CollectionFactory as AllemiCollectionFactory;
use Magento\Store\Model\StoreManagerInterface;

class AllemiRepository implements AllemiRepositoryInterface
{
    protected $resource;

    protected $allemiFactory;

    protected $dataObjectHelper;

    protected $dataObjectProcessor;

    protected $dataAllemiFactory;

    private $storeManager;

    public function __construct(
        ResourceAllemi $resource,
        AllemiCollectionFactory $allemiFactory,
        Data\AllemiInterfaceFactory $dataAllemiFactory,
        DataObjectHelper $dataObjectHelper,
		DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager
    ) {
        $this->resource = $resource;
		$this->allemiFactory = $allemiFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataAllemiFactory = $dataAllemiFactory;
		$this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
    }

    public function save(\Ambab\EMImodule\Api\Data\AllemiInterface $emi)
    {
        if ($emi->getStoreId() === null) {
            $storeId = $this->storeManager->getStore()->getId();
            $emi->setStoreId($storeId);
        }
        try {
            $this->resource->save($emi);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __('Could not save the emi: %1', $exception->getMessage()),
                $exception
            );
        }
        return $emi;
    }

    public function getById($id)
    {
		$emi = $this->allemiFactory->create();
        $emi->load($id);
        // print_r($emi); exit;
        if (!$emi->getId()) {
            throw new NoSuchEntityException(__('emi with id "%1" does not exist.', $id));
        }
        return $emi;
    }
	
    public function delete(\Ambab\EMImodule\Api\Data\AllemiInterface $emi)
    {
        try {
            $this->resource->delete($emi);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the emi: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    public function deleteById($id)
    {
        return $this->delete($this->getById($id));
    }
}
?>
