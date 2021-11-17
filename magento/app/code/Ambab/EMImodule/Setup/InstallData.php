<?php

namespace Ambab\EMImodule\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    protected $date;
 
    public function __construct(
        \Magento\Framework\Stdlib\DateTime\DateTime $date
    ) {
        $this->date = $date;
    }
    
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $dataNewsRows = [
            [
                'bank_name' => 'Indian Bank',
                'month' => 6,
                'ROI' => 8
            ],
            [
                'bank_name' => 'SBI Bank',
                'month' => 3,
                'ROI' => 7
            ]
        ];
        
        foreach($dataNewsRows as $data) {
            $setup->getConnection()->insert($setup->getTable('emi_options'), $data);
        }
    }
}
?>