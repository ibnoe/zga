<?php

class blanket_identification_formdelete extends Controller {

	function blanket_identification_formdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("bif", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('blanket_identification_formdelete','bif','delete', $id);
		//$this->db->delete("bif");
	}
}

?>