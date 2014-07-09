<?php

class rcn_linedelete extends Controller {

	function rcn_linedelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("rcnline", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('rcn_linedelete','rcnline','delete', $id);
		//$this->db->delete("rcnline");
	}
}

?>