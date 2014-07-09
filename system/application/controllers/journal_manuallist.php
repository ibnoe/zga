<?php

class journal_manuallist extends Controller {

	function journal_manuallist()
	{
		parent::Controller();	
		
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('generallib');
	}
	
	function _qhelp($data, $edit_module_id)
	{
		$this->db->from('journalmanual');
$this->db->where('journalmanual.disabled = 0');
$this->db->select('journalmanual.id as id', false);
$this->db->select('journalmanual.reference as journalmanual__reference', false);
$this->db->select('DATE_FORMAT(journalmanual.date, "%d-%m-%Y") as journalmanual__date', false);
$this->db->select('journalmanual.notes as journalmanual__notes', false);
$this->db->select('journalmanual.lastupdate as journalmanual__lastupdate', false);
$this->db->select('journalmanual.updatedby as journalmanual__updatedby', false);
		
		if (isset($_POST['searchtext']) && $_POST['searchtext'] != "")
		{
			$where = "";
			
			//$where .= "db.field like '".$_POST['searchtext']."'";
			//$where .= " || db.field like '".$_POST['searchtext']."'";
			
			$where .= "journalmanual.reference like '%".$_POST['searchtext']."%'";$where .= " || journalmanual.date like '%".$_POST['searchtext']."%'";$where .= " || journalmanual.notes like '%".$_POST['searchtext']."%'";$where .= " || journalmanual.lastupdate like '%".$_POST['searchtext']."%'";$where .= " || journalmanual.updatedby like '%".$_POST['searchtext']."%'";
			
			$where = "(".$where.")";
			
			$this->db->where($where);
		}
		
		if (!isset($_POST['sortby']))
		{
			
$this->db->order_by('journalmanual__reference', 'asc');
$this->db->order_by('journalmanual__date', 'desc');
$this->db->order_by('journalmanual__lastupdate', 'desc');
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
		
		$data['fields'] = array('journalmanual__reference' => 'Reference', 'journalmanual__date' => 'Date', 'journalmanual__notes' => 'Notes', 'journalmanual__lastupdate' => 'Last Update', 'journalmanual__updatedby' => 'Last Update By');
		
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
		$this->load->view('journal_manual_list_view', $data);
	}
}

?>