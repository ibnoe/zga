<?php

class uploaded_pricedeletedelete extends Controller {

	function uploaded_pricedeletedelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("uploadedpricelist", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('uploaded_pricedeletedelete','uploadedpricelist','delete', $id);
		//$this->db->delete("uploadedpricelist");
	}
}

?>