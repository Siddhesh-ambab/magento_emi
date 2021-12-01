<?php

namespace Ambab\CustomApi\Model\Api;

use Psr\Log\LoggerInterface;
use \Magento\Sales\Api\OrderRepositoryInterface;
use Magento\Store\Model\StoreManagerInterface;

class Custom
{
    protected $logger;
    protected $order;
    protected $productRepository;
    protected $StoreManagerInterface;


public function __construct(
    LoggerInterface $logger,
    OrderRepositoryInterface $order,
    \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
    StoreManagerInterface $StoreManagerInterface
    )
    {
    $this->logger = $logger;
    $this->order = $order;
    $this->productRepository = $productRepository;
    $this->StoreManagerInterface = $StoreManagerInterface;
    }

    /**
     * @inheritdoc
     */

    public function getPost($id)
    {
        // $response = ['success' => false];
        try {
            $order = $this->order->get($id);
            $result= [];
            $result['Order_no'] = $order->getIncrementId();
            $i=1;
            
            // $productId = $order->getProductId();
            // $product = $this->productRepository->getById($productId);
            // $p=$product->getId();
            
            // if ($product)
            // {
                //     $image_url = $this->imageHelper->init($product, 'product_base_image')->getUrl();
                // $response = [
                    //     [
                        //         "product_image_url" => $image_url,
                        //     ],
                        // ];
                        // return $response;
                        // }
                        
            foreach ($order->getAllItems() as $item)
            {
                $result['items'][$i]['Product_name'] = $item->getName();
                $result['items'][$i]['price'] = $item->getOriginalPrice();
                $result['items'][$i]['quantity'] = $item->getQtyOrdered();
                $result['items'][$i]['special_price'] = $item->getPrice();
                $result['items'][$i]['discount_price'] = $item->getDiscountAmount();

                $productId = $result['items'][$i]['product_id'] = $item->getProductId();

                // Get Image url
                $product = $this->productRepository->getById($productId);
                $store = $this->StoreManagerInterface->getStore();

                $result['items'][$i]['image_url'] = $store->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . 'catalog/product' .$product->getImage();
                
                $i++;
            }
            $result['payment_method']=$order->getPayment()->getMethod();
            $result['shipping_address']=$order->getShippingAddress()->getData();
            $result['shipping_method']=$order->getShippingMethod();
            $result['shipping_amount']=$order->getShippingAmount();

            // ****** For Result ******
            $response = ['success' => true, 'message' => $result
            // $id,$shipping_address,$shipping_amount,$payment_method,$shipping_method
        ];
            } 
        catch (\Exception $e) 
            {
                $response = ['success' => false, 'message' => $e->getMessage()];
                $this->logger->info($e->getMessage());
            }
            $returnArray = json_encode($response);
            return $response;
        }
}
?>