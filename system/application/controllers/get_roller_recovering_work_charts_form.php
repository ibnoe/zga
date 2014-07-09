<?php

class get_roller_recovering_work_charts_form extends Controller {

	function get_roller_recovering_work_charts_form()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index()
	{
		$this->db->from('rcn');
		$q = $this->db->get();
		
		$rcn_opt = array();
		foreach ($q->result() as $row)
		{
			$rcn_opt[$row->id] = $row->norcn;
		}
		
		$data['rcn_opt'] = $rcn_opt;
		
		$this->load->view('get_roller_recovering_work_charts_form_opt', $data);
	}
	
	function submit()
	{
		$rcn_id = $_POST['rcn_id'];
		
		$this->db->from('rcn');
		$this->db->join('customer', 'customer.id = rcn.customer_id');
		$this->db->where('rcn.id', $rcn_id);
		$this->db->select('customer.firstname as customer_firstname');
		$this->db->select('rcn.*');
		$q = $this->db->get();
		$data = $q->row_array();
		$this->load->view("roller_recovering_work_charts_form", $data);
	}
}

?>