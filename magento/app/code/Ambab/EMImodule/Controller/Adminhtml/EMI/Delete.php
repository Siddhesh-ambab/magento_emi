<?php
namespace Ambab\EMImodule\Controller\Adminhtml\EMI;

class Delete extends \Magento\Backend\App\Action
{
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $resultRedirect = $this->resultRedirectFactory->create();
        if($id){
            $bank_name="";
            try{
                $model= $this->_objectManager->create(\Ambab\EMImodule\Model\emiDataFetch::class);
                $model->load($id);
                $bank_name= $model->getBank_name();
                $model->delete();
                $this->messageManager->addSuccess(__('The emi has been delete.'));
                $this->_eventManager->dispatch('adminhtml_emi_on_delete',['bank_name'=> $bank_name,'status'=> 'success']);
                return $resultRedirect->setPath('*/*/');
            }catch(\Exception $e){
                $this->_eventManager->dispatch('adminhtml_emi_on_delete',['bank_name'=>$bank_name,'status'=>'fail']);
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/edit',['id'=> $id]);
            }
        }
        $this->messageManager->addError(_('We cant delete'));
        return $resultRedirect-> setPath('*/*/');
    }
}