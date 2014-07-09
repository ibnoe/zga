<?php

class price_listdelete extends Controller {

	function price_listdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("pricelist", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('price_listdelete','pricelist','delete', $id);
		//$this->db->delete("pricelist");
	}
}

?>