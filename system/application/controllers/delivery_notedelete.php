<?php

class delivery_notedelete extends Controller {

	function delivery_notedelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("deliveryorder", $data);
		//$this->db->delete("deliveryorder");
	}
}

?>