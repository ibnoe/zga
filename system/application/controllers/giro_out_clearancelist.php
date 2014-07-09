<?php

class giro_out_clearancelist extends Controller {

	function giro_out_clearancelist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('girooutclearance');
$this->db->where('girooutclearance.disabled = 0');
$this->db->select('girooutclearance.id as id', false);
$this->db->select('DATE_FORMAT(girooutclearance.date, "%d-%m-%Y") as girooutclearance__date', false);
$this->db->select('girooutclearance.idstring as girooutclearance__idstring', false);
$this->db->select('girooutclearance.notes as girooutclearance__notes', false);
$this->db->select('girooutclearance.lastupdate as girooutclearance__lastupdate', false);
$this->db->select('girooutclearance.updatedby as girooutclearance__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "girooutclearance.date like '%".$_POST['searchtext']."%'";$where .= " || girooutclearance.idstring like '%".$_POST['searchtext']."%'";$where .= " || girooutclearance.notes like '%".$_POST['searchtext']."%'";$where .= " || girooutclearance.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || girooutclearance.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('girooutclearance__date', 'asc');
$this->db->order_by('girooutclearance__date', 'desc');
$this->db->order_by('girooutclearance__lastupdate', 'desc');
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
		
		$data['fields'] = array('girooutclearance__date' => 'Date', 'girooutclearance__idstring' => 'ID', 'girooutclearance__notes' => 'Notes', 'girooutclearance__lastupdate' => 'Last Update', 'girooutclearance__updatedby' => 'Last Update By');
		
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
		$this->load->view('giro_out_clearance_list_view', $data);
	}
}

?>