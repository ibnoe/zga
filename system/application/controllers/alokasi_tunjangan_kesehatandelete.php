<?php

class alokasi_tunjangan_kesehatandelete extends Controller {

	function alokasi_tunjangan_kesehatandelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("tunjangankesehatanallowance", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('alokasi_tunjangan_kesehatandelete','tunjangankesehatanallowance','delete', $id);
		//$this->db->delete("tunjangankesehatanallowance");
	}
}

?>