<?php

class rcnlookup extends Controller {

	function rcnlookup()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('rcn');
$this->db->join('customer', 'customer.id = rcn.customer_id', 'left');
$this->db->where('rcn.disabled = 0');
$this->db->select('customer.firstname as customer__firstname', false);
$this->db->select('rcn.customer_id as rcn__customer_id', false);
$this->db->select('rcn.id as id', false);
$this->db->select('rcn.norif as rcn__norif', false);
$this->db->select('rcn.norcn as rcn__norcn', false);
$this->db->select('rcn.customerponumber as rcn__customerponumber', false);
$this->db->select('DATE_FORMAT(rcn.datercn, "%d-%m-%Y") as rcn__datercn', false);
$this->db->select('rcn.reqtorecover as rcn__reqtorecover', false);
$this->db->select('rcn.reqcoretoreturn as rcn__reqcoretoreturn', false);
$this->db->select('rcn.reqreturnunused as rcn__reqreturnunused', false);
$this->db->select('rcn.reqreturnfaulty as rcn__reqreturnfaulty', false);
$this->db->select('rcn.reqothers as rcn__reqothers', false);
$this->db->select('rcn.notes as rcn__notes', false);
$this->db->select('rcn.status as rcn__status', false);
$this->db->select('rcn.totalrollerscollected as rcn__totalrollerscollected', false);
$this->db->select('rcn.lastupdate as rcn__lastupdate', false);
$this->db->select('rcn.updatedby as rcn__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "rcn.norif like '%".$_POST['searchtext']."%'";$where .= " || rcn.norcn like '%".$_POST['searchtext']."%'";$where .= " || rcn.customerponumber like '%".$_POST['searchtext']."%'";$where .= " || rcn.datercn like '%".$_POST['searchtext']."%'";$where .= " || customer.firstname like '%".$_POST['searchtext']."%'";$where .= " || rcn.reqtorecover like '%".$_POST['searchtext']."%'";$where .= " || rcn.reqcoretoreturn like '%".$_POST['searchtext']."%'";$where .= " || rcn.reqreturnunused like '%".$_POST['searchtext']."%'";$where .= " || rcn.reqreturnfaulty like '%".$_POST['searchtext']."%'";$where .= " || rcn.reqothers like '%".$_POST['searchtext']."%'";$where .= " || rcn.notes like '%".$_POST['searchtext']."%'";$where .= " || rcn.status like '%".$_POST['searchtext']."%'";$where .= " || rcn.totalrollerscollected like '%".$_POST['searchtext']."%'";$where .= " || rcn.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || rcn.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('rcn__norif', 'asc');
$this->db->order_by('rcn__datercn', 'desc');
$this->db->order_by('rcn__lastupdate', 'desc');
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
		
		$data['fields'] = array('rcn__norif' => 'No RIF', 'rcn__norcn' => 'No RCN', 'rcn__customerponumber' => 'No PO', 'rcn__datercn' => 'Date', 'customer__firstname' => 'Customer', 'rcn__reqtorecover' => 'Roller to Recover', 'rcn__reqcoretoreturn' => 'Exchange Core to Return', 'rcn__reqreturnunused' => 'Roller Return Unused', 'rcn__reqreturnfaulty' => 'Roller Returned Faulty', 'rcn__reqothers' => 'Others', 'rcn__notes' => 'Notes', 'rcn__status' => 'Status', 'rcn__totalrollerscollected' => 'Total Rollers Collected', 'rcn__lastupdate' => 'Last Update', 'rcn__updatedby' => 'Last Update By');
		
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
		$this->load->view('rcn_lookup_view', $data);
	}
}

?>