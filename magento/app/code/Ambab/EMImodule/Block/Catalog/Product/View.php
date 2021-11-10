<?php
namespace Ambab\EMImodule\Block\Catalog\Product;
use Magento\Catalog\Block\Product\Context;
use Magento\Catalog\Block\Product\AbstractProduct;
use Ambab\EMImodule\Model\emiDataFetchFactory;


class View extends AbstractProduct
{
    protected $_product;
    protected $_emiDataFetchFactory;
    protected $registry;

    public function __construct(Context $context, 
    array $data,
    \Magento\Framework\Registry $registry,
    emiDataFetchFactory $emiDataFetchFactory
    )
    {
        $this->_emiDataFetchFactory = $emiDataFetchFactory;
        $this->registry = $registry;
        // $this->productFactory = $productFactory;
        parent::__construct($context, $data);
    }

    public function _prepareLayout()
    {
        return parent::_prepareLayout();

        // $emi = $this->getEMI();
    }

    public function getCurrentProduct()
    {
        return $this->registry->registry('current_product');
    }

    // public function getPriceById($id)
    // {
    //     $id =  700;//Product ID
    //     $product = $this->productFactory->create();
    //     $productPriceById = $product->load($id)->getPrice();
    //     return $productPriceById;
    // }

    public function getCollection(){
        return $this->_emiDataFetchFactory->create()->getCollection();
    }

    // public function getEMI()
    // {
    //  $emi_id = $this->getRequest()->getParam('emi_id');
    //  $emi = $this->_emiDataFetchFactory->create()->load($emi_id);
        
    //  return $emi;
    // }

    public function getProductPrize()
    {
        $_product = $this->getProduct();
        $productprice = $_product->getFinalPrice(); 
        return $productprice;
    }
    
    public function getEMI_Plan($id)
    {
        $emiData = $this->_emiDataFetchFactory->create();
        $collection = $emiData->getCollection()
                ->addFieldToFilter('id', array('Like' => $id))
                ->load();
        
        return $collection;
    }

    public function getEMI_Detail($bank_name)
    {
        $bankName = $this->_emiDataFetchFactory->create();
        $collection = $bankName->getCollection()
                ->addFieldToFilter('bank_name', array('Like' => $bank_name))
                ->load();
        
        return $collection;
    }

    public function getEMI($Price, $interest_rate, $emi_plan)
    {   
        $interest_rate = $interest_rate / (12 * 100); 
        $emi = ($Price * $interest_rate * pow(1 + $interest_rate, $emi_plan)) /  
        (pow(1 + $interest_rate, $emi_plan) - 1); 

        return ($emi); 
    }

    public function getBank()
    {
        $bank = $this->_emiDataFetchFactory->create();
        $collection = $bank->getCollection()
                ->distinct(true)
                ->addFieldToSelect('bank_name')
                ->load();
        
        return $collection;
    }



}

?>