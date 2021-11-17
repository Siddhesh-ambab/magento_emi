<?php
namespace Ambab\EMImodule\Block\Adminhtml;

class EmiDataFetch extends \Magento\Backend\Block\Widget\Grid\Container
{
    protected function _construct()
    {
        $this->_controller = 'adminhtml_emi';
        $this->_blockGroup = 'Ambab_EMImodule';
        $this->_headerText = __('Manage emi');

        parent::_construct();

        if ($this->_isAllowedAction('Ambab_EMImodule::save')) {
            $this->buttonList->update('add', 'label', __('Add emi'));
        } else {
            $this->buttonList->remove('add');
        }
    }

    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}
?>
