<?php

class penerimaan_item_for_service_linedelete extends Controller {

	function penerimaan_item_for_service_linedelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("insertitemline", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('penerimaan_item_for_service_linedelete','insertitemline','delete', $id);
		//$this->db->delete("insertitemline");
	}
}

?>