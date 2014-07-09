<?php

class klaim_tunjangan_kesehatandelete extends Controller {

	function klaim_tunjangan_kesehatandelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("tunjangankesehatanusage", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('klaim_tunjangan_kesehatandelete','tunjangankesehatanusage','delete', $id);
		//$this->db->delete("tunjangankesehatanusage");
	}
}

?>