<?php
 
namespace Magetop\Helloworld\Setup;
 
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
 
class UpgradeData implements UpgradeDataInterface
{
 
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
 
        if (version_compare($context->getVersion(), '1.1.1') < 0) {
            $tableName = $setup->getTable('emi_options');
            //Check for the existence of the table
            if ($setup->getConnection()->isTableExists($tableName) == true) {
                $data = [
                    [
                        'bank_name' => 'HDFC Bank',
                        'month' => 6,
                        'ROI' => 6
                    ]
                ];
                foreach ($data as $item) {
                    //Insert data
                    $setup->getConnection()->insert($tableName, $item);
                }
            }
        }
        $setup->endSetup();
    }
}