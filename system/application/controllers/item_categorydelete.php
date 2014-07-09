<?php

class item_categorydelete extends Controller {

	function item_categorydelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("itemcategory", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('item_categorydelete','itemcategory','delete', $id);
		//$this->db->delete("itemcategory");
	}
}

?>