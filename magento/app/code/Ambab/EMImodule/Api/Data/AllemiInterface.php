<?php
namespace Ambab\EMImodule\Api\Data;

interface AllemiInterface
{
	const ID = 'id';
	const Bank_name  = 'bank_name';
	const Month = 'month';
	const ROI = 'ROI';

	public function getId();

	public function getBank_name();

	public function getMonth();

	public function getROI();


	public function setId($id);

	public function setBank_name($bank_name);

	public function setMonth($month);

	public function setROI($ROI);

}
?>