<?php

class manufacturing_order_historylist extends Controller {

	function manufacturing_order_historylist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('manufacturingorderdone');
$this->db->where('manufacturingorderdone.disabled = 0');
$this->db->select('manufacturingorderdone.id as id', false);
$this->db->select('manufacturingorderdone.idstring as manufacturingorderdone__idstring', false);
$this->db->select('DATE_FORMAT(manufacturingorderdone.date, "%d-%m-%Y") as manufacturingorderdone__date', false);
$this->db->select('manufacturingorderdone.notes as manufacturingorderdone__notes', false);
$this->db->select('manufacturingorderdone.lastupdate as manufacturingorderdone__lastupdate', false);
$this->db->select('manufacturingorderdone.updatedby as manufacturingorderdone__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "manufacturingorderdone.idstring like '%".$_POST['searchtext']."%'";$where .= " || manufacturingorderdone.date like '%".$_POST['searchtext']."%'";$where .= " || manufacturingorderdone.notes like '%".$_POST['searchtext']."%'";$where .= " || manufacturingorderdone.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || manufacturingorderdone.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('manufacturingorderdone__idstring', 'asc');
$this->db->order_by('manufacturingorderdone__date', 'desc');
$this->db->order_by('manufacturingorderdone__lastupdate', 'desc');
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
		
		$data['fields'] = array('manufacturingorderdone__idstring' => 'ID', 'manufacturingorderdone__date' => 'Date', 'manufacturingorderdone__notes' => 'Notes', 'manufacturingorderdone__lastupdate' => 'Last Update', 'manufacturingorderdone__updatedby' => 'Last Update By');
		
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
		$this->load->view('manufacturing_order_history_list_view', $data);
	}
}

?>