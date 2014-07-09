<?php

class giro_in_clearancelist extends Controller {

	function giro_in_clearancelist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('giroinclearance');
$this->db->where('giroinclearance.disabled = 0');
$this->db->select('giroinclearance.id as id', false);
$this->db->select('DATE_FORMAT(giroinclearance.date, "%d-%m-%Y") as giroinclearance__date', false);
$this->db->select('giroinclearance.idstring as giroinclearance__idstring', false);
$this->db->select('giroinclearance.notes as giroinclearance__notes', false);
$this->db->select('giroinclearance.lastupdate as giroinclearance__lastupdate', false);
$this->db->select('giroinclearance.updatedby as giroinclearance__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "giroinclearance.date like '%".$_POST['searchtext']."%'";$where .= " || giroinclearance.idstring like '%".$_POST['searchtext']."%'";$where .= " || giroinclearance.notes like '%".$_POST['searchtext']."%'";$where .= " || giroinclearance.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || giroinclearance.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('giroinclearance__date', 'asc');
$this->db->order_by('giroinclearance__date', 'desc');
$this->db->order_by('giroinclearance__lastupdate', 'desc');
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
		
		$data['fields'] = array('giroinclearance__date' => 'Date', 'giroinclearance__idstring' => 'ID', 'giroinclearance__notes' => 'Notes', 'giroinclearance__lastupdate' => 'Last Update', 'giroinclearance__updatedby' => 'Last Update By');
		
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
		$this->load->view('giro_in_clearance_list_view', $data);
	}
}

?>