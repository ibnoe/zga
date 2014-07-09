<?php

class penawarandelete extends Controller {

	function penawarandelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("salesorderquote", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('penawarandelete','salesorderquote','delete', $id);
		//$this->db->delete("salesorderquote");
	}
}

?>