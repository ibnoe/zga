<?php

class ongkos_kirim_importdelete extends Controller {

	function ongkos_kirim_importdelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("ongkoskirimimport", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('ongkos_kirim_importdelete','ongkoskirimimport','delete', $id);
		//$this->db->delete("ongkoskirimimport");
	}
}

?>