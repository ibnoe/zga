<?php

class currencydelete extends Controller {

	function currencydelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("currency", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('currencydelete','currency','delete', $id);
		//$this->db->delete("currency");
	}
}

?>