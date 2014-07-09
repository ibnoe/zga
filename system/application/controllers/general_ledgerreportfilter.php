<?php

class general_ledgerreportfilter extends Controller {

	function general_ledgerreportfilter()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function index()
	{
		$data = array();
		
		
$data['journal__from_date'] = '';
$data['journal__to_date'] = '';
$coa_opt = array();
$q = $this->db->get('coa');
if ($q->num_rows() > 0)
foreach ($q->result() as $row) { $coa_opt[$row->id] = $row->name; }
$data['coa_opt'] = $coa_opt;
$data['journal__coa_id'] = '';
		
		$this->load->view('general_ledgerreportfilterview', $data);
	}
}

?>