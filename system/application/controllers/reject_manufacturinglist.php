<?php

class reject_manufacturinglist extends Controller {

	function reject_manufacturinglist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('rejectmanufacturing');
$this->db->join('manufacturingrejectreason', 'manufacturingrejectreason.id = rejectmanufacturing.manufacturingrejectreason_id', 'left');
$this->db->where('rejectmanufacturing.disabled = 0');
$this->db->select('manufacturingrejectreason.name as manufacturingrejectreason__name', false);
$this->db->select('rejectmanufacturing.manufacturingrejectreason_id as rejectmanufacturing__manufacturingrejectreason_id', false);
$this->db->select('rejectmanufacturing.id as id', false);
$this->db->select('rejectmanufacturing.idstring as rejectmanufacturing__idstring', false);
$this->db->select('DATE_FORMAT(rejectmanufacturing.date, "%d-%m-%Y") as rejectmanufacturing__date', false);
$this->db->select('rejectmanufacturing.notes as rejectmanufacturing__notes', false);
$this->db->select('rejectmanufacturing.lastupdate as rejectmanufacturing__lastupdate', false);
$this->db->select('rejectmanufacturing.updatedby as rejectmanufacturing__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "rejectmanufacturing.idstring like '%".$_POST['searchtext']."%'";$where .= " || rejectmanufacturing.date like '%".$_POST['searchtext']."%'";$where .= " || manufacturingrejectreason.name like '%".$_POST['searchtext']."%'";$where .= " || rejectmanufacturing.notes like '%".$_POST['searchtext']."%'";$where .= " || rejectmanufacturing.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || rejectmanufacturing.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('rejectmanufacturing__idstring', 'asc');
$this->db->order_by('rejectmanufacturing__date', 'desc');
$this->db->order_by('rejectmanufacturing__lastupdate', 'desc');
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
		
		$data['fields'] = array('rejectmanufacturing__idstring' => 'ID', 'rejectmanufacturing__date' => 'Date', 'manufacturingrejectreason__name' => 'Manufacturing Reject Reason', 'rejectmanufacturing__notes' => 'Notes', 'rejectmanufacturing__lastupdate' => 'Last Update', 'rejectmanufacturing__updatedby' => 'Last Update By');
		
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
		$this->load->view('reject_manufacturing_list_view', $data);
	}
}

?>