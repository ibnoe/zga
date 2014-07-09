<?php

class penawaran_linedelete extends Controller {

	function penawaran_linedelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("salesorderquoteline", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('penawaran_linedelete','salesorderquoteline','delete', $id);
		//$this->db->delete("salesorderquoteline");
	}
}

?>