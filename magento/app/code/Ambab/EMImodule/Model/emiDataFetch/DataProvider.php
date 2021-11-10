<?php
namespace Ambab\EMImodule\Model\emiDataFetch;

use Ambab\EMImodule\Model\ResourceModel\emiDataFetch\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    
    protected $collection;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var array
     */
    protected $loadedData;

   
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $allemiCollectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $allemiCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->meta = $this->prepareMeta($this->meta);
    }

   
    public function prepareMeta(array $meta)
    {
        return $meta;
    }

   
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();

        foreach ($items as $emi) {
            $this->loadedData[$emi->getId()] = $emi->getData();
        }

        $data = $this->dataPersistor->get('emical_emi');
        if (!empty($data)) {
            $emi = $this->collection->getNewEmptyItem();
            $emi->setData($data);
            $this->loadedData[$emi->getId()] = $emi->getData();
            $this->dataPersistor->clear('emical_emi');
        }

        return $this->loadedData;
    }
}