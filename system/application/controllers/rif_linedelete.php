<?php

class rif_linedelete extends Controller {

	function rif_linedelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("rcnline", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('rif_linedelete','rcnline','delete', $id);
		//$this->db->delete("rcnline");
	}
}

?>