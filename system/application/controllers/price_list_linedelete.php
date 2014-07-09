<?php

class price_list_linedelete extends Controller {

	function price_list_linedelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("pricelistline", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('price_list_linedelete','pricelistline','delete', $id);
		//$this->db->delete("pricelistline");
	}
}

?>