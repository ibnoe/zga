<?php

class giro_inlookup extends Controller {

	function giro_inlookup()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('giroin');
$this->db->join('customer', 'customer.id = giroin.customer_id', 'left');
$this->db->join('currency', 'currency.id = giroin.currency_id', 'left');
$this->db->join('coa', 'coa.id = giroin.coa_id', 'left');
$this->db->where('giroin.disabled = 0');
$this->db->select('customer.firstname as customer__firstname', false);
$this->db->select('giroin.customer_id as giroin__customer_id', false);
$this->db->select('currency.name as currency__name', false);
$this->db->select('giroin.currency_id as giroin__currency_id', false);
$this->db->select('coa.name as coa__name', false);
$this->db->select('giroin.coa_id as giroin__coa_id', false);
$this->db->select('giroin.id as id', false);
$this->db->select('giroin.giroinid as giroin__giroinid', false);
$this->db->select('DATE_FORMAT(giroin.createdate, "%d-%m-%Y") as giroin__createdate', false);
$this->db->select('giroin.amount as giroin__amount', false);
$this->db->select('giroin.amountused as giroin__amountused', false);
$this->db->select('giroin.notes as giroin__notes', false);
$this->db->select('giroin.usedflag as giroin__usedflag', false);
$this->db->select('giroin.lastupdate as giroin__lastupdate', false);
$this->db->select('giroin.updatedby as giroin__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "giroin.giroinid like '%".$_POST['searchtext']."%'";$where .= " || giroin.createdate like '%".$_POST['searchtext']."%'";$where .= " || customer.firstname like '%".$_POST['searchtext']."%'";$where .= " || currency.name like '%".$_POST['searchtext']."%'";$where .= " || giroin.amount like '%".$_POST['searchtext']."%'";$where .= " || giroin.amountused like '%".$_POST['searchtext']."%'";$where .= " || coa.name like '%".$_POST['searchtext']."%'";$where .= " || giroin.notes like '%".$_POST['searchtext']."%'";$where .= " || giroin.usedflag like '%".$_POST['searchtext']."%'";$where .= " || giroin.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || giroin.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('giroin__giroinid', 'asc');
$this->db->order_by('giroin__lastupdate', 'desc');
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
		
		$data['fields'] = array('giroin__giroinid' => 'Giro ID', 'giroin__createdate' => 'Creation Date', 'customer__firstname' => 'Customer', 'currency__name' => 'Currency', 'giroin__amount' => 'Amount', 'giroin__amountused' => 'Amount Used', 'coa__name' => 'Account', 'giroin__notes' => 'Notes', 'giroin__usedflag' => 'Used', 'giroin__lastupdate' => 'Last Update', 'giroin__updatedby' => 'Last Update By');
		
		if (count($_POST) == 0)
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
		$this->load->view('giro_in_lookup_view', $data);
	}
}

?>