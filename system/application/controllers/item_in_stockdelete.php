<?php

class item_in_stockdelete extends Controller {

	function item_in_stockdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("item", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('item_in_stockdelete','item','delete', $id);
		//$this->db->delete("item");
	}
}

?>