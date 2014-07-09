<?php

class kurs_historydelete extends Controller {

	function kurs_historydelete()
	{
		parent::Controller();	
	}
	
	function index($id)
	{
		$this->db->where("id", $id);
$data['disabled'] = true;
$this->db->update("kurshistory", $data);
$this->load->library('generallib');
$this->generallib->commonfunction('kurs_historydelete','kurshistory','delete', $id);
		//$this->db->delete("kurshistory");
	}
}

?>