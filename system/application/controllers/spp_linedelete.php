<?php

class spp_linedelete extends Controller {

	function spp_linedelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("suratpermintaanpembelianline", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('spp_linedelete','suratpermintaanpembelianline','delete', $id);
		//$this->db->delete("suratpermintaanpembelianline");
	}
}

?>