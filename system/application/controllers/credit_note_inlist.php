<?php

class credit_note_inlist extends Controller {

	function credit_note_inlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('creditnotein');
$this->db->join('supplier', 'supplier.id = creditnotein.supplier_id', 'left');
$this->db->join('coa', 'coa.id = creditnotein.coa_id', 'left');
$this->db->join('currency', 'currency.id = creditnotein.currency_id', 'left');
$this->db->where('creditnotein.disabled = 0');
$this->db->select('supplier.firstname as supplier__firstname', false);
$this->db->select('creditnotein.supplier_id as creditnotein__supplier_id', false);
$this->db->select('coa.name as coa__name', false);
$this->db->select('creditnotein.coa_id as creditnotein__coa_id', false);
$this->db->select('currency.name as currency__name', false);
$this->db->select('creditnotein.currency_id as creditnotein__currency_id', false);
$this->db->select('creditnotein.id as id', false);
$this->db->select('creditnotein.creditnoteinid as creditnotein__creditnoteinid', false);
$this->db->select('DATE_FORMAT(creditnotein.date, "%d-%m-%Y") as creditnotein__date', false);
$this->db->select('DATE_FORMAT(creditnotein.expirydate, "%d-%m-%Y") as creditnotein__expirydate', false);
$this->db->select('creditnotein.amount as creditnotein__amount', false);
$this->db->select('creditnotein.amountused as creditnotein__amountused', false);
$this->db->select('creditnotein.notes as creditnotein__notes', false);
$this->db->select('creditnotein.usedflag as creditnotein__usedflag', false);
$this->db->select('creditnotein.lastupdate as creditnotein__lastupdate', false);
$this->db->select('creditnotein.updatedby as creditnotein__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "creditnotein.creditnoteinid like '%".$_POST['searchtext']."%'";$where .= " || creditnotein.date like '%".$_POST['searchtext']."%'";$where .= " || creditnotein.expirydate like '%".$_POST['searchtext']."%'";$where .= " || supplier.firstname like '%".$_POST['searchtext']."%'";$where .= " || coa.name like '%".$_POST['searchtext']."%'";$where .= " || currency.name like '%".$_POST['searchtext']."%'";$where .= " || creditnotein.amount like '%".$_POST['searchtext']."%'";$where .= " || creditnotein.amountused like '%".$_POST['searchtext']."%'";$where .= " || creditnotein.notes like '%".$_POST['searchtext']."%'";$where .= " || creditnotein.usedflag like '%".$_POST['searchtext']."%'";$where .= " || creditnotein.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || creditnotein.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('creditnotein__creditnoteinid', 'asc');
$this->db->order_by('creditnotein__date', 'desc');
$this->db->order_by('creditnotein__lastupdate', 'desc');
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
		
		$data['fields'] = array('creditnotein__creditnoteinid' => 'CN ID', 'creditnotein__date' => 'Date', 'creditnotein__expirydate' => 'Expiry Date', 'supplier__firstname' => 'Supplier', 'coa__name' => 'Account', 'currency__name' => 'Currency', 'creditnotein__amount' => 'Amount', 'creditnotein__amountused' => 'Amount Used', 'creditnotein__notes' => 'Notes', 'creditnotein__usedflag' => 'Used', 'creditnotein__lastupdate' => 'Last Update', 'creditnotein__updatedby' => 'Last Update By');
		
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
		$this->load->view('credit_note_in_list_view', $data);
	}
}

?>