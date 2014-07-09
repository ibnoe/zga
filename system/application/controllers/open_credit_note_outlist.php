<?php

class open_credit_note_outlist extends Controller {

	function open_credit_note_outlist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('creditnoteout');
$this->db->join('customer', 'customer.id = creditnoteout.customer_id', 'left');
$this->db->join('coa', 'coa.id = creditnoteout.coa_id', 'left');
$this->db->join('currency', 'currency.id = creditnoteout.currency_id', 'left');
$this->db->where('creditnoteout.disabled = 0');
$this->db->where('creditnoteout.usedflag = 0');
$this->db->select('customer.firstname as customer__firstname', false);
$this->db->select('creditnoteout.customer_id as creditnoteout__customer_id', false);
$this->db->select('coa.name as coa__name', false);
$this->db->select('creditnoteout.coa_id as creditnoteout__coa_id', false);
$this->db->select('currency.name as currency__name', false);
$this->db->select('creditnoteout.currency_id as creditnoteout__currency_id', false);
$this->db->select('creditnoteout.id as id', false);
$this->db->select('creditnoteout.id as creditnoteout__id', false);
$this->db->select('creditnoteout.creditnoteoutid as creditnoteout__creditnoteoutid', false);
$this->db->select('DATE_FORMAT(creditnoteout.date, "%d-%m-%Y") as creditnoteout__date', false);
$this->db->select('DATE_FORMAT(creditnoteout.expirydate, "%d-%m-%Y") as creditnoteout__expirydate', false);
$this->db->select('creditnoteout.amount as creditnoteout__amount', false);
$this->db->select('creditnoteout.amountused as creditnoteout__amountused', false);
$this->db->select('creditnoteout.notes as creditnoteout__notes', false);
$this->db->select('creditnoteout.usedflag as creditnoteout__usedflag', false);
$this->db->select('creditnoteout.lastupdate as creditnoteout__lastupdate', false);
$this->db->select('creditnoteout.updatedby as creditnoteout__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "creditnoteout.id like '%".$_POST['searchtext']."%'";$where .= " || creditnoteout.creditnoteoutid like '%".$_POST['searchtext']."%'";$where .= " || creditnoteout.date like '%".$_POST['searchtext']."%'";$where .= " || creditnoteout.expirydate like '%".$_POST['searchtext']."%'";$where .= " || customer.firstname like '%".$_POST['searchtext']."%'";$where .= " || coa.name like '%".$_POST['searchtext']."%'";$where .= " || currency.name like '%".$_POST['searchtext']."%'";$where .= " || creditnoteout.amount like '%".$_POST['searchtext']."%'";$where .= " || creditnoteout.amountused like '%".$_POST['searchtext']."%'";$where .= " || creditnoteout.notes like '%".$_POST['searchtext']."%'";$where .= " || creditnoteout.usedflag like '%".$_POST['searchtext']."%'";$where .= " || creditnoteout.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || creditnoteout.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('creditnoteout__id', 'asc');
$this->db->order_by('creditnoteout__date', 'desc');
$this->db->order_by('creditnoteout__lastupdate', 'desc');
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
		$data['perpage'] = 10000;
		
		$data['sortby'] = array();$data['sortdirection'] = array();
		if (isset($_POST['sortby'])) $data['sortby'] = $_POST['sortby'];
		if (isset($_POST['sortdirection'])) $data['sortdirection'] = $_POST['sortdirection'];
		
		$data['fields'] = array('creditnoteout__creditnoteoutid' => 'CN ID', 'creditnoteout__date' => 'Date', 'creditnoteout__expirydate' => 'Expiry Date', 'customer__firstname' => 'Customer', 'coa__name' => 'Account', 'currency__name' => 'Currency', 'creditnoteout__amount' => 'Amount', 'creditnoteout__amountused' => 'Amount Used', 'creditnoteout__notes' => 'Notes', 'creditnoteout__usedflag' => 'Used', 'creditnoteout__lastupdate' => 'Last Update', 'creditnoteout__updatedby' => 'Last Update By');
		
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
		$this->load->view('open_credit_note_out_list_view', $data);
	}
}

?>