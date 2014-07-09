<?php

class sellable_itemdelete extends Controller {

	function sellable_itemdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("item", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('sellable_itemdelete','item','delete', $id);
		//$this->db->delete("item");
	}
}

?>