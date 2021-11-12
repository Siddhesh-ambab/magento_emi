<?php
namespace Ambab\EMImodule\Model;

class PaymentMethod extends \Magento\Payment\Model\Method\AbstractMethod
{
    /**
     * Payment code
     *
     * @var string
     */
    protected $_code = 'custompayment';
}