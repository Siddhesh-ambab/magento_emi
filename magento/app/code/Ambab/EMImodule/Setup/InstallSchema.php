<?php

namespace Ambab\EMImodule\Setup;

use \Magento\Framework\Setup\InstallSchemaInterface;
use \Magento\Framework\Setup\ModuleContextInterface;
use \Magento\Framework\Setup\SchemaSetupInterface;
use \Magento\Framework\DB\Ddl\Table;

/**
 * Class InstallSchema
 *
 * @package Thecoachsmb\Mymodule\Setup
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * Install Articles table
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $tableName = $setup->getTable('emi_options');

        if ($setup->getConnection()->isTableExists($tableName) != true) {
            $table = $setup->getConnection()
                ->newTable($tableName)
                ->addColumn(
                    'id',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'unsigned' => true,
                        'nullable' => false,
                        'primary' => true
                    ],
                    'ID'
                )
                ->addColumn(
                    'bank_name',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => false],
                    'bank_name'
                )
                ->addColumn(
                    'month',
                    Table::TYPE_INTEGER,
                    null,
                    ['nullable' => false],
                    'Month'
                )
                ->addColumn(
                    'ROI',
                    Table::TYPE_NUMERIC,
                    null,
                    ['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
                    'Rate Of Interest'
                )
                ->setComment('emi_options');
            $setup->getConnection()->createTable($table);
        }

        $setup->endSetup();
    }
}