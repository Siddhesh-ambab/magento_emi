<?php

namespace Ambab\EMImodule\Model\emiDataFetch\Source;

use Magento\Framework\Data\OptionSourceInterface;

class Status implements OptionSourceInterface
{
    protected $emidataFetch;

    public function __construct(\Ambab\EMImodule\Model\emiDataFetch $emidataFetch)
    {
        $this->emidataFetch = $emidataFetch;
    }

    public function toOptionArray()
    {
        $availableOptions = $this->emidataFetch->getAvailableStatuses();
        $options = [];
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }
}
?>
