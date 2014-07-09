<?php

class cash_banklist extends Controller {

	function cash_banklist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('cashbank');
$this->db->join('currency', 'currency.id = cashbank.currency_id', 'left');
$this->db->join('coa', 'coa.id = cashbank.coa_id', 'left');
$this->db->where('cashbank.disabled = 0');
$this->db->select('currency.name as currency__name', false);
$this->db->select('cashbank.currency_id as cashbank__currency_id', false);
$this->db->select('coa.name as coa__name', false);
$this->db->select('cashbank.coa_id as cashbank__coa_id', false);
$this->db->select('cashbank.id as id', false);
$this->db->select('cashbank.name as cashbank__name', false);
$this->db->select('cashbank.notes as cashbank__notes', false);
$this->db->select('cashbank.lastupdate as cashbank__lastupdate', false);
$this->db->select('cashbank.updatedby as cashbank__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "cashbank.name like '%".$_POST['searchtext']."%'";$where .= " || currency.name like '%".$_POST['searchtext']."%'";$where .= " || coa.name like '%".$_POST['searchtext']."%'";$where .= " || cashbank.notes like '%".$_POST['searchtext']."%'";$where .= " || cashbank.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || cashbank.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('cashbank__name', 'asc');
$this->db->order_by('cashbank__lastupdate', 'desc');
		}
		
		return $data;
	}
	
	function index($edit_module_id=0)
	{
		$data = array();
		
		
		
		$data['pageno'] = 0;
		if (isset($_POST['pageno'])) 
		{
			$data['pageno'] = $_POST['pageno'];
		}
		//echo $data['pageno'];
		$data['perpage'] = 20;
		
		$data['sortby'] = array();$data['sortdirection'] = array();
		if (isset($_POST['sortby'])) $data['sortby'] = $_POST['sortby'];
		if (isset($_POST['sortdirection'])) $data['sortdirection'] = $_POST['sortdirection'];
		
		$data['fields'] = array('cashbank__name' => 'Name', 'currency__name' => 'Currency', 'coa__name' => 'Account', 'cashbank__notes' => 'Notes', 'cashbank__lastupdate' => 'Last Update', 'cashbank__updatedby' => 'Last Update By');
		
		if (false)
		{
		
		$data['totalrecords'] = 0;
		
		$data['rows'] = array();
		
		$data['totalpages'] = 0;
		
		}
		else
		{
		
		$data = $this->_qhelp($data, $edit_module_id);
		
		
		
		$q = $this->db->get();
		
		$all_arr = $q->result_array();
		
		$data['totalrecords'] = count($q->result_array());
		
		$data = $this->_qhelp($data, $edit_module_id);
		
		$this->generallib->apply_sort_to_query($data);
		
		$this->db->limit($data['perpage'], $data['pageno']*$data['perpage']);
		
		$q = $this->db->get();
		
		$data['rows'] = $q->result_array();
		
		$data['totalpages'] = ceil($data['totalrecords']/$data['perpage']);
		
		
		
		
		}
		///
		$this->load->view('cash_bank_list_view', $data);
	}
}

?>