<?php

class marketing_officerlookup extends Controller {

	function marketing_officerlookup()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('marketingofficer');
$this->db->where('marketingofficer.disabled = 0');
$this->db->select('marketingofficer.id as id', false);
$this->db->select('marketingofficer.idstring as marketingofficer__idstring', false);
$this->db->select('marketingofficer.name as marketingofficer__name', false);
$this->db->select('marketingofficer.notes as marketingofficer__notes', false);
$this->db->select('marketingofficer.lastupdate as marketingofficer__lastupdate', false);
$this->db->select('marketingofficer.updatedby as marketingofficer__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "marketingofficer.idstring like '%".$_POST['searchtext']."%'";$where .= " || marketingofficer.name like '%".$_POST['searchtext']."%'";$where .= " || marketingofficer.notes like '%".$_POST['searchtext']."%'";$where .= " || marketingofficer.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || marketingofficer.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('marketingofficer__idstring', 'asc');
$this->db->order_by('marketingofficer__lastupdate', 'desc');
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
		
		$data['fields'] = array('marketingofficer__idstring' => 'ID', 'marketingofficer__name' => 'Officer Name', 'marketingofficer__notes' => 'Notes', 'marketingofficer__lastupdate' => 'Last Update', 'marketingofficer__updatedby' => 'Last Update By');
		
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
		$this->load->view('marketing_officer_lookup_view', $data);
	}
}

?>