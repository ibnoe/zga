<?php

class fixed_assetdelete extends Controller {

	function fixed_assetdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("fixedasset", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('fixed_assetdelete','fixedasset','delete', $id);
		//$this->db->delete("fixedasset");
	}
}

?>