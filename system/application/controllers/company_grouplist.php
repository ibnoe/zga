<?php

class company_grouplist extends Controller {

	function company_grouplist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('customergroup');
$this->db->where('customergroup.disabled = 0');
$this->db->select('customergroup.id as id', false);
$this->db->select('customergroup.idstring as customergroup__idstring', false);
$this->db->select('customergroup.name as customergroup__name', false);
$this->db->select('customergroup.notes as customergroup__notes', false);
$this->db->select('customergroup.lastupdate as customergroup__lastupdate', false);
$this->db->select('customergroup.updatedby as customergroup__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "customergroup.idstring like '%".$_POST['searchtext']."%'";$where .= " || customergroup.name like '%".$_POST['searchtext']."%'";$where .= " || customergroup.notes like '%".$_POST['searchtext']."%'";$where .= " || customergroup.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || customergroup.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('customergroup__idstring', 'asc');
$this->db->order_by('customergroup__lastupdate', 'desc');
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
		
		$data['fields'] = array('customergroup__idstring' => 'ID', 'customergroup__name' => 'Group Name', 'customergroup__notes' => 'Notes', 'customergroup__lastupdate' => 'Last Update', 'customergroup__updatedby' => 'Last Update By');
		
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
		$this->load->view('company_group_list_view', $data);
	}
}

?>