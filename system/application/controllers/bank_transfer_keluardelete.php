<?php

class bank_transfer_keluardelete extends Controller {

	function bank_transfer_keluardelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("banktransferkeluar", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('bank_transfer_keluardelete','banktransferkeluar','delete', $id);
		//$this->db->delete("banktransferkeluar");
	}
}

?>