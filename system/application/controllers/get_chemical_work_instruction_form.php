<?php

class get_chemical_work_instruction_form extends Controller {

	function get_chemical_work_instruction_form()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index()
	{
		$this->db->from('penambahanstockchemical');
		$q = $this->db->get();
		
		$penambahanstockchemical_opt = array();
		foreach ($q->result() as $row)
		{
			$penambahanstockchemical_opt[$row->id] = $row->idstring;
		}
		
		$data['penambahanstockchemical_opt'] = $penambahanstockchemical_opt;
		
		$this->load->view('get_chemical_work_instruction_form_opt', $data);
	}
	
	function submit()
	{
		$penambahanstockchemical_id = $_POST['penambahanstockchemical_id'];
		
		$this->db->where('penambahanstockchemical.id', $penambahanstockchemical_id);
		$q = $this->db->get('penambahanstockchemical');
		$data = $q->row_array();
		$this->load->view("chemical_work_instruction_form", $data);
	}
}

?>