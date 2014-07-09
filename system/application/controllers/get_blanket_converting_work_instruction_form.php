<?php

class get_blanket_converting_work_instruction_form extends Controller {

	function get_blanket_converting_work_instruction_form()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index()
	{
		$this->db->from('bif');
		$q = $this->db->get();
		
		$bif_opt = array();
		foreach ($q->result() as $row)
		{
			$bif_opt[$row->id] = $row->idstring;
		}
		
		$data['bif_opt'] = $bif_opt;
		
		$this->load->view('get_blanket_converting_work_instruction_form_opt', $data);
	}
	
	function submit()
	{
		$bif_id = $_POST['bif_id'];
		
		$this->db->where('bif.id', $bif_id);
		$this->db->from('bif');
		$this->db->join('customer', 'bif.customer_id = customer.id', 'left');
		$this->db->join('marketingofficer', 'bif.marketingofficer_id = marketingofficer.id', 'left');
		$this->db->select('customer.firstname as customer_firstname');
		$this->db->select('marketingofficer.name as marketingofficer_name');
		$this->db->select('bif.*');
		$q = $this->db->get();
		
		$data = $q->row_array();
		
		$this->load->view("blanket_converting_work_instruction_form", $data);
	}
}

?>