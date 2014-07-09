<?php

class productionrequestorderdelete extends Controller {

	function productionrequestorderdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("productionrequestorder", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('productionrequestorderdelete','productionrequestorder','delete', $id);
		//$this->db->delete("productionrequestorder");
	}
}

?>