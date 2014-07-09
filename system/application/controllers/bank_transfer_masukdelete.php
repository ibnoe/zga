<?php

class bank_transfer_masukdelete extends Controller {

	function bank_transfer_masukdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("banktransfermasuk", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('bank_transfer_masukdelete','banktransfermasuk','delete', $id);
		//$this->db->delete("banktransfermasuk");
	}
}

?>