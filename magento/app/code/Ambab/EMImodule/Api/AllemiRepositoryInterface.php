<?php
namespace Ambab\EMImodule\Api;

interface AllemiRepositoryInterface
{
	public function save(\Ambab\EMImodule\Api\Data\AllemiInterface $emi);

    public function getById($id);

    public function delete(\Ambab\EMImodule\Api\Data\AllemiInterface $emi);

    public function deleteById($id);
}
?>
