<?php

class penerimaan_item_for_servicedelete extends Controller {

	function penerimaan_item_for_servicedelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("insertitem", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('penerimaan_item_for_servicedelete','insertitem','delete', $id);
		//$this->db->delete("insertitem");
	}
}

?>