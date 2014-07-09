<?php

class riflist extends Controller {

	function riflist()
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
$this->db->select('DATE_FORMAT(rcn.incomingrolldate, "%d-%m-%Y") as rcn__incomingrolldate', false);
$this->db->select('rcn.incomingrolltime as rcn__incomingrolltime', false);
$this->db->select('DATE_FORMAT(rcn.identificationdate, "%d-%m-%Y") as rcn__identificationdate', false);
$this->db->select('rcn.identificationtime as rcn__identificationtime', false);
$this->db->select('rcn.press as rcn__press', false);
$this->db->select('rcn.nodiss as rcn__nodiss', false);
$this->db->select('rcn.datercn as rcn__datercn', false);
$this->db->select('rcn.totalrollerscollected as rcn__totalrollerscollected', false);
$this->db->select('rcn.lastupdate as rcn__lastupdate', false);
$this->db->select('rcn.updatedby as rcn__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "rcn.norif like '%".$_POST['searchtext']."%'";$where .= " || rcn.incomingrolldate like '%".$_POST['searchtext']."%'";$where .= " || rcn.incomingrolltime like '%".$_POST['searchtext']."%'";$where .= " || rcn.identificationdate like '%".$_POST['searchtext']."%'";$where .= " || rcn.identificationtime like '%".$_POST['searchtext']."%'";$where .= " || rcn.press like '%".$_POST['searchtext']."%'";$where .= " || customer.firstname like '%".$_POST['searchtext']."%'";$where .= " || rcn.nodiss like '%".$_POST['searchtext']."%'";$where .= " || rcn.datercn like '%".$_POST['searchtext']."%'";$where .= " || rcn.totalrollerscollected like '%".$_POST['searchtext']."%'";$where .= " || rcn.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || rcn.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('rcn__norif', 'asc');
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
		$data['perpage'] = 20;
		
		$data['sortby'] = array();$data['sortdirection'] = array();
		if (isset($_POST['sortby'])) $data['sortby'] = $_POST['sortby'];
		if (isset($_POST['sortdirection'])) $data['sortdirection'] = $_POST['sortdirection'];
		
		$data['fields'] = array('rcn__norif' => 'No RIF', 'rcn__incomingrolldate' => 'Date of Incoming Roll', 'rcn__incomingrolltime' => 'Time of Incoming Roll', 'rcn__identificationdate' => 'Date of Identification', 'rcn__identificationtime' => 'Time of Identification', 'rcn__press' => 'Press', 'customer__firstname' => 'Customer', 'rcn__nodiss' => 'No Diss', 'rcn__datercn' => 'Date RCN', 'rcn__totalrollerscollected' => 'Total Rollers Collected', 'rcn__lastupdate' => 'Last Update', 'rcn__updatedby' => 'Last Update By');
		
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
		$this->load->view('rif_list_view', $data);
	}
}

?>